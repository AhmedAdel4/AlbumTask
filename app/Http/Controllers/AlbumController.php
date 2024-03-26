<?php

namespace App\Http\Controllers;

use App\Http\Requests\AlbumRequest;
use App\Http\Requests\moveImagesRequest;
use App\Http\Requests\PhotoRequest;
use App\Models\Album;
use App\Services\AlbumService;
use App\Services\ImageService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class AlbumController extends Controller
{

    protected $albumService;
    protected $imageService;

    public function __construct(AlbumService $albumService, ImageService $imageService)
    {
        $this->albumService = $albumService;
        $this->imageService = $imageService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $albums = $this->albumService->index();
        return view('album.index', compact('albums'));
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
        return redirect(route('albums.index'))->with('success', __('site.DataSaved'));
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


    /**
     * Update the specified resource in storage.
     */
    public function update(AlbumRequest $request, Album $album)
    {
        $this->albumService->update($request->validated(), $album);
        return redirect(route('albums.index'))->with('success', __('site.DataUpdated'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Album $album)
    {
        $this->albumService->destroy($album);
        return redirect()->back()->with('success', __('site.DataDeleted'));
    }

    public function storeImage(PhotoRequest $request)
    {
        $album = $this->albumService->find($request->validated()['albumId']);
        $response = $this->imageService->store($request->validated(), $album);
        return response()->json(['id' => $response]);
    }


    public function storeMovedImages(moveImagesRequest $request)
    {
        $response = $this->albumService->moveImages($request->validated());
        return redirect(route('albums.index'))->with('success', __('site.DataUpdated'));
    }

    public function deleteImage($fileId)
    {
        $response = $this->imageService->delete($fileId);
        return response()->json(['message' => 'deleted successfully']);
    }

    public function moveImages($albumId)
    {
        $albums = $this->albumService->all()->except($albumId);
        if (count($albums) > 0)
            return view('album.chooseAlbum', ['albums' => $albums, 'oldAlbumId' => $albumId]);
        return redirect(route('albums.index'))->with('success', __('site.NoAlbumsFound'));
    }
}
