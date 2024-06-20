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
        Schema::create('thong_tin_cham_congs', function (Blueprint $table) {
            $table->id('id');
            $table->unsignedBigInteger('MaNV');
            $table->time('Checkin')->nullable();
            $table->time('Checkout')->nullable();
            $table->date('NgayChamCong')->nullable();
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
        Schema::dropIfExists('thong_tin_cham_congs');
    }
};
