<div class="border-b border-gray-900/10 pb-12">
    <h2 class="text-base/7 font-semibold text-gray-900">{{ request()->routeIs('barangs.create') ? 'Tambah Barang' : 'Edit Barang' }}</h2>
    <div class="mt-6 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
        <div class="sm:col-span-3">
            <label for="last-name" class="block text-sm/6 font-medium text-gray-900">Kode Barang</label>
            <div class="mt-2">
                <input type="text"  name="kode_barang" value="{{ old('kode_barang', $barang->kode_barang ?? '') }}" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
                @error('kode_barang')
                    <div class="text-red-500 text-sm">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="sm:col-span-3">
            <label for="first-name" class="block text-sm/6 font-medium text-gray-900">Nama Barang</label>
            <div class="mt-2">
                <input type="text"  name="nama_barang" value="{{ old('nama_barang', $barang->nama_barang ?? '') }}" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
                @error('nama_barang')
                    <div class="text-red-500 text-sm">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="sm:col-span-3">
            <label for="last-name" class="block text-sm/6 font-medium text-gray-900">Stock</label>
            <div class="mt-2">
                <input type="number" name="qty" value="{{ old('qty', $barang->qty ?? '') }}" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
                @error('qty')
                    <div class="text-red-500 text-sm">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="sm:col-span-3">
            <label for="status" class="block text-sm/6 font-medium text-gray-900">Status</label>
            <div class="mt-2 grid grid-cols-1">
                <select name="status" class="col-start-1 row-start-1 w-full appearance-none rounded-md bg-white py-1.5 pr-8 pl-3 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
                    <option disabled selected disabled {{ old('status', isset($barangIn) ? $barangIn->status : '') === null ? 'selected' : '' }}>Pilih Status Barang</option> 
                    <option value="1" {{ old('status', $barang->status ?? '') == 1 ? "selected" : "" }}>Tersedia</option>
                    <option value="0" {{ old('status', $barang->status ?? '') == 0 ? "selected" : "" }}>Kosong</option>
                </select>
                @error('status')
                    <div class="text-red-500 text-sm">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="col-span-full">
            <label for="description" class="block text-sm/6 font-medium text-gray-900">Description</label>
            <div class="mt-2">
                <textarea name="description" id="description" rows="3" value="{{ old('description', $barang->description ?? '') }}" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">{{ old('description', $barang->description ?? '') }}</textarea>
            </div>
        </div>
    </div>
</div>