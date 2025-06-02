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
        Schema::create('workers', function (Blueprint $table) {
            $table->id();

            $table->string('name', 50); //Имя
            $table->string('second_name', 50)->nullable(); //Отчество
            $table->string('surname', 50); //Фамилия
            $table->string('phone', 20)->unique();

            $table->timestamps();
            $table->softDeletes();

            $table->index(['surname', 'name']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('workers');
    }
};
