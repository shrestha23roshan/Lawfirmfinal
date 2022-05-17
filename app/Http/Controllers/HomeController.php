<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Modules\About\Entities\About;
use Modules\Services\Repositories\Services\ServicesRepository;
use Modules\Services\Entities\Service;
use Modules\Resources\Entities\Resource;

class HomeController extends Controller
{
    // private $services;

    // public function __construct(ServicesRepository $services)
    // {
    //     $this->services = $services;
    // }
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('layouts.frontend.index');
        // ->withServices($this->services->getServices());
    }

    public function about()
    {
        // $about = About::where('status', '1')->orderBy('created_at', 'desc')->get();
        $about = About::where('status', '1')->get();
        $services = Service::where('status', '1')->get();
        $resources = Resource::where('is_active', '1')->get();

        return view('layouts.frontend.index', compact('about', 'services', 'resources'));
    }

    public function sendMail(Request $request)
    {
        // dd($request);
        $data = [
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'messages' => $request->get('message')
        ];  
        // dd($data);

        \Mail::send('email.contact', $data , function($message){
            $message->from('websitesreply2323@gmail.com');
            $message->to('shrestha23roshan@gmail.com', 'Admin')
            ->subject('ThapaLaw Contact Form Message.');
        });

        // return \Redirect::route('/')->with('success_message', 'Thank you for contacting us!');
                return redirect()->back()->withSuccessMessage('Thank you for Enquiry us!');

    }
}
