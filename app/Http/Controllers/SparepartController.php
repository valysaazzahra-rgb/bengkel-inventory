<?php

namespace App\Http\Controllers;

use App\Models\{Sparepart, Category, Supplier};
use Illuminate\Http\Request;

class SparepartController extends Controller
{
    public function index(Request $request)
    {
        $q = $request->query('q');

        $data = Sparepart::with('category', 'supplier')
            ->when($q, function ($query) use ($q) {
                $query->where('name', 'like', "%{$q}%")
                      ->orWhere('code', 'like', "%{$q}%");
            })
            ->orderBy('name')
            ->paginate(10)
            ->withQueryString();

        return view('spareparts.index', compact('data', 'q'));
    }

    public function create()
    {
        $categories = Category::orderBy('name')->get();
        $suppliers  = Supplier::orderBy('name')->get();

        return view('spareparts.create', compact('categories', 'suppliers'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'supplier_id' => 'nullable|exists:suppliers,id',
            'code' => 'required|string|max:50|unique:spareparts,code',
            'name' => 'required|string|max:200',
            'unit' => 'required|string|max:30',
            'purchase_price' => 'required|numeric|min:0',
            'sell_price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'min_stock' => 'required|integer|min:0',
            'description' => 'nullable|string|max:1000',
        ]);

        Sparepart::create($validated);

        return redirect()->route('spareparts.index')->with('success', 'Sparepart berhasil ditambahkan.');
    }

    public function edit(Sparepart $sparepart)
    {
        $categories = Category::orderBy('name')->get();
        $suppliers  = Supplier::orderBy('name')->get();

        return view('spareparts.edit', compact('sparepart', 'categories', 'suppliers'));
    }

    public function update(Request $request, Sparepart $sparepart)
    {
        $validated = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'supplier_id' => 'nullable|exists:suppliers,id',
            'code' => 'required|string|max:50|unique:spareparts,code,' . $sparepart->id,
            'name' => 'required|string|max:200',
            'unit' => 'required|string|max:30',
            'purchase_price' => 'required|numeric|min:0',
            'sell_price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'min_stock' => 'required|integer|min:0',
            'description' => 'nullable|string|max:1000',
        ]);

        $sparepart->update($validated);

        return redirect()->route('spareparts.index')->with('success', 'Sparepart berhasil diupdate.');
    }

    public function destroy(Sparepart $sparepart)
    {
        $sparepart->delete();
        return redirect()->route('spareparts.index')->with('success', 'Sparepart berhasil dihapus.');
    }
}