<?php

namespace Modules\About\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\About\Entities\About;

class AboutController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $about = About::all();
        return view('about::About.index', compact('about'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('about::About.create');
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $destinationpath = 'uploads/about/';
        $data = $request->except('attachment');
// dd($data);
        $imageFile = $request->attachment;
        if($imageFile) {
            $extension = strrchr($imageFile->getClientOriginalName(), '.');
            $new_file_name = "about_" . time();
            $attachment = $imageFile->move($destinationpath, $new_file_name.$extension);
            $data['attachment'] = isset($attachment) ? $new_file_name . $extension : NULL;
        }
        $about = About::create($data);

        if($about){
            return redirect()->route('admin.about.index')
                        ->withSuccessMessage('About is added successfully.');
        }
    
        return redirect()->back()
                ->withInput()
                ->withWarningMessage('About can not be added.');
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit($id)
    {
        $about = About::find($id);
        return view('about::About.edit', compact('about'));
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $id = (int) $id;
        $about = About::findOrFail($id);

        $data['heading'] = $request->heading;
        $data['description'] = $request->description;
        $data['status'] = $request->status;

        $imageFile = $request->attachment;
        $destinationpath = 'uploads/about/';

        if ($imageFile) {
            if (file_exists($destinationpath . $about->attachment) &&  $about->attachment != '') {
                unlink($destinationpath . $about->attachment);
            }
            $extension = strrchr($imageFile->getClientOriginalName(), '.');
            $new_file_name = "about_" . time();
            $attachment = $imageFile->move($destinationpath, $new_file_name.$extension);
            $data['attachment'] = isset($attachment) ? $new_file_name . $extension : null;
        }
        
        if (About::where(['id' => $id])->update($data)) {
            return redirect()->route('admin.about.index')
            ->withSuccessMessage('About is updated successfully.');
        }

        return redirect()->back()
            ->withInput()
            ->withWarningMessage('About can not be updated.');
    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy($id)
    {
        $about = About::find($id);
        $destinationpath = 'uploads/about/';
        $previousAttachment = $about->attachment;

        $flag = About::where(['id' => $about->id])->delete();
       $about->delete();
       if ($flag) {
           if (file_exists($destinationpath. $previousAttachment) && $previousAttachment != '') {
               unlink($destinationpath. $previousAttachment);
           }
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

