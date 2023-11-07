@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Permission Disabled') }}</div>

                <div class="card-body">
                    {{-- @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{ __('A fresh verification link has been sent to your email address.') }}
                        </div>
                    @endif --}}

                    Your access permission has been temporarily disabled by the administrator. Please contact the administrator to request reactivation.
                    <a href="mailTo:{{ config('cms.support.email') }}">{{ config('cms.support.email') }}</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
