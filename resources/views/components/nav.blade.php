<nav class="navbar bg-body-tertiary fixed-top">
  <div class="container-fluid">
    <a class="navbar-brand" href="{{route('home')}}">Test Books</a>
    @if(auth()->check())
    <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar"
      aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
      <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="offcanvasNavbarLabel">Menu</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
      </div>
      <div class="offcanvas-body">
        <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="{{route('books.index')}}"><i class="fa-solid fa-book"></i> Inicio</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{route('genders.index')}}"><i class="fa-solid fa-bookmark"></i> Géneros</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{route('logout')}}"><i class="fa-solid fa-right-from-bracket"></i> Logout</a>
          </li>
        </ul>
      </div>
    </div>
    @endif
  </div>
</nav>