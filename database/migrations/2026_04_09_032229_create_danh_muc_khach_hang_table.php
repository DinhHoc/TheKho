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
        Schema::create('danh_muc_khach_hang', function (Blueprint $table) {
            $table->id();
            $table->string('ma_khach');
            $table->string('ten_khach_hang');
            $table->string('dia_chi');
            $table->string('ma_so_thue');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('danh_muc_khach_hang');
    }
};
