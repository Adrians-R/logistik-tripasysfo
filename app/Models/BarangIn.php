<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BarangIn extends Model
{
    use HasFactory;

    // Kolom yang boleh diisi secara massal
    protected $fillable = [
        'barang_in_id',
        'kode_barang',
        'qty',
        'origin',
        'status',
        'tgl_masuk',
    ];

    protected $casts = [
        'tgl_masuk' => 'datetime', // otomatis jadi Carbon instance
    ];

    public function barang()
    {
        return $this->belongsTo(Barang::class, 'kode_barang', 'kode_barang');
    }
}
