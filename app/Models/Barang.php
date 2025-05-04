<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;

    // Kolom yang boleh diisi secara massal
    protected $fillable = [
        'kode_barang',
        'nama_barang',
        'qty',
        'status',
        'description',
    ];

    public function barangIns()
    {
        return $this->hasMany(BarangIn::class, 'kode_barang', 'kode_barang');
    }

    public function barangOuts()
    {
        return $this->hasMany(BarangOut::class, 'kode_barang', 'kode_barang');
    }
}