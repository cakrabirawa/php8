<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        // Tabel Menus (Mendukung Menu Dropdown Bertingkat)
        Schema::create('menus', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('route_name')->nullable(); // Nullable jika hanya menjadi induk dropdown
            $table->text('icon')->nullable();         // Nullable untuk sub-menu
            $table->unsignedBigInteger('parent_id')->nullable(); // Relasi ke menu induk
            $table->integer('order_no')->default(0);
            $table->timestamps();

            $table->foreign('parent_id')->references('id')->on('menus')->onDelete('cascade');
        });

        // Tabel Pivot Hak Akses (Role <=> Menu)
        Schema::create('role_menu', function (Blueprint $table) {
            $table->id();
            $table->string('role');
            $table->foreignId('menu_id')->constrained()->onDelete('cascade');

            $table->index(['role', 'menu_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('role_menu');
        Schema::dropIfExists('menus');
    }
};
