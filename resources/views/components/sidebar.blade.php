<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center"
        href="{{ auth()->check() && auth()->user()->role == 'user' ? route('user.dashboard') : route('admin.dashboard') }}">
        <div class="sidebar--icon">
            <!-- <img src="{{ asset('/assets/images/logo/mql-logo.png')}}" height="30px" weight="30px" alt="Logo"> -->
        </div>

        <div class="sidebar-brand-text mx-3">MQLDATA</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link"
            href="{{ auth()->check() && auth()->user()->role == 'user' ? route('user.dashboard') : route('admin.dashboard') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">Discover</div>

    <!-- Admin and Superadmin Menu Items -->
    @if(auth()->check() && in_array(auth()->user()->role, ['admin', 'superadmin']))
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
            aria-expanded="true" aria-controls="collapseUtilities">
            <i class="fas fa-fw fa-users"></i>
            <span>LinkedIn Data</span>
        </a>
        <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
            <div class="bg-white collapse-inner rounded">
                <h6 class="collapse-header card-header">LinkedIn Data</h6>
                <a class="collapse-item" href="{{route('admin.linkedin.index')}}">People</a>
                <a class="collapse-item" href="{{route('admin.companies.index')}}">Account</a>
            </div>
        </div>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.blog.index') }}">
            <i class="fas fa-fw fa-blog"></i>
            <span>Blogs</span>
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.users.index') }}">
            <i class="fas fa-fw fa-users"></i>
            <span>Manage Users</span>
        </a>
    </li>
    @endif

    <!-- Editor Menu Items -->
    @if(auth()->check() && auth()->user()->role == 'editor')
    <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.blog.index') }}">
            <i class="fas fa-fw fa-blog"></i>
            <span>Blogs</span>
        </a>
    </li>
    @endif

    <!-- User Menu Items -->
    @if(auth()->check() && auth()->user()->role == 'user')
    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link" href="{{route('search')}}">
            <i class="fas fa-fw fa-search"></i>
            <span>X-Ray Search</span>
        </a>
    </li>

    <!-- Nav Item - Utilities Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
            aria-expanded="true" aria-controls="collapseUtilities">
            <i class="fas fa-fw fa-users"></i>
            <span>Contacts</span>
        </a>
        <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
            <div class="bg-white collapse-inner rounded">
                <h6 class="collapse-header card-header">Contact Management</h6>
                <a class="collapse-item" href="{{route('people')}}">People</a>
                <a class="collapse-item" href="{{route('companies')}}">Account</a>
            </div>
        </div>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">Manage</div>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="true"
            aria-controls="collapsePages">
            <i class="fas fa-fw fa-file-invoice"></i>
            <span>Billing</span>
        </a>
        <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
            <div class="bg-white collapse-inner rounded">
                <h6 class="collapse-header card-header">Payment Management</h6>
                <a class="collapse-item" href="{{route('user.dashboard')}}">Subscriptions</a>
                <a class="collapse-item" href="{{route('user.dashboard')}}">Invoices</a>
            </div>
        </div>
    </li>

    <!-- Nav Item -  -->
    <li class="nav-item">
        <a class="nav-link" href="{{route('user.dashboard')}}">
            <i class="fas fa-fw fa-users"></i>
            <span>Team</span>
        </a>
    </li>

    <!-- Nav Item -  -->
    <li class="nav-item">
        <a class="nav-link" href="{{route('user.dashboard')}}">
            <i class="far fa-question-circle"></i>
            <span>Knowledge Base</span>
        </a>
    </li>

    <!-- Nav Item -  -->
    <li class="nav-item">
        <a class="nav-link" href="{{route('user.dashboard')}}">
            <i class="fas fa-headset"></i>
            <span>Support</span>
        </a>
    </li>
    @endif

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

    <!-- Sidebar Message -->
    <div class="sidebar-card d-none d-lg-flex">
        <img class="sidebar-card-illustration mb-2" src="{{ asset('assets/images/undraw_rocket.svg')}}" alt="...">
        <p class="text-center mb-2">Packed with premium features, and more!</p>
        <a class="btn btn-success btn-sm" href="x">Upgrade to Pro!</a>
    </div>
</ul>