@extends('layouts.app')

@section('content')
    <div class="card" style="background-color: rgb(41 63 84) !important; color: white">
        <div class="container">
            <div class="row mb-2">
                <div class="col-md-12 col-sm-12">
                    <div class="form-group">
                        <label for="body">@lang('site.photos') <span class="text-danger ml-1">
                                @lang('site.UploadImage')</span></label>
                        <div id="myDropzone" style="color: black" class="dropzone"></div>
                        <input type="hidden" id="albumId" name="albumId" value="{{ $album->id }}"> <!-- Moved inside the dropzone form -->
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        var albumId = document.getElementById('albumId').value;

        Dropzone.autoDiscover = false;
        var myDropzone = new Dropzone("#myDropzone", {
            url: "{{ route('albums.store.Image') }}",
            method: "post",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            maxFilesize: 5,
            acceptedFiles: ".jpg,.jpeg,.png,.gif",
            addRemoveLinks: true,
            dictDefaultMessage: "Upload images here",
            dictFallbackMessage: "Your browser does not support drag and drop file uploads.",
            dictFallbackText: "Please use the fallback form below to upload your files.",
            dictFileTooBig: "File is too big. Max filesize: 5MB.",
            dictInvalidFileType: "You can't upload files of this type.",
            dictCancelUpload: "Cancel upload",
            dictCancelUploadConfirmation: "Are you sure you want to cancel this upload?",
            dictRemoveFile: "Remove file",
            dictMaxFilesExceeded: "You can not upload any more files.",
            sending: function(file, xhr, formData) {
                formData.append("albumId", albumId);
            }
        });
    </script>
@endsection
