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
                    <a href="{{ url('/supervisorDash') }}" class="waves-effect bx-fade-right-hover">
                        <i class="bx bx-home-circle"></i>
                        <span key="t-dashboards">Dashboard</span>
                    </a>
                </li>
                <center>
                    <hr width="90%">
                </center>

                <li class="menu-title" key="t-menu">Options</li>
                <li>
                    <a href="{{ url('/dailyProduction') }}" class="waves-effect bx-fade-right-hover">
                        <i class="fa-solid fa-truck-fast"></i>
                        <span key="t-dashboards">Daily Production</span>
                    </a>
                </li>
                <li>
                    <a href="{{ url('/trainingRequirement') }}" class="waves-effect bx-fade-right-hover">
                        <i class="fa-solid fa-gear"></i>
                        <span key="t-dashboards">Training Requirements</span>
                    </a>
                </li>
                <li>
                    <a href="{{ url('/leaves') }}" class="waves-effect bx-fade-right-hover">
                        <i class="fa-solid fa-person-walking-arrow-right"></i>
                        <span key="t-dashboards">Leave Request</span>
                    </a>
                </li>
                <li>
                    <a href="{{ url('/outsource') }}" class="waves-effect bx-fade-right-hover">
                        <i class="fa-solid fa-border-top-left"></i>
                        <span key="t-dashboards">Outsource Orders</span>
                    </a>
                </li>



            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>
