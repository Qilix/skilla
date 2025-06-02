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
        Schema::create('workers_ex_order_types', function (Blueprint $table) {
            $table->id();

            $table->foreignId('worker_id')->constrained('workers')->cascadeOnDelete();
            $table->foreignId('order_type_id')->constrained('order_types')->cascadeOnDelete();

            $table->timestamps();
            $table->softDeletes();

            $table->unique(['worker_id', 'order_type_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('workers_ex_order_types');
    }
};
