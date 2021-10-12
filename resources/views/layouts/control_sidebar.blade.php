<aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{ asset('images/profiles/'.auth()->user()->profile) }}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">See Profile</a>
        </div>
    </div>
    <!-- Sidebar Menu -->
    <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
            <a href="{{route('logout')}}" class="nav-link">
              <i class="nav-icon fas fa-sign-out"></i>
              <p>
                Sign Out
              </p>
            </a>
          </li>
        </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </aside>

  </div>
    <!-- ./wrapper -->