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
        Schema::create('quyet_dinh_khen_thuong__ky_luats', function (Blueprint $table) {
            $table->id('SoQuyetDinhKhenThuong_KyLuat');
            $table->date('NgayQuyetDinhKhenThuong_KyLuat');
            $table->string('NoiDungQuyetDinhKhenThuong_KyLuat');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('quyet_dinh_khen_thuong__ky_luats');
    }
};
