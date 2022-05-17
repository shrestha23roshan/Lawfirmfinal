<?php
namespace Modules\Configuration\Repositories\Module;

interface ModuleRepository
{
    public function all();
    public function maxOrderPosition();
    public function lists();
    public function modulesWithHierarchy();
    public function create($data);
    public function update($id, $data);
    public function destroy($id);
    public function sortOrder($data);
}