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

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Records
    </div>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseStudents"
            aria-expanded="true" aria-controls="collapseStudents">
            <i class="fas fa-user-graduate"></i>
            <span>Students</span>
        </a>
        <div id="collapseStudents" class="collapse" aria-labelledby="headingStudents" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Student Records:</h6>
                <a class="collapse-item" href="#">Create Student</a>
                <a class="collapse-item" href="#">Search Student</a>
            </div>
        </div>
    </li>

     <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTeachers"
            aria-expanded="true" aria-controls="collapseTeachers">
            <i class="fas fa-chalkboard-teacher"></i>
            <span>Teachers</span>
        </a>
        <div id="collapseTeachers" class="collapse" aria-labelledby="headingTeachers" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Course Records:</h6>
                <a class="collapse-item" href="#">Create Teacher</a>
                <a class="collapse-item" href="#">Search Teacher</a>
            </div>
        </div>
    </li>

    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseCourses"
            aria-expanded="true" aria-controls="collapseCourses">
            <i class="fas fa-th-list"></i>
            <span>Courses</span>
        </a>
        <div id="collapseCourses" class="collapse" aria-labelledby="headingCourses" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Course Records:</h6>
                <a class="collapse-item" href="#">Create Course</a>
                <a class="collapse-item" href="#">Search Course</a>
            </div>
        </div>
    </li>



    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Transactions
    </div>

    <!-- Nav Item - Pages Collapse Menu -->
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
                <a class="collapse-item" href="#">New Enrollment</a>
                <a class="collapse-item" href="#">View Enrollment</a>
                <a class="collapse-item" href="#">Add, Change, Withdraw</a>
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
                <a class="collapse-item" href="#">Teaching Load</a>
                <a class="collapse-item" href="#">Class List</a>
                <a class="collapse-item" href="#">Billing Assessment</a>
                <a class="collapse-item" href="#">Grade Sheet</a>
            </div>
        </div>
    </li>

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

    {{-- <li class="nav-item">
        <a class="nav-link" href="{{url('/users-mgt')}}">
            <i class="fas fa-users fa-chart-area"></i>
            <span>User Management</span></a>
    </li> --}}


    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
