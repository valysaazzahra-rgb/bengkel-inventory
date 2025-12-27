ini create
@extends('layouts.app')

@section('content')
<div class="card">
  <div class="card-header"><strong>Tambah Sparepart</strong></div>
  <div class="card-body">
    <form method="POST" action="{{ route('spareparts.store') }}">
      @csrf

      <div class="row">
        <div class="col-md-4 form-group">
          <label>Kode</label>
          <input type="text" name="code" class="form-control" required value="{{ old('code') }}" placeholder="SP-0001">
        </div>

        <div class="col-md-8 form-group">
          <label>Nama</label>
          <input type="text" name="name" class="form-control" required value="{{ old('name') }}">
        </div>

        <div class="col-md-4 form-group">
          <label>Kategori</label>
          <select name="category_id" class="form-control" required>
            <option value="">- pilih -</option>
            @foreach($categories as $c)
              <option value="{{ $c->id }}" @selected(old('category_id')==$c->id)>{{ $c->name }}</option>
            @endforeach
          </select>
        </div>

        <div class="col-md-4 form-group">
          <label>Supplier (opsional)</label>
          <select name="supplier_id" class="form-control">
            <option value="">- tidak ada -</option>
            @foreach($suppliers as $s)
              <option value="{{ $s->id }}" @selected(old('supplier_id')==$s->id)>{{ $s->name }}</option>
            @endforeach
          </select>
        </div>

        <div class="col-md-4 form-group">
          <label>Unit</label>
          <input type="text" name="unit" class="form-control" required value="{{ old('unit','pcs') }}">
        </div>

        <div class="col-md-3 form-group">
          <label>Harga Beli</label>
          <input type="number" step="0.01" name="purchase_price" class="form-control" required value="{{ old('purchase_price',0) }}">
        </div>

        <div class="col-md-3 form-group">
          <label>Harga Jual</label>
          <input type="number" step="0.01" name="sell_price" class="form-control" required value="{{ old('sell_price',0) }}">
        </div>

        <div class="col-md-2 form-group">
          <label>Stok Awal</label>
          <input type="number" name="stock" class="form-control" required value="{{ old('stock',0) }}" min="0">
        </div>

        <div class="col-md-2 form-group">
          <label>Min Stok</label>
          <input type="number" name="min_stock" class="form-control" required value="{{ old('min_stock',0) }}" min="0">
        </div>

        <div class="col-md-12 form-group">
          <label>Deskripsi</label>
          <textarea name="description" class="form-control" rows="3">{{ old('description') }}</textarea>
        </div>
      </div>

      <button class="btn btn-primary">Simpan</button>
      <a href="{{ route('spareparts.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
  </div>
</div>
@endsection