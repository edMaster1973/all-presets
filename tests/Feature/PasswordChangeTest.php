<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;

class PasswordChangeTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Testa se a página de alteração de senha pode ser acessada.
     *
     * @return void
     */
    public function test_password_change_page_can_be_displayed()
    {
        $user = User::factory()->create();

        $response = $this
            ->actingAs($user)
            ->get(route('password.change.form'));

        $response->assertStatus(200);
        $response->assertViewIs('auth.change-password');
    }

    /**
     * Testa se a senha pode ser alterada com dados válidos.
     *
     * @return void
     */
    public function test_password_can_be_changed_with_valid_data()
    {
        $user = User::factory()->create([
            'password' => Hash::make('OldPassword123!'),
        ]);

        $response = $this
            ->actingAs($user)
            ->post(route('password.change.update'), [
                'current_password' => 'OldPassword123!',
                'new_password' => 'NewPassword456@',
                'new_password_confirmation' => 'NewPassword456@',
            ]);

        $response->assertRedirect(route('password.change.form'));
        $response->assertSessionHas('success', 'Senha alterada com sucesso!');

        // Verifica se a senha foi atualizada no banco de dados
        $this->assertTrue(
            Hash::check('NewPassword456@', $user->fresh()->password)
        );
    }

    /**
     * Testa se a senha atual incorreta resulta em erro.
     *
     * @return void
     */
    public function test_current_password_must_be_correct()
    {
        $user = User::factory()->create([
            'password' => Hash::make('CorrectPassword123!'),
        ]);

        $response = $this
            ->actingAs($user)
            ->post(route('password.change.update'), [
                'current_password' => 'WrongPassword123!',
                'new_password' => 'NewPassword456@',
                'new_password_confirmation' => 'NewPassword456@',
            ]);

        $response->assertSessionHasErrors('current_password');
    }

    /**
     * Testa se a nova senha deve ser diferente da atual.
     *
     * @return void
     */
    public function test_new_password_must_be_different_from_current()
    {
        $user = User::factory()->create([
            'password' => Hash::make('SamePassword123!'),
        ]);

        $response = $this
            ->actingAs($user)
            ->post(route('password.change.update'), [
                'current_password' => 'SamePassword123!',
                'new_password' => 'SamePassword123!',
                'new_password_confirmation' => 'SamePassword123!',
            ]);

        $response->assertSessionHasErrors('new_password');
    }

    /**
     * Testa se a confirmação da senha deve corresponder.
     *
     * @return void
     */
    public function test_new_password_must_be_confirmed()
    {
        $user = User::factory()->create([
            'password' => Hash::make('OldPassword123!'),
        ]);

        $response = $this
            ->actingAs($user)
            ->post(route('password.change.update'), [
                'current_password' => 'OldPassword123!',
                'new_password' => 'NewPassword456@',
                'new_password_confirmation' => 'DifferentPassword789#',
            ]);

        $response->assertSessionHasErrors('new_password');
    }

    /**
     * Testa se a senha deve atender aos requisitos mínimos.
     *
     * @return void
     */
    public function test_new_password_must_meet_requirements()
    {
        $user = User::factory()->create([
            'password' => Hash::make('OldPassword123!'),
        ]);

        // Senha muito curta
        $response = $this
            ->actingAs($user)
            ->post(route('password.change.update'), [
                'current_password' => 'OldPassword123!',
                'new_password' => 'Short1!',
                'new_password_confirmation' => 'Short1!',
            ]);

        $response->assertSessionHasErrors('new_password');
    }

    /**
     * Testa se usuários não autenticados não podem acessar a página.
     *
     * @return void
     */
    public function test_unauthenticated_users_cannot_access_password_change()
    {
        $response = $this->get(route('password.change.form'));

        $response->assertRedirect('/login');
    }
}
