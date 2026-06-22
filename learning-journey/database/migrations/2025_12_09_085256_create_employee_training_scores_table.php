<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('employee_training_scores', function (Blueprint $table) {
            $table->id();

            $table->string('employee_id');
            $table->foreign('employee_id')
                ->references('employee_id')
                ->on('employees')
                ->onDelete('cascade');

            // Scores 0–100
            $table->integer('gramedia_daily_store')->nullable();
            $table->integer('rso_supervisory_skill')->nullable();
            $table->integer('rso_retail_salesmanship')->nullable();
            $table->integer('rso_customer_service_loyalty')->nullable();
            $table->integer('rso_product_merchandising')->nullable();
            $table->integer('rso_visual_merchandising')->nullable();
            $table->integer('rso_retail_store_promotion')->nullable();
            $table->integer('rso_store_financial_perspective')->nullable();
            $table->integer('rso_store_general_checkup_strategy')->nullable();

            $table->integer('learning_hours')->nullable();
            $table->integer('nilai_ngecas')->nullable();

            // Free text fields
            $table->text('inhouse_training')->nullable();
            $table->text('public_training')->nullable();
            $table->text('intensive_training')->nullable();
            $table->text('development_program')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('employee_training_scores');
    }
};
