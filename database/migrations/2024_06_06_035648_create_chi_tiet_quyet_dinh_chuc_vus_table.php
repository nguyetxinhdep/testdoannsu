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
        Schema::create('chi_tiet_quyet_dinh_chuc_vus', function (Blueprint $table) {
            $table->id('id');
            $table->unsignedBigInteger('SoQuyetDinhChucVu');
            $table->unsignedBigInteger('MaChucVu');
            $table->timestamps();

            // Khóa ngoại
            $table->foreign('SoQuyetDinhChucVu')->references('SoQuyetDinhChucVu')->on('quyet_dinh_chuc_vus')->onDelete('cascade');
            $table->foreign('MaChucVu')->references('MaChucVu')->on('chuc_vus')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('chi_tiet_quyet_dinh_chuc_vus');
    }
};
