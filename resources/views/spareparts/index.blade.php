@extends('layouts.app')

@section('content')
<div class="card">
  <div class="card-header d-flex justify-content-between align-items-center">
    <strong>Data Sparepart</strong>
    <a href="{{ route('spareparts.create') }}" class="btn btn-primary btn-sm">+ Tambah</a>
  </div>

  <div class="card-body">
    <form class="mb-3" method="GET" action="{{ route('spareparts.index') }}">
      <div class="input-group">
        <input type="text" name="q" class="form-control" placeholder="Cari sparepart (kode/nama)..." value="{{ $q }}">
        <div class="input-group-append">
          <button class="btn btn-secondary">Search</button>
        </div>
      </div>
    </form>

    <div class="table-responsive">
      <table class="table table-bordered">
        <thead>
          <tr>
            <th style="width:70px;">No</th>
            <th>Kode</th>
            <th>Nama</th>
            <th>Kategori</th>
            <th>Supplier</th>
            <th>Unit</th>
            <th>Stok</th>
            <th>Min</th>
            <th>Harga Jual</th>
            <th style="width:170px;">Aksi</th>
          </tr>
        </thead>
        <tbody>
          @forelse($data as $i => $row)
            <tr>
              <td>{{ $data->firstItem() + $i }}</td>
              <td>{{ $row->code }}</td>
              <td>{{ $row->name }}</td>
              <td>{{ $row->category?->name }}</td>
              <td>{{ $row->supplier?->name ?? '-' }}</td>
              <td>{{ $row->unit }}</td>
              <td>
                @if($row->stock <= $row->min_stock)
                  <span class="badge badge-danger">{{ $row->stock }}</span>
                @else
                  <span class="badge badge-success">{{ $row->stock }}</span>
                @endif
              </td>
              <td>{{ $row->min_stock }}</td>
              <td>{{ number_format($row->sell_price, 2) }}</td>
              <td>
                <a href="{{ route('spareparts.edit', $row->id) }}" class="btn btn-warning btn-sm">Edit</a>
                <form action="{{ route('spareparts.destroy', $row->id) }}" method="POST" class="d-inline"
                      onsubmit="return confirm('Hapus sparepart ini?');">
                  @csrf
                  @method('DELETE')
                  <button class="btn btn-danger btn-sm">Hapus</button>
                </form>
              </td>
            </tr>
          @empty
            <tr><td colspan="10">Belum ada data.</td></tr>
          @endforelse
        </tbody>
      </table>
    </div>

    {{ $data->links() }}
  </div>
</div>
@endsection