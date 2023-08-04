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
        Schema::create('personal_informations_users', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->cascadeOnDelete();
            $table->unsignedBigInteger('congregacao_id');
            $table->foreign('congregacao_id')->references('id')->on('congregacaos')->cascadeOnDelete()->nullable();
            $table->string('cep');
            $table->string('street');
            $table->string('district');
            $table->string('city');
            $table->string('state');
            $table->string('number_home');
            $table->string('telephone');
            $table->date('birth');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('personal_informations_users');
    }
};
