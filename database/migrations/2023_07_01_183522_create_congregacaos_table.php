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
        Schema::create('congregacaos', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->unsignedBigInteger('setor_id');
            $table->foreign('setor_id')->references('id')->on('setors')->cascadeOnDelete();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('congregacaos');
    }
};
