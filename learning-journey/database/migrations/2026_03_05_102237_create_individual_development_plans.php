<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('individual_development_plans', function (Blueprint $table) {

            $table->id();

            $table->string('employee_id');
            $table->unsignedBigInteger('competency_id');

            // foreign key
            $table->foreign('competency_id')
                ->references('id')
                ->on('competencies')
                ->cascadeOnDelete();

            $table->unsignedTinyInteger('current_level');
            $table->unsignedTinyInteger('target_level');

            $table->text('target_idp');

            $table->string('mentor_name')->nullable();

            $table->date('first_meeting_date')->nullable();

            $table->enum('status', [
                'draft',
                'pending',
                'waiting_hr',
                'completed'
            ])->default('draft');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('individual_development_plans');
    }
};