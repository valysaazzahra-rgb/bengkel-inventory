@extends('layouts.app')

@section('content')
<div class="card">
  <div class="card-header"><strong>Edit User</strong></div>
  <div class="card-body">

    @if ($errors->any())
      <div class="alert alert-danger">Ada input yang belum benar.</div>
    @endif

    <form method="POST" action="{{ route('users.update', $user->id) }}">
      @csrf
      @method('PUT')

      <div class="form-group">
        <label>Nama</label>
        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
               value="{{ old('name', $user->name) }}" required>
        @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
      </div>

      <div class="form-group">
        <label>Email</label>
        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
               value="{{ old('email', $user->email) }}" required>
        @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
      </div>

      <div class="form-group">
        <label>Role</label>
        <select name="role" class="form-control @error('role') is-invalid @enderror" required>
          @foreach($roles as $r)
            <option value="{{ $r }}" @selected(old('role', $user->role)==$r)>{{ strtoupper($r) }}</option>
          @endforeach
        </select>
        @error('role') <div class="invalid-feedback">{{ $message }}</div> @enderror
      </div>

      <div class="form-group">
        <label>Password (opsional)</label>
        <input type="password" name="password" class="form-control @error('password') is-invalid @enderror"
               placeholder="Kosongkan jika tidak diubah">
        @error('password') <div class="invalid-feedback">{{ $message }}</div> @enderror
      </div>

      <div class="form-group">
        <label>Konfirmasi Password</label>
        <input type="password" name="password_confirmation" class="form-control"
               placeholder="Kosongkan jika tidak diubah">
      </div>

      <button class="btn btn-primary">Update</button>
      <a href="{{ route('users.index') }}" class="btn btn-secondary">Kembali</a>
    </form>

  </div>
</div>
@endsection