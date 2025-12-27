@extends('layouts.app')

@section('content')
<div class="card">
  <div class="card-header">
    <strong>Detail Stok Keluar</strong>
  </div>

  <div class="card-body">
    <div class="mb-3">
      <div><strong>No Transaksi:</strong> {{ $stockOut->trx_no }}</div>
      <div><strong>Tanggal:</strong> {{ $stockOut->date }}</div>
      <div><strong>Tipe:</strong> {{ strtoupper($stockOut->type) }}</div>
      <div><strong>Customer:</strong> {{ $stockOut->customer_name ?? '-' }}</div>
      <div><strong>Dibuat oleh:</strong> {{ $stockOut->creator?->name }}</div>
      <div><strong>Catatan:</strong> {{ $stockOut->note }}</div>
      <div><strong>Total:</strong> {{ number_format($stockOut->total, 2) }}</div>
    </div>

    <div class="table-responsive">
      <table class="table table-bordered">
        <thead>
          <tr>
            <th>Sparepart</th>
            <th>Qty</th>
            <th>Harga</th>
            <th>Subtotal</th>
          </tr>
        </thead>
        <tbody>
          @foreach($stockOut->items as $it)
            <tr>
              <td>{{ $it->sparepart?->code }} - {{ $it->sparepart?->name }}</td>
              <td>{{ $it->qty }}</td>
              <td>{{ number_format($it->price, 2) }}</td>
              <td>{{ number_format($it->subtotal, 2) }}</td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>

    <a href="{{ route('stock-outs.index') }}" class="btn btn-secondary">Kembali</a>
  </div>
</div>
@endsection