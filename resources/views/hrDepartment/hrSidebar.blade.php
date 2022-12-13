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
                    <a href="{{ url('/hrDashboard') }}" class="waves-effect bx-fade-right-hover">
                        <i class="bx bx-home-circle"></i>
                        <span key="t-dashboards">Dashboard</span>
                    </a>
                </li>
                <center>
                    <hr width="90%">
                </center>
                <li class="menu-title" key="t-menu">Options</li>
                <li>
                    <a href="{{ url('employeeManagement') }}" class="waves-effect bx-fade-right-hover">
                        <i class="fa-solid fa-person-burst"></i>
                        <span key="t-dashboards">Employee Management</span>
                    </a>
                </li>
                <li>
                    <a href="{{ url('viewProfile') }}" class="waves-effect bx-fade-right-hover">
                        <i class="fa-solid fa-eye"></i>
                        <span key="t-dashboards">View Profile</span>
                    </a>
                </li>
                <li>
                    <a href="{{ url('inactiveProfile') }}" class="waves-effect bx-fade-right-hover">
                        <i class="fa-regular fa-circle-xmark"></i>
                        <span key="t-dashboards">Inactive Profile</span>
                    </a>
                </li>
                <li>
                    <a href="{{ url('hrTrainingRequirement') }}" class="waves-effect bx-fade-right-hover">
                        <i class="fa-solid fa-transgender"></i>
                        <span key="t-dashboards">Training Required Employees</span>
                    </a>
                </li>
                <li>
                    <a href="{{ url('leaveRequestEmployees') }}" class="waves-effect bx-fade-right-hover">
                        <i class="fa-solid fa-tag"></i>
                        <span key="t-dashboards"> Employees Requesting Leave</span>
                    </a>
                </li>
                <li>
                    <a href="{{ url('outsourceEvaluation') }}" class="waves-effect bx-fade-right-hover">
                        <i class="fa-solid fa-check"></i>
                        <span key="t-dashboards">Outside Labors Evaluation</span>
                    </a>
                </li>
                <li>
                    <a href="{{ url('/studentView') }}" class="waves-effect bx-fade-right-hover">
                        <i class="fa-solid fa-check"></i>
                        <span key="t-dashboards">Students</span>
                    </a>
                </li>


            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>
