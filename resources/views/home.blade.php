@php
    $id = session('id');
    $role = session('role');

    use App\Models\UserPrivilege;
    //Getting user Privileges from database
    $privileges = UserPrivilege::where('userId', auth()->user()->userId)->first();
@endphp

@if (!empty($id))

    @if (\Illuminate\Support\Facades\Auth::id() == $id)


        <!doctype html>
        <html lang="en">

        <head>

            @include('layouts.appStyles')

            <style>
                /* Media Query for Mobile Devices */
                @media (max-width: 480px) {
                    .demo {
                        height: 200px;
                        border-radius: 15px;
                    }

                    .card-title {
                        font-size: 15px;
                        font-weight: 500;
                    }

                }

                /* Media Query for low resolution  Tablets, Ipads */
                @media (min-width: 481px) and (max-width: 767px) {
                    .demo {
                        height: 200px;
                        border-radius: 15px;
                    }

                    .card-title {
                        font-size: 10px;
                        font-weight: 500;
                    }
                }

                /* Media Query for Tablets Ipads portrait mode */
                @media (min-width: 768px) and (max-width: 1024px) {
                    .demo {
                        height: 200px;
                        border-radius: 15px;
                    }

                    .card-title {
                        font-size: 0.65rem;
                        font-weight: 500;
                    }
                }

                /* Media Query for Laptops and Desktops */
                @media (min-width: 1025px) and (max-width: 1280px) {
                    .demo {
                        height: 200px;
                        border-radius: 15px;
                    }

                    .card-title {
                        font-size: 20px;
                        font-weight: 500;
                    }

                }

                /* Media Query for Large screens */
                @media (min-width: 1281px) {
                    .demo {
                        height: 200px;
                        border-radius: 15px;
                    }

                    .card-title {
                        font-size: 22px;
                        font-weight: 500;
                    }
                }


                .bg-text {
                    background-color: rgb(0, 0, 0);
                    /* Fallback color */
                    background-color: rgba(0, 0, 0, 0.4);
                    /* Black w/opacity/see-through */
                    color: white;
                    font-weight: bold;
                    border: 3px solid #f1f1f1;
                    position: relative;
                    top: -50%;
                    left: 50%;
                    transform: translate(-50%, -50%);
                    z-index: 2;
                    width: 80%;
                    padding: 20px;
                    text-align: center;
                }

                .bg-image {
                    /* The image used */
                    background-image: url("assets/images/layouts/back1.jpg");

                    /* Add the blur effect */
                    filter: blur(2px);
                    -webkit-filter: blur(2px);

                    /* Full height */
                    height: 100%;
                    border-radius: 15px;

                    /* Center and scale the image nicely */
                    background-position: center;
                    background-repeat: no-repeat;
                    background-size: cover;
                }

                .button {
                    border-radius: 5px;
                    background-color: #182747;
                    border: none;
                    color: #FFFFFF;
                    text-align: center;
                    font-size: 20px;
                    padding: 10px;
                    transition: all 0.5s;
                    cursor: pointer;
                }

                .button span {
                    cursor: pointer;
                    display: inline-block;
                    position: relative;
                    transition: 0.5s;
                }

                .button span:after {
                    content: '\00bb';
                    position: absolute;
                    opacity: 0;
                    top: 0;
                    right: -20px;
                    transition: 0.5s;
                }

                .button:hover span {
                    padding-right: 25px;
                }

                .button:hover span:after {
                    opacity: 1;
                    right: 0;
                }

                /*.dot {
        height: 25px;
        width: 25px;
        background-color: #bbb;
        border-radius: 50%;
        display: inline-block;
    }*/

                .dot-shuttle {
                    position: relative;
                    left: -15px;
                    width: 18px;
                    height: 18px;
                    border-radius: 6px;
                    background-color: black;
                    color: transparent;
                    margin: -1px 0;
                    filter: blur(2px);
                }

                .dot-shuttle::before,
                .dot-shuttle::after {
                    content: '';
                    display: inline-block;
                    position: absolute;
                    top: 0;
                    width: 18px;
                    height: 18px;
                    border-radius: 6px;
                    background-color: black;
                    color: transparent;
                    filter: blur(2px);
                }

                .dot-shuttle::before {
                    left: 15px;
                    animation: dotShuttle 2s infinite ease-out;
                }

                .dot-shuttle::after {
                    left: 30px;
                }

                @keyframes dotShuttle {

                    0%,
                    50%,
                    100% {
                        transform: translateX(0);
                    }

                    25% {
                        transform: translateX(-55px);
                    }

                    75% {
                        transform: translateX(55px);
                    }
                }


                .stage {
                    display: flex;
                    justify-content: center;
                    align-items: center;
                    position: relative;
                    padding: 2rem 0;
                    margin: 0 -5%;
                    overflow: hidden;
                }

                .filter-contrast {
                    filter: contrast(5);
                    background-color: white;
                }
            </style>

        </head>

        <body data-sidebar="dark">

            <!-- <body data-layout="horizontal" data-topbar="dark"> -->

            <!-- Begin page -->
            <div id="layout-wrapper">


                {{--    Header --}}
                @include('layouts.homeHeader')
                <!-- ========== Left Sidebar Start ========== -->
                {{-- @include('Layout.sidebar') --}}
                <!-- Left Sidebar End -->


                <!-- ============================================================== -->
                <!-- Start right Content here -->
                <!-- ============================================================== -->
                <div class="main-content" style="margin-left: -2px">

                    <div class="page-content">
                        <div class="container-fluid">



                            <!-- start page title -->
                            <br><br>
                            <div class="row">
                                <div class="col-12">
                                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                        <h4 style="display: flex">
                                            <p id="greetings" class="mb-sm-0 font-size-15"></p>
                                            <p class="mb-sm-0 font-size-15">
                                                {{ \Illuminate\Support\Facades\Auth::user()->name }}</p>
                                        </h4>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-6 col-md-2 col-sm-12">
                                        <div class="row">
                                            <div class="col-lg-6 col-md-2 col-sm-12">
                                                <div class="card demo"
                                                    style="background-color: white;  border-left: 6px solid #182747;">
                                                    <div class="card-body"><br>
                                                        <center>
                                                            <div class="row">
                                                                <div class="container">
                                                                    @if ($role == 'Admin')
                                                                        <a href="{{ url('userDashboard') }}"
                                                                            class="button"><span>User
                                                                                Management</span></a>
                                                                    @else
                                                                        <h2><span>Hr
                                                                                Management</span></h2>
                                                                    @endif

                                                                </div>
                                                            </div><br>
                                                            <div class="row">
                                                                <center>
                                                                    <div class="container">
                                                                        <div class="stage filter-contrast">
                                                                            <div class="dot-shuttle"></div>
                                                                        </div>
                                                                    </div>
                                                                </center>
                                                            </div>
                                                        </center>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-2 col-sm-12">
                                                <div class="card demo"
                                                    style="background-color: white;  border-left: 6px solid #182747;">
                                                    <div class="card-body"><br>
                                                        <center>
                                                            <div class="row">
                                                                <div class="container">

                                                                    @if (!empty($privileges->hr))
                                                                        <a href="{{ url('hrDashboard') }}"
                                                                            class="button"><span>Hr
                                                                                Management</span></a>
                                                                    @elseif($role == 'Admin')
                                                                        <a href="{{ url('hrDashboard') }}"
                                                                            class="button"><span>Hr
                                                                                Management</span></a>
                                                                    @else
                                                                        <h2><span>Hr
                                                                                Management</span></h2>
                                                                    @endif

                                                                </div>
                                                            </div><br>
                                                            <div class="row">
                                                                <center>
                                                                    <div class="container">
                                                                        <div class="stage filter-contrast">
                                                                            <div class="dot-shuttle"></div>
                                                                        </div>
                                                                    </div>
                                                                </center>
                                                            </div>
                                                        </center>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-lg-6 col-md-2 col-sm-12">
                                                <div class="card demo"
                                                    style="background-color: white;  border-left: 6px solid #182747;">
                                                    <div class="card-body"><br>
                                                        <center>
                                                            <div class="row">
                                                                <div class="container">

                                                                    @if (!empty($privileges->supervisor))
                                                                        <a href="{{ url('supervisorDash') }}"
                                                                            class="button"><span>Supervisor</span></a>
                                                                    @elseif($role == 'Admin')
                                                                        <a href="{{ url('supervisorDash') }}"
                                                                            class="button"><span>Supervisor</span></a>
                                                                    @else
                                                                        <h2><span>Supervisor</span></h2>
                                                                    @endif

                                                                </div>
                                                            </div><br>
                                                            <div class="row">
                                                                <center>
                                                                    <div class="container">
                                                                        <div class="stage filter-contrast">
                                                                            <div class="dot-shuttle"></div>
                                                                        </div>
                                                                    </div>
                                                                </center>
                                                            </div>
                                                        </center>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-2 col-sm-12">
                                                <div class="card demo"
                                                    style="background-color: white;  border-left: 6px solid #182747;">
                                                    <div class="card-body"><br>
                                                        <center>
                                                            <div class="row">
                                                                <div class="container">

                                                                    @if (!empty($privileges->pm))
                                                                        <a href="{{ url('productionManagerDash') }}"
                                                                            class="button"><span>Production
                                                                                Management</span></a>
                                                                    @elseif($role == 'Admin')
                                                                        <a href="{{ url('productionManagerDash') }}"
                                                                            class="button"><span>Production
                                                                                Management</span></a>
                                                                    @else
                                                                        <h2><span>Production Management</span></h2>
                                                                    @endif

                                                                </div>
                                                            </div><br>
                                                            <div class="row">
                                                                <center>
                                                                    <div class="container">
                                                                        <div class="stage filter-contrast">
                                                                            <div class="dot-shuttle"></div>
                                                                        </div>
                                                                    </div>
                                                                </center>
                                                            </div>
                                                        </center>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-6 col-md-2 col-sm-12">
                                        <img src="{{ URL::asset('/assets/images/xtreme.png') }}" alt=""
                                            style="width: 80%;" height="83%">

                                    </div>
                                </div>

                            </div>
                            <!-- end page title -->
                        </div>

                        <!-- end row -->

                        <!-- container-fluid -->
                    </div>
                    <!-- End Page-content -->


                    @include('layouts.homeFooter')
                </div>
                <!-- end main content-->

            </div>
            <!-- END layout-wrapper -->

            <!-- Right Sidebar -->
            @include('layouts.rightSideBar')

            <!-- /Right-bar -->

            <!-- Right bar overlay-->
            <div class="rightbar-overlay"></div>

            <!-- JAVASCRIPT -->
            @include('layouts.appJs')

            <script>
                var myDate = new Date();
                var hrs = myDate.getHours();

                var greet;

                if (hrs < 12)
                    greet = 'Good Morning';
                else if (hrs >= 12 && hrs <= 17)
                    greet = 'Good Afternoon';
                else if (hrs >= 17 && hrs <= 24)
                    greet = 'Good Evening';

                document.getElementById('greetings').innerHTML = greet + ' ,  ';
            </script>


        </body>

        </html>
    @else
        @include('layouts.notValidateUser')
    @endif
@else
    @include('layouts.noUser')
@endif
