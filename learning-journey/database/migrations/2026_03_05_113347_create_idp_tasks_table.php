<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('idp_tasks', function (Blueprint $table) {

            $table->id();

            $table->unsignedBigInteger('idp_id');            

            $table->foreign('idp_id')
            ->references('id')
            ->on('individual_development_plans')
            ->cascadeOnDelete();

            $table->text('task');
            $table->enum('category', [
            'knowledge','experiential_learning','mentoring'
            ]);


            $table->text('notes_ss')->nullable();
        
            $table->date('target_date')->nullable();

            $table->string('evidence_link')->nullable();

            $table->text('feedback_sm')->nullable();

            $table->text('feedback_hr')->nullable();
            
            $table->enum('status', [
                'pending',
                'ongoing',
                'completed'
            ])->default('pending');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('idp_tasks');
    }
};