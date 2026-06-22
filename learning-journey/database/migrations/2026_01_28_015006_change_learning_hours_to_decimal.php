<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('employee_training_scores', function (Blueprint $table) {
            $table->decimal('learning_hours', 5, 2)
                  ->nullable()
                  ->change();
        });
    }

    public function down(): void
    {
        Schema::table('employee_training_scores', function (Blueprint $table) {
            $table->integer('learning_hours')
                  ->nullable()
                  ->change();
        });
    }
};
