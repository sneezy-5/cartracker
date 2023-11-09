
  <!-- Topbar Start -->
  <div class="container-fluid bg-dark py-3 px-lg-5 d-none d-lg-block bg-topstart">
       @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
        <div class="row">
            <div class="col-md-6 text-center text-lg-left mb-2 mb-lg-0">
                <div class="d-inline-flex align-items-center " >
                    <a class="text-body pr-3 cl-topstart" href=""><i class="fa fa-phone-alt mr-2 cl-topstart" ></i>+225 0000000</a>
                    <span class="text-body">|</span>
                    <a class="text-body px-3 cl-topstart" href=""><i class="fa fa-envelope mr-2"></i>contact@X-transports.net</a>
                </div>
            </div>
            <div class="col-md-6 text-center text-lg-right">
                <div class="d-inline-flex align-items-center">
                    <a class="text-body px-3 cl-topstart" href="">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a class="text-body px-3 cl-topstart" href="">
                        <i class="fab fa-twitter"></i>
                    </a>
                    <a class="text-body px-3 cl-topstart" href="">
                        <i class="fab fa-linkedin-in"></i>
                    </a>
                    <a class="text-body px-3 cl-topstart" href="">
                        <i class="fab fa-instagram"></i>
                    </a>
                    <a class="text-body pl-3 cl-topstart" href="">
                        <i class="fab fa-youtube"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <!-- Topbar End -->


<!-- Navbar Start -->
<div class="container-fluid position-relative nav-bar p-0 bg-topstart">
    <div class="position-relative bg-topstart" style="z-index: 9;">
        <nav class="navbar navbar-expand-lg bg-secondary navbar-dark py-3 py-lg-0 pl-3 pl-lg-5 bg-nav">
            <a href="" class="navbar-brand">
                <img class="logo" src="{{asset('img/car-rent-1.png')}}">
            </a>
            <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-between px-3" id="navbarCollapse">
                <div class="navbar-nav ml-auto py-0">
                    <a href="/" class="nav-item nav-link @if(Request::is('/')) active @endif">Accueil</a>
                    <a href="{{ route('about') }}" class="nav-item nav-link @if(Request::is('about')) active @endif">A propos</a>
                    <a href="{{ route('service') }}" class="nav-item nav-link @if(Request::is('services')) active @endif">Service</a>
                    <div class="nav-item dropdown">
                        <a href="{{ route('carlist') }}" class="nav-link dropdown-toggle" data-toggle="dropdown">Vehicule</a>
                        <div class="dropdown-menu rounded-0 m-0">
                            <a href="{{ route('carlist') }}" class="dropdown-item @if(Request::is('carlist')) active @endif">Liste de vehicue</a>
                            <!-- Autres éléments de menu ici -->
                        </div>
                    </div>
                    <a href="{{ route('contact') }}" class="nav-item nav-link @if(Request::is('contact')) active @endif">Contact</a>
                </div>
            </div>
        </nav>
    </div>
</div>
<!-- Navbar End -->

