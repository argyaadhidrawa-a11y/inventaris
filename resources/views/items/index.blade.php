@extends('layouts.app')
@section('title', 'Barang')

@section('content')
    <div class="page-header">
        <div>
            <h1><i class="bi bi-box-fill text-primary me-2"></i>Barang</h1>
            <p class="subtitle mb-0">Kelola data barang inventaris</p>
        </div>
        <a href="{{ route('items.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-lg me-1"></i> Tambah Barang
        </a>
    </div>

    <div class="card">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-modern mb-0">
                    <thead>
                        <tr>
                            <th style="width: 60px;">No</th>
                            <th>Nama Barang</th>
                            <th>Kategori</th>
                            <th class="text-end">Stok</th>
                            <th class="text-end">Harga</th>
                            <th style="width: 200px;" class="text-end">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($items as $item)
                            <tr>
                                <td><span class="badge bg-light text-dark">{{ $loop->iteration }}</span></td>
                                <td><strong>{{ $item->name }}</strong></td>
                                <td><span class="badge bg-primary-subtle text-primary">{{ $item->category }}</span></td>
                                <td class="text-end">{{ number_format($item->stock, 0, ',', '.') }}</td>
                                <td class="text-end">Rp {{ number_format($item->price, 0, ',', '.') }}</td>
                                <td class="text-end">
                                    <a href="{{ route('items.edit', $item) }}" class="btn btn-sm btn-outline-warning me-1" title="Ubah">
                                        <i class="bi bi-pencil-fill"></i>
                                    </a>
                                    <button type="button" class="btn btn-sm btn-outline-danger"
                                        data-bs-toggle="modal" data-bs-target="#deleteItemModal"
                                        data-delete-action="{{ route('items.destroy', $item) }}"
                                        data-delete-name="{{ $item->name }}" title="Hapus">
                                        <i class="bi bi-trash-fill"></i>
                                    </button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6">
                                    <div class="empty-state">
                                        <i class="bi bi-inbox d-block"></i>
                                        <p class="mb-0">Belum ada barang. Mulai tambahkan yang pertama!</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="modal fade" id="deleteItemModal" tabindex="-1" aria-labelledby="deleteItemModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteItemModalLabel">Konfirmasi Hapus</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                </div>
                <div class="modal-body">
                    Apakah Anda yakin ingin menghapus barang <strong id="deleteItemName"></strong>?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Batal</button>
                    <form id="deleteItemForm" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Hapus Barang</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.querySelectorAll('[data-delete-action]').forEach((button) => {
            button.addEventListener('click', () => {
                document.getElementById('deleteItemName').textContent = button.dataset.deleteName;
                document.getElementById('deleteItemForm').action = button.dataset.deleteAction;
            });
        });
    </script>
@endsection
