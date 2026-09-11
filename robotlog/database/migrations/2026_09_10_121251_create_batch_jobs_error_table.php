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
        Schema::create('robot_job_logs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('batch_job_id')->index('batch_job_id_index');
            $table->string('company', 50);
            $table->string('status', 50);
            $table->text('caption')->nullable();
            $table->dateTime('start_date_time')->nullable();
            $table->dateTime('end_date_time')->nullable();
            $table->text('info')->nullable();
            $table->string('invoice_no')->nullable()->index('invoice_no_index');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('robot_job_logs');
    }
};
