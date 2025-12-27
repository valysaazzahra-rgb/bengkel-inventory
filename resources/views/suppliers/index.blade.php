@extends('layouts.app')

@section('content')
<div class="card">
  <div class="card-header d-flex justify-content-between align-items-center">
    <strong>Data Supplier</strong>
    <a href="{{ route('suppliers.create') }}" class="btn btn-primary btn-sm">+ Tambah</a>
  </div>

  <div class="card-body">
    <form class="mb-3" method="GET" action="{{ route('suppliers.index') }}">
      <div class="input-group">
        <input type="text" name="q" class="form-control" placeholder="Cari supplier (nama/phone)..." value="{{ $q }}">
        <div class="input-group-append">
          <button class="btn btn-secondary">Search</button>
        </div>
      </div>
    </form>

    <div class="table-responsive">
      <table class="table table-bordered">
        <thead>
          <tr>
            <th style="width:80px;">No</th>
            <th>Nama</th>
            <th>Phone</th>
            <th>Alamat</th>
            <th style="width:170px;">Aksi</th>
          </tr>
        </thead>
        <tbody>
          @forelse($data as $i => $row)
            <tr>
              <td>{{ $data->firstItem() + $i }}</td>
              <td>{{ $row->name }}</td>
              <td>{{ $row->phone ?? '-' }}</td>
              <td>{{ $row->address ?? '-' }}</td>
              <td>
                <a href="{{ route('suppliers.edit', $row->id) }}" class="btn btn-warning btn-sm">Edit</a>
                <form action="{{ route('suppliers.destroy', $row->id) }}" method="POST" class="d-inline"
                      onsubmit="return confirm('Hapus supplier ini?');">
                  @csrf
                  @method('DELETE')
                  <button class="btn btn-danger btn-sm">Hapus</button>
                </form>
              </td>
            </tr>
          @empty
            <tr><td colspan="5">Belum ada data.</td></tr>
          @endforelse
        </tbody>
      </table>
    </div>

    {{ $data->links() }}
  </div>
</div>
@endsection