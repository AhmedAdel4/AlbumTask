<?php

namespace App\Http\Controllers;

use App\Http\Requests\AlbumRequest;
use App\Http\Requests\PhotoRequest;
use App\Models\Album;
use App\Services\AlbumService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class AlbumController extends Controller
{

    protected $albumService;

    public function __construct(AlbumService $albumService)
    {
        $this->albumService = $albumService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $albums = $this->albumService->index();
        return view('album.index',compact('albums'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('album.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AlbumRequest $request)
    {
        $this->albumService->store($request->validated());
        return redirect(route('albums.index'))->with('success',__('site.DataSaved'));
    }



    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Album $album)
    {
        return view('album.edit', ['album' => $album]);
    }

    public function uploadeImage(Album $album)
    {
        return view('album.upload', ['album' => $album]);
    }

    public function storeImage(PhotoRequest $request)
    {
        $request->validated();
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AlbumRequest $request, Album $album)
    {
        $this->albumService->update($request->validated(), $album);
        return redirect(route('albums.index'))->with('success',__('site.DataUpdated'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Album $album)
    {
        $this->albumService->destroy($album);
        return redirect()->back()->with('success',__('site.DataDeleted'));
    }
}
