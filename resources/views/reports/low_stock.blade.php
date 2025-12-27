@extends('layouts.app')

@section('content')
<div class="card">
  <div class="card-header"><strong>Laporan Stok Menipis</strong></div>
  <div class="card-body table-responsive">
    <table class="table table-bordered">
      <thead><tr><th>Kode</th><th>Nama</th><th>Kategori</th><th>Stok</th><th>Min</th></tr></thead>
      <tbody>
        @foreach($data as $sp)
          <tr>
            <td>{{ $sp->code }}</td>
            <td>{{ $sp->name }}</td>
            <td>{{ $sp->category?->name }}</td>
            <td>{{ $sp->stock }}</td>
            <td>{{ $sp->min_stock }}</td>
          </tr>
        @endforeach
      </tbody>
    </table>

    {{ $data->links() }}
  </div>
</div>
@endsection