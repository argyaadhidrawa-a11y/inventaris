<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Item;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $judul = 'Dashboard Inventaris';
        $ringkasan = [
            'kategori' => Category::count(),
            'barang' => Item::count(),
            'hampirHabis' => Item::where('stock', '<', 5)->count(),
            'totalNilai' => Item::query()->get()->sum(fn (Item $item) => $item->stock * (float) $item->price),
        ];

        return view('dashboard', compact('judul', 'ringkasan'));
    }
}
