<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
        <img src="{{asset('backend/dist/img/AdminLTELogo.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">Manage Library</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{asset('backend/dist/img/user2-160x160.jpg')}}" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">{{\Illuminate\Support\Facades\Auth::user()->name}}</a>
            </div>
        </div>

        <!-- SidebarSearch Form -->
        <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a href="{{route('admin.author.list')}}" class="nav-link {{request()->is('admin/authors/list') ? 'active' : ''}}">
                        <i class="nav-icon fas  fa-coffee"></i>
                        <p>
                            Manage Authors
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{route('admin.category.list')}}" class="nav-link {{request()->is('admin/categories/list') ? 'active' : ''}}">
                        <i class="nav-icon fas  fa-puzzle-piece"></i>
                        <p>
                            Manage Category Book
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{route('admin.publisher.list')}}" class="nav-link {{request()->is('admin/publishers/list') ? 'active' : ''}}">
                        <i class="nav-icon fas  fa-paint-brush"></i>
                        <p>
                            Manage Publishers
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{route('admin.book.list')}}" class="nav-link {{request()->is('admin/books/list') ? 'active' : ''}}">
                        <i class="nav-icon fas  fa-book"></i>
                        <p>
                            Manage Books
                        </p>
                    </a>
                </li>



                @if (Auth::check())
                <li class="nav-item">
                    <a href="" class="nav-link" href="{{ route('logout') }}"
                       onclick="event.preventDefault(); document.getElementById('logout-form').submit()">
                        <i class="nav-icon fas fa-book"></i>
                        <p>
                            Logout
                        </p>
                        <form id="logout-form" action="{{route('logout')}}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </a>
                </li>
                @endif

            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
