<?php

namespace Modules\News\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\News\Repositories\News\NewsRepository;
use Modules\News\Http\Requests\News\StoreRequest;
use Modules\News\Http\Requests\News\UpdateRequest;

class NewsController extends Controller
{
    private $news;

    public function __construct(NewsRepository $news)
    {
        $this->news = $news;
        $this->destinationpath = 'uploads/news/';
    }
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        return view('news::News.index')
        ->withNews($this->news->all());
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('news::News.create');
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
            $extension = strrchr($imageFile->getClientOriginalName(), '.');
            $new_file_name = "news_" . time();
            $attachment = $imageFile->move($this->destinationpath, $new_file_name . $extension);
            $data['attachment'] = isset($attachment) ? $new_file_name . $extension : NULL;
        }

        if ($imageFiles) {
            $extension = $imageFiles->getClientOriginalName();
            // $new_file_name = "_" . time();
            $attachment = $imageFiles->move($this->destinationpath, $extension);
            $data['file'] = isset($attachment) ? $extension : NULL;
        }

        $news = $this->news->create($data);

        if ($news) {
            return redirect()->route('admin.news.index')
                ->withSuccessMessage('News is added successfully');
        }

        return redirect()->back()
            ->withInput()
            ->withWarningMessage('News can not be added.');
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit($id)
    {
        return view('news::News.edit')
        ->withNews($this->news->find($id));
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update(UpdateRequest $request, $id)
    {
        $data = $request->except('attachment', 'file');
        $news = $this->news->find($id);

        $imageFile = $request->attachment;
        $imageFiles = $request->file;
        if ($imageFile) {
            if (file_exists($this->destinationpath . $news->attachment) && $news->attachment != '') {
                unlink($this->destinationpath . $news->attachment);
            }
            $extension = strrchr($imageFile->getClientOriginalName(), '.');
            $new_file_name = "news_" . time();
            $attachment = $imageFile->move($this->destinationpath, $new_file_name . $extension);
            $data['attachment'] = isset($attachment) ? $new_file_name . $extension : NULL;
        }
        if ($imageFiles) {
            if (file_exists($this->destinationpath . $news->file) && $news->file != '') {
                unlink($this->destinationpath . $news->file);
            }
            $extension = $imageFiles->getClientOriginalName();
            // $new_file_name = "_" . time();
            $attachment = $imageFiles->move($this->destinationpath, $extension);
            $data['file'] = isset($attachment) ? $extension : NULL;
        }

        $news = $this->news->update($id, $data);

        if ($news) {
            return redirect()->route('admin.news.index')
                ->withSuccessMessage('Page is updated successfully');
        }

        return redirect()->back()
            ->withInput()
            ->withWarningMessage('Page can not be updated.');
    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy($id)
    {
        $news = $this->news->find($id);
        $previousAttachment = $news->attachment;
        $previousFile = $news->file;

        $flag = $this->news->destroy($id);
        if ($flag) {
            if (file_exists($this->destinationpath . $previousAttachment) && $previousAttachment != '') {
                unlink($this->destinationpath . $previousAttachment);
            }

            if (file_exists($this->destinationpath . $previousFile) && $previousFile != '') {
                unlink($this->destinationpath . $previousFile);
            }

            return response()->json([
                'type' => 'success',
                'message' => 'News is deleted successfully.'
            ], 200);
        }
        return response()->json([
            'type' => 'error',
            'message' => 'News can not be deleted.',
        ], 422);
    }
}
