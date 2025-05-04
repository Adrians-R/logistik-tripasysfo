<style>
    span.select2-selection.select2-selection--single {
        border: 1px solid #727272;
        height: 38px;
        padding-top: 4px;
    }
</style>

<x-app-layout>
  <x-slot name="header">
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
          {{ __('Barang Keluar') }}
      </h2>
  </x-slot>

  <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
          <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
              <div class="p-6 text-gray-900">
                  <form action="{{ route('barangOuts.store') }}" method="POST">
                      @csrf
                      @include('barangOuts.form')
                      <div class="mt-6 flex items-center justify-end gap-x-6">
                          <a href="{{ route('barangOuts.index') }}" type="button" class="text-sm/6 border-6 font-semibold text-gray-900">Batal</a>
                          <button type="submit" class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-xs hover:bg-indigo-500 
                          focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Simpan</button>
                      </div>
                  </form>
              </div>
          </div>
      </div>
  </div>
</x-app-layout>

<script>
    $(document).ready(function() {
        $('#kode_barang').select2({
            placeholder: "Pilih Kode Barang", // Menambahkan placeholder
            allowClear: true, // Membolehkan clear pencarian
            width: '100%' // Membuat dropdown select2 mengisi seluruh lebar
        });
    });
</script>