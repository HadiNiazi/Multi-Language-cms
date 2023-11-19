@extends('layouts.site')

@section('title', 'Homepage')

@section('header')
@include('site.includes.landing_page_header')
@endsection

@section('css')
<style>
    .center-links {
        display: flex;
        justify-content: center;
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
              <h4>Please select your language to continue</h4>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <div class="container">
                        <div class="center-links">
                            <div>
                                @if (count($languages) > 0)
                                    @foreach ($languages as $language)
                                        <a href="{{ route('site.languages', $language->code) }}" class="btn m-1">{{ ucfirst($language->name) }}</a>
                                    @endforeach
                                @else
                                <h4 class="text-danger text-center">No language found.</h4>
                                @endif
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
