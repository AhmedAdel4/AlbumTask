<?php

namespace App\Services;


use App\Repositories\AlbumRepositoryInterface;


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

    public function store($data)
    {
        $logo = $this->albumRepository->create($data);
        if (isset($data['file'])) {
            $logo->addMedia($data['file'])->toMediaCollection('logo');
        }
    }

    public function update($data, $logo)
    {
        $logo = $this->albumRepository->update($data, $logo);
        if (isset($data['file'])) {
            $logo->clearMediaCollection('logo');
            $logo->addMedia($data['file'])->toMediaCollection('logo');
        }
    }

    public function destroy($logo)
    {
        $this->albumRepository->delete($logo);
    }
}
