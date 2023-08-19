@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">

                    <table class="table">
                        <thead>
                            <tr>
                                <th>Title</th>
                                <td>{{ $translatedTitle }}</td>
                            </tr>
                            <tr>
                                <th>Heading 1</th>
                                <td>{{ $translatedContent1 }}</td>
                            </tr>
                            <tr>
                                <th>Heading 2</th>
                                <td>{{ $translatedContent2 }}</td>
                            </tr>
                            <tr>
                                <th>Heading 3</th>
                                <td>{{ $translatedContent3 }}</td>
                            </tr>
                        </thead>
                    </table>


                </div>
            </div>
        </div>
    </div>
</div>
@endsection
