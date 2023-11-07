@extends('layouts.admin')

@section('title', 'Admin Dashboard')

@section('css')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.css">
@endsection

@section('content')
<div class="content-wrapper">
	<div class="content">

        <div class="d-flex justify-content-between mb-3">
            <h4 class="text-dark font-weight-medium"><b>Fruits</b></h4>
        </div>
        <div class="invoice-wrapper rounded border bg-white py-5 px-3 px-md-4 px-lg-5 mb-6">

            <div class="table-responsive">
            <table id="lessons-table" class="table mt-3 table-striped text-center" style="width:100%">
                <thead>
                <tr>
                    <th>Title 1</th>
                    <th>Title 2</th>
                    <th>Title 3</th>
                    <th>Translation Status</th>
                    <th>Created By</th>
                    <th>Updated By</th>
                    <th>Created At</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>

        </div>
    </div>
</div>
@endsection

@section('scripts')
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.js"></script>
<script>

    $(document).ready(function() {

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        let currentLocation = window.location.href;

        var languageId = currentLocation.substring(currentLocation.lastIndexOf('/') + 1);

        var table = $("#lessons-table").DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('fruits.index', '') }}" + '/'+ languageId,
            columns: [
                {data: 'title_1'},
                {data: 'title_2'},
                {data: 'title_3'},
                {data: 'status'},
                {data: 'created_by'},
                {data: 'updated_by'},
                {data: 'created_at'},
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ]
        });



        // Deleting Post
        $('body').on('click', '.deleteButton', function (e) {

            e.preventDefault();

            var fruit_id = $(this).data("id");

            if(confirm("Are You sure want to delete !")){
                $.ajax({
                type: "DELETE",
                url: "{{ route('admin.fruits.destroy', '') }}" +'/'+ fruit_id,
                success: function (data) {

                    if (data.message) {
                        toastr["info"](data.message);
                    }

                    table.draw();
                },
                error: function (data) {

                    if(data.responseJSON.error){
                        toastr["error"](data.responseJSON.error);
                    }
                    else {
                        toastr["error"]('Something went wrong, please refresh webpage and try again, if still problem persist contact with administrator');
                    }

                }
                });
            }


        });

    });

</script>


@endsection
