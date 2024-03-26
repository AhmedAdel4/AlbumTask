<?php

namespace App\Services;


use App\Repositories\ImageRepositoryInterface;
use Illuminate\Support\Facades\Log;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class ImageService
{
    protected $imageRepository;

    public function __construct(ImageRepositoryInterface $imageRepository)
    {
        $this->imageRepository = $imageRepository;
    }




    public function store($data, $album)
    {
        $dataToBeSaved = [
            'album_id' => $data['albumId'],
            'name' => $data['file']->getClientOriginalName(),
        ];
        $image = $this->imageRepository->create($dataToBeSaved);
        if (isset($data['file'])) {
            $media =  $album->addMedia($data['file'])->toMediaCollection('album');
            $media['picture_id'] = $image->id;
            $media->save();
        }
        return $image->id;
    }

    public function delete($fileId)
    {
        $image = $this->imageRepository->find($fileId);
        if ($image) {
            $this->imageRepository->delete($image);
            $media = Media::where('picture_id', $fileId)->first();
            if ($media) {
                $media->delete();
            }
        }
    }
}
