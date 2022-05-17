<header class="fixed ">
    <div class="main-header">
      <!-- Logo -->
      <a class="logo">
          <!-- mini logo for sidebar mini 50x50 pixels -->
          <span class="logo-mini"><b>LFF</b></span>
          <!-- logo for regular state and mobile devices -->
          <span class="logo-lg">Lawfirmfinal&nbsp;CMS</span>
        </a>
    
        <!-- Header Navbar -->
        <nav class="navbar navbar-static-top" role="navigation">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
            <span class="sr-only">Toggle navigation</span>
          </a>
          <!-- Navbar Right Menu -->
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
              <!-- Messages: style can be found in dropdown.less-->
          
              <!-- /.messages-menu -->
    
              <!-- Notifications Menu -->
             
              <!-- Tasks Menu -->
  
              <!-- User Account Menu -->
              <li class="dropdown user user-menu">
                <!-- Menu Toggle Button -->
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <!-- The user image in the navbar-->
                    <img src="{{ asset('uploads/avatar.png') }}" class="user-image" alt="User Image">
                  <!-- hidden-xs hides the username on small devices so only the image appears. -->
                  <span class="hidden-xs">{{ auth()->user()->full_name }}</span>
                </a>
                <ul class="dropdown-menu">
                  <!-- The user image in the menu -->
                  <li class="user-header">
                    <img src="{{ asset('uploads/avatar.png') }}" class="img-circle" alt="User Image">
    
                    <p>
                      {{ auth()->user()->full_name }}
                      <small>Member since {{ auth()->user()->created_at }}</small>
                    </p>
                  </li>
                  <!-- Menu Body -->
                  
                  <!-- Menu Footer-->
                  <li class="user-footer">
                    <div class="pull-left">
                      <a href="#" class="btn btn-default btn-flat">Profile</a>
                    </div>
                    <div class="pull-right">
                      <a href="{{ route('auth.logout') }}" class="btn btn-default btn-flat"
                      onclick="event.preventDefault();
                               document.getElementById('logout-form').submit();">
                      Logout
                      </a>
                      <form id="logout-form" action="{{ route('auth.logout') }}" method="POST" style="display: none;">
                                          {{ csrf_field() }}
                      </form>
                    </div>
                  </li>
                </ul>
              </li>
              <!-- Control Sidebar Toggle Button -->
              <li >
                <div id="google_translate_element" style="display:none;"></div>
              </li>
              
            </ul>
          </div>
        </nav>
    </div>
      
  </header>