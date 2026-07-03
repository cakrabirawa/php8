<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('mentorings', function (Blueprint $table) {
            $table->string('status')
                  ->default('pending')
                  ->after('notes'); // letakkan setelah notes
        });
    }

    public function down()
    {
        Schema::table('mentorings', function (Blueprint $table) {
            $table->dropColumn('status');
        });
    }
};
