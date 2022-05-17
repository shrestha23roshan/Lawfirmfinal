<?php

namespace Modules\Configuration\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

use Modules\Configuration\Repositories\Role\RoleRepository;
use Modules\Configuration\Repositories\Module\ModuleRepository;
use Modules\Configuration\Http\Requests\Role\StoreRequest;
use Modules\Configuration\Http\Requests\Role\UpdateRequest;


class RoleController extends Controller
{
    
    /**
     * The role repository instance.
     * 
     * @var RoleRepository
     */
    protected $roles;

    /**
     * The module repository instance.
     * 
     * @var ModuleRepository
     */
    protected $modules;

    /**
     * Create a new controller instance.
     * 
     * @param RoleRepository $users
     * @param ModuleRepository $modules
     * @return void
     */
    public function __construct(
        RoleRepository $roles,
        ModuleRepository $modules
    )
    {
        $this->roles = $roles;
        $this->modules = $modules;
    }
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        return view('configuration::Role.index')
        ->withRoles($this->roles->all());
    }
    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('configuration::Role.create')
        ->withModules($this->modules->modulesWithHierarchy());
    }
    
    
    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(StoreRequest $request)
    {
        // dd($request->all());
        $data = $request->all();
        $data['is_active'] = '1';
        $role = $this->roles->create($data);
        $this->roles->syncModules($role, $request->modules);
        session()->flash('success_message', 'Role is added successfully.');
        return redirect()->route('admin.privilege.role.index');
    }

    /**
     * Show the specified resource.
     * @return Response
     */
    public function show($id)
    {
        $role = $this->roles->find($id);
        return response()->json([
            'status' => 'ok', 
            'role' => $role
        ], 200);    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit($id)
    {
        try{
            $modules = $this->roles->getModules($id);

            $accessedModules = [];
            foreach($modules as $key => $module){
                $accessedModules[] = $module->id;
            }

            return view('configuration::Role.edit')
                ->withRole($this->roles->find($id))
                ->with('role_modules', $accessedModules)
                ->withModules($this->modules->modulesWithHierarchy());
        } catch(\Illuminate\Database\Eloquent\ModelNotFoundExecption $e){
            return view('layputs.backend.denied');
        }
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update(UpdateRequest $request, $id)
    {
        // dd($request->modules);
        $modules = $request->modules ? $request->modules : [];
        $role = $this->roles->update($id, $request->all());
        $this->roles->syncModules($role, $modules);

        session()->flash('success_message', 'Role is updated successfully.');
        return redirect()->route('admin.privilege.role.index');
    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy($id)
    {
        $flag = $this->roles->destroy($id);
        if($flag){
            return response()->json([
                'type'=>'success',
                'message'=>'Role is deleted successfully.'
            ], 200);
        }

        return response()->json([
            'type'=>'error',
            'message'=>'Role can not deleted.'
        ], 422);

    }
}
