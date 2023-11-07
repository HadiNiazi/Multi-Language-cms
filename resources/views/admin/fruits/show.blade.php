@extends('layouts.admin')

@section('title', 'Show Fruit')

@section('css')
    <style>
        table th {
            width: 15%;
        }
    </style>
@endsection

@section('content')
    <div class="content-wrapper">
        <div class="content">

            <a href="{{ route('admin.fruits.index') }}" class="btn btn-info mt-2 mb-3">Go Back</a>

            <div class="invoice-wrapper rounded border bg-white py-5 px-3 px-md-4 px-lg-5 mb-6">
                <div class="d-flex justify-content-between mb-3">
                    <h4 class="text-dark font-weight-medium">
                        <b>Show Fruit</b>
                    </h4>
                </div>

                <div class="card card-default">
                    <div class="card-body">

                        <h4 class="mt-2 mb-3"><b>Heading 1</b></h4>

                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">Title</th>
                                    <td>{{ $translation->title_1 }}</td>
                                </tr>
                                <tr>
                                    <th scope="col">Heading Title</th>
                                    <td>{{ $translation->heading_title_1 }}</td>
                                </tr>
                                <tr>
                                    <th scope="col">Description</th>
                                    <td>{{ strip_tags($translation->description_1) }}</td>
                                </tr>
                            </thead>
                        </table>

                        <h4 class="mt-3 mb-3"><b>Heading 2</b></h4>

                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">Title</th>
                                    <td>{{ $translation->title_2 }}</td>
                                </tr>
                                <tr>
                                    <th scope="col">Heading Title</th>
                                    <td>{{ $translation->heading_title_2 }}</td>
                                </tr>
                                <tr>
                                    <th scope="col">Description</th>
                                    <td>{{ strip_tags($translation->description_2) }}</td>
                                </tr>
                            </thead>
                        </table>

                        <h4 class="mt-2 mb-3"><b>Heading 3</b></h4>

                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">Title</th>
                                    <td>{{ $translation->title_3 }}</td>
                                </tr>
                                <tr>
                                    <th scope="col">Heading Title</th>
                                    <td>{{ $translation->heading_title_3 }}</td>
                                </tr>
                                <tr>
                                    <th scope="col">Description</th>
                                    <td>{{ strip_tags($translation->description_3) }}</td>
                                </tr>
                            </thead>
                        </table>

                        @if ($fruit->translation)
                            @if ($fruit->translation->images != null)
                                <h4 class="mt-2 mb-3"><b>Image</b></h4>
                                @foreach (explode('|', $fruit->translation->images) as $image)
                                    <img src="{{ asset('storage/fruits/images/'. $image) }}" style="width: 100%; height: 100%; margin:10px" alt="fruit image">
                                @endforeach
                            @endif
                        @endif

                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection

@section('scripts')
@endsection
