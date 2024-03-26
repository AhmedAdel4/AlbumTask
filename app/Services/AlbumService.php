<?php

namespace App\Services;


use App\Repositories\AlbumRepositoryInterface;
use Exception;

class AlbumService
{
    protected $albumRepository;

    public function __construct(AlbumRepositoryInterface $albumRepository)
    {
        $this->albumRepository = $albumRepository;
    }


    public function index()
    {
        return $this->albumRepository->orderby('created_at', 'DESC')->paginate(20);
    }

    public function all()
    {
        return $this->albumRepository->all();
    }

    public function find($id)
    {
        return $this->albumRepository->find($id);
    }

    public function store($data)
    {
        $this->albumRepository->create($data);
    }

    public function moveImages($data)
    {
        try {
            $album_id = $data['album_id'];
            $oldAlbumId = $data['oldAlbumId'];

            $oldAlbum = $this->find($oldAlbumId);

            $mediaItems = $oldAlbum->media;
            foreach ($mediaItems as $mediaItem) {
                $mediaItem->model_id = $album_id;
                $mediaItem->save();
            }

            $pictures = $oldAlbum->pictures;

            foreach ($pictures as $picture) {
                $picture->album_id = $album_id;
                $picture->save();
            }
            $this->destroy($oldAlbum);
            return true;
        } catch (Exception $e) {
            return false;
        }
    }

    public function update($data, $album)
    {
        $album = $this->albumRepository->update($data, $album);
    }

    public function destroy($album)
    {
        $this->albumRepository->delete($album);
    }
}
