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
        Schema::create('khen_thuong__ky_luat_tap_thes', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('SoQuyetDinhKhenThuong_KyLuat');
                $table->unsignedBigInteger('MaPhongBan');
                $table->string('SoTienKhenThuong_KyLuatTapThe');
                $table->timestamps();
    
                // Khóa ngoại
                $table->foreign('MaPhongBan')->references('MaPhongBan')->on('phong_bans')->onDelete('cascade');
                $table->foreign('SoQuyetDinhKhenThuong_KyLuat','sqdktkl')->references('SoQuyetDinhKhenThuong_KyLuat')->on('quyet_dinh_khen_thuong__ky_luats')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('khen_thuong__ky_luat_tap_thes');
    }
};
