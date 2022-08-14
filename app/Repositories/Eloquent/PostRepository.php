<?php

namespace App\Repositories\Eloquent;

use App\Models\Post;
use App\Repositories\BaseRepository;
use App\Repositories\RepositoryInterface;

class PostRepository extends BaseRepository implements RepositoryInterface
{
    public function __construct()
    {
        parent::__construct(new Post);
    }
}
