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
                    <a href="{{ url('/productionManagerDash') }}" class="waves-effect bx-fade-right-hover">
                        <i class="bx bx-home-circle"></i>
                        <span key="t-dashboards">Dashboard</span>
                    </a>
                </li>
                <center>
                    <hr width="90%">
                </center>
                <li class="menu-title" key="t-menu">Options</li>
                <li>
                    <a href="{{ url('/efficiencyStatus') }}" class="waves-effect bx-fade-right-hover">
                        <i class="fa-solid fa-signal"></i>
                        <span key="t-dashboards">Daily Production Efficiency and Status</span>
                    </a>
                </li>
                <li>
                    <a href="{{ url('/chartDemonstration') }}" class="waves-effect bx-fade-right-hover">
                        <i class="fa-solid fa-chart-simple"></i>
                        <span key="t-dashboards">Chart Demonstration</span>
                    </a>
                </li>


            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>
