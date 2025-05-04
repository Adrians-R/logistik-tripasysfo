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
        Schema::create('barang_ins', function (Blueprint $table) {
            $table->id();
            $table->string('barang_in_id')->unique();
            $table->string('kode_barang');
            $table->integer('qty');
            $table->boolean('status');
            $table->string('origin');
            $table->date('tgl_masuk');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('barang_ins');
    }
};
