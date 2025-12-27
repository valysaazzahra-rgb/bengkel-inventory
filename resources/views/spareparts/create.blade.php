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
          <input type="text"
                 name="code"
                 class="form-control"
                 required
                 placeholder="SP-0001"
                 value="{{ old('code') }}">
        </div>

        <div class="col-md-8 form-group">
          <label>Nama</label>
          <input type="text"
                 name="name"
                 class="form-control"
                 required
                 placeholder="Contoh: Oli Mesin 10W-40"
                 value="{{ old('name') }}">
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
          <input type="text"
                 name="unit"
                 class="form-control"
                 required
                 placeholder="pcs / botol / set"
                 value="{{ old('unit','pcs') }}">
        </div>

        {{-- ANGKA: tidak pakai value 0, pakai placeholder --}}
        <div class="col-md-3 form-group">
          <label>Harga Beli</label>
          <input type="number"
                 name="purchase_price"
                 class="form-control"
                 min="0"
                 step="0.01"
                 placeholder="0"
                 value="{{ old('purchase_price') }}">
        </div>

        <div class="col-md-3 form-group">
          <label>Harga Jual</label>
          <input type="number"
                 name="sell_price"
                 class="form-control"
                 min="0"
                 step="0.01"
                 placeholder="0"
                 value="{{ old('sell_price') }}">
        </div>

        <div class="col-md-3 form-group">
          <label>Stok Awal</label>
          <input type="number"
                 name="stock"
                 class="form-control"
                 min="0"
                 placeholder="0"
                 value="{{ old('stock') }}">
        </div>

        <div class="col-md-3 form-group">
          <label>Min Stok</label>
          <input type="number"
                 name="min_stock"
                 class="form-control"
                 min="0"
                 placeholder="0"
                 value="{{ old('min_stock') }}">
        </div>

        <div class="col-md-12 form-group">
          <label>Deskripsi</label>
          <textarea name="description"
                    class="form-control"
                    rows="3"
                    placeholder="Opsional...">{{ old('description') }}</textarea>
        </div>
      </div>

      <button class="btn btn-primary">Simpan</button>
      <a href="{{ route('spareparts.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
  </div>
</div>
@endsection