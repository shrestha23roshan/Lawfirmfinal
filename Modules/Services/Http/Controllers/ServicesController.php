<?php

namespace Modules\Services\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Services\Http\Requests\Services\StoreRequest;
use Modules\Services\Repositories\Services\ServicesRepository;
use Modules\Services\Http\Requests\Services\UpdateRequest;

class ServicesController extends Controller
{
    private $services;

    public function __construct(ServicesRepository $services)
    {
        $this->services = $services;
    }
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        return view('services::Services.index')
        ->withServices($this->services->all());
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('services::Services.create');
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(StoreRequest $request)
    {
        $data = $request->all();
        
        $services = $this->services->create($data);
        if ($services) {
            return redirect()->route('admin.services.index')
            ->withSuccessMessage('Service is added successfully.');
        }
        return redirect()->back()
                ->withInput()
                ->withWarningMessage('Service can not be added.');
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit($id)
    {
        return view('services::Services.edit')
        ->withService($this->services->find($id));
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update(UpdateRequest $request, $id)
    {
        $data = $request->all();

        $services = $this->services->update($id, $data);
        if($services){
            return redirect()->route('admin.services.index')
                ->withSuccessMessage('Service is updated successfully');
        }

        return redirect()->back()
            ->withInput()
            ->withWarningMessage('Service can not be updated.');

    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy($id)
    {
        $services = $this->services->find($id);

        $flag = $this->services->destroy($id);
        if ($flag) {
            return response()->json([
                'type' => 'success',
                'message' => 'Service is deleted successfully.'
            ], 200);
        }
        return response()->json([
            'type' => 'error',
            'message' => 'Service can not be deleted.',
        ], 422);
    }
}
