@extends('layouts.app')

@section('content')
<div class="card">
  <div class="card-header"><strong>Edit Supplier</strong></div>
  <div class="card-body">
    <form method="POST" action="{{ route('suppliers.update', $supplier->id) }}">
      @csrf
      @method('PUT')

      <div class="form-group">
        <label>Nama</label>
        <input type="text" name="name" class="form-control" required value="{{ old('name', $supplier->name) }}">
      </div>

      <div class="form-group">
        <label>Phone</label>
        <input type="text" name="phone" class="form-control" value="{{ old('phone', $supplier->phone) }}">
      </div>

      <div class="form-group">
        <label>Alamat</label>
        <textarea name="address" class="form-control" rows="3">{{ old('address', $supplier->address) }}</textarea>
      </div>

      <button class="btn btn-primary">Update</button>
      <a href="{{ route('suppliers.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
  </div>
</div>
@endsection