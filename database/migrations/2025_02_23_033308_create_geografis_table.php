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
        Schema::create('geografis', function (Blueprint $table) {
            $table->id();
            $table->decimal('luas_wilayah', 10, 2);
            $table->string('batas_utara');
            $table->string('batas_selatan');
            $table->string('batas_timur');
            $table->string('batas_barat');
            $table->decimal('radius_kecamatan', 10, 2);
            $table->decimal('radius_kabupaten', 10, 2);
            $table->decimal('radius_provinsi', 10, 2);
            $table->decimal('radius_negara', 10, 2);

            
            $table->unsignedBigInteger('desa_id');
            $table->foreign('desa_id')->references('id')->on('desas')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('geografis');
    }
};
