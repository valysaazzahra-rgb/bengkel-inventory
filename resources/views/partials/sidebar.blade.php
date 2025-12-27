<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <a href="{{ route('dashboard') }}" class="brand-link">
    <span class="brand-text font-weight-light ml-2">Bengkel Inventory</span>
  </a>

  <div class="sidebar">
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column">

        <li class="nav-item">
          <a href="{{ route('dashboard') }}" class="nav-link">
            <i class="nav-icon fas fa-tachometer-alt"></i><p>Dashboard</p>
          </a>
        </li>

        @if(in_array(auth()->user()->role, ['admin','staff']))
          <li class="nav-header">MASTER DATA</li>
          <li class="nav-item"><a href="{{ route('categories.index') }}" class="nav-link"><i class="nav-icon fas fa-tags"></i><p>Kategori</p></a></li>
          <li class="nav-item"><a href="{{ route('suppliers.index') }}" class="nav-link"><i class="nav-icon fas fa-truck"></i><p>Supplier</p></a></li>
          <li class="nav-item"><a href="{{ route('spareparts.index') }}" class="nav-link"><i class="nav-icon fas fa-cogs"></i><p>Sparepart</p></a></li>

          <li class="nav-header">TRANSAKSI</li>
          <li class="nav-item"><a href="{{ route('stock-ins.index') }}" class="nav-link"><i class="nav-icon fas fa-arrow-down"></i><p>Stok Masuk</p></a></li>
          <li class="nav-item"><a href="{{ route('stock-outs.index') }}" class="nav-link"><i class="nav-icon fas fa-arrow-up"></i><p>Stok Keluar</p></a></li>
        @endif

        <li class="nav-header">LAPORAN</li>
        <li class="nav-item"><a href="{{ route('reports.low-stock') }}" class="nav-link"><i class="nav-icon fas fa-exclamation-triangle"></i><p>Stok Menipis</p></a></li>
        <li class="nav-item"><a href="{{ route('reports.transactions') }}" class="nav-link"><i class="nav-icon fas fa-list"></i><p>Transaksi</p></a></li>
        <li class="nav-item"><a href="{{ route('reports.recap') }}" class="nav-link"><i class="nav-icon fas fa-chart-bar"></i><p>Rekap</p></a></li>

        @if(auth()->user()->role === 'admin')
          <li class="nav-header">ADMIN</li>
          <li class="nav-item"><a href="{{ route('users.index') }}" class="nav-link"><i class="nav-icon fas fa-users"></i><p>Users</p></a></li>
        @endif

      </ul>
    </nav>
  </div>
</aside>