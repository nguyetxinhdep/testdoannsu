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
        Schema::create('quyet_dinh_luongs', function (Blueprint $table) {
            $table->id('SoQuyetDinhLuong');
            $table->unsignedBigInteger('MaNV');
            $table->decimal('MucLuongCoBan', 15, 2);
            $table->date('NgayQuyetDinhLuong');
            $table->timestamps();

            // Khóa ngoại
            $table->foreign('MaNV')->references('MaNV')->on('nhan_viens')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('quyet_dinh_luongs');
    }
};
