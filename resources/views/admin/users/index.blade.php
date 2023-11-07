@extends('layouts.admin')

@section('title', 'Users')

@section('css')
<link rel="stylesheet" href="{{ asset('assets/admin/css/common.css') }}">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.css">
<link href="{{ asset('assets/admin/plugins/select2/css/select2.min.css') }}" rel="stylesheet" />
@endsection

@section('content')
<div class="content-wrapper">
	<div class="content">

        <!-- Add and Edit New user -->
        <div class="modal fade" id="ajaxuserFormModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
              <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title ajaxuserModalTitle"><span id="userFormModalHeading"></span></h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                  </div>

                  <!-- Modal body -->
                  <div class="modal-body">
                    <form id="user_form">
                        <span id="generalError" class="text-danger error_msgs"></span><br>

                        <input type="hidden" name="user" id="user">
                        <div class="row mb-3">
                            <div class="col">
                                <label for="name">Name</label> <span class="star-color">*</span>
                                  <input type="text" name="name" id="name" class="form-control" placeholder="Name">
                                <span id="nameError" class="error_msgs text-danger"></span>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col">
                                <label for="email">Email</label> <span class="star-color">*</span>
                                  <input type="text" name="email" id="email" class="form-control" placeholder="Email">
                                <span id="emailError" class="error_msgs text-danger"></span>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col">
                                <label>Status</label> <span class="star-color">*</span>
                                <select name="status" id="status" class="form-control" required>
                                    <option value="" disabled selected>Choose Option</option>
                                    <option value="0">No</option>
                                    <option value="1">Yes</option>
                                </select>
                                <span id="statusError" class="error_msgs text-danger"></span>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col">
                                <label>Role</label> <span class="star-color">*</span>
                                <select name="role" id="role" class="form-control" required>
                                    <option value="" disabled selected>Choose Option</option>
                                    <option value="0">Translator</option>
                                    <option value="1">Administrator</option>
                                </select>
                                <span id="roleError" class="error_msgs text-danger"></span>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col">
                                <label class="text-dark font-weight-medium">Languages <span style="opacity: 0.5; font-size: 12px">(Optional)</span></label>
                                <select name="languages[]" class="js-example-basic-multiple languages form-control" multiple="multiple">
                                    {{-- @foreach ($languages as $clinician)
                                        <option value="{{ $clinician->id }}">{{ $clinician->name }}</option>
                                    @endforeach --}}
                                </select>
                                <span id="languagesError" class="error_msgs text-danger"></span>
                            </div>
                        </div>
                    </form>
                  </div>

                  <!-- Modal footer -->
                  <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    <button id="userSaveBtn" class="btn btn-success"></button>
                  </div>
              </div>
            </div>
        </div>
        <!-- End Add New User -->


        <!-- Show User -->
        <div class="modal fade" id="ajaxShowUserModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
              <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Show User</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                  </div>

                  <!-- Modal body -->
                  <div class="modal-body">
                    <table class="table table-borderless">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <td id="show_user_name"></td>
                            </tr>
                            <tr>
                                <th>Email</th>
                                <td id="show_user_email"></td>
                            </tr>

                            <tr>
                                <th>Languages</th>
                                <td id="show_languages"></td>
                            </tr>

                            <tr>
                                <th>Role</th>
                                <td id="show_user_role"></td>
                            </tr>

                            <tr>
                                <th>Status</th>
                                <td id="show_user_status"></td>
                            </tr>

                        </thead>
                    </table>

                  </div>

                  <!-- Modal footer -->
                  <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                  </div>
              </div>
            </div>
        </div>
        <!-- End Show user -->

        <a href="javascript:void(0)" id="ajaxNewUser" data-toggle="modal" class="btn btn-info mt-2 mb-4">New User</a>

        <div class="d-flex justify-content-between mb-3">
            <h4 class="text-dark font-weight-medium"><b>Users</b></h4>
        </div>
        <div class="invoice-wrapper rounded border bg-white py-5 px-3 px-md-4 px-lg-5 mb-6">

            <div class="table-responsive">
            <table id="users-table" class="table mt-3 table-striped text-center" style="width:100%">
                <thead>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Languages</th>
                    <th>Role</th>
                    <th>Status</th>
                    <th style="width: 20%">Actions</th>
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
<script src="{{ asset('assets/admin/plugins/select2/js/select2.min.js') }}"></script>

