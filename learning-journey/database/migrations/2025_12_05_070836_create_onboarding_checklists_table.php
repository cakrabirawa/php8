<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('onboarding_checklists', function (Blueprint $table) {
            $table->id();

            $table->string('employee_id');
            $table->unsignedInteger('month');
            $table->unsignedInteger('week');
            $table->unsignedTinyInteger('score')->nullable();

            $table->json('checklist_json');

            $table->text('notes_store_manager')->nullable();

            $table->enum('status', ['draft','pending_sm','pending', 'approved', 'rejected'])->default('draft');
            $table->text('notes_hr')->nullable();
            $table->text('notes_ss')->nullable();

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('onboarding_checklists');
    }
};
