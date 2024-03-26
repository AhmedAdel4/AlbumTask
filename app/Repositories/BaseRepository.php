<?php

namespace App\Repositories;

use BadMethodCallException;
use Illuminate\Database\Eloquent\Model;
use Prophecy\Exception\Doubler\MethodNotFoundException;

abstract class BaseRepository
{
    public function __call($name, $arguments)
    {
        try {
            return $this->model->$name(...$arguments);
        } catch (\Throwable $th) {
            if ($th instanceof BadMethodCallException) {
                throw new MethodNotFoundException('Method name not found', self::class, $name);
            }

            throw $th;
        }
    }

    public function search($q)
    {
        return $this->model->search($q)
            ->get();
    }

    public function findByAttributes(array $attributes)
    {
        return $this->model->where($attributes);
    }

    public function update(array $data, Model $model)
    {
        $model->update($data);
        return $model->refresh();
    }

    public function delete(Model $model)
    {
        return $model->delete();
    }
}
