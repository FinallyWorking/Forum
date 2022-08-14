<?php

namespace App\Repositories\Eloquent;

use App\Models\Forum;
use App\Repositories\BaseRepository;
use App\Repositories\RepositoryInterface;

class ForumRepository extends BaseRepository implements RepositoryInterface
{
    public function __construct()
    {
        parent::__construct(new Forum);
    }
}
