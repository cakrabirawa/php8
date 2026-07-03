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
        Schema::create('checklist_templates', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('month'); // 1 - 6
            $table->unsignedInteger('week');  // 1 - 4
            $table->json('template_json');    // item checklist JSON
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('checklist_templates');
    }
};
