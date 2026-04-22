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
        Schema::create('scholarships', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description');
            $table->decimal('amount', 10, 2);
            $table->date('deadline');
            $table->text('requirements')->nullable();
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->string('category')->nullable();
            $table->integer('slots')->default(0);
            $table->integer('slots_filled')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('scholarships');
    }
};
