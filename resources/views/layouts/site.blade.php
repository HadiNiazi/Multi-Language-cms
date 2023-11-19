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
  @yield('header')
  <!-- End Header -->
  <div style="margin-bottom: 150px;"></div>

  <!-- Start #main -->
  @yield('content')
  <!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer" class="site-footer">


    <div class="container d-md-flex py-4">

      <div class="me-md-auto text-center text-md-start">
        <div class="copyright">
          &copy; Copyright <strong><span><a target="_blank" href="https://cdlcell.com">Career Developmen Lab</a></span></strong>. All Rights Reserved
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

  <script>
    $(document).ready(function() {

        $('.language').on('change', function() {
          var selectedLanguage = this.value;
          var currentUrl = window.location.href;
          var urlParts = currentUrl.split('/');

          // Find the section part in the URL
          var sectionIndex = urlParts.indexOf("fruits") !== -1 ? urlParts.indexOf("fruits") :
                            urlParts.indexOf("vegetables") !== -1 ? urlParts.indexOf("vegetables") :
                            urlParts.indexOf("vitamins") !== -1 ? urlParts.indexOf("vitamins") :
                            -1;



          if (sectionIndex !== -1) {
              // Update the language part in the URL
              urlParts[3] = selectedLanguage; // Assuming the language part is at index 3

              // Reconstruct the URL with the updated language
              var newUrl = urlParts.join('/');
              window.location.href = newUrl;
          }
          else {
            urlParts[3] = selectedLanguage; // Assuming the language part is at index 3
              // Reconstruct the URL with the updated language
              var newUrl = urlParts.join('/');
              window.location.href = newUrl;
          }


      });

    });
  </script>

  <script src="{{ asset('assets/site/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <!-- Template Main JS File -->
  <script src="{{ asset('assets/site/js/main.js') }}"></script>


</body>

</html>
