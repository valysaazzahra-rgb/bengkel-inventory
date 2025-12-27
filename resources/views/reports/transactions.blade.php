@extends('layouts.app')

@section('content')
<div class="card">
  <div class="card-header"><strong>Laporan Transaksi</strong></div>
  <div class="card-body">

    <h5>Stok Masuk</h5>
    <div class="table-responsive mb-4">
      <table class="table table-bordered">
        <thead><tr><th>Tanggal</th><th>Invoice</th><th>Supplier</th><th>Total</th></tr></thead>
        <tbody>
          @foreach($ins as $r)
            <tr>
              <td>{{ $r->date }}</td>
              <td>{{ $r->invoice_no }}</td>
              <td>{{ $r->supplier?->name }}</td>
              <td>{{ number_format($r->total, 2) }}</td>
            </tr>
          @endforeach
        </tbody>
      </table>
      {{ $ins->links() }}
    </div>

    <h5>Stok Keluar</h5>
    <div class="table-responsive">
      <table class="table table-bordered">
        <thead><tr><th>Tanggal</th><th>No Transaksi</th><th>Tipe</th><th>Total</th></tr></thead>
        <tbody>
          @foreach($outs as $r)
            <tr>
              <td>{{ $r->date }}</td>
              <td>{{ $r->trx_no }}</td>
              <td>{{ strtoupper($r->type) }}</td>
              <td>{{ number_format($r->total, 2) }}</td>
            </tr>
          @endforeach
        </tbody>
      </table>
      {{ $outs->links() }}
    </div>

  </div>
</div>
@endsection