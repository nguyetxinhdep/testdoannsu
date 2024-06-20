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
        Schema::create('messages', function (Blueprint $table) {
            $table->id('id');
            $table->unsignedBigInteger('adminid');
            $table->string('name');
            $table->string('message');
            $table->timestamps();

            // Khóa ngoại
            $table->foreign('adminid')->references('id')->on('users')->onDelete('cascade');
            // $table->foreign('MaChucVu')->references('MaChucVu')->on('chuc_vus')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('messages');
    }
};
