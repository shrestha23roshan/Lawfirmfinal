<?php
namespace Modules\Configuration\Repositories\User;

use Modules\Configuration\Entities\User;
use Modules\Configuration\Entities\Module;
use App\Repositories\BaseRepositoryEloquent;
use DB;

class UserRepositoryEloquent extends BaseRepositoryEloquent implements UserRepository
{

    /**
     * Create a new controller instance.
     * 
     * @param App\Modules\User\Models\User $user
     * @param App\Modules\User\Models\Module $module
     * @return void
     */
    public function __construct(
        User $user,
        Module $module
    )
    {
        $this->model = $user;
        $this->module = $module;
    }

    /**
     * Find active users.
     * 
     * @return list
     */
    public function lists()
    {
        return $this->model->model('is_active', 1)
                    ->lists('name', 'id');
    }

     /**
     * Get all access modules by user
     * 
     * @param int $id
     */
    public function accessModules($id)
    {
        $user = $this->model->findOrFail($id);
        $modulesArray = $user->role->modules->pluck('id');

        return $this->module->with(['childrens' => function($child) use ($modulesArray){
                $child->whereIn('id', $modulesArray);
                $child->where('is_active', '1');
                $child->orderBy('order_position');
        }, 'childrens.childrens' => function($grandchild){
            $grandchild->where('is_active', '1');
            $grandchild->orderBy('order_position');
        }])
        ->whereIn('id', $modulesArray)
        ->where('parent_id', 0)
        ->where('is_active', '1')
        ->orderBy('order_position')
        ->get();
    }

    /**
     * Remove the specified resource from the storage.
     * 
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{
            $user = $this->model->findOrFail($id);
            $user->delete();
            return response()->json([
                'status' => 'ok', 
                'message' => 'User is deleted successfully.'
            ], 200);
        } catch(\Illuminate\Database\QueryException $e){
            return response()->json([
                'status' => 'error', 
                'message' => 'User can not be deleted.'
            ], 422);
        }
    }

     /**
     * Change user status 
     * 
     * @param int $id
     * @return App\Modules\User\Models\User $user
     */
    public function changeStatus($id)
    {
        DB::beginTransaction();
        try{
            $user = $this->model->findOrFail($id);
            $user->is_active == '0' ? $user->fill(['is_active' => '1'])->save() : $user->fill(['is_active' => '0'])->save();
            DB::commit();
            return $user;
        } catch(\Exception $e){
            DB::rollback();
            return false;
        }
    }
}
