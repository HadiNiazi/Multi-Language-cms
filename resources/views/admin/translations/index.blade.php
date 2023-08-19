@extends('layouts.auth')

@section('title', 'Admin Dashboard')

@section('css')

@endsection

@section('content')
<div class="content-wrapper" data-select2-id="8">
	<div class="content" data-select2-id="7">
		<!-- For Components documentaion -->
		<div class="card card-default">
			<div class="px-6 py-4">
				<p>Keep transalation safely<span class="text-secondary text-capitalize"> {{ auth()->user() ? auth()->user()->name: '' }} </span> we will help you regarding any query.</a></p>
			</div>
		</div>
		<!-- Masked Input -->
		<div class="card card-default">
			<div class="card-header">
				<h2>Translations</h2>
			</div>
			<div class="card-body">

				<div class="row">
					<div class="col-xl-12">
						<div class="mb-5">
							<label class="text-dark">Key</label>
							<div class="input-group mb-3">
								<input type="text" class="form-control" placeholder="key">
                            </div>
						</div>
					</div>
					<div class="col-xl-12">
						<div class="mb-5">
							<label class="text-dark font-weight-medium">Translation</label>
							<div class="input-group mb-3">
								<textarea name="translation" class="form-control" id="" cols="10" rows="10" placeholder="Enter translation"></textarea>
                            </div>
						</div>
					</div>

                    <div class="col-xl-12">
                        <button class="btn btn-primary">Submit</button>
                    </div>
				</div>

			</div>
		</div>


	</div>
</div>
@endsection

@section('scripts')

@endsection
