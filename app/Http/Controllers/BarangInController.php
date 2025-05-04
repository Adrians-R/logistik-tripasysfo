<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\BarangIn;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;

class BarangInController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $barangIns = BarangIn::paginate(10);
        return view('barangIns.index', compact('barangIns'));
        
    }
    
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $barangs = Barang::all();
        return view('barangIns.create',compact('barangs'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // try {
        //     $request->validate([
        //         'barang_in_id' => 'required|unique:barang_ins',
        //         'kode_barang' => 'required',
        //         'qty' => 'required|integer',
        //         'origin' => 'string',
        //         'status' => 'integer',
        //         'tgl_masuk' =>'date',
        //     ]);

        //     BarangIn::create($request->all());

        //     $barang = Barang::where('kode_barang', $request->kode_barang)->first();
        //     $barang->qty = $barang->qty + $request->qty;
        //     $barang->save();

        //     return redirect()->route('barangIns.index')->with('success', 'Barang berhasil ditambahkan');
        // } catch (\Throwable $th) {
        //     dd($th);
        // }
        $request->validate([
            'barang_in_id' => 'required|unique:barang_ins,barang_in_id',
            'kode_barang' => 'required',
            'qty' => 'required|integer|min:1',
            'origin' => 'required|string',
            'status' => 'required|integer',
            'tgl_masuk' => 'required|date',
        ], [
            'barang_in_id.required' => 'Kode Barang Masuk tidak boleh kosong.',
            'barang_in_id.unique' => 'Kode Barang Masuk sudah digunakan oleh barang lain.',
            'kode_barang.required' => 'Kode Barang tidak boleh kosong.',
            'qty.required' => 'Quantity tidak boleh kosong.',
            'qty.min' => 'Quantity tidak boleh 0.',
            'origin.required' => 'Origin tidak boleh kosong.',
            'status.required' => 'Status tidak boleh kosong.',
            'tgl_masuk.required' => 'Tanggal Masuk tidak boleh kosong.',
        ]);

        BarangIn::create($request->all());

        $barang = Barang::where('kode_barang', $request->kode_barang)->first();
        $barang->qty = $barang->qty + $request->qty;
        $barang->save();

        return redirect()->route('barangIns.index')->with('success', 'Barang berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(BarangIn $barangIn)
    {
        return view('barangIns.show', compact('barangIns'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, BarangIn $barangIn)
    {   
        $barangs = Barang::all();   
        return view('barangIns.edit', compact('barangIn','barangs'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, BarangIn $barangIn)
    {
        $request->validate([
            'barang_in_id' => 'required|unique:barang_ins, barang_in_id,'.$brangIns->id.',id',
            'kode_barang' => 'required',
            'qty' => 'required|integer|min:1',
            'origin' => 'string',
            'status' => 'required|integer',
            'tgl_masuk' =>'required|date',
        ], [
            'barang_in_id' => 'Kode Barang Masuk tidak boleh kosong.',
            'barang_in_id.unique' => 'Kode Barang Masuk sudah digunakan oleh barang lain.',
            'kode_barang.required' => 'Kode Barang tidak boleh kosong.',
            'qty.required' => 'Quantity tidak boleh kosong.',
            'qty.min' => 'Quantity tidak boleh 0.',
            'origin.required' => 'Origin tidak boleh kosong.',
            'status.required' => 'Status tidak boleh kosong.',
            'tgl_masuk.required' => 'Tanggal Masuk tidak boleh kosong.',
        ]);
        $barang = Barang::where('kode_barang', $barangIn->kode_barang)->first();
        $barang->qty = $barang->qty - $barangIn->qty;
        $barang->save();

        $barangIn->update($request->all());

        $barang->qty = $barang->qty + $request->qty;
        $barang->save();
        return redirect()->route('barangIns.index')->with('success', 'Barang berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(BarangIn $barangIn)
    {
        // $barang = Barang::where('kode_barang', $barangIn->kode_barang)->first();
        // $barang->qty = $barang->qty - $barangIn->qty;
        // $barang->save();

        // $barangIn->delete();
        // return redirect()->route('barangIns.index')->with('success', 'Barang berhasil dihapus');
        $barang = Barang::where('kode_barang', $barangIn->kode_barang)->first();

        if ($barang) {
            $barang->qty = $barang->qty - $barangIn->qty;
            $barang->save();
        }

        $barangIn->delete();

        return redirect()->route('barangIns.index')->with('success', 'Barang berhasil dihapus');
    }
}
