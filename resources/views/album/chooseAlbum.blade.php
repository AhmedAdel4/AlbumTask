@extends('layouts.app')

@section('content')
    <div class="card" style="background-color: rgb(41 63 84) !important; color: white">
        <div class="container">
            <form action="{{ route('albums.moveImages.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('POST')
                <div class="row mb-3 mt-3">
                    <div class="col-md-12 col-sm-12">
                        <div class="form-group">
                            <label for="album_id">@lang('site.Choose') @lang('site.Album')</label>
                            <select name="album_id" class="form-control">
                                <option value="">Select Album</option>
                                @foreach ($albums as $album)
                                    <option value="{{ $album->id }}">{{ $album->name }}</option>
                                @endforeach
                            </select>
                            @error('album_id')
                                <div class="text-danger">*{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <input type="hidden" name="oldAlbumId" value="{{ $oldAlbumId }}">

                    <div class="col-12 mt-2">
                        <button type="submit" class="btn btn-success" style="background-color: springgreen"
                            id="btn-submit">@lang('site.Save')</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
