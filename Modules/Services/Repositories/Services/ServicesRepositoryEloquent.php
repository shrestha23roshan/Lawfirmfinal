<?php

namespace Modules\Services\Repositories\Services;

use App\Repositories\BaseRepositoryEloquent;
use Modules\Services\Entities\Service;

class ServicesRepositoryEloquent extends BaseRepositoryEloquent implements ServicesRepository
{
    protected $model;

    public function __construct(Service $model)
    {
        $this->model = $model;
    }

       //frontend
    //    public function getServices()
    //    {
    //        return $this->model->where('status', '1')->get();
    //    }
}