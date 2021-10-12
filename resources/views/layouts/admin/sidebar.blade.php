<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{url('/dashboard')}}" class="brand-link">
      <img src="{{ asset('images/profiles/'.auth()->user()->profile) }}" alt="MMS" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">MMS</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{ asset('images/profiles/'.auth()->user()->profile) }}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="{{url('/home')}}" class="d-block">{{auth()->user()->name}}</a>
        </div>
      </div>

      <!-- SidebarSearch Form -->
      <div class="form-inline">
      <form method="GET" action="{{url('search')}}">
          <div class="input-group" data-widget="">
              <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search" name="search">
              <div class="input-group-append">
                <button class="btn btn-sidebar" type="submit">
                  <i class="fas fa-search fa-fw"></i>
                </button>
              </div>
          </div>
        </form>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
            <a href="{{url('/admin_users')}}" class="nav-link">
              <i class="nav-icon fa fa-users"></i>
              <p>
                Users
              </p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>