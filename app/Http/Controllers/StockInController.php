<?php

namespace App\Http\Controllers;

use App\Models\{StockIn,StockInItem,Supplier,Sparepart};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StockInController extends Controller
{
    public function index()
    {
        $data = StockIn::with('supplier','creator')
            ->orderByDesc('date')
            ->paginate(10);

        return view('stock_ins.index', compact('data'));
    }

    public function create()
    {
        $suppliers = Supplier::orderBy('name')->get();
        $spareparts = Sparepart::orderBy('name')->get();

        return view('stock_ins.create', compact('suppliers','spareparts'));
    }

public function store(Request $request)
{
    $validated = $request->validate([
        'supplier_id' => 'nullable|exists:suppliers,id',
        'date' => 'required|date',
        'note' => 'nullable|string',
        'items' => 'required|array|min:1',
        'items.*.sparepart_id' => 'required|exists:spareparts,id|distinct',
        'items.*.qty' => 'required|integer|min:1',
        'items.*.price' => 'required|numeric|min:0',
    ]);

    DB::transaction(function () use ($validated, $request) {
        $invoiceNo = 'IN-' . date('Ymd') . '-' . str_pad((string) random_int(1, 9999), 4, '0', STR_PAD_LEFT);

        $stockIn = StockIn::create([
            'invoice_no'  => $invoiceNo,
            'supplier_id' => $validated['supplier_id'] ?? null,
            'date'        => $validated['date'],
            'note'        => $validated['note'] ?? null,
            'total'       => 0,
            'created_by'  => $request->user()->id,
        ]);

        $total = 0;

        foreach ($validated['items'] as $item) {
            $subtotal = $item['qty'] * $item['price'];
            $total += $subtotal;

            StockInItem::create([
                'stock_in_id' => $stockIn->id,
                'sparepart_id'=> $item['sparepart_id'],
                'qty'         => $item['qty'],
                'price'       => $item['price'],
                'subtotal'    => $subtotal,
            ]);

            // update stock
            Sparepart::where('id', $item['sparepart_id'])
                ->update(['stock' => DB::raw('stock + ' . (int) $item['qty'])]);
        }

        $stockIn->update(['total' => $total]);
    });

    return redirect()->route('stock-ins.index')->with('success', 'Stock In berhasil disimpan.');
}

    public function show(StockIn $stockIn)
    {
        $stockIn->load('supplier','creator','items.sparepart');
        return view('stock_ins.show', compact('stockIn'));
    }
}