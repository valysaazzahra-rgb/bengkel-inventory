<?php

namespace App\Http\Controllers;

use App\Models\{Sparepart,StockIn,StockOut};
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function lowStock()
    {
        $data = Sparepart::with('category')
            ->whereColumn('stock','<=','min_stock')
            ->orderBy('stock','asc')
            ->paginate(15);

        return view('reports.low_stock', compact('data'));
    }

    public function transactions()
    {
        $ins = StockIn::with('supplier')->orderByDesc('date')->paginate(10, ['*'], 'ins');
        $outs = StockOut::orderByDesc('date')->paginate(10, ['*'], 'outs');

        return view('reports.transactions', compact('ins','outs'));
    }

    public function recap(Request $request)
    {
        $from = $request->query('from');
        $to = $request->query('to');

        $qIns = StockIn::query();
        $qOut = StockOut::query();

        if ($from) { $qIns->whereDate('date','>=',$from); $qOut->whereDate('date','>=',$from); }
        if ($to)   { $qIns->whereDate('date','<=',$to);   $qOut->whereDate('date','<=',$to); }

        $totalIn  = (float) $qIns->sum('total');
        $totalOut = (float) $qOut->sum('total');

        return view('reports.recap', compact('from','to','totalIn','totalOut'));
    }
}