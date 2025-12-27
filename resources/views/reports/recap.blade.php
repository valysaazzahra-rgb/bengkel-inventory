@extends('layouts.app')

@section('content')
<div class="card">
  <div class="card-header"><strong>Rekap</strong></div>
  <div class="card-body">

    <form method="GET" class="row mb-3">
      <div class="col-md-3">
        <label>Dari</label>
        <input type="date" name="from" class="form-control" value="{{ $from }}">
      </div>
      <div class="col-md-3">
        <label>Sampai</label>
        <input type="date" name="to" class="form-control" value="{{ $to }}">
      </div>
      <div class="col-md-3 d-flex align-items-end">
        <button class="btn btn-primary">Filter</button>
      </div>
    </form>

    <div class="row">
      <div class="col-md-6">
        <div class="card"><div class="card-body">
          <h5>Total Stok Masuk</h5>
          <h3>{{ number_format($totalIn, 2) }}</h3>
        </div></div>
      </div>
      <div class="col-md-6">
        <div class="card"><div class="card-body">
          <h5>Total Stok Keluar</h5>
          <h3>{{ number_format($totalOut, 2) }}</h3>
        </div></div>
      </div>
    </div>

  </div>
</div>
@endsection