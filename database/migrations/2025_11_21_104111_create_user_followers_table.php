<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('user_followers', function (Blueprint $table) {

            // ID do usuário que está sendo seguido (o perfil)
            $table->foreignId('user_id')
                ->constrained('users')
                ->onDelete('cascade');

            // ID do usuário que segue (seguidor)
            $table->foreignId('follower_id')
                ->constrained('users')
                ->onDelete('cascade');

            // definir as duas tabelas como chave primária composta
            $table->primary(['user_id', 'follower_id']);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_followers');
    }
};
