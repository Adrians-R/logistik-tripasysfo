<div class="border-b border-gray-900/10 pb-12">
    <h2 class="text-base/7 font-semibold text-gray-900">{{ request()->routeIs('barangOuts.create') ? 'Tambah Barang Keluar' : 'Edit Barang Keluar' }}</h2>
    <div class="mt-6 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
        <div class="sm:col-span-3">
            <label for="last-name" class="block text-sm/6 font-medium text-gray-900">Kode Barang Keluar</label>
            <div class="mt-2">
                <input type="text"  name="barang_out_id" value="{{ old('barang_out_id', $barangOut->barang_out_id ?? '') }}" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
                @error('barang_out_id')
                    <div class="text-red-500 text-sm">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="sm:col-span-3">
            <label for="status" class="block text-sm/6 font-medium text-gray-900">Kode Barang</label>
            <div class="mt-2 grid grid-cols-1">
                <select name="kode_barang" id="kode_barang" class="col-start-1 row-start-1 w-full appearance-none rounded-md bg-white py-1.5 pr-8 pl-3 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
                    <option disabled value="" {{ old('status', isset($barangOut) ? $barangOut->kode_barang : '') == null ? 'selected' : '' }}>Pilih Kode Barang</option>
                    @foreach($barangs as $barang)
                        <option value="{{ $barang->kode_barang }}"
                            {{ old('kode_barang', $barangIn->kode_barang ?? '') == $barang->kode_barang ? 'selected' : '' }}>
                            {{ $barang->kode_barang }} - {{ $barang->nama_barang }}
                        </option>
                    @endforeach
                </select>
                @error('kode_barang')
                    <div class="text-red-500 text-sm">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="sm:col-span-3">
            <label for="last-name" class="block text-sm/6 font-medium text-gray-900">Stock</label>
            <div class="mt-2">
                <input type="number" name="qty" value="{{ old('qty', $barangOut->qty ?? '') }}" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
                @error('qty')
                    <div class="text-red-500 text-sm">{{ $message }}</div>
                @enderror
            </div>
        </div>
        
        <div class="sm:col-span-3">
            <label for="status" class="block text-sm/6 font-medium text-gray-900">Status</label>
            <div class="mt-2 grid grid-cols-1">
                <select name="status" class="col-start-1 row-start-1 w-full appearance-none rounded-md bg-white py-1.5 pr-8 pl-3 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
                    <option disabled selected {{ old('status', isset($barangOut) ? $barangOut->status : '') === null ? 'selected' : '' }}>Pilih Status Barang</option>
                    <option value="1" {{ old('status', $barangOut->status ?? '') == 1 ? "selected" : "" }}>Aktif</option>
                    <option value="0" {{ old('status', $barangOut->status ?? '') == 0 ? "selected" : "" }}>Tidak Aktif</option>
                </select>
                @error('status')
                    <div class="text-red-500 text-sm">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="sm:col-span-3">
            <label for="last-name" class="block text-sm/6 font-medium text-gray-900">Tujuan Barang</label>
            <div class="mt-2">
                <input type="text" name="destination" value="{{ old('destination', $barangOut->destination ?? '') }}" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
                @error('destination')
                    <div class="text-red-500 text-sm">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="sm:col-span-3">
            <label for="last-name" class="block text-sm/6 font-medium text-gray-900">Tanggal Keluar</label>
            <div class="mt-2">
                <input type="date" name="tgl_keluar"
                value="{{ old('tgl_keluar', isset($barangOut) ? $barangOut->tgl_keluar->format('Y-m-d') : '') }}"
                class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
                @error('tgl_keluar')
                    <div class="text-red-500 text-sm">{{ $message }}</div>
                @enderror
            </div>
        </div>

    </div>
</div>