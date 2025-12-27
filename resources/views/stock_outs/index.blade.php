@extends('layouts.app')

@section('content')
<div class="card">
  <div class="card-header d-flex justify-content-between align-items-center">
    <strong>Transaksi Stok Keluar</strong>
    <a href="{{ route('stock-outs.create') }}" class="btn btn-primary btn-sm">+ Tambah</a>
  </div>

  <div class="card-body table-responsive">
    <table class="table table-bordered">
      <thead>
        <tr>
          <th>Tanggal</th>
          <th>No Transaksi</th>
          <th>Tipe</th>
          <th>Customer</th>
          <th>Total</th>
          <th>Dibuat oleh</th>
          <th>Aksi</th>
        </tr>
      </thead>
      <tbody>
        @forelse($data as $row)
          <tr>
            <td>{{ $row->date }}</td>
            <td>{{ $row->trx_no }}</td>
            <td>{{ strtoupper($row->type) }}</td>
            <td>{{ $row->customer_name ?? '-' }}</td>
            <td>{{ number_format($row->total, 2) }}</td>
            <td>{{ $row->creator?->name }}</td>
            <td>
              <a class="btn btn-info btn-sm" href="{{ route('stock-outs.show', $row->id) }}">Detail</a>
            </td>
          </tr>
        @empty
          <tr><td colspan="7">Belum ada data.</td></tr>
        @endforelse
      </tbody>
    </table>

    {{ $data->links() }}
  </div>
</div>
@endsection