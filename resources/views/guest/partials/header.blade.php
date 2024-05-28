<header>

    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">

          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
              <li class="nav-item">
                <a class="nav-link" aria-current="page" href="{{ route('admin.home') }}">Home</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" aria-current="page" href="{{ route('login') }}">Login</a>
              </li>
              <li class="nav-item">
                {{-- _blanck si usa per aprire una nuova pagina al posto di caricare la stessa pagina --}}
                <a class="nav-link" target="_blank" href="{{ route('home') }}">Go to WebSite</a>
              </li>


            </ul>



          </div>
        </div>
    </nav>

</header>
