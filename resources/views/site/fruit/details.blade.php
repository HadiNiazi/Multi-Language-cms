@extends('layouts.site')

@section('title', 'Homepage')

@section('css')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="{{ asset('assets/site/css/common.css') }}">
@endsection

@section('header')
    @include('site.includes.header')
@endsection

@section('content')
<main id="main">

    <!-- ======= Start items Section ======= -->
    <section id="items" class="items">
        <div class="container">

            <div class="section-title mb-5">
              <h2>{{ __('message.fruits') }}</h2>

              <a href="{{ route('site.language.item', [request()->segment(1), request()->segment(2)]) }}" class="btn" style="background-color: #1977cc; color: white">{{ __('message.go_back') }}</a>
            </div>


            <div class="row">
                <div class="col-lg-12">
                    @if ($translation)
                        <table id="fruits-details-table" class="table" @if(request()->language == 'urd' || request()->language == 'ara') dir="rtl" @endif>
                            <thead>
                                <tr>
                                    <th>{{ __('message.title_1') }}</th>
                                    <td>{{ $translation ? $translation->title_1: '' }}</td>
                                </tr>
                                <tr>
                                    <th>{{ __('message.heading_title_1') }}</th>
                                    <td>{{ $translation ? $translation->heading_title_1: '' }}</td>
                                </tr>
                                <tr>
                                    <th>{{ __('message.description_1') }}</th>
                                    <td>{!! $translation ? $translation->description_1: '' !!}</td>
                                </tr>

                                <tr style="height: 50px;">
                                    <td></td>
                                    <td></td>
                                </tr>

                                <tr>
                                    <th>{{ __('message.title_2') }}</th>
                                    <td>{{ $translation ? $translation->title_2: '' }}</td>
                                </tr>
                                <tr>
                                    <th>{{ __('message.heading_title_2') }}</th>
                                    <td>{{ $translation ? $translation->heading_title_2: '' }}</td>
                                </tr>

                                <tr>
                                    <th>{{ __('message.description_2') }}</th>
                                    <td>{!! $translation ? $translation->description_2: '' !!}</td>
                                </tr>

                                <tr style="height: 50px;">
                                    <td></td>
                                    <td></td>
                                </tr>

                                <tr>
                                    <th>{{ __('message.title_3') }}</th>
                                    <td>{{ $translation ? $translation->title_3: '' }}</td>
                                </tr>
                                <tr>
                                    <th>{{ __('message.heading_title_3') }}</th>
                                    <td>{{ $translation ? $translation->heading_title_3: '' }}</td>
                                </tr>
                                <tr>
                                    <th>{{ __('message.description_3') }}</th>
                                    <td>{!! $translation ? $translation->description_3: '' !!}</td>
                                </tr>
                            </thead>

                        </table>

                        <div class="mt-5 mb-3 " @if(request()->language == 'urdu' || request()->language == 'arabic') dir="rtl" @endif>
                                @if ($translation)
                                    @if($translation->images != null)

                                        <h5 class="text-black"><b>Images</b></h5>

                                        @foreach (explode('|', $translation->images) as $image)
                                            @if ($image != null)
                                                <img src="{{ asset('storage/fruits/images/'. $image) }}" class="img-fluid image-size" alt="fruit image">
                                            @endif
                                        @endforeach

                                    @endif
                                @endif
                        </div>
                    @else
                    <h4 class="text-danger text-center text-bold">No fruit found.</h4>
                    @endif
                </div>
            </div>
    </section>
    <!-- ======= End items Section ======= -->


</main>
@endsection
