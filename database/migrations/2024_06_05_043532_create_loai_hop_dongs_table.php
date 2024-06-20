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
        Schema::create('loai_hop_dongs', function (Blueprint $table) {
            $table->id('MaLoaiHopDong');
            $table->string('TenLoaiHopDong');
            $table->string('ThoiHanHopDong');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('loai_hop_dongs');
    }
};
