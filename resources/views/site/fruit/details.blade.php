@extends('layouts.site')

@section('title', 'Homepage')

@section('css')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
@endsection

@section('content')
<main id="main">

    <!-- ======= Start items Section ======= -->
    <section id="items" class="items">
        <div class="container">

            <div class="section-title">
              <h2>Fruits</h2>
            </div>


            <div class="row">
                <div class="col-lg-12">
                    <table id="fruits-table" class="table">
                        <thead>
                            <tr>
                                <th>Title 1</th>
                                <td>{{ $translation ? $translation->title_1: '' }}</td>
                            </tr>
                            <tr>
                                <th>Title 2</th>
                                <td>{{ $translation ? $translation->title_2: '' }}</td>
                            </tr>
                            <tr>
                                <th>Title 3</th>
                                <td>{{ $translation ? $translation->title_3: '' }}</td>
                            </tr>
                            <tr>
                                <th>Heading title 1</th>
                                <td>{{ $translation ? $translation->heading_title_1: '' }}</td>
                            </tr>
                            <tr>
                                <th>Heading title 2</th>
                                <td>{{ $translation ? $translation->heading_title_2: '' }}</td>
                            </tr>
                            <tr>
                                <th>Heading title 3</th>
                                <td>{{ $translation ? $translation->heading_title_3: '' }}</td>
                            </tr>
                            <tr>
                                <th>Description 1</th>
                                <td>{!! $translation ? $translation->description_1: '' !!}</td>
                            </tr>
                            <tr>
                                <th>Description 2</th>
                                <td>{!! $translation ? $translation->description_2: '' !!}</td>
                            </tr>
                            <tr>
                                <th>Description 3</th>
                                <td>{!! $translation ? $translation->description_3: '' !!}</td>
                            </tr>
                        </thead>

                      </table>

                      @if($translation->images != null)

                        <h5 class="mt-2 mb-3"><b>Images</b></h5>

                        @foreach (explode('|', $translation->images) as $image)
                            @if ($image != null)
                                <img src="{{ asset('storage/fruits/images/'. $image) }}" class="img-fluid image-size" alt="fruit image">
                            @endif
                        @endforeach
                      @endif
                </div>
            </div>
    </section>
    <!-- ======= End items Section ======= -->


</main>
@endsection
