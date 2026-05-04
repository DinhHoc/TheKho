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
        Schema::create('phieu_nhap', function (Blueprint $table) {
            $table->id()->primary();
            $table->string('ma_khach');
            $table->string('ten_khach_hang');
            $table->date('ngay_nhap');
            $table->string('so_phieu_nhap');
            $table->string('ma_hang');
            $table->string('ten_mat_hang');
            $table->string('dvt');
            $table->string('ma_kho');
            $table->string('ma_lo');
            $table->integer('so_luong');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('phieu_nhap');
    }
};
