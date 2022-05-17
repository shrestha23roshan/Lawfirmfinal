<?php

namespace App\Http\Middleware;

use App\Facades\AccessFacade;

use Illuminate\Support\Facades\Auth;
use Closure;
use Illuminate\Contracts\Auth\Guard;

class Access
{
    /**
     * The Guard implementation.
     * 
     * @var Guard
     */
    protected $access;

    /**
     * Create a new filter instance.
     * 
     * @param Guard @access
     * @return void
     */
    public function __construct(Guard $access)
    {
        $this->access = $access;
    }

     /**
     * Handle an incoming request.
     * 
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next, $module_slug)
    {
        $flag = AccessFacade::hasAccess($module_slug);
    
        if(gettype($flag) == 'string'){
            return view('auth.login');
        }

        if($this->access->guest() || !$flag){
            if($request->ajax()){
                return response('Unauthorized.', 401);
            } else {
                return view('layouts.backend.denied');
            }
        }
        
        return $next($request);
    }
}