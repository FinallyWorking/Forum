<?php

namespace App\Repositories;

use Illuminate\Support\Collection;

interface RepositoryInterface
{
    public function all();

    public function query();

    public function find(int $id);

    public function create(array | Collection $data);

    public function update(int $id, array | Collection $data);

    public function delete(int $id);
}
