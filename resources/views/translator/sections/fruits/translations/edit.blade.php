@extends('layouts.admin')

@section('title', 'Translations')

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

            <a href="{{ route('fruits.index', request()->language) }}" class="btn btn-info mt-2 mb-3">Go Back</a>

            <div class="invoice-wrapper rounded border bg-white py-5 px-3 px-md-4 px-lg-5 mb-6">
                <div class="d-flex justify-content-between mb-3">
                    <h4 class="text-dark font-weight-medium">
                        <b>Create Translation</b>
                    </h4>

                    <div class="row">

                        <form id="language_form" action="{{ route('fruits.translations.edit', request()->route('fruit')) }}">
                            <select name="language" id="language" class="form-control">
                                <option value="" selected disabled>Choose Language</option>
                                @foreach (loginUserAssignedLanguages() as $language)
                                    <option @selected(old('language', request()->language == $language->code)) value="{{ $language->code }}">{{ ucfirst($language->name) }}</option>
                                @endforeach
                            </select>
                        </form>

                    </div>

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

                <form id="translation-form" method="post" action="{{ route('fruits.translations.store') }}" enctype="multipart/form-data">
                    @csrf

                    <input type="hidden" name="language" value="{{ request()->language }}">
                    <input type="hidden" name="fruit" value="{{ request()->route('fruit') }}">

                    <div class="row">
                        <div class="col-6">

                            <h4 class="mt-3 mb-3">Heading 1</h4>

                            <div class="row mb-3">
                                <div class="col">
                                    <label for="title">Title</label> <span class="star-color">*</span>
                                    <input type="text" value="{{ $translation->title_1 }}" class="form-control" readonly
                                        placeholder="Enter title">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col">
                                    <label for="title">Heading Title</label> <span class="star-color">*</span>
                                    <input type="text" value="{{ $translation->heading_title_1 }}"
                                        class="form-control" placeholder="Enter Heading title" readonly>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col">
                                    <label>Heading Description</label> <span class="star-color">*</span>
                                    <textarea id="heading_description_1" cols="10" rows="6" class="form-control"
                                        placeholder="Enter description" readonly>{{ $translation->description_1 }}</textarea>
                                </div>
                            </div>

                        </div>

                        <div class="col-6">

                            <h4 class="mt-3 mb-3">Heading 1</h4>

                            <div class="row mb-3">
                                <div class="col">
                                    <label for="title">Title</label> <span class="star-color">*</span>
                                    <input type="text" name="translated_title_1" value="{{ old('translated_title_1', $translatedFruits ? $translatedFruits->title_1: '') }}" class="form-control arabic"
                                        placeholder="Enter title">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col">
                                    <label for="title">Heading Title</label> <span class="star-color">*</span>
                                    <input type="text" name="translated_heading_title_1" value="{{ old('translated_heading_title_1', $translatedFruits ? $translatedFruits->heading_title_1: '') }}"
                                        class="form-control arabic" placeholder="Enter Heading title">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col">
                                    <label>Heading Description</label> <span class="star-color">*</span>
                                    <textarea id="translated_heading_description_1" name="translated_heading_description_1" cols="10" rows="3" class="form-control"
                                        placeholder="Enter description">{{ old('translated_heading_description_1', $translatedFruits ? $translatedFruits->description_1: '') }}</textarea>
                                </div>
                            </div>

                        </div>
                    </div>



                    <div class="row">
                        <div class="col-6">

                            <h4 class="mt-3 mb-3">Heading 2</h4>

                            <div class="row mb-3">
                                <div class="col">
                                    <label for="title">Title</label> <span class="star-color">*</span>
                                    <input type="text" value="{{ $translation->title_2 }}" class="form-control"
                                        placeholder="Enter title" readonly>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col">
                                    <label for="title">Heading Title</label> <span class="star-color">*</span>
                                    <input type="text" value="{{ $translation->heading_title_2 }}"
                                        class="form-control" placeholder="Enter Heading title" readonly>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col">
                                    <label>Heading Description</label> <span class="star-color">*</span>
                                    <textarea id="heading_description_2" cols="10" rows="6" class="form-control"
                                        placeholder="Enter description" readonly>{{ $translation->description_2 }}</textarea>
                                </div>
                            </div>

                        </div>
                        <div class="col-6">

                            <h4 class="mt-3 mb-3">Heading 2</h4>

                            <div class="row mb-3">
                                <div class="col">
                                    <label for="title">Title</label> <span class="star-color">*</span>
                                    <input type="text" name="translated_title_2" value="{{ old('translated_title_2', $translatedFruits ? $translatedFruits->title_2: '') }}" class="form-control arabic"
                                        placeholder="Enter title">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col">
                                    <label for="title">Heading Title</label> <span class="star-color">*</span>
                                    <input type="text" name="translated_heading_title_2" value="{{ old('translated_heading_title_2', $translatedFruits ? $translatedFruits->heading_title_2: '') }}"
                                        class="form-control arabic" placeholder="Enter Heading title">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col">
                                    <label>Heading Description</label> <span class="star-color">*</span>
                                    <textarea id="translated_heading_description_2" name="translated_heading_description_2" cols="10" rows="3" class="form-control arabic"
                                        placeholder="Enter description">{{ old('translated_heading_description_2', $translatedFruits ? $translatedFruits->description_2: '') }}</textarea>
                                </div>
                            </div>

                        </div>
                    </div>


                    <div class="row">
                        <div class="col-6">

                            <h4 class="mt-3 mb-3">Heading 3</h4>

                            <div class="row mb-3">
                                <div class="col">
                                    <label for="title">Title</label> <span class="star-color">*</span>
                                    <input type="text" value="{{ $translation->title_3 }}" class="form-control"
                                        placeholder="Enter title" readonly>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col">
                                    <label for="title">Heading Title</label> <span class="star-color">*</span>
                                    <input type="text" value="{{ $translation->heading_title_3 }}"
                                        class="form-control" placeholder="Enter Heading title" readonly>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col">
                                    <label>Heading Description</label> <span class="star-color">*</span>
                                    <textarea id="heading_description_3" cols="10" rows="6" class="form-control"
                                        placeholder="Enter description" readonly>{{ $translation->description_3 }}</textarea>
                                </div>
                            </div>

                        </div>

                        <div class="col-6">

                            <h4 class="mt-3 mb-3">Heading 3</h4>

                            <div class="row mb-3">
                                <div class="col">
                                    <label for="title">Title</label> <span class="star-color">*</span>
                                    <input type="text" name="translated_title_3" value="{{ old('translated_title_3', $translatedFruits ? $translatedFruits->title_3: '') }}" class="form-control arabic"
                                        placeholder="Enter title">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col">
                                    <label for="title">Heading Title</label> <span class="star-color">*</span>
                                    <input type="text" name="translated_heading_title_3" value="{{ old('translated_heading_title_3', $translatedFruits ? $translatedFruits->heading_title_3: '') }}"
                                        class="form-control arabic" placeholder="Enter Heading title">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col">
                                    <label>Heading Description</label> <span class="star-color">*</span>
                                    <textarea id="translated_heading_description_3" name="translated_heading_description_3" cols="10" rows="3" class="form-control arabic"
                                        placeholder="Enter description">{{ old('translated_heading_description_3', $translatedFruits ? $translatedFruits->description_3: '') }}</textarea>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="row">
                        <div class="col-6">

                            <div class="row mb-3">
                                <div class="col">
                                    <label>Content Status</label> <span class="star-color">*</span>
                                    <select name="status" class="form-control" disabled>
                                        <option value="1" @selected($translation->status == 1)>In-Progress</option>
                                        <option value="2" @selected($translation->status == 2)>Completed</option>
                                    </select>
                                </div>
                            </div>

                            @if (isAdmin())
                            <div class="row mb-3" id="visibilty_div">
                                <div class="col">
                                    <label>Visible</label>
                                    <select name="is_visible" class="form-control" disabled>
                                        <option value="0" @selected(old('is_visible', $translation ? $translation->is_visible: 0) == 0)>No</option>
                                        <option value="1" @selected(old('is_visible', $translation ? $translation->is_visible: 0) == 1)>Yes</option>
                                    </select>
                                </div>
                            </div>
                            @endif

                            <div class="row mb-3">
                                <div class="col">
                                    <label>Image <small>(Optional)</small></label>
                                    <input type="file" name="images[]" multiple id="images" class="form-control"
                                        accept="image/*" disabled>
                                    <small>Accepted file extentions (.png .jpg .jpeg .svg)</small>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col">
                                    @if ($translation)

                                        @if ($translation->images != null)
                                            <h4 class="mt-2 mb-3"><b>Images</b></h4>
                                        @endif

                                        @foreach (explode('|', $translation->images) as $image)
                                            @if ($image != null)
                                                <img src="{{ asset('storage/fruits/images/'. $image) }}" style="width: 225px; margin:10px" alt="fruit image">
                                            @endif
                                        @endforeach
                                    @endif
                                </div>
                            </div>

                        </div>

                        <div class="col-6">

                            <div class="row mb-3">
                                <div class="col">
                                    <label>Translation Status</label> <span class="star-color">*</span>
                                    <select name="translated_status" id="translated_status" class="form-control arabic">
                                        <option value="1" @selected(old('translated_status', $translatedFruits ? $translatedFruits->status: 0) == 1)>In-Progress</option>
                                        <option value="2" @selected(old('translated_status', $translatedFruits ? $translatedFruits->status: 0) == 2)>Completed</option>
                                    </select>
                                </div>
                            </div>

                            @if (isAdmin())
                            <div class="row mb-3" id="translated_visibilty_div">
                                <div class="col">
                                    <label>Visible</label>
                                    <select name="translated_is_visible" class="form-control arabic">
                                        <option value="0" @selected(old('translated_is_visible', $translatedFruits ? $translatedFruits->is_visible: '') == 0)>No</option>
                                        <option value="1" @selected(old('translated_is_visible', $translatedFruits ? $translatedFruits->is_visible: '') == 1)>Yes</option>
                                    </select>
                                </div>
                            </div>
                            @endif

                            <div class="row mb-3">
                                <div class="col">
                                    <label>Image <small>(Optional)</small></label>
                                    <input type="file" name="translated_images[]" multiple id="translated_images" class="form-control arabic"
                                        accept="image/*">
                                    <small>Accepted file extentions (.png .jpg .jpeg .svg)</small>
                                </div>
                            </div>

                            <div class="row mb-3" id="translated_image_preview_div">
                                <div class="col">
                                    <label class="text-dark font-weight-medium">Image Preview</label>
                                    <div class="input-group mb-3">
                                        <div id="translated_preview-image-before-upload"></div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col" id="translated_img_div">
                                    @if ($translatedFruits->images != null)

                                        <h4 class="mt-2 mb-3"><b>Images</b></h4>

                                        @foreach (explode('|', $translatedFruits->images) as $image)
                                            @if ($image != null)
                                                <img src="{{ asset('storage/fruits/images/'. $image) }}" style="width: 225px; margin:10px" alt="fruit image">
                                            @endif
                                        @endforeach

                                    @elseif($translation->images != null)

                                        <h4 class="mt-2 mb-3"><b>Images</b></h4>

                                        @foreach (explode('|', $translation->images) as $image)
                                            @if ($image != null)
                                                <img src="{{ asset('storage/fruits/images/'. $image) }}" style="width: 225px; margin:10px" alt="fruit image">
                                            @endif
                                        @endforeach
                                    @endif
                                </div>
                            </div>

                            <div class="row mt-3 mb-3">
                                <div class="col">
                                    <button name="delete" id="deleteBtn" class="btn btn-danger">Remove</button>
                                    <button type="submit" name="completed" class="btn btn-secondary">Completed</button>
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
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
<script src="{{ asset('assets/admin/plugins/summernote/summernote-ext-rtl.js') }}"></script>



    <script type="text/javascript">
        $(function() {
        $("#translated_images").change(function (){
            $("#translated_img_div").hide();
        });
        });
    </script>

    <script>
        $(function() {

            $('#image_preview_div').hide();
            $('#translated_image_preview_div').hide();

            $("#translated_images").change(function() {

                $('#translated_preview-image-before-upload').html('');

                if (this.files && this.files[0]) {
                    for (var i = 0; i < this.files.length; i++) {
                        var reader = new FileReader();
                        reader.onload = translatedImageIsLoaded;
                        reader.readAsDataURL(this.files[i]);
                    }
                }
            });
        });

        function translatedImageIsLoaded(e) {
            $('#image_preview_div').show();
            $('#translated_image_preview_div').show();
            $('#translated_preview-image-before-upload').append('<img style="width: 225px; margin:10px" src=' + e.target.result + '>');
        };
    </script>

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
        }).next().find(".note-editable").attr("contenteditable", false);
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
        }).next().find(".note-editable").attr("contenteditable", false);;
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
        }).next().find(".note-editable").attr("contenteditable", false);
    </script>

    <script>
        $('#translated_heading_description_1').summernote({


            placeholder: 'Enter description here ...',
            tabsize: 10,
            height: 100,
            toolbar: [
                ['font', ['bold', 'underline', 'clear']],
                ['fontsize', ['fontsize']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['height', ['height']],
                ['insert', ['link']]
                // ['insert',['rtl', 'ltr']],
                // ['direction', ['rtl']]
            ]
        }).next().find(".note-editable").attr("contenteditable", true);

        var language = location.search.split('language=')[1] ? location.search.split('language=')[1] : '';

        let rtlLanguages = @json($rTlLanguageCodes);


        rtlLanguages.forEach(function(currentValue, index, arr) {

            // Add custom CSS for RTL support
            if (language == currentValue) {
                $('input').append('<style>.arabic { direction: rtl; text-align: right; }</style>');

                $('head').append('<style>.note-editable { direction: rtl; text-align: right; }</style>');

                $('head').append('<style>div.note-editable ol li { margin-right: 20px; }</style>');
                $('head').append('<style>div.note-editable ul li { margin-right: 20px; }</style>');
                $('head').append('<style>div.note-editable ul li { list-style-type: disc; }</style>');

                // $('div.note-editable ul li').css('list-style-type', 'disc');
                // $('div.note-editable ol li').css('margin-right', '20px');
                // $('div.note-editable ul li').css('margin-right', '20px');
                // $('div.note-editable ol li').css('margin-right', '20px');

                // $(".note-editable").each( function () {

                //     // var fruit_id = $(this).contenteditable("id");



                //     var content = $('head').attr("contenteditable");

                //     $('#summernote').summernote('background', 'red'));

                //     $('head').append('<style>.note-editable { direction: rtl; text-align: right; }</style>')

                //     console.log(content)
                //     if (content) {

                //         console.log(content)
                //         // $(this).css('direction', 'rtl');
                //         // $(this).css('text-align', 'right');

                //         // $('head').$(this).append('<style> { direction: rtl; text-align: right; }</style>');
                //     }
                // });

                // $("#translated_heading_description_3").each( function () {
                    // var editable = $(this).val( $('#translated_heading_description_3').attr("contenteditable") );



                    // if (editable) {
                    //     $('head').append('<style>.note-editable { direction: rtl; text-align: right; }</style>');

                    // }
                // });
                // var input = $('#translated_heading_description_3').attr('contenteditable');
                // console.log(input)
                // if (input) {
                // }

            }

        });

    </script>

    <script>
        $('#translated_heading_description_2').summernote({
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
        }).next().find(".arabic").attr("contenteditable", true);
    </script>

    <script>
        $('#translated_heading_description_3').summernote({
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
        }).next().find(".arabic").attr("contenteditable", true);
    </script>

    <script>
        $(document).ready(function() {
            $('#language').change(function() {
                $('#language_form').submit();
            });
        });
    </script>

    <script>
        $('#deleteBtn').click(function(e) {
            e.preventDefault();

            if (confirm('Are you sure want to delete it')) {
                $('#translation-form').append('<input type="hidden" name="delete" value="delete" />');
                $('#translation-form').submit();
            }

        });
    </script>

    <script>
        let status = "{{ $translation->status }}";
        let translatedFruitStatus = "{{ $translatedFruits->status }}";


        if (status == 2) {
            $('#visibilty_div').show();
        }
        else {
            $('#visibilty_div').hide();
        }

        if (translatedFruitStatus == 2) {
            $('#translated_visibilty_div').show();
        }
        else {
            $('#translated_visibilty_div').hide();
        }

        $('#translated_status').change(function() {
            let status = this.value;

            if (status == 2) {
                $('#translated_visibilty_div').show();
            }
            else {
                $('#translated_visibilty_div').hide();
            }
        });
    </script>

@endsection
