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
        Schema::create('so_bao_hiems', function (Blueprint $table) {
            $table->id('MaSoBaoHiem');
            $table->unsignedBigInteger('MaNV');
            $table->date('NgayLapSoBaoHiem');
            $table->string('ThoiHanSoBaoHiem');
            $table->unsignedBigInteger('MaBaoHiem');
            $table->timestamps();

            // Khóa ngoại
            $table->foreign('MaNV')->references('MaNV')->on('nhan_viens')->onDelete('cascade');
            $table->foreign('MaBaoHiem')->references('MaBaoHiem')->on('bao_hiems')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('so_bao_hiems');
    }
};
