<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('mentorings', function (Blueprint $table) {
            $table->id();

            // Employee yang di-mentoring
            $table->string('employee_id');
            $table->unsignedTinyInteger('score')->nullable();

            // Nama pengisi / mentor
            $table->string('mentor_name');

            // Store tempat mentoring
            $table->string('store_id');

            // Catatan mentoring
            $table->text('notes')->nullable();

            $table->timestamps();

            // Foreign key ke employees
            $table->foreign('employee_id')
                ->references('employee_id')
                ->on('employees')
                ->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('mentorings');
    }
};
