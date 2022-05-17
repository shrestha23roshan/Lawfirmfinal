<?php

namespace App\Http\ViewComposers\Backend;

use Illuminate\View\View;
use Modules\Configuration\Repositories\User\UserRepository;

use Illuminate\Support\Facades\Auth;
use Cache;
use Session;

class SidebarComposer
{
    /**
     * UserRepository instance.
     * 
     * @var UserRepository
     */
    protected $userRepository;

    /**
     * Create a new sidebar composer.
     * 
     * @param UserRepository $user
     */
    public function __construct(
        UserRepository $userRepository
    )
    {
        $this->userRepository = $userRepository;
    }

    /**
     * Bind data to the View
     * 
     * @param View $view
     * @return void
     */
    public function compose(View $view)
    {
        $user = auth()->user();
        $modules = $this->userRepository->accessModules($user->id);

        $access_modules = [];
        foreach($modules as $key => $module) {
            $access_modules[] = [
                'id' => $module->id,
                'parent_id' => $module->parent_id,
                'slug' => $module->slug,
                'heading' => $module->module_name
            ];

            if(count($module->childrens)) {
                foreach ($module->childrens as $key => $children) {
                    $access_modules[] = [
                        'id' => $children->id,
                        'parent_id' => $children->parent_id,
                        'slug' => $children->slug,
                        'heading' => $children->module_name
                    ];

                    if(count($children->childrens)) {
                        foreach ($children->childrens as $key => $grandChildren) {
                            $access_modules[] = [
                                'id' => $grandChildren->id,
                                'parent_id' => $grandChildren->parent_id,
                                'slug' => $grandChildren->slug,
                                'heading' => $grandChildren->module_name
                            ];
                        }
                    }
                }
            }
        }

        session()->put('access_modules', $access_modules);
// dd($modules);
        $view->with('modules', $modules)
            ->with('user', $user);
    }
}