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
        Schema::create('phieu_ghi_nhan_phu_trois', function (Blueprint $table) {
            $table->id('SoPhieu');
            $table->date('NgayPhuTroi');
            $table->string('HinhThucPhuTroi');
            $table->decimal('HeSoPhuTroi', 5, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('phieu_ghi_nhan_phu_trois');
    }
};
