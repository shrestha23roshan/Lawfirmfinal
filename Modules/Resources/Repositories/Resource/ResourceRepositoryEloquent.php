<?php
namespace Modules\Resources\Repositories\Resource;

use App\Repositories\BaseRepositoryEloquent;
use Modules\Resources\Entities\Resource;

class ResourceRepositoryEloquent extends BaseRepositoryEloquent implements ResourceRepository
{
    protected $model;

    public function __construct(Resource $model)
    {
        $this->model = $model;
    }
}