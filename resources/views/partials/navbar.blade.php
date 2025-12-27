<nav class="main-header navbar navbar-expand navbar-white navbar-light">
  <ul class="navbar-nav">
    <li class="nav-item">
      <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
    </li>
  </ul>

  <ul class="navbar-nav ml-auto">
    <li class="nav-item mr-3">
      <span class="nav-link">
        {{ auth()->user()->name }} ({{ auth()->user()->role }})
      </span>
    </li>
    <li class="nav-item">
      <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button class="btn btn-danger btn-sm mt-1 mr-2">Logout</button>
      </form>
    </li>
  </ul>
</nav>