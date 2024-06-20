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
        Schema::create('nhan_viens', function (Blueprint $table) {
            $table->id('MaNV');
            $table->string('TenNV');
            $table->string('GioiTinh');
            $table->date('NgaySinh');
            $table->string('DiaChiNV');
            $table->string('DienThoaiNV');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nhan_viens');
    }
};
