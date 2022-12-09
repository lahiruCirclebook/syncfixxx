@php
    $role = session('role');

@endphp
<div class="vertical-menu">

    <div data-simplebar class="h-100">

        <!--- Sidemenu -->
        <div id="sidebar-menu">

            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title" key="t-menu">Menu</li>
                <li>
                    <a href="{{ url('/userDashboard') }}" class="waves-effect bx-fade-right-hover">
                        <i class="bx bx-home-circle"></i>
                        <span key="t-dashboards">Dashboard</span>
                    </a>
                </li>
                <center>
                    <hr width="90%">
                </center>

                <li class="menu-title" key="t-menu">Users</li>
                <li>
                    <a href="{{ url('/userManagement') }}" class="waves-effect bx-fade-right-hover">
                        <i class="fa fa-user-plus"></i>
                        <span key="t-dashboards">Add User</span>
                    </a>

                    <a href="{{ url('disabledUsers') }}" class="waves-effect bx-fade-right-hover">
                        <i class="fa fa-unlock-alt"></i>
                        <span key="t-dashboards">Deactivated User</span>
                    </a>
                </li>
            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>
