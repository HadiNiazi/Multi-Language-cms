@extends('layouts.admin')

@section('title', 'Admin Dashboard')

@section('css')

@endsection

@section('content')
<div class="content-wrapper">
    <div class="content">
        <div class="row">
            <div class="col-lg-12">
                <div class="card card-default">
                    <div class="card-header">
                      <h2>Sections</h2>
                    </div>
                    <div class="card-body">

                      <div class="row">

                        <div class="col-lg-3 col-xl-4">
                          <div class="card card-default">
                            <div class="card-header card-header-border-bottom">
                              <h2>Fruits <small><span class="badge badge-primary badge-pill">{{ $totalFruitsCount ? $totalFruitsCount: 0 }}</span></small></h2>
                            </div>
                            <div class="card-body">
                              <a href="{{ route('languages', ['section' => 'fruits']) }}" type="button" class="btn btn-primary btn-pill">Open All</a>
                            </div>
                          </div>
                        </div>

                        <div class="col-lg-3 col-xl-4">
                            <div class="card card-default">
                              <div class="card-header card-header-border-bottom">
                                <h2>Vegetables <small><span class="badge badge-secondary badge-pill">0</span></small></h2>
                              </div>
                              <div class="card-body">
                                <a type="button" class="btn btn-secondary btn-pill">Open All</a>
                              </div>
                            </div>
                        </div>

                        <div class="col-lg-3 col-xl-4">
                            <div class="card card-default">
                              <div class="card-header card-header-border-bottom">
                                <h2>Herbs <small><span class="badge badge-warning badge-pill">0</span></small></h2>
                              </div>
                              <div class="card-body">
                                <a type="button" class="btn btn-warning btn-pill">Open All</a>
                              </div>
                            </div>
                        </div>

                      </div>
                    </div>
                  </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')

@endsection
