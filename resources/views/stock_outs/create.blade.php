@extends('layouts.app')

@section('content')
<div class="card">
  <div class="card-header"><strong>Tambah Stok Keluar</strong></div>
  <div class="card-body">
    <form method="POST" action="{{ route('stock-outs.store') }}">
      @csrf

      <div class="row">
        <div class="col-md-3">
          <label>Tanggal</label>
          <input type="date" name="date" class="form-control" required>
        </div>
        <div class="col-md-3">
          <label>Tipe</label>
          <select name="type" class="form-control" required>
            <option value="sale">Sale</option>
            <option value="service">Service</option>
          </select>
        </div>
        <div class="col-md-3">
          <label>Customer (opsional)</label>
          <input type="text" name="customer_name" class="form-control">
        </div>
        <div class="col-md-3">
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
    options += `<option value="${sp.id}" data-stock="${sp.stock}">
      ${sp.code} - ${sp.name} (stok: ${sp.stock})
    </option>`;
  });

  return `
  <div class="card p-3 mb-2">
    <div class="row">
      <div class="col-md-6">
        <label>Sparepart</label>
        <select name="items[${i}][sparepart_id]" class="form-control sparepart-select" required>
          ${options}
        </select>
        <small class="text-muted stock-info"></small>
      </div>

      <div class="col-md-2">
        <label>Qty</label>
        <input type="number" name="items[${i}][qty]" class="form-control qty" min="1" required>
      </div>

      <div class="col-md-3">
        <label>Harga</label>
        <input type="number" step="0.01" name="items[${i}][price]" class="form-control" min="0" required>
      </div>

      <div class="col-md-1 d-flex align-items-end">
        <button type="button" class="btn btn-danger btn-sm remove">x</button>
      </div>
    </div>
  </div>`;
}

function attachEvents(container){
  const select = container.querySelector('.sparepart-select');
  const info = container.querySelector('.stock-info');
  const qty = container.querySelector('.qty');

  const updateInfo = () => {
    const opt = select.options[select.selectedIndex];
    const stock = opt?.getAttribute('data-stock');
    info.textContent = stock !== null ? `Stok tersedia: ${stock}` : '';
    if (stock) qty.max = stock; // bantu user, tapi tetap dicek di controller
  };

  select.addEventListener('change', updateInfo);
  updateInfo();
}

document.getElementById('addItem').addEventListener('click', () => {
  const wrapper = document.createElement('div');
  wrapper.innerHTML = rowTemplate(idx++);
  const box = wrapper.firstElementChild;

  box.querySelector('.remove').addEventListener('click', () => box.remove());
  attachEvents(box);

  document.getElementById('items').appendChild(box);
});

// auto 1 item
document.getElementById('addItem').click();
</script>
@endpush