<?php
namespace Modules\Configuration\Repositories\Role;

use Modules\Configuration\Entities\Role;
use App\Repositories\BaseRepositoryEloquent;
use DB;

class RoleRepositoryEloquent extends BaseRepositoryEloquent implements RoleRepository
{

    public function __construct(Role $role)
    {
        $this->model = $role;
    }

   /**
     * Get list with role and id
     */
    public function lists()
    {
        return $this->model->pluck('role', 'id');
    }

    /**
     * Get Modules by id
     * 
     * @param int $id
     */
    public function getModules($id)
    {
        return $this->model->findOrFail($id)->modules()->get();
    }

    /**
     * Synchronize modules with role
     */
    public function syncModules($role, $data)
    {
        $role->modules()->sync($data);
    }

    /**
     * Update user role
     * 
     * @param int $id
     * @param object $data
     * @return App\Modules\User\Models\Role $role
     */
    public function update($id, $data)
    {
        $role = $this->model->findOrFail($id);
        $role->fill($data)->save();
        return $role;
    }

    /**
     * Find user role
     */
    public function find($id)
    {
        return $this->model->find($id);
    }
}
