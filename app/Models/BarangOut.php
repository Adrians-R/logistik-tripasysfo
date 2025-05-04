<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BarangOut extends Model
{
    use HasFactory;

    // Kolom yang boleh diisi secara massal
    protected $fillable = [
        'barang_out_id',
        'kode_barang',
        'qty',
        'destination',
        'status',
        'tgl_keluar',
    ];
    
    protected $casts = [
        'tgl_keluar' => 'datetime', // otomatis jadi Carbon instance
    ];

    public function barang()
    {
        return $this->belongsTo(Barang::class, 'kode_barang', 'kode_barang');
    }
}
