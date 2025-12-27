@extends('layouts.app')

@section('content')
<div class="row">
  <div class="col-md-4">
    <div class="card"><div class="card-body">
      <h5>Total Sparepart</h5><h2>{{ $totalSpareparts }}</h2>
    </div></div>
  </div>
  <div class="col-md-4">
    <div class="card"><div class="card-body">
      <h5>Total Supplier</h5><h2>{{ $totalSuppliers }}</h2>
    </div></div>
  </div>
  <div class="col-md-4">
    <div class="card"><div class="card-body">
      <h5>Stok Menipis</h5><h2>{{ $lowStockCount }}</h2>
    </div></div>
  </div>
</div>

<div class="card">
  <div class="card-header"><strong>Stok Menipis</strong></div>
  <div class="card-body table-responsive">
    <table class="table table-bordered">
      <thead><tr><th>Kode</th><th>Nama</th><th>Kategori</th><th>Stok</th><th>Min</th></tr></thead>
      <tbody>
        @forelse($lowStocks as $sp)
          <tr>
            <td>{{ $sp->code }}</td>
            <td>{{ $sp->name }}</td>
            <td>{{ $sp->category?->name }}</td>
            <td>{{ $sp->stock }}</td>
            <td>{{ $sp->min_stock }}</td>
          </tr>
        @empty
          <tr><td colspan="5">Tidak ada.</td></tr>
        @endforelse
      </tbody>
    </table>
  </div>
</div>
@endsection