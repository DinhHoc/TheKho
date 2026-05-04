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
        Schema::create('danh_muc_hang_hoa', function (Blueprint $table) {
            $table->id();
            $table->string('ma_hang');
            $table->string('ten_mat_hang');
            $table->string('dvt');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('danh_muc_hang_hoa');
    }
};
