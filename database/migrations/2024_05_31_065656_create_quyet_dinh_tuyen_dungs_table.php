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
        Schema::create('quyet_dinh_tuyen_dungs', function (Blueprint $table) {
            $table->bigIncrements('SoQuyetDinhTuyenDung');
            $table->date('NgayQuyetDinhTuyenDung');
            $table->text('ThoiGianThuViec')->nullable();
            $table->decimal('MucLuongThuViec', 10, 2)->nullable();
            $table->text('NoiDungQuyetDInhTuyenDung');
            $table->unsignedBigInteger('MaNV');
            $table->unsignedBigInteger('MaPhongBan');
            $table->timestamps();

            // Khóa ngoại đến bảng phòng ban
            $table->foreign('MaPhongBan')->references('MaPhongBan')->on('phong_bans')->onDelete('cascade');
            $table->foreign('MaNV')->references('MaNV')->on('nhan_viens')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('quyet_dinh_tuyen_dungs');
    }
};
