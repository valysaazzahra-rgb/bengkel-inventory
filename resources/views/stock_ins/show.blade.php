@extends('layouts.app')

@section('content')
<div class="card">
  <div class="card-header">
    <strong>Detail Stok Masuk</strong>
  </div>

  <div class="card-body">
    <div class="mb-3">
      <div><strong>Invoice:</strong> {{ $stockIn->invoice_no }}</div>
      <div><strong>Tanggal:</strong> {{ $stockIn->date }}</div>
      <div><strong>Supplier:</strong> {{ $stockIn->supplier?->name }}</div>
      <div><strong>Dibuat oleh:</strong> {{ $stockIn->creator?->name }}</div>
      <div><strong>Catatan:</strong> {{ $stockIn->note }}</div>
      <div><strong>Total:</strong> {{ number_format($stockIn->total, 2) }}</div>
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
          @foreach($stockIn->items as $it)
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

    <a href="{{ route('stock-ins.index') }}" class="btn btn-secondary">Kembali</a>
  </div>
</div>
@endsection