<?php

namespace App\Repositories\ElequentRepository;

use App\Models\Picture;
use App\Repositories\BaseRepository;
use App\Repositories\ImageRepositoryInterface;


class ImageRepository extends BaseRepository implements ImageRepositoryInterface
{
    protected $model;

    public function __construct(
        Picture $model
    ) {
        $this->model = $model;
    }


}
