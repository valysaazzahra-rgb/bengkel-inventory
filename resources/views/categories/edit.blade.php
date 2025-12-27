@extends('layouts.app')

@section('content')
<div class="card">
  <div class="card-header"><strong>Edit Kategori</strong></div>
  <div class="card-body">
    <form method="POST" action="{{ route('categories.update', $category->id) }}">
      @csrf
      @method('PUT')

      <div class="form-group">
        <label>Nama Kategori</label>
        <input type="text" name="name" class="form-control" required value="{{ old('name', $category->name) }}">
      </div>

      <button class="btn btn-primary">Update</button>
      <a href="{{ route('categories.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
  </div>
</div>
@endsection