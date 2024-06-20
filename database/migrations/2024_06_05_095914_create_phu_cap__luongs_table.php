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
        Schema::create('phu_cap__luongs', function (Blueprint $table) {
            $table->id('id');
            $table->unsignedBigInteger('SoQuyetDinhLuong');
            $table->unsignedBigInteger('MaPhuCap');
            $table->timestamps();

            // Khóa ngoại
            $table->foreign('MaPhuCap')->references('MaPhuCap')->on('phu_caps')->onDelete('cascade');
            $table->foreign('SoQuyetDinhLuong')->references('SoQuyetDinhLuong')->on('quyet_dinh_luongs')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('phu_cap__luongs');
    }
};
