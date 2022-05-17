<?php

namespace Modules\Resources\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Resources\Http\Requests\Resource\StoreRequest;
use Modules\Resources\Repositories\Resource\ResourceRepository;
use Modules\Resources\Http\Requests\Resource\UpdateRequest;

class ResourcesController extends Controller
{
    private $resources;

    public function __construct(ResourceRepository $resources)
    {
        $this->resources = $resources;
        $this->destinationpath = 'uploads/resources/';
    }
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        return view('resources::Resource.index')
        ->withResources($this->resources->all());
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('resources::Resource.create');
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(StoreRequest $request)
    {
        $data = $request->except('attachment', 'file');
        $imageFile = $request->attachment;
        $imageFiles = $request->file;
        if ($imageFile) {
            $extension = $imageFile->getClientOriginalName();
            // $new_file_name = "resource_" . time();
            $attachment = $imageFile->move($this->destinationpath, $extension);
            $data['attachment'] = isset($attachment) ? $extension : NULL;
        }

        if ($imageFiles) {
            $extension = $imageFiles->getClientOriginalName();
            // $new_file_name = "_" . time();
            $attachment = $imageFiles->move($this->destinationpath, $extension);
            $data['file'] = isset($attachment) ? $extension : NULL;
        }

        $resources = $this->resources->create($data);

        if ($resources) {
            return redirect()->route('admin.resources.index')
                ->withSuccessMessage('Resource is added successfully');
        }

        return redirect()->back()
            ->withInput()
            ->withWarningMessage('Resource can not be added.');
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit($id)
    {
        return view('resources::Resource.edit')
        ->withResource($this->resources->find($id));
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update(UpdateRequest $request, $id)
    {
        $data = $request->except('attachment', 'file');
        $resources = $this->resources->find($id);

        $imageFile = $request->attachment;
        $imageFiles = $request->file;
        if ($imageFile) {
            if (file_exists($this->destinationpath . $resources->attachment) && $resources->attachment != '') {
                unlink($this->destinationpath . $resources->attachment);
            }
            $extension = $imageFile->getClientOriginalName();
            // $new_file_name = "_" . time();
            $attachment = $imageFile->move($this->destinationpath, $extension);
            $data['attachment'] = isset($attachment) ? $extension : NULL;
        }
        if ($imageFiles) {
            if (file_exists($this->destinationpath . $resources->file) && $resources->file != '') {
                unlink($this->destinationpath . $resources->file);
            }
            $extension = $imageFiles->getClientOriginalName();
            // $new_file_name = "_" . time();
            $attachment = $imageFiles->move($this->destinationpath, $extension);
            $data['file'] = isset($attachment) ? $extension : NULL;
        }

        $resources = $this->resources->update($id, $data);

        if ($resources) {
            return redirect()->route('admin.resources.index')
                ->withSuccessMessage('Resources is updated successfully');
        }

        return redirect()->back()
            ->withInput()
            ->withWarningMessage('Resources can not be updated.');
    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy($id)
    {
        $resources = $this->resources->find($id);
        $previousAttachment = $resources->attachment;
        $previousFile = $resources->file;

        $flag = $this->resources->destroy($id);
        if ($flag) {
            if (file_exists($this->destinationpath . $previousAttachment) && $previousAttachment != '') {
                unlink($this->destinationpath . $previousAttachment);
            }

            if (file_exists($this->destinationpath . $previousFile) && $previousFile != '') {
                unlink($this->destinationpath . $previousFile);
            }

            return response()->json([
                'type' => 'success',
                'message' => 'Resource is deleted successfully.'
            ], 200);
        }
        return response()->json([
            'type' => 'error',
            'message' => 'Resource can not be deleted.',
        ], 422);
    }
}
