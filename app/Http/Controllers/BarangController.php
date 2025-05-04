<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;

class BarangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $barangs = Barang::all();
        $barangs = Barang::paginate(10);
        return view('barangs.index', compact('barangs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('barangs.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'kode_barang' => 'required|unique:barangs,kode_barang',
            'nama_barang' => 'required',
            'qty' => 'required|integer|min:1',
            'status' => 'required|integer',
            'description' => 'nullable|string',
        ], [
            'kode_barang.required' => 'Kode Barang tidak boleh kosong.',
            'kode_barang.unique' => 'Kode Barang sudah digunakan, silakan gunakan kode lain.',
            'nama_barang.required' => 'Nama Barang tidak boleh kosong.',
            'qty.required' => 'Quantity tidak boleh kosong.',
            'qty.min' => 'Quantity tidak boleh 0.',
            'status.required' => 'Status tidak boleh kosong.',
        ]);

        Barang::create($request->all());
        return redirect()->route('barangs.index')->with('success', 'Barang berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Barang $barang)
    {
        return view('barangs.show', compact('barang'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Barang $barang)
    {
        return view('barangs.edit', compact('barang'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Barang $barang)
    {
        $request->validate([
            'kode_barang' => 'required|unique:barangs,kode_barang,'.$barang->id.',id',
            'nama_barang' => 'required',
            'qty' => 'required|integer|min:1',
            'status' => 'integer',
            'description' => 'nullable|string',
        ], [
            'kode_barang.required' => 'Kode Barang tidak boleh kosong.',
            'kode_barang.unique' => 'Kode Barang sudah digunakan oleh barang lain.',
            'nama_barang.required' => 'Nama Barang tidak boleh kosong.',
            'qty.required' => 'Quantity tidak boleh kosong.',
            'qty.min' => 'Quantity tidak boleh 0.',
            'status.required' => 'Status tidak boleh kosong.',
        ]);

        $barang->update($request->all());
        return redirect()->route('barangs.index')->with('success', 'Barang berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Barang $barang)
    {
        // Hapus relasi barangIn dan barangOut
        $barang->barangIns()->delete();
        $barang->barangOuts()->delete();

        // Hapus barang
        $barang->delete();

        return redirect()->route('barangs.index')->with('success', 'Barang dan semua data terkait berhasil dihapus');
    }
}
