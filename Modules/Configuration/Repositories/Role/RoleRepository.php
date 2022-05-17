<?php
namespace Modules\Configuration\Repositories\Role;

interface RoleRepository
{
    public function all();
    public function lists();
    public function getModules($id);
    public function syncModules($role, $data);
    public function update($id, $data);
    public function find($id);
}