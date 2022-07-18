<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{url('/dashboard')}}">
        <div class="sidebar-brand-icon">
            <img src="{{asset('img/MDC-Logo-clipped.png')}}" style="width:60px;" alt="MDC Logo">
        </div>
        <div class="sidebar-brand-text mx-3">MDC&#xB7;SIS</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item">
        <a class="nav-link" href="{{url('/dashboard')}}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    @if(auth()->user()->isAny(['registrar','head']))

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Records
    </div>

    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseStudents"
            aria-expanded="true" aria-controls="collapseStudents">
            <i class="fas fa-user-graduate"></i>
            <span>Students</span>
        </a>
        <div id="collapseStudents" class="collapse" aria-labelledby="headingStudents" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Student Records:</h6>
                <a class="collapse-item" href="{{url('/students/create')}}">Create Student</a>
                <a class="collapse-item" href="{{url('/students/search')}}">Search Student</a>
            </div>
        </div>
    </li>
    @endif

    @if(auth()->user()->isAny(['registrar','head']))
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseCourses"
            aria-expanded="true" aria-controls="collapseCourses">
            <i class="fas fa-th-list"></i>
            <span>Courses &amp; Programs</span>
        </a>
        <div id="collapseCourses" class="collapse" aria-labelledby="headingCourses" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Course Records:</h6>
                <a class="collapse-item" href="{{url('/courses/create')}}">Create Course</a>
                <a class="collapse-item" href="{{url('/courses/search')}}">Search Course</a>
                <h6 class="collapse-header">Programs Records:</h6>
                <a class="collapse-item" href="{{url('/programs/create')}}">Create Program</a>
                <a class="collapse-item" href="{{url('/programs/search')}}">Search Program</a>
            </div>
        </div>
    </li>
    @endif

    @if(auth()->user()->is('admin'))
    <li class="nav-item">
        <a class="nav-link" href="{{url('/terms')}}">
            <i class="fas fa-calendar"></i>
            <span>Terms &amp; Periods</span></a>
    </li>
    @endif

    @if(auth()->user()->isAny(['registrar','head','admin']))
     <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTeachers"
            aria-expanded="true" aria-controls="collapseTeachers">
            <i class="fas fa-chalkboard-teacher"></i>
            <span>Teachers</span>
        </a>
        <div id="collapseTeachers" class="collapse" aria-labelledby="headingTeachers" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Teacher Records:</h6>
                <a class="collapse-item" href="{{url('/teachers/create')}}">Create Teacher</a>
                <a class="collapse-item" href="{{url('/teachers/search')}}">Search Teacher</a>
            </div>
        </div>
    </li>
    @endif

    @if(auth()->user()->isAny(['registrar','head','admin']))
    <li class="nav-item">
        <a class="nav-link" href="{{url('/departments')}}">
            <i class="fas fa-chart-pie"></i>
            <span>Departments</span></a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="{{url('/venues')}}">
            <i class="fas fa-map-marker-alt"></i>
            <span>Venues</span></a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="{{url('/sections')}}">
            <i class="fas fa-th-large"></i>
            <span>Sections</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Transactions
    </div>

    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseEnrollment" aria-expanded="false"
            aria-controls="collapseEnrollment">
            <i class="fas fa-fw fa-folder"></i>
            <span>Enrollment</span>
        </a>
        <div id="collapseEnrollment" class="collapse" aria-labelledby="headingEnrollment"
            data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Enrollment Transaction:</h6>
                <a class="collapse-item" href="{{url('/enrols')}}">Search Enrollment</a>
                <a class="collapse-item" href="#">Add, Change, Withdraw</a>
                <a class="collapse-item" href="{{url('/classes')}}">Class Offerings</a>
            </div>
        </div>
    </li>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseReports" aria-expanded="false"
            aria-controls="collapseReports">
            <i class="fas fa-fw fa-file"></i>
            <span>Reports</span>
        </a>
        <div id="collapseReports" class="collapse" aria-labelledby="headingReports"
            data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Generate Reports:</h6>
                <a class="collapse-item" href="{{url('/reports/student-list')}}">Student List</a>
                <a class="collapse-item" href="#">Teaching Load</a>
                <a class="collapse-item" href="#">Class List</a>
                <a class="collapse-item" href="#">Billing Assessment</a>
                <a class="collapse-item" href="#">Grade Sheet</a>
            </div>
        </div>
    </li>
    @endif

    @if(auth()->user()->is('admin'))
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUsers" aria-expanded="false"
            aria-controls="collapseUsers">
            <i class="fas fa-fw fa-users"></i>
            <span>User Management</span>
        </a>
        <div id="collapseUsers" class="collapse" aria-labelledby="headingUsers"
            data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Manage Users:</h6>
                <a class="collapse-item" href="{{url('/user-mgt')}}">Users</a>
                <a class="collapse-item" href="{{url('/roles')}}">Roles</a>
                <a class="collapse-item" href="{{url('/permissions')}}">Permissions</a>
            </div>
        </div>
    </li>
    @endif

    @if(auth()->user()->is('teacher'))
    <li class="nav-item">
        <a class="nav-link" href="{{url('/teacher-classes')}}">
            <i class="fas fa-chalkboard"></i>
            <span>My Classes</span></a>
    </li>
    @endif

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
