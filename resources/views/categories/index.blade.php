@extends('layouts.app')
@section('title', 'Kategori')

@section('content')
    <div class="page-header">
        <div>
            <h1><i class="bi bi-tags-fill text-primary me-2"></i>Kategori</h1>
            <p class="subtitle mb-0">Kelola kategori barang inventaris</p>
        </div>
        <a href="{{ route('categories.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-lg me-1"></i> Tambah Kategori
        </a>
    </div>

    <div class="card">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-modern mb-0">
                    <thead>
                        <tr>
                            <th style="width: 60px;">No</th>
                            <th>Nama Kategori</th>
                            <th>Deskripsi</th>
                            <th style="width: 200px;" class="text-end">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($categories as $category)
                            <tr>
                                <td><span class="badge bg-light text-dark">{{ $loop->iteration }}</span></td>
                                <td><strong>{{ $category->name }}</strong></td>
                                <td class="text-muted">{{ $category->description ?? '-' }}</td>
                                <td class="text-end">
                                    <a href="{{ route('categories.edit', $category) }}"
                                        class="btn btn-sm btn-outline-warning me-1" title="Ubah">
                                        <i class="bi bi-pencil-fill"></i>
                                    </a>
                                    <button type="button" class="btn btn-sm btn-outline-danger"
                                        data-bs-toggle="modal" data-bs-target="#deleteCategoryModal"
                                        data-delete-action="{{ route('categories.destroy', $category) }}"
                                        data-delete-name="{{ $category->name }}" title="Hapus">
                                        <i class="bi bi-trash-fill"></i>
                                    </button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4">
                                    <div class="empty-state">
                                        <i class="bi bi-inbox d-block"></i>
                                        <p class="mb-0">Belum ada kategori. Mulai tambahkan yang pertama!</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="modal fade" id="deleteCategoryModal" tabindex="-1" aria-labelledby="deleteCategoryModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteCategoryModalLabel">Konfirmasi Hapus</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                </div>
                <div class="modal-body">Apakah Anda yakin ingin menghapus kategori <strong id="deleteCategoryName"></strong>?</div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Batal</button>
                    <form id="deleteCategoryForm" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Hapus Kategori</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.querySelectorAll('[data-delete-action]').forEach((button) => {
            button.addEventListener('click', () => {
                document.getElementById('deleteCategoryName').textContent = button.dataset.deleteName;
                document.getElementById('deleteCategoryForm').action = button.dataset.deleteAction;
            });
        });
    </script>
@endsection