@extends('layouts.app')
@section('title', 'Dashboard')

@section('content')
    <div class="page-header">
        <div>
            <h1>{{ $judul }}</h1>
            <p class="subtitle mb-0">Selamat datang! Berikut ringkasan inventaris Anda.</p>
        </div>
    </div>

    <div class="row g-4 mb-4">
        {{-- Kartu Kategori --}}
        <div class="col-12 col-sm-6 col-xl-3">
            <div class="stat-card bg-gradient-primary">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <div class="label">Kategori</div>
                        <div class="number">{{ $ringkasan['kategori'] }}</div>
                    </div>
                    <div class="icon"><i class="bi bi-tags-fill"></i></div>
                </div>
            </div>
        </div>

        {{-- Kartu Barang --}}
        <div class="col-12 col-sm-6 col-xl-3">
            <div class="stat-card bg-gradient-success">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <div class="label">Total Barang</div>
                        <div class="number">{{ $ringkasan['barang'] }}</div>
                    </div>
                    <div class="icon"><i class="bi bi-box-fill"></i></div>
                </div>
            </div>
        </div>

        {{-- Kartu Hampir Habis --}}
        <div class="col-12 col-sm-6 col-xl-3">
            <div class="stat-card bg-gradient-warning">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <div class="label">Hampir Habis</div>
                        <div class="number">{{ $ringkasan['hampirHabis'] }}</div>
                    </div>
                    <div class="icon"><i class="bi bi-exclamation-triangle-fill"></i></div>
                </div>
            </div>
        </div>

        {{-- Kartu Total Nilai --}}
        <div class="col-12 col-sm-6 col-xl-3">
            <div class="stat-card bg-gradient-info">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <div class="label">Total Nilai Stok</div>
                        <div class="number">Rp {{ number_format($ringkasan['totalNilai'] / 1000000, 1) }}jt</div>
                    </div>
                    <div class="icon"><i class="bi bi-cash-stack"></i></div>
                </div>
            </div>
        </div>
    </div>

    {{-- Quick Actions --}}
    <div class="card">
        <div class="card-body p-4">
            <h5 class="fw-bold mb-3"><i class="bi bi-lightning-charge-fill text-warning me-2"></i>Aksi Cepat</h5>
            <div class="d-flex flex-wrap gap-2">
                <a href="{{ route('categories.create') }}" class="btn btn-outline-primary">
                    <i class="bi bi-plus-circle me-1"></i> Tambah Kategori
                </a>
                <a href="{{ route('items.create') }}" class="btn btn-primary">
                    <i class="bi bi-plus-circle me-1"></i> Tambah Barang
                </a>
                <a href="{{ route('items.index') }}" class="btn btn-outline-secondary">
                    <i class="bi bi-list-ul me-1"></i> Kelola Barang
                </a>
            </div>
        </div>
    </div>
@endsection