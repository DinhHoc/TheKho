<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('the_kho', function (Blueprint $table) {
            $table->id();

            // Thông tin thẻ
            $table->string('ma_hang');
            $table->string('ten_mat_hang');

            // 🔥 QUAN TRỌNG (fix lỗi của bạn)
            $table->date('ngay_bat_dau')->nullable();
            $table->date('ngay_ket_thuc')->nullable();

            // Ngày tạo
            $table->dateTime('ngay_tao')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('the_kho');
    }
};