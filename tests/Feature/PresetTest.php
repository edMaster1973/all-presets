<?php

namespace Tests\Feature;

use App\Models\Preset;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PresetTest extends TestCase
{
    use RefreshDatabase;

    public function test_presets_screen_can_be_rendered(): void
    {
        $user = User::factory()->create();

        $response = $this
            ->actingAs($user)
            ->get('/presets');

        $response->assertOk();
    }

    public function test_user_can_create_preset(): void
    {
        $user = User::factory()->create();

        $response = $this
            ->actingAs($user)
            ->post('/presets', [
                'name' => 'My Rock Preset',
                'pedal_brand' => 'Boss',
                'pedal_model' => 'GT-1000',
                'description' => 'Perfect for rock songs',
                'settings' => 'Gain: 7, Treble: 6, Middle: 5, Bass: 6',
            ]);

        $response->assertRedirect('/presets');
        $this->assertDatabaseHas('presets', [
            'name' => 'My Rock Preset',
            'user_id' => $user->id,
        ]);
    }

    public function test_user_can_update_preset(): void
    {
        $user = User::factory()->create();
        $preset = Preset::factory()->create(['user_id' => $user->id]);

        $response = $this
            ->actingAs($user)
            ->put("/presets/{$preset->id}", [
                'name' => 'Updated Preset',
                'pedal_brand' => $preset->pedal_brand,
                'pedal_model' => $preset->pedal_model,
                'description' => 'Updated description',
                'settings' => 'New settings',
            ]);

        $response->assertRedirect('/presets');
        $this->assertDatabaseHas('presets', [
            'id' => $preset->id,
            'name' => 'Updated Preset',
        ]);
    }

    public function test_user_can_delete_preset(): void
    {
        $user = User::factory()->create();
        $preset = Preset::factory()->create(['user_id' => $user->id]);

        $response = $this
            ->actingAs($user)
            ->delete("/presets/{$preset->id}");

        $response->assertRedirect('/presets');
        $this->assertDatabaseMissing('presets', [
            'id' => $preset->id,
        ]);
    }

    public function test_user_cannot_update_other_users_preset(): void
    {
        $user = User::factory()->create();
        $otherUser = User::factory()->create();
        $preset = Preset::factory()->create(['user_id' => $otherUser->id]);

        $response = $this
            ->actingAs($user)
            ->put("/presets/{$preset->id}", [
                'name' => 'Hacked Preset',
                'pedal_brand' => 'Hacked',
                'pedal_model' => 'Hacked',
            ]);

        $response->assertForbidden();
    }
}
