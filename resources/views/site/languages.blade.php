@extends('layouts.site')

@section('title', 'Homepage')

@section('header')
    @include('site.includes.header')
@endsection


@section('css')
<style>
    .center-links {
        display: flex;
        justify-content: center;
        height: 100vh;
    }
    .center-links div a {
        background-color: #1977cc;
        color: white;
    }
    .center-links div a:hover {
        border: 2px solid #1977cc !important;
        color: black;
    }
</style>
@endsection

@section('content')
<main id="main">

    <!-- ======= Start items Section ======= -->
    <section id="items" class="items">
        <div class="container">

            <div class="section-title mb-5">
              <h4>{{ __('message.select_your_item') }}</h4>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <div class="container">
                        <div class="center-links">
                            <div>
                                <a href="{{ route('site.language.item', [request()->segment(1), 'fruits']) }}" class="btn m-1">{{ __('message.fruits') }}</a>
                                <a href="#" class="btn m-1">{{ __('message.vegetables') }}</a>
                                <a href="#" class="btn m-1">{{ __('message.vitamins') }}</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ======= End items Section ======= -->


</main>
@endsection

@section('scripts')
<script>
    $(document).ready(function() {

        $('.language').on('change', function() {

          var selectedLanguage = this.value;
          var currentUrl = window.location.href;
          var urlParts = currentUrl.split('/');

          // Find the section part in the URL
        //   var sectionIndex = urlParts.indexOf("fruits") !== -1 ? urlParts.indexOf("fruits") :
        //                     urlParts.indexOf("vegetables") !== -1 ? urlParts.indexOf("vegetables") :
        //                     urlParts.indexOf("vitamins") !== -1 ? urlParts.indexOf("vitamins") :
        //                     -1;

        //   if (sectionIndex !== -1) {
              // Update the language part in the URL
              urlParts[3] = selectedLanguage; // Assuming the language part is at index 3

            //   alert(urlParts[3])

              // Reconstruct the URL with the updated language
              var newUrl = urlParts.join('/');
              window.location.href = newUrl;

              $('.language').val(selectedLanguage).attr("selected", "selected");
        //   }
      });

    });
  </script>
@endsection
