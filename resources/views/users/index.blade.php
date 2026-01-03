@extends('layouts.app')

@section('content')
<div class="card">
  <div class="card-header d-flex justify-content-between align-items-center">
    <strong>Manajemen User</strong>
    <a href="{{ route('users.create') }}" class="btn btn-primary btn-sm">+ Tambah</a>
  </div>

  <div class="card-body">

    @if(session('success'))
      <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if(session('error'))
      <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <form class="mb-3" method="GET" action="{{ route('users.index') }}">
      <div class="input-group">
        <input type="text" name="q" class="form-control" placeholder="Cari nama/email..." value="{{ $q }}">
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
            <th>Nama</th>
            <th>Email</th>
            <th>Role</th>
            <th style="width:170px;">Aksi</th>
          </tr>
        </thead>
        <tbody>
          @forelse($users as $i => $u)
            <tr>
              <td>{{ $users->firstItem() + $i }}</td>
              <td>{{ $u->name }}</td>
              <td>{{ $u->email }}</td>
              <td><span class="badge badge-info text-uppercase">{{ $u->role }}</span></td>
              <td>
                <a href="{{ route('users.edit', $u->id) }}" class="btn btn-warning btn-sm">Edit</a>

                <form action="{{ route('users.destroy', $u->id) }}" method="POST" class="d-inline"
                      onsubmit="return confirm('Hapus user ini?');">
                  @csrf
                  @method('DELETE')
                  <button class="btn btn-danger btn-sm">Hapus</button>
                </form>
              </td>
            </tr>
          @empty
            <tr><td colspan="5">Belum ada user.</td></tr>
          @endforelse
        </tbody>
      </table>
    </div>

    {{ $users->links() }}
  </div>
</div>
@endsection