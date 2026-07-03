<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('employee_evaluations', function (Blueprint $table) {
            $table->decimal('business_score', 6, 2)->nullable()->after('employee_id');
            $table->decimal('behavior_score', 6, 2)->nullable()->after('business_score');
            $table->decimal('pa_score', 6, 2)->nullable()->after('behavior_score');
        });
    }

    public function down(): void
    {
        Schema::table('employee_evaluations', function (Blueprint $table) {
            $table->dropColumn([
                'business_score',
                'behavior_score',
                'pa_score',
            ]);
        });
    }
};
