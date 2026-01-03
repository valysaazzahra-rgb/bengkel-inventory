<?php

namespace App\Http\Controllers;

use App\Models\{StockOut,StockOutItem,Sparepart};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StockOutController extends Controller
{
    public function index()
    {
        $data = StockOut::with('creator')
            ->orderByDesc('date')
            ->paginate(10);

        return view('stock_outs.index', compact('data'));
    }

    public function create()
    {
        $spareparts = Sparepart::orderBy('name')->get();
        return view('stock_outs.create', compact('spareparts'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'date' => 'required|date',
            'type' => 'required|in:sale,service',
            'customer_name' => 'nullable|string|max:255',
            'note' => 'nullable|string',
            'items' => 'required|array|min:1',
            'items.*.sparepart_id' => 'required|exists:spareparts,id|distinct',
            'items.*.qty' => 'required|integer|min:1',
            'items.*.price' => 'required|numeric|min:0',
        ]);

        DB::transaction(function () use ($validated, $request) {

            // cek stok dulu sebelum update
            foreach ($validated['items'] as $item) {
                $sp = Sparepart::lockForUpdate()->find($item['sparepart_id']);
                if ($item['qty'] > $sp->stock) {
                    abort(422, "Stok tidak cukup untuk {$sp->name}. Stok tersedia: {$sp->stock}");
                }
            }

            $trxNo = 'OUT-' . date('Ymd') . '-' . str_pad((string)random_int(1,9999), 4, '0', STR_PAD_LEFT);

            $stockOut = StockOut::create([
                'trx_no' => $trxNo,
                'date' => $validated['date'],
                'type' => $validated['type'],
                'customer_name' => $validated['customer_name'] ?? null,
                'note' => $validated['note'] ?? null,
                'total' => 0,
                'created_by' => $request->user()->id
            ]);

            $total = 0;

            foreach ($validated['items'] as $item) {
                $subtotal = $item['qty'] * $item['price'];
                $total += $subtotal;

                StockOutItem::create([
                    'stock_out_id' => $stockOut->id,
                    'sparepart_id' => $item['sparepart_id'],
                    'qty' => $item['qty'],
                    'price' => $item['price'],
                    'subtotal' => $subtotal,
                ]);

                Sparepart::where('id', $item['sparepart_id'])
                    ->update(['stock' => DB::raw('stock - '.$item['qty'])]);
            }

            $stockOut->update(['total' => $total]);
        });

        return redirect()->route('stock-outs.index')->with('success', 'Stock Out berhasil disimpan.');
    }

    public function show(StockOut $stockOut)
    {
        $stockOut->load('creator','items.sparepart');
        return view('stock_outs.show', compact('stockOut'));
    }
}