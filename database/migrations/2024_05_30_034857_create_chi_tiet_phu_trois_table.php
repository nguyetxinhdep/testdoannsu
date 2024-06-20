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
        Schema::create('chi_tiet_phu_trois', function (Blueprint $table) {
            $table->id('MaChiTiet');
            $table->unsignedBigInteger('MaNV');
            $table->unsignedBigInteger('SoPhieu');
            $table->integer('SoGio');
            $table->timestamps();

            // Khóa ngoại
            $table->foreign('MaNV')->references('MaNV')->on('nhan_viens')->onDelete('cascade');
            $table->foreign('SoPhieu')->references('SoPhieu')->on('phieu_ghi_nhan_phu_trois')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('chi_tiet_phu_trois');
    }
};
