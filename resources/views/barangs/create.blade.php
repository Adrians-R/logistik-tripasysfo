<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Data barang') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{ route('barangs.store') }}" method="POST">
                        @csrf
                        @include('barangs.form')
                        <div class="mt-6 flex items-center justify-end gap-x-6">
                            <a href="{{ route('barangs.index') }}" type="button" class="text-sm/6 font-semibold text-gray-900">Batal</a>
                            <button type="submit" class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-xs hover:bg-indigo-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
  </x-app-layout>
  