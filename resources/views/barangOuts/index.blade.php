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
                  <a href="{{ route('barangOuts.create') }}" class="btn btn-primary mb-5">Tambah Baru</a>
                  
                  <table id="barangs-table" class="table table-bordered table-striped">
                      <thead>
                      <tr>
                          <th>Kode Barang Keluar</th>
                          <th>Kode Barang</th>
                          <th>Stok</th>
                          <th>Status</th>
                          <th>Tujuan Barang</th>
                          <th>Tanggal Keluar</th>
                          <th>Aksi</th>
                      </tr>
                      </thead>
                      <tbody>
                      @foreach ($barangOuts as $barangOuts)
                      <tr>
                          <td>{{ $barangOuts->barang_out_id }}</td>
                          <td>{{ $barangOuts->kode_barang }}</td>
                          <td>{{ $barangOuts->qty }}</td>
                          <td>{{ $barangOuts->status == 1 ? 'Aktif' : 'Tidak Aktif' }}</td>
                          <td>{{ $barangOuts->destination }}</td>   
                          <td>{{ $barangOuts->tgl_keluar->format('d M Y') }}</td>
                          <td>
                          <a href="{{ route('barangOuts.edit', $barangOuts->id) }}" class="btn btn-warning btn-sm">Edit</a>
                          <button type="button" class="btn btn-danger btn-sm btn-confirm-delete" data-id="{{ $barangOuts->id }}">
                            Hapus
                            </button>
                            <form id="delete-form-{{ $barangOuts->id }}"
                            action="{{ route('barangOuts.destroy', $barangOuts->id) }}"
                            method="POST"
                            style="display: none;">
                            @csrf
                            @method('DELETE')
                            </form>
                          </td>
                      </tr>
                      @endforeach
                      </tbody>
                  </table>
              </div>
          </div>
      </div>
  </div>
</x-app-layout>

<script>
  $(document).ready(function () {
      $('#barangs-table').DataTable({
          responsive: true,
      });
  });
</script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const deleteButtons = document.querySelectorAll('.btn-confirm-delete');
  
        deleteButtons.forEach(function (button) {
            button.addEventListener('click', function () {
                const id = this.getAttribute('data-id');
                if (confirm('Apakah kamu yakin ingin menghapus data ini?')) {
                    document.getElementById('delete-form-' + id).submit();
                }
            });
        });
    });
  </script>