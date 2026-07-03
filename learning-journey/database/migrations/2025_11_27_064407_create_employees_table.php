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
        Schema::create('employees', function (Blueprint $table) {
            $table->id();

            // Employee basic info
            $table->string('employee_id')->unique();
            $table->string('name');
            $table->enum('contract_type', ['Permanent', 'Contract']);

            // Foreign keys
            $table->foreignId('region_id')
                ->nullable()
                ->constrained()
                ->nullOnDelete();

            $table->foreignId('store_id')
                ->nullable()
                ->constrained()
                ->nullOnDelete();

            $table->foreignId('section_id')
                ->nullable()
                ->constrained()
                ->nullOnDelete();

            $table->foreignId('job_id')
                ->nullable()
                ->constrained()
                ->nullOnDelete();

            // Date attributes
            $table->date('birthday')->nullable();
            $table->date('initial_employment_date')->nullable();
            $table->date('joining_date')->nullable();
            $table->date('permanent_date')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
