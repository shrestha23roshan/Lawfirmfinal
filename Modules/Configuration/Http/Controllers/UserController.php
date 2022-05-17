<?php

namespace Modules\Configuration\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

use Modules\Configuration\Repositories\Role\RoleRepository;
use Modules\Configuration\Repositories\User\UserRepository;
use Modules\Configuration\Entities\User;
use Modules\Configuration\Http\Requests\User\StoreRequest;
use Modules\Configuration\Http\Requests\User\UpdateRequest;

class UserController extends Controller
{
      /**
     * The RoleRepository instance.
     * 
     * @var RoleRepository
     */
    protected $roles;

    /**
     * The UserRepository instance.
     * 
     * @var UserRepository
     */
    protected $users;

    public function __construct(
        RoleRepository $roles,
        UserRepository $users
    )
    {
        $this->roles = $roles;
        $this->users = $users;
    }

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        return view('configuration::User.index')
        ->withRoles($this->roles->lists())
        ->withUsers($this->users->all());
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        // return view('configuration::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(StoreRequest $request)
    {
        $data = $request->all();
        $data['password'] = bcrypt($request->password);
        $user = $this->users->create($data);
        if($user){
            return response()->json([
                'status'=>'ok',
                'user'=> $user,
                'message' => 'User is added successfully.'
            ], 200);
        } else {
            return response()->json([
                'status'=>'error',
                'message'=>'User can not be added.'
            ], 422);
        }
    }

    /**
     * Show the specified resource.
     * @return Response
     */
    public function show($id)
    {
        $user = $this->users->find($id);
        return response()->json([
        'status' => 'ok', 
        'user' => $user
        ], 200);    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit()
    {
        // return view('configuration::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update(UpdateRequest $request)
    {
        $user = $this->users->update($request->id, $request->all());
        if($user){
            return response()->json([
                'status'=>'ok',
                'user'=>$user,
                'message'=>'User is updated successfully.'
            ], 200);
        } else {
            return response()->json([
                'status'=>'error',
                'message'=>'User can not be updated.'
            ], 422);
        }
    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy($id)
    {
        $flag = $this->users->destroy($id);
        if($flag){
            return response()->json([
                'type'=>'success',
                'message'=>'User is deleted successfully.'
            ], 200);
        }

        return response()->json([
            'type'=>'error',
            'message'=>'User can not deleted.'
        ], 422);
    }
     /**
     * Change status of the specified user from storage.
     * 
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function changeStatus($id)
    {
        $user = $this->users->changeStatus($id);
        $message = ($user->is_active == '1') ? "User is activated successfully." : "User is deactivated successfully.";
        return response()->json([
            'status' => 'ok', 
            'user' => $user, 
            'message'=>$message
        ], 200);
    }

    public function users(Request $request)
    {
        return response()->json([
            'status'=>'ok', 
            'users'=> $this->users->allUsers()
        ], 200);
    }
}
