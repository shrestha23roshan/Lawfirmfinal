<?php
namespace Modules\Configuration\Repositories\Module;

use Modules\Configuration\Entities\Module;
use App\Repositories\BaseRepositoryEloquent;
use DB;
class ModuleRepositoryEloquent extends BaseRepositoryEloquent implements ModuleRepository
{

    public function __construct(Module $module)
    {
        $this->model = $module;
    }

    public function maxOrderPosition()
    {
        return $this->model->max('order_position');
    }

    /**
     * Get list with module_name and id
     */
    public function lists()
    {
        return $this->model->lists('module_name', 'id');
    }

    /**
     * Manage modules hierarchy
     */
    public function modulesWithHierarchy()
    {
        return $this->model->with(['childrens' => function($child){
            $child->where('is_active', '1');
        }], 'childrens.childrens')
        ->where('parent_id', 0)
        ->where('is_active', '1')
        ->orderBy('order_position')
        ->get();
    }

    /**
     * Create module
     * 
     * @param object $data
     * return App\Modules\User\Models\Module $module
     */
    public function create($data)
    {
        $data['order_position'] = $this->maxOrderPosition() + 1;
        return $this->model->create($data);
    }

    /**
     * Update module
     * 
     * @param int $id
     * @param object $data
     * @return App\Modules\User\Models\Module $module
     */
    public function update($id, $data)
    {
        $module = $this->model->findOrFail($id);
        $module->fill($data->all())->save();
        return $module;
    }

    /**
     * Remove module by id
     * 
     * @param int $id
     * @return boolean
     */
    public function destroy($id)
    {
        try{
            $module = $this->model->findOrFail($id);
            $module->delete();
            return true;
        } catch(\Illuminate\Database\QueryException $e){
            return false;
        }
    }

    /**
     * Sort modules order
     * 
     * @return boolean
     */
    public function sortOrder($data)
    {
        DB::beginTransaction();
        try{
            $modules = explode('&', str_replace('module[]=', '', $data));
            $position = 1;
            foreach($modules as $moduleId){
                $module = $this->model->find($moduleId);
                $module->order_position = $position;
                $module->save();
                $position++;
            }
            DB::commit();
            return true;
        } catch(\Exception $e){
            DB::rollback();
            return false;
        }
    }
}
