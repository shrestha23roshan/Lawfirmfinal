<div class="fixed">
    <aside class="main-sidebar">
      <!-- sidebar: style can be found in sidebar.less -->
      <section class="sidebar">
          
          <!-- Sidebar user panel (optional) -->
          <div class="user-panel">
              <div class="pull-left image">
                @if(Auth::user()->image_icon)
        
                <img src="{{ URL::asset('uploads/settings/profile/'.Auth::user()->image_icon.'-s.jpg') }}"  class="img-circle" width="48" height="48" alt="User"> 
                @else
        
                <img src="{{ URL::asset('uploads/avatar.png') }}" alt="User" width="48" height="48" /> @endif
              </div>
              <div class="pull-left info">
                <p>{{ $user->full_name }}</p>
                <div class="email">{{ $user->designation }}</div>
              </div>
            </div>
      
          <!-- Sidebar Menu -->
          <ul class="sidebar-menu" data-widget="tree">
            <li>
              <a href="{{ route('dashboard') }}" id="dashboard">
                  <i class="fa fa-dashboard"></i>
                  <span>Dashboard</span>
              </a>
          </li>
      
            @foreach($modules as $module)
            <li class="@if(count($module->childrens)>0) treeview @endif {{ classActivePath('$module->menu_class') }}">
              <a href="@if(count($module->childrens)>0) javascript:void(0); @else {!! route($module->slug.'.index') !!} @endif" id="{{ $module->menu_class }}"
                @if(count($module->childrens) > 0) class="menu-toggle" @endif>
                <i class="{{ $module->icon }}"></i>
                <span>{{ $module->module_name }}</span>
                @if(count($module->childrens)>0)
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
                @endif
              </a>
              @if(count($module->childrens))
              <ul class="treeview-menu">
                @foreach($module->childrens as $children)
                <li id="{{ $children->menu_class }}">
                  <a href="{{ route($children->slug.'.index') }}">
                    <i class="{{ $children->icon }}"></i>{{ $children->module_name }}
                  </a>
                </li>
                @endforeach
              </ul>
              @endif
            </li>
            @endforeach
          </ul>
          <!-- /.sidebar-menu -->
        </section>
        <!-- /.sidebar -->
    </aside>
  </div>