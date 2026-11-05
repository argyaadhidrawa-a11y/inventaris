<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Item;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class ItemController extends Controller
{
    public function index(): View
    {
        $items = Item::query()->latest()->get();

        return view('items.index', compact('items'));
    }

    public function create(): View
    {
        return view('items.create', ['categories' => Category::query()->orderBy('name')->pluck('name')]);
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:100'],
            'category' => ['required', 'string', Rule::exists('categories', 'name')],
            'stock' => ['required', 'integer', 'min:0'],
            'price' => ['required', 'numeric', 'min:0'],
        ]);

        Item::create($validated);

        return redirect()->route('items.index')
            ->with('success', 'Barang "'.$validated['name'].'" berhasil ditambahkan.');
    }

    public function show(Item $item): RedirectResponse
    {
        return redirect()->route('items.edit', $item);
    }

    public function edit(Item $item): View
    {
        return view('items.edit', [
            'item' => $item,
            'categories' => Category::query()->orderBy('name')->pluck('name'),
        ]);
    }

    public function update(Request $request, Item $item): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:100'],
            'category' => ['required', 'string', Rule::exists('categories', 'name')],
            'stock' => ['required', 'integer', 'min:0'],
            'price' => ['required', 'numeric', 'min:0'],
        ]);

        $item->update($validated);

        return redirect()->route('items.index')
            ->with('success', 'Barang berhasil diperbarui.');
    }

    public function destroy(Item $item): RedirectResponse
    {
        $item->delete();

        return redirect()->route('items.index')
            ->with('success', 'Barang berhasil dihapus.');
    }
}
