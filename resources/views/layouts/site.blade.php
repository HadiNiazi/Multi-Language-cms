<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>@yield('title') | {{ config('app.name') }} </title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  {{-- <link href="{{ asset('assets/site/img/favicon.png') }}" rel="icon"> --}}
  {{-- <link href="{{ asset('assets/site/img/apple-touch-icon.png') }}" rel="apple-touch-icon"> --}}

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="{{ asset('assets/site/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/site/vendor/animate.css/animate.min.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/site/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/site/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/site/vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/site/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/site/vendor/remixicon/remixicon.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/site/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('assets/site/css/common.css') }}">
  <!-- Template Main CSS File -->

  <link href="{{ asset('assets/site/plugins/toaster/toastr.min.css') }}">

  @yield('css')

  <link href="{{ asset('assets/site/css/style.css') }}" rel="stylesheet">
</head>

<body>


  <!-- ======= Header ======= -->
  <header id="header" class="fixed-top">
    <div class="container d-flex align-items-center">

      <h1 class="logo me-auto"><a href="{{ route('site.home') }}">CMS</a></h1>
      <!-- Uncomment below if you prefer to use an image logo -->
      <!-- <a href="{{ route('site.home') }}" class="logo me-auto"><img src="{{ asset('assets/site/img/logo.png') }}" alt="" class="img-fluid"></a>-->

      <nav id="navbar" class="navbar order-last order-lg-0">
        <ul>
          <li class="dropdown"><a href="#"><span>Fruits</span> <i class="bi bi-chevron-down"></i></a>
            <ul>
                @if (count(fetchAllPublishedFruits()) > 0)
                    @foreach (fetchAllPublishedFruits() as $fruit)
                            <li><a href="#">{{ $fruit->translation ? $fruit->translation->title_1: '' }}</a></li>
                    @endforeach
                @else
                <ul>
                    <li>
                        <a href="#">No fruit found.</a>
                    </li>
                </ul>
                @endif

                <li><a href="#">More...</a></li>
            </ul>
          </li>
          <li class="dropdown"><a href="#"><span>Vegetables</span> <i class="bi bi-chevron-down"></i></a>
            <ul>
                <li><a href="#">Vegetable 1</a></li>
                <li><a href="#">Vegetable 2</a></li>
                <li><a href="#">Vegetable 3</a></li>
                <li><a href="#">More...</a></li>
            </ul>
          </li>
          <li class="dropdown"><a href="#"><span>Vitamins</span> <i class="bi bi-chevron-down"></i></a>
            <ul>
                <li><a href="#">Vitamin 1</a></li>
                <li><a href="#">Vitamin 2</a></li>
                <li><a href="#">Vitamin 3</a></li>
                <li><a href="#">More...</a></li>
            </ul>
          </li>

          <li><a class="nav-link scrollto" href="#contact">Contact</a></li>

          <li class="flex-parent">
            <input type="text" name="search" id="search-input" class="form-control flex-child" placeholder="Search...">
            <button class="flex-child btn" id="search-btn"><i class="fas fa-search"></i></button>
          </li>

          <!-- list item with multiple childs -->
          {{-- <li class="dropdown"><a href="#"><span>Fruits</span> <i class="bi bi-chevron-down"></i></a>
            <ul>
                <li><a href="#">Drop Down 1</a></li>
                <li class="dropdown"><a href="#"><span>Deep Drop Down</span> <i class="bi bi-chevron-right"></i></a>
                <ul>
                    <li><a href="#">Deep Drop Down 1</a></li>
                    <li><a href="#">Deep Drop Down 2</a></li>
                    <li><a href="#">Deep Drop Down 3</a></li>
                    <li><a href="#">Deep Drop Down 4</a></li>
                    <li><a href="#">Deep Drop Down 5</a></li>
                </ul>
                </li>
                <li><a href="#">Drop Down 2</a></li>
                <li><a href="#">Drop Down 3</a></li>
                <li><a href="#">Drop Down 4</a></li>
            </ul>
          </li> --}}

          <li>
            <select name="languages" class="languages-dropdwon">
                <option value="" disabled selected>Choose Language</option>
                <option value="ara">Arabic</option>
                <option value="urd">Urdu</option>
              </select>
          </li>

          <li>
            <a href="{{ route('login') }}" class="btn login-btn">Login</a>
          </li>

        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav><!-- .navbar -->


      {{-- <a href="#appointment" class="appointment-btn scrollto"><span class="d-none d-md-inline">Make an</span> Appointment</a> --}}

    </div>
  </header><!-- End Header -->
  <div style="margin-bottom: 150px;"></div>

  <!-- Start #main -->
  @yield('content')
  <!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer" class="site-footer">


    <div class="container d-md-flex py-4">

      <div class="me-md-auto text-center text-md-start">
        <div class="copyright">
          &copy; Copyright <strong><span><a href="https://cdlcell.com">Career Developmen Lab</a></span></strong>. All Rights Reserved
        </div>
      </div>
      <div class="social-links text-center text-md-right pt-3 pt-md-0">
        <a href="#" class="twitter"><i class="bx bxl-twitter"></i></a>
        <a href="#" class="facebook"><i class="bx bxl-facebook"></i></a>
        <a href="#" class="instagram"><i class="bx bxl-instagram"></i></a>
        <a href="#" class="google-plus"><i class="bx bxl-skype"></i></a>
        <a href="#" class="linkedin"><i class="bx bxl-linkedin"></i></a>
      </div>
    </div>
  </footer><!-- End Footer -->

  <div id="preloader"></div>
  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
  <!-- Vendor JS Files -->

  <script src="{{ asset('assets/site/plugins/toasts/toast.js') }}"></script>
  <script src="{{ asset('assets/site/plugins/toasts/main.js') }}"></script>
  @yield('scripts')

  <script src="{{ asset('assets/site/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <!-- Template Main JS File -->
  <script src="{{ asset('assets/site/js/main.js') }}"></script>

</body>

</html>
