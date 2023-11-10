@extends('layouts.site')

@section('title', 'Homepage')

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
              <h4>Please select your item</h4>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <div class="container">
                        <div class="center-links">
                            <div>
                                <a href="{{ route('site.language.item', [request()->segment(1), 'fruits']) }}" class="btn m-1">Fruits</a>
                                <a href="#" class="btn m-1">Vegetables</a>
                                <a href="#" class="btn m-1">Vitamins</a>
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
