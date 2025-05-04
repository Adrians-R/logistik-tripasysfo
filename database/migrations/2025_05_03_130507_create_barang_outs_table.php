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
        Schema::create('barang_outs', function (Blueprint $table) {
            $table->id();
            $table->string('barang_out_id')->unique();
            $table->string('kode_barang');
            $table->integer('qty');
            $table->boolean('status');
            $table->string('destination');
            $table->date('tgl_keluar');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('barang_outs');
    }
};
