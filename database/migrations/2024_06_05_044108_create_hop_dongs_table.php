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
        Schema::create('hop_dongs', function (Blueprint $table) {
            $table->id('SoHopDong');
            $table->unsignedBigInteger('MaLoaiHopDong');
            $table->unsignedBigInteger('MaNV');
            $table->date('NgayLapHopDong');
            $table->string('NoiDungHopDong');
            $table->timestamps();

            // Khóa ngoại
            $table->foreign('MaNV')->references('MaNV')->on('nhan_viens')->onDelete('cascade');
            $table->foreign('MaLoaiHopDong')->references('MaLoaiHopDong')->on('loai_hop_dongs')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hop_dongs');
    }
};
