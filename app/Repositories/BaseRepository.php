<?php

namespace App\Repositories;

use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Model;
use App\Repositories\RepositoryInterface;

class BaseRepository implements RepositoryInterface
{
    public function __construct(private Model $model)
    {
    }

    public function all()
    {
        return $this->model->all();
    }

    public function query()
    {
        return $this->model->query();
    }

    public function find(int $id)
    {
        return $this->model->find($id);
    }

    public function create(array | Collection $data)
    {
        return $this->model->create($data);
    }

    public function update(int $id, array | Collection $data)
    {
        return $this->model->where('id', $id)->update($data);
    }

    public function delete(int $id)
    {
        return $this->model->where('id', $id)->delete();
    }
}
