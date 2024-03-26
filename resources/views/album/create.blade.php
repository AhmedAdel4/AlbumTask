@extends('layouts.app')

@section('content')
    <div class="card" style="background-color: rgb(41 63 84) !important; color: white">
        <div class="container">
            <form id="createForm" action="{{ route('albums.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row mb-3 mt-3">
                    <div class="col-md-12 col-sm-12">
                        <div class="form-group">
                            <label for="name">@lang('site.Name')</label>
                            <input type="text" name="name" class="form-control"
                                value="{{ old('name') }}">
                            @error('name')
                                <div class="text-danger">*{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                   

                    <div class="col-12 mt-2">
                        <button type="submit" class="btn btn-success" style="background-color: springgreen"
                            id="btn-submit">@lang('site.Save')</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection



