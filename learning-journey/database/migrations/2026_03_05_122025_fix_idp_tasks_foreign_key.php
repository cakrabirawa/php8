<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('idp_tasks', function (Blueprint $table) {

            // drop FK lama
            $table->dropForeign(['idp_id']);

            // buat FK baru
            $table->foreign('idp_id')
                ->references('id')
                ->on('individual_development_plans')
                ->cascadeOnDelete();

        });
    }

    public function down(): void
    {
        Schema::table('idp_tasks', function (Blueprint $table) {

            $table->dropForeign(['idp_id']);

            $table->foreign('idp_id')
                ->references('id')
                ->on('unused')
                ->cascadeOnDelete();

        });
    }
};