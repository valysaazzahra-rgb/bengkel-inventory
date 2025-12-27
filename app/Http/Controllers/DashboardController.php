<?php

namespace App\Http\Controllers;

use App\Models\{Sparepart,Supplier,StockIn,StockOut};
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalSpareparts = Sparepart::count();
        $totalSuppliers  = Supplier::count();
        $lowStockCount   = Sparepart::whereColumn('stock', '<=', 'min_stock')->count();

        $lowStocks = Sparepart::with('category')
            ->whereColumn('stock', '<=', 'min_stock')
            ->orderBy('stock','asc')
            ->limit(10)->get();

        $lastIns  = StockIn::orderByDesc('date')->limit(5)->get();
        $lastOuts = StockOut::orderByDesc('date')->limit(5)->get();

        return view('dashboard.index', compact(
            'totalSpareparts','totalSuppliers','lowStockCount','lowStocks','lastIns','lastOuts'
        ));
    }
}