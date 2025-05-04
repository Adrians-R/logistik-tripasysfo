<x-app-layout>
  <x-slot name="header">
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
          {{ __('Barang Masuk') }}
      </h2>
  </x-slot>

  <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
          <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
              <div class="p-6 text-gray-900">
                  <a href="{{ route('barangIns.create') }}" class="btn btn-primary mb-5">Tambah Baru</a>
                  
                  <table id="barangs-table" class="table table-bordered table-striped">
                      <thead>
                      <tr>
                          <th>Kode Barang Masuk</th>
                          <th>Kode Barang</th>
                          <th>Stok</th>
                          <th>Status</th>
                          <th>Asal Barang</th>
                          <th>Tanggal Masuk</th>
                          <th>Aksi</th>
                      </tr>
                      </thead>
                      <tbody>
                      @foreach ($barangIns as $barangIns)
                      <tr>
                          <td>{{ $barangIns->barang_in_id }}</td>
                          <td>{{ $barangIns->kode_barang }}</td>
                          <td>{{ $barangIns->qty }}</td>
                          <td>{{ $barangIns->status == 1 ? 'Aktif' : 'Tidak Aktif' }}</td>
                          <td>{{ $barangIns->origin }}</td>   
                          <td>{{ $barangIns->tgl_masuk->format('d M Y') }}</td>
                          <td>
                          <a href="{{ route('barangIns.edit', $barangIns->id) }}" class="btn btn-warning btn-sm">Edit</a>
                          <button type="button" class="btn btn-danger btn-sm btn-confirm-delete" data-id="{{ $barangIns->id }}">
                              Hapus
                          </button>
                          <form id="delete-form-{{ $barangIns->id }}"
                            action="{{ route('barangIns.destroy', $barangIns->id) }}"
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