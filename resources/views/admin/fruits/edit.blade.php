@extends('layouts.admin')

@section('title', 'Edit Fruit')

@section('css')
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/admin/css/common.css') }}">
    <style>
        div .note-editable ol li {
            margin-left: 15px; /* Adjust the margin as needed */
        }
        div .note-editable ul li {
            list-style-type: disc;
            margin-left: 15px; /* Adjust the margin as needed */
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
                        <b>Edit Fruit</b>
                    </h4>
                </div>

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="post" action="{{ route('admin.fruits.update', $fruit->fruit_id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="row">
                        <div class="col">

                            <h4 class="mt-3 mb-3">Heading 1</h4>

                            <div class="row mb-3">
                                <div class="col">
                                    <label for="title">Title</label> <span class="star-color">*</span>
                                    <input type="text" name="title_1" value="{{ old('title_1', $translation->title_1) }}" class="form-control"
                                        placeholder="Enter title">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col">
                                    <label for="title">Heading Title</label> <span class="star-color">*</span>
                                    <input type="text" name="heading_title_1" value="{{ old('heading_title_1', $translation->heading_title_1) }}"
                                        class="form-control" placeholder="Enter Heading title">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col">
                                    <label>Heading Description</label> <span class="star-color">*</span>
                                    <textarea id="heading_description_1" name="heading_description_1" cols="10" rows="3" class="form-control"
                                        placeholder="Enter description">{{ old('heading_description_1', $translation->description_1) }}</textarea>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="row">
                        <div class="col">

                            <h4 class="mt-3 mb-3">Heading 2</h4>

                            <div class="row mb-3">
                                <div class="col">
                                    <label for="title">Title</label> <span class="star-color">*</span>
                                    <input type="text" name="title_2" value="{{ old('title_2', $translation->title_2) }}" class="form-control"
                                        placeholder="Enter title">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col">
                                    <label for="title">Heading Title</label> <span class="star-color">*</span>
                                    <input type="text" name="heading_title_2" value="{{ old('heading_title_2', $translation->heading_title_2) }}"
                                        class="form-control" placeholder="Enter Heading title">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col">
                                    <label>Heading Description</label> <span class="star-color">*</span>
                                    <textarea id="heading_description_2" name="heading_description_2" cols="10" rows="3" class="form-control"
                                        placeholder="Enter description">{{ old('heading_description_2', $translation->description_2) }}</textarea>
                                </div>
                            </div>

                        </div>
                    </div>


                    <div class="row">
                        <div class="col">

                            <h4 class="mt-3 mb-3">Heading 3</h4>

                            <div class="row mb-3">
                                <div class="col">
                                    <label for="title">Title</label> <span class="star-color">*</span>
                                    <input type="text" name="title_3" value="{{ old('title_3', $translation->title_3) }}" class="form-control"
                                        placeholder="Enter title">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col">
                                    <label for="title">Heading Title</label> <span class="star-color">*</span>
                                    <input type="text" name="heading_title_3" value="{{ old('heading_title_3', $translation->heading_title_3) }}"
                                        class="form-control" placeholder="Enter Heading title">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col">
                                    <label>Heading Description</label> <span class="star-color">*</span>
                                    <textarea id="heading_description_3" name="heading_description_3" cols="10" rows="3" class="form-control"
                                        placeholder="Enter description">{{ old('heading_description_3', $translation->description_3) }}</textarea>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="row">
                        <div class="col">

                            <div class="row mb-3">
                                <div class="col">
                                    <label>Content Status</label> <span class="star-color">*</span>
                                    <select name="status" id="status" class="form-control">
                                        <option value="" disabled selected>Choose Option</option>
                                        <option value="1" @selected(old('status', $translation->status) == 1)>In Progress</option>
                                        <option value="2" @selected(old('status', $translation->status) == 2)>Completed</option>
                                    </select>
                                </div>
                            </div>

                            <div class="row mb-3" id="visibilty_div">
                                <div class="col">
                                    <label>Visible</label>
                                    <select name="is_visible" class="form-control">
                                        <option value="" disabled selected>Choose Option</option>
                                        <option value="0" @selected(old('is_visible', $translation->is_visible) == 0 )>No</option>
                                        <option value="1" @selected(old('is_visible', $translation->is_visible) == 1 )>Yes</option>
                                    </select>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col">
                                    <label>Image <small>(Optional)</small></label>
                                    <input type="file" name="images[]" multiple id="images" class="form-control"
                                        accept="image/*">
                                    <small>Accepted file extentions (.png .jpg .jpeg .svg)</small>
                                </div>
                            </div>

                            <div class="row mb-3" id="image_preview_div">
                                <div class="col">
                                    <label class="text-dark font-weight-medium">Image Preview</label>
                                    <div class="input-group mb-3">
                                        <div id="preview-image-before-upload"></div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col" id="translated_img_div">
                                    @if($translation->images != null)

                                        <h4 class="mt-2 mb-3"><b>Images</b></h4>

                                        @foreach (explode('|', $translation->images) as $image)
                                            @if ($image != null)
                                                <img src="{{ asset('storage/fruits/images/'. $image) }}" style="width: 225px; margin:10px" alt="fruit image">
                                            @endif
                                        @endforeach
                                    @endif
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </div>

                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
@endsection

@section('scripts')

    <script>

        $('#image_preview_div').hide();

        $(function() {
            $("#images").change(function() {

                $('#translated_img_div').hide();
                $('#preview-image-before-upload').html('');

                if (this.files && this.files[0]) {
                    for (var i = 0; i < this.files.length; i++) {
                        var reader = new FileReader();
                        reader.onload = imageIsLoaded;
                        reader.readAsDataURL(this.files[i]);
                    }
                }
            });
        });

        function imageIsLoaded(e) {
            $('#image_preview_div').show();
            $('#preview-image-before-upload').append('<img style="max-height: 250px; margin:10px" src=' + e.target.result + '>');
        };
    </script>

    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
    <script>
        $('#heading_description_1').summernote({
            placeholder: 'Enter description here ...',
            tabsize: 10,
            height: 100,
            toolbar: [
                ['font', ['bold', 'underline', 'clear']],
                ['fontsize', ['fontsize']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['height', ['height']],
                ['insert', ['link']],
            ]
        });
    </script>

    <script>
        $('#heading_description_2').summernote({
            placeholder: 'Enter description here ...',
            tabsize: 10,
            height: 100,
            toolbar: [
                ['font', ['bold', 'underline', 'clear']],
                ['fontsize', ['fontsize']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['height', ['height']],
                ['insert', ['link']],
            ]
        });
    </script>

    <script>
        $('#heading_description_3').summernote({
            placeholder: 'Enter description here ...',
            tabsize: 10,
            height: 100,
            toolbar: [
                ['font', ['bold', 'underline', 'clear']],
                ['fontsize', ['fontsize']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['height', ['height']],
                ['insert', ['link']],
            ]
        });
    </script>

    <script>

        let status = "{{ $translation->status }}";

        if (status == 2) {
            $('#visibilty_div').show();
        }
        else {
            $('#visibilty_div').hide();
        }

        $('#status').change(function() {
            let status = this.value;

            if (status == 2) {
                $('#visibilty_div').show();
            }
            else {
                $('#visibilty_div').hide();
            }
        });
    </script>

@endsection
