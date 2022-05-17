<?php
namespace Modules\News\Repositories\News;

use App\Repositories\BaseRepositoryEloquent;
use Modules\News\Entities\News;

class NewsRepositoryEloquent extends BaseRepositoryEloquent implements NewsRepository
{
    protected $model;

    public function __construct(News $model)
    {
        $this->model = $model;
    }
}