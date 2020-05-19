<header id="header"@if(Route::current()->getName() != 'home') class="header-fixed"@endif>
  <div class="container">

    <div id="logo" class="pull-left">
      <h1>
        <a href="{{ route('home') }}#intro">
          <span><i class="fa fa-map-marker" aria-hidden="true"></i></span>
          {{ env('APP_NAME', 'The Event') }}
        </a>
      </h1>
    </div>

    <nav id="nav-menu-container">
      <ul class="nav-menu">
        <li class="menu-active"><a href="{{ Route::current()->getName() != 'home' ? route('home') : '' }}#intro">Home</a></li>
        <li><a href="{{ Route::current()->getName() != 'home' ? route('home') : '' }}#barang">Barang</a></li>
        <li><a href="{{ Route::current()->getName() != 'home' ? route('home') : '' }}#jenis">Jenis</a></li>
        <li><a href="{{ Route::current()->getName() != 'home' ? route('home') : '' }}#satuan">Satuan</a></li>
      </ul>
    </nav>
  </div>
</header>
