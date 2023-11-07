@extends('layouts.admin')

@section('title', 'Assigned Languages')

@section('content')
    <div class="content-wrapper">
        <div class="content">

            <div class="card card-default">
                <div class="card-header">
                    <h2>Assigned Languages</h2>

                </div>
                <div class="card-body">

                    @if(isAdmin())

                        @foreach ($allLanguages as $langauge)
                            <form id="language_form">
                                <div class="col-12">
                                    Translate into <a data-lang="{{ $langauge['code'] }}" class="assignedLanguage mt-2" href="javascript:void(0)">{{ $langauge['name'] }}</a><br>
                                </div>
                            </form>
                        @endforeach

                    @elseif ($assignedLanguages)
                        @foreach ($assignedLanguages as $langauge)
                            <form id="language_form">
                                <div class="col-12">
                                    Translate into <a data-lang="{{ $langauge['code'] }}" class="assignedLanguage mt-2" href="javascript:void(0)">{{ $langauge['name'] }}</a><br>
                                </div>
                            </form>
                        @endforeach
                    @else
                        <h4 style="padding: 20px" class="text-center text-danger">No Language assigned to you yet.</h4>
                    @endif

                </div>
            </div>

        </div>

    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            $('.assignedLanguage').click(function(e) {

                e.preventDefault();

                var language = $(this).data("lang");

                window.location = "{{ route('fruits.index', '') }}" +'/'+language;

                return false;
            });
        });
    </script>
@endsection
