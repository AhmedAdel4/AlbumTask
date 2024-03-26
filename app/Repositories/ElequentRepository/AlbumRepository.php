<?php

namespace App\Repositories\ElequentRepository;

use App\Models\Album;
use App\Repositories\BaseRepository;
use App\Repositories\AlbumRepositoryInterface;


class AlbumRepository extends BaseRepository implements AlbumRepositoryInterface
{
    protected $model;

    public function __construct(
        Album $model
    ) {
        $this->model = $model;
    }


}
