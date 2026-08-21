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
    Schema::table('robot_postings', function (Blueprint $table) {
      $table->string('final_status', 50)->nullable()->after('c_is_split_invoice_return');
      $table->timestamp('final_status_checked_date')->nullable()->after('final_status');
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::table('robot_postings', function (Blueprint $table) {
      $table->dropColumn(['final_status', 'final_status_checked_date']);
    });
  }
};
