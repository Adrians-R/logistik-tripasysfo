<?php

namespace App\Http\Controllers;

use App\Models\BarangOut;
use App\Models\Barang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;

class BarangOutController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $barangOuts = BarangOut::paginate(10);
        return view('barangOuts.index', compact('barangOuts'));
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $barangs = Barang::all();
        return view('barangOuts.create', compact('barangs'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // $request->validate([
        //     'barang_out_id' => 'required|unique:barang_outs',
        //     'kode_barang' => 'required',
        //     'qty' => 'required|integer',
        //     'destination' => 'string',
        //     'status' => 'required|integer',
        //     'tgl_keluar' =>'date',
        // ], [
        //     'barang_out_id' => 'Kode Barang Masuk tidak boleh kosong.',
        //     'kode_barang.required' => 'Kode Barang tidak boleh kosong.',
        //     'qty.required' => 'Quantity tidak boleh kosong.',
        //     'origin.required' => 'Origin tidak boleh kosong.',
        //     'status.required' => 'Status tidak boleh kosong.',
        //     'tgl_masuk.required' => 'Tanggal Masuk tidak boleh kosong.',
        // ]);

        // BarangOut::create($request->all());

        // $barang = Barang::where('kode_barang', $request->kode_barang)->first();
        // $barang->qty = $barang->qty - $request->qty;
        // $barang->save();

        // return redirect()->route('barangOuts.index')->with('success', 'Barang berhasil ditambahkan');
        $request->validate([
            'barang_out_id' => 'required|unique:barang_outs,barang_out_id',
            'kode_barang' => 'required',
            'qty' => 'required|integer|min:1',
            'destination' => 'nullable|string',
            'status' => 'required|integer',
            'tgl_keluar' => 'required|date',
        ], [
            'barang_out_id.required' => 'Kode Barang Keluar tidak boleh kosong.',
            'barang_out_id.unique' => 'Kode Barang Keluar sudah digunakan oleh barang lain.',
            'kode_barang.required' => 'Kode Barang tidak boleh kosong.',
            'qty.required' => 'Quantity tidak boleh kosong.',
            'qty.min' => 'Quantity tidak boleh 0.',
            'status.required' => 'Status tidak boleh kosong.',
            'tgl_keluar.required' => 'Tanggal Keluar tidak boleh kosong.',
        ]);
    
        // Ambil barang dari kode_barang
        $barang = Barang::where('kode_barang', $request->kode_barang)->first();
    
        // Cek apakah barang ada dan qty mencukupi
        if (!$barang) {
            return back()->withErrors(['kode_barang' => 'Barang tidak ditemukan.'])->withInput();
        }
    
        if ($request->qty > $barang->qty) {
            return back()->withErrors(['qty' => 'Jumlah yang diminta melebihi stok yang tersedia (' . $barang->qty . ').'])->withInput();
        }
    
        // Simpan barang keluar
        BarangOut::create($request->all());
    
        // Kurangi stok barang
        $barang->qty -= $request->qty;
        $barang->save();
    
        return redirect()->route('barangOuts.index')->with('success', 'Barang berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(BarangOut $barangOut)
    {
        return view('barangOuts.show', compact('barangOuts'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, BarangOut $barangOut)
    {   
        $barangs = Barang::all(); 
        return view('barangOuts.edit', compact('barangOut','barangs'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, BarangOut $barangOut)
    {
        $request->validate([
            'barang_out_id' => 'required|unique:barang_outs,barang_out_id,'.$barangOut->id.',id',
            'kode_barang' => 'required',
            'qty' => 'required|integer|min:1',
            'destination' => 'nullable|string',
            'status' => 'required|integer',
            'tgl_keluar' => 'required|date',
        ], [
            'barang_out_id.required' => 'Kode Barang Keluar tidak boleh kosong.',
            'barang_out_id.unique' => 'Kode Barang Keluar sudah digunakan oleh barang lain.',
            'kode_barang.required' => 'Kode Barang tidak boleh kosong.',
            'qty.required' => 'Quantity tidak boleh kosong.',
            'qty.min' => 'Quantity tidak boleh 0.',
            'status.required' => 'Status tidak boleh kosong.',
            'tgl_keluar.required' => 'Tanggal Keluar tidak boleh kosong.',
        ]);
        $barang = Barang::where('kode_barang', $barangOut->kode_barang)->first();

        // Kembalikan qty lama ke stok
        if ($barang) {
            $barang->qty += $barangOut->qty;
        }

        // Validasi apakah qty baru melebihi stok
        if ($request->qty > $barang->qty) {
            return back()->withErrors(['qty' => 'Jumlah yang diminta melebihi stok yang tersedia (' . $barang->qty . ').'])->withInput();
        }

        // Update stok dengan qty baru
        $barang->qty -= $request->qty;
        $barang->save();

        // Update data barang keluar
        $barangOut->update($request->all());

        return redirect()->route('barangOuts.index')->with('success', 'Barang berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(BarangOut $barangOut)
    {
        $barang = Barang::where('kode_barang', $barangOut->kode_barang)->first();

        if ($barang) {
            $barang->qty = $barang->qty + $barangOut->qty;
            $barang->save();
        }

        $barangOut->delete();

        return redirect()->route('barangOuts.index')->with('success', 'Barang berhasil dihapus');
    }
}
