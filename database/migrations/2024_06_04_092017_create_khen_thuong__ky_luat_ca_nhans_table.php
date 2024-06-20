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
        Schema::create('khen_thuong__ky_luat_ca_nhans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('SoQuyetDinhKhenThuong_KyLuat');
            $table->unsignedBigInteger('MaNV');
            $table->string('SoTienKhenThuong_KyLuatCaNhan');
            $table->timestamps();

            // Khóa ngoại
            $table->foreign('MaNV')->references('MaNV')->on('nhan_viens')->onDelete('cascade');
            $table->foreign('SoQuyetDinhKhenThuong_KyLuat','sqdktklcanhan')->references('SoQuyetDinhKhenThuong_KyLuat')->on('quyet_dinh_khen_thuong__ky_luats')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('khen_thuong__ky_luat_ca_nhans');
    }
};
