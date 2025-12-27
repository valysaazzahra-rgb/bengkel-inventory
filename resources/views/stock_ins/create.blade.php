@extends('layouts.app')

@section('content')
<div class="card">
  <div class="card-header"><strong>Tambah Stok Masuk</strong></div>
  <div class="card-body">
    <form method="POST" action="{{ route('stock-ins.store') }}">
      @csrf

      <div class="row">
        <div class="col-md-4">
          <label>Supplier</label>
          <select name="supplier_id" class="form-control" required>
            <option value="">- pilih -</option>
            @foreach($suppliers as $s)
              <option value="{{ $s->id }}">{{ $s->name }}</option>
            @endforeach
          </select>
        </div>
        <div class="col-md-4">
          <label>Tanggal</label>
          <input type="date" name="date" class="form-control" required>
        </div>
        <div class="col-md-4">
          <label>Catatan</label>
          <input type="text" name="note" class="form-control">
        </div>
      </div>

      <hr>
      <h5>Items</h5>

      <div id="items"></div>

      <button type="button" class="btn btn-secondary" id="addItem">+ Tambah Item</button>
      <button class="btn btn-primary">Simpan</button>
    </form>
  </div>
</div>
@endsection

@push('scripts')
<script>
let idx = 0;
const spareparts = @json($spareparts);

function rowTemplate(i){
  let options = `<option value="">- pilih -</option>`;
  spareparts.forEach(sp => {
    options += `<option value="${sp.id}">${sp.code} - ${sp.name}</option>`;
  });

  return `
  <div class="card p-3 mb-2">
    <div class="row">
      <div class="col-md-6">
        <label>Sparepart</label>
        <select name="items[${i}][sparepart_id]" class="form-control" required>${options}</select>
      </div>
      <div class="col-md-2">
        <label>Qty</label>
        <input type="number" name="items[${i}][qty]" class="form-control" min="1" required>
      </div>
      <div class="col-md-3">
        <label>Harga Beli</label>
        <input type="number" step="0.01" name="items[${i}][price]" class="form-control" min="0" required>
      </div>
      <div class="col-md-1 d-flex align-items-end">
        <button type="button" class="btn btn-danger btn-sm remove">x</button>
      </div>
    </div>
  </div>`;
}

document.getElementById('addItem').addEventListener('click', () => {
  const div = document.createElement('div');
  div.innerHTML = rowTemplate(idx++);
  div.querySelector('.remove').addEventListener('click', () => div.remove());
  document.getElementById('items').appendChild(div);
});

// auto 1 item
document.getElementById('addItem').click();
</script>
@endpush