<script>

// $.fn.modal.Constructor.prototype._enforceFocus = function() {};

 // when modal is open
 $('.modal').on('shown.bs.modal', function () {
        $('.languages').select2({
            placeholder: "    Select Option",
            allowClear: true
        });
  });

</script>
<script>

    $(document).ready(function() {

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        var table = $("#users-table").DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('admin.users.index') }}",
            columns: [
                {data: 'name'},
                {data: 'email'},
                {data: 'languages'},
                {data: 'role'},
                {data: 'status', name: 'status', orderable: false, searchable: false},
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ]
        });


        // Save Lesson
        $('#userSaveBtn').click(function (e) {
            e.preventDefault();
            // $('#loader').loading({show: true});
            $(this).html("Saving...");
            $(this).attr('disabled', true);
            $('.error_msgs').html('');

            $.ajax({
                data: $('#user_form').serialize(),
                url: "{{ route('admin.users.store') }}",
                type: "POST",
                dataType: 'json',
                success: function (response) {
                    $('#user_form').trigger("reset");
                    $('#ajaxuserFormModal').modal('hide');
                    toastr['success'](response.message)
                    table.draw();
                },
                error: function (data) {
                    if(data.responseJSON.errors){
                        $("#nameError").html(data.responseJSON.errors.name);
                        $("#emailError").html(data.responseJSON.errors.email);
                        $("#statusError").html(data.responseJSON.errors.status);
                        $("#roleError").html(data.responseJSON.errors.role);
                    }
                    else if(data.responseJSON.error){
                        $("#generalError").html(data.responseJSON.error);
                    }
                    $('#userSaveBtn').html('Save');
                    $('#userSaveBtn').attr('disabled', false);
                }
            });
        });

        // Show User
        $('body').on('click', '.showButton', function () {

            var user_id = $(this).data("id");

            $.ajax({
                data: $('#user_form').serialize(),
                url: "{{ route('admin.users.show', '') }}"+ "/"+ user_id,
                type: "GET",
                dataType: 'json',
                success: function (response) {
                    $('#ajaxShowUserModal').modal('show');

                    if (response.user) {
                        $('#show_user_name').html(response.user.name);
                        $('#show_user_email').html(response.user.email);
                        $('#show_user_role').html(response.user.role);
                        $('#show_user_status').html(response.user.status);
                        $('#show_languages').html(response.user.languages);

                    }
                },
                error: function (data) {
                    if(data.responseJSON.errors){
                        $("#nameError").html(data.responseJSON.errors.name);
                        $("#emailError").html(data.responseJSON.errors.email);
                        $("#statusError").html(data.responseJSON.errors.status);
                    }
                    else if(data.responseJSON.error){
                        toastr['error'](data.responseJSON.error);
                    }
                    else {
                        toastr['error']('Something went wrong, please refresh webpage and try again.');
                    }
                }
            });

        });

        // Edit User
        $('body').on('click', '.editButton', function () {

            $('#userSaveBtn').html('Save');
            $('#userSaveBtn').attr('disabled', false);
            $(".languages").val('').change();

            var user_id = $(this).data("id");
            var url = "{{ route('admin.users.edit', ':id') }}";
            url = url.replace(':id', user_id);

            $.ajax({
                url: url,
                type: "GET",
                dataType: 'json',
                success: function (response) {
                    $('#ajaxuserFormModal').modal('show');
                    $('#userFormModalHeading').html("Edit User");

                    if (response.user) {

                        let status = response.user.email_verified_at != null ? 1: 0;
                        let role = response.user.role;

                        $('#user').val(response.user.id);
                        $('#name').val(response.user.name);
                        $('#email').val(response.user.email);
                        $("#role option[value='"+ role +"']").attr("selected", true);
                        $("#status option[value='"+ status +"']").attr("selected", true);
                    }

                    if (response.languages) {

                        var allOptions = [];
                        var selectedOptions = [];

                        $('.languages').empty().trigger('change');

                        var languages = JSON.parse(loadLanguages());

                        $.each(languages, function(indexs, items) {

                            $.each(items, function(index, item) {

                                $(".languages option[value="+item.id+"]").remove();

                                let languageName = capitalizeFirstLetter(item.name);

                                allOptions = $("<option></option>").val(item.id).text(languageName);

                                $('.languages').append(allOptions).trigger('change');
                            });

                        });

                        $.each(response.languages, function(index, item) {

                            $(".languages option[value="+item.id+"]").remove();

                            let languageName = capitalizeFirstLetter(item.name);

                            selectedOptions = $("<option selected></option>").val(item.id).text(languageName);

                            $('.languages').append(selectedOptions).trigger('change');

                        });

                    }
                },
                error: function (data) {

                    if(data.responseJSON.errors){
                        $("#nameError").html(data.responseJSON.errors.name);
                        $("#emailError").html(data.responseJSON.errors.email);
                        $("#statusError").html(data.responseJSON.errors.status);
                    }
                    else if(data.responseJSON.error){
                        toastr['error'](data.responseJSON.error);
                    }
                    else {
                        toastr["error"]('Something went wrong, please refresh webpage and try again, if still problem persist contact with administrator');
                    }
                    // $('#userSaveBtn').html('Save');
                    // $('#userSaveBtn').attr('disabled', false);
                }
            });

        });

        // Deleting Post
        $('body').on('click', '.deleteButton', function () {

            var user_id = $(this).data("id");

            if(confirm("Are You sure want to delete !")){
                $.ajax({
                type: "DELETE",
                url: "{{ route('admin.users.destroy', '') }}" +'/'+ user_id,
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


        $('#ajaxNewUser').click(function () {
            $("#user_id").val('');
            $('#ajaxuserFormModal').modal('show');
            $('#userSaveBtn').html("Save");
            $('#userFormModalHeading').html("New User");
            $('.error_msgs').html('');
            $('#userSaveBtn').attr('disabled', false);
            $('#user_form').trigger("reset");

            $('.languages').empty().trigger('change');

            var options = [];

            var languages = JSON.parse(loadLanguages());

            $.each(languages, function(indexs, items) {

                $.each(items, function(index, item) {

                    $(".languages option[value="+item.id+"]").remove();

                    let languageName = capitalizeFirstLetter(item.name);

                    options = $("<option></option>").val(item.id).text(languageName);

                    $('.languages').append(options).trigger('change');
                });

            });
        });

        $('body').on('click', '.editButton', function () {
            $('.error_messages').html('');
        });

        $('#ajaxuserFormModal').on('hidden.bs.modal', function() {
            $('.error_msgs').html('');
            $("#status option").attr("selected", false);
            $("#role option").attr("selected", false);
            $(".languages").attr("selected", false);
        });


        function loadLanguages()
        {
            var response = $.ajax({
                async: false,
                url: "{{ route('admin.languages') }}",
                type: "GET",
                dataType: 'json',
                success: function (response) {

                    // console.log(response)

                },
                error: function (data) {

                    if(data.responseJSON.error){
                        toastr['error'](data.responseJSON.error);
                    }
                    else {
                        toastr['error']('Something went wrong, please refresh webpage and try again.');
                    }

                }
            }).responseText;

            return response;

        }

        function capitalizeFirstLetter(string) {
            return string.charAt(0).toUpperCase() + string.slice(1);
        }

    });

</script>


@endsection
