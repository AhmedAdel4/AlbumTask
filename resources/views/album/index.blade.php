@extends('layouts.app')

@section('content')

    @include('includes.messages')
    <div class="mb-2">
        <a class="btn btn-success" href="{{ route('albums.create') }}">@lang('site.Add') @lang('site.Album')</a>
    </div>

    <div class="card">
        <div class="card-datatable table-responsive pt-0" style="background-color: #dbc9c9">
            @if (count($albums) > 0)
                <table class="table  table-bordered text-center">
                    <thead>
                        <tr>
                            <th style="background-color: #dbc9c9">#</th>
                            <th style="background-color: #dbc9c9">@lang('site.Name')</th>
                            <th style="background-color: #dbc9c9">@lang('site.photos')</th>
                            <th style="background-color: #dbc9c9">@lang('site.Actions')</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($albums as $album)
                            <tr>
                                <td style="background-color: #dbc9c9">{{ $loop->index + 1 }}</td>
                                <td style="background-color: #dbc9c9">{{ $album->name }}</td>
                                <td style="background-color: #dbc9c9">
                                    <a href="{{ route('albums.Images', $album) }}" class="btn btn-sm btn-primary" style="margin-right: 5px;">
                                        <span>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-plus mr-50">
                                                <line x1="12" y1="5" x2="12" y2="19"></line>
                                                <line x1="5" y1="12" x2="19" y2="12"></line>
                                            </svg>
                                        </span>
                                        <span>@lang('site.Add') @lang('site.photos')</span>
                                    </a>

                                </td>
                                <td style="background-color: #dbc9c9">
                                    <!-- Edit Button -->
                                    <a href="{{ route('albums.edit', $album) }}" class="btn btn-sm btn-primary"
                                        style="margin-right: 5px;">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"
                                            class="feather feather-edit-2 mr-50">
                                            <path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path>
                                        </svg>
                                        <span>@lang('site.Edit')</span>
                                    </a>

                                    <!-- Delete Button -->
                                    <form action="{{ route('albums.destroy', $album) }}" method="POST"
                                        style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" style="background-color: #dc3545"
                                            class="btn btn-sm btn-danger">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round"
                                                class="feather feather-trash mr-50">
                                                <polyline points="3 6 5 6 21 6"></polyline>
                                                <path
                                                    d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2">
                                                </path>
                                            </svg>
                                            <span>@lang('site.Delete')</span>
                                        </button>
                                    </form>
                                </td>

                            </tr>
                        @endforeach
                    </tbody>

                </table>
            @else
                <div class="text-center">
                    No data found
                </div>
            @endif
        </div>
    </div>
@endsection
