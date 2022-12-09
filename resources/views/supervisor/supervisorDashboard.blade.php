@php
    $id = session('id');
    $role = session('role');
@endphp

@if (!empty($id))

    @if (\Illuminate\Support\Facades\Auth::id() == $id)
        <!doctype html>
        <html lang="en">

        <head>

            @include('layouts.appStyles')

            <style>
                #timecard {
                    box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;
                }
            </style>

        </head>

        <body data-sidebar="dark">

            <!-- Begin page -->
            <div id="layout-wrapper">


                {{--    Header --}}
                @include('layouts.header')

                {{--    End Header --}}

                <!-- Left Sidebar Start  -->
                @include('supervisor.supervisorSidebar')
                <!-- Left Sidebar End -->



                <!-- ============================================================== -->
                <!-- Start right Content here -->
                <!-- ============================================================== -->
                <div class="main-content">
                    <div class="page-content">
                        <div class="container-fluid">

                            <!-- start page title -->
                            <div class="row">
                                <div class="col-12">
                                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                        <h4 class="mb-sm-0 font-size-18">Dashboard</h4>
                                        <div class="page-title-right">
                                            <ol class="breadcrumb m-0">
                                                <li class="breadcrumb-item"><a
                                                        href="javascript: void(0);">Dashboards</a></li>
                                                <li class="breadcrumb-item active">Supervisor</li>
                                            </ol>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <!-- end page title -->
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-lg-3">
                                                    <div class="media">
                                                        <div class="me-3">
                                                            <img src="{{ URL::asset('/assets/images/users/user.png') }}"
                                                                alt=""
                                                                class="avatar-md rounded-circle img-thumbnail">
                                                        </div>
                                                        <div class="media-body align-self-center">
                                                            <div class="text-muted">
                                                                <p class="mb-2 mt-2" id="greetings"></p>
                                                                <h5 class="font-size-15 text-truncate">
                                                                    {{ \Illuminate\Support\Facades\Auth::user()->name }}
                                                                </h5>
                                                                <p class="text-muted mb-0 text-truncate">
                                                                    {{ \Illuminate\Support\Facades\Auth::user()->role }}
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-lg-6 align-self-center">
                                                    <div class="text-lg-center mt-4 mt-lg-0">
                                                        <div class="row">
                                                            <div class="col-xxl-3">
                                                                <div>
                                                                    <h6 class="text-muted text-truncate mb-2">Present
                                                                        Employees</h6>

                                                                    @if ($presentEmployee == 0)
                                                                        <h5 class="mb-0">0</h5>
                                                                    @else
                                                                        <h5 class="mb-0">{{ $presentEmployee }}
                                                                        </h5>
                                                                    @endif

                                                                </div>
                                                            </div>
                                                            <div class="col-xxl-3">
                                                                <div>
                                                                    <h6 class="text-muted text-truncate mb-2">Absent
                                                                        Employees</h6>
                                                                    @if ($absentEmployee == 0)
                                                                        <h5 class="mb-0">0</h5>
                                                                    @else
                                                                        <h5 class="mb-0">{{ $absentEmployee }}
                                                                        </h5>
                                                                    @endif

                                                                    {{-- <h5 class="mb-0">@if (!empty($totalApproved)){{$totalApproved}}@else 0 @endif</h5> --}}
                                                                </div>
                                                            </div>
                                                            <div class="col-xxl-3">
                                                                <div>
                                                                    <h6 class="text-muted text-truncate mb-2">Total
                                                                        Production
                                                                    </h6>
                                                                    @if ($totalProduction == 0)
                                                                        <h5 class="mb-0">0</h5>
                                                                    @else
                                                                        <h5 class="mb-0">{{ $totalProduction }}
                                                                        </h5>
                                                                    @endif
                                                                    {{-- <h5 class="mb-0">@if (!empty($totalPending)){{$totalPending}}@else 0 @endif</h5> --}}
                                                                </div>
                                                            </div>
                                                            <div class="col-xxl-3">
                                                                <div>
                                                                    <h6 class="text-muted text-truncate mb-2">Damage
                                                                        Count
                                                                    </h6>
                                                                    @if ($damageCount == 0)
                                                                        <h5 class="mb-0">0</h5>
                                                                    @else
                                                                        <h5 class="mb-0">{{ $damageCount }}
                                                                        </h5>
                                                                    @endif
                                                                    {{-- <h5 class="mb-0">@if (!empty($totalPending)){{$totalPending}}@else 0 @endif</h5> --}}
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-lg-3 d-none d-lg-block">
                                                    <div class="clearfix mt-4 mt-lg-0">
                                                        <div class="dropdown float-end">
                                                            <button class="btn btn-info dropdown-toggle" type="button"
                                                                data-bs-toggle="dropdown" aria-haspopup="true"
                                                                aria-expanded="false">
                                                                <i class="bx bxs-cog align-middle me-1 bx-spin"></i>
                                                                Settings
                                                            </button>
                                                            <div class="dropdown-menu dropdown-menu-end">
                                                                <a class="dropdown-item"
                                                                    href="{{ url('/editProfileView') . $id }}">Edit
                                                                    Profile</a>
                                                                <a class="dropdown-item"
                                                                    href="{{ url('/changePasswordView') . $id }}">Change
                                                                    Password</a>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- end row -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- end row -->

                            <div class="row">

                                <div class="col-xl-4">
                                    <div class="card bg-info bg-soft" id="timecard">
                                        <div>
                                            <div class="row">
                                                <div class="col-7">
                                                    <div class="text-primary p-3">
                                                        <h5 style="color: rgb(20, 21, 21)" class="mb-3">Welcome Back !
                                                        </h5>
                                                        <h3><span id="time"></span></h3>
                                                    </div>
                                                </div>
                                                <div class="col-5 align-self-end">
                                                    {{-- <img src="{{ URL::asset('/assets/images/profile-img.png') }}" alt="" class="img-fluid"> --}}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <br>

                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="card">
                                                <div class="card-body">

                                                    <div class="d-flex align-items-center mb-3">

                                                        <div class="avatar-xs me-3 col-6">
                                                            <span
                                                                class="avatar-title rounded-circle bg-success bg-soft text-primary font-size-18">
                                                                <i class="fa-solid fa-hands"></i>
                                                            </span>
                                                        </div>

                                                        <div class="col-6">
                                                            <h5 class="font-size-14 mb-0">Training Needs</h5>
                                                            @if (!empty($trainingNeed))
                                                                <h5 class="mb-0">{{ $trainingNeed }}
                                                                </h5>
                                                            @else
                                                                <h5 class="mb-0">0</h5>
                                                            @endif
                                                        </div>

                                                        {{-- <div class="col-3"><h3>@if (!empty($totalQuotations)){{$totalQuotations}}@else 0 @endif</h3></div> --}}

                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="card">
                                                <div class="card-body">
                                                    <div class="d-flex align-items-center mb-3">

                                                        <div class="avatar-xs me-3 col-6">
                                                            <span
                                                                class="avatar-title rounded-circle bg-success bg-soft text-primary font-size-18">
                                                                <i class="fa-solid fa-person-half-dress"></i>
                                                            </span>
                                                        </div>

                                                        <div class="col-6">
                                                            <h5 class="font-size-14 mb-0">Leaves request</h5>
                                                            @if (!empty($leaveRequest))
                                                                <h5 class="mb-0">{{ $leaveRequest }}
                                                                </h5>
                                                            @else
                                                                <h5 class="mb-0">0</h5>
                                                            @endif
                                                        </div>

                                                        {{-- <div class="col-3"><h3>@if (!empty($totalSubmittedQuotations)){{$totalSubmittedQuotations}}@else 0 @endif</h3></div> --}}

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                </div>
                                <div class="col-xl-8">

                                    <div class="card" style="width: 100%">
                                        <div class="card-body" style="height: 400px;">
                                            <h4
                                                class="card-title
                                                mb-4">
                                                Outsource Summary
                                            </h4>

                                            <div id="pie_chart_all" class="apex-charts" dir="ltr"></div>

                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            {{--        Footer --}}
            @include('layouts.footer')
            {{--        End Footer --}}
            </div>
            <!-- end main content-->

            </div>
            <!-- END layout-wrapper -->

            <!-- Right Sidebar -->
            @include('layouts.rightSideBar')
            <!-- /Right-bar -->

            <!-- Right bar overlay-->
            <div class="rightbar-overlay"></div>

            @include('layouts.appJs')

            <script>
                setInterval(displayclock, 500);

                function displayclock() {
                    var time = new Date();
                    var hrs = time.getHours();
                    var min = time.getMinutes();
                    var sec = time.getSeconds();
                    var en = 'AM';
                    if (hrs >= 12) {
                        en = 'PM';
                    }
                    if (hrs > 12) {
                        hrs = hrs - 12;
                    }
                    if (hrs == 0) {
                        hrs = 12;
                    }
                    if (hrs < 10) {
                        hrs = '0' + hrs;
                    }
                    if (min < 10) {
                        min = '0' + min;
                    }
                    if (sec < 10) {
                        sec = '0' + sec;
                    }
                    document.getElementById("time").innerHTML = hrs + ':' + min + ':' + sec + ' ' + en;
                }
            </script>

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

                document.getElementById('greetings').innerHTML = greet;
            </script>

            <script>
                $('tr[data-href]').on("click", function() {
                    document.location = $(this).data('href');
                });
            </script>

            <script>
                /*Pie Chart*/
                options = {
                    chart: {
                        height: 360,
                        type: "pie"
                    },
                    series: [{{ $coverAmount }}, {{ $frameAmount }}, {{ $threadAmount }}, {{ $expectedUmbrella }},
                        {{ $rejectedUmbrella }}
                    ],
                    labels: ["Cover Amount", "Frame Amount", "Thread Amount", "Expected Umbrella", "Rejected Umbrella"],
                    colors: ["#F46A6A", "#F1B44C", "#5A6EE6", "#50A5F1", "#C47AFF"],
                    legend: {
                        show: !0,
                        position: "bottom",
                        horizontalAlign: "center",
                        verticalAlign: "middle",
                        floating: !1,
                        fontSize: "14px",
                        offsetX: 0
                    },
                    responsive: [{
                        breakpoint: 600,
                        options: {
                            chart: {
                                height: 240
                            },
                            legend: {
                                show: !1
                            }
                        }
                    }]
                };
                (chart = new ApexCharts(document.querySelector("#pie_chart_all"), options)).render();
            </script>

        </body>

        </html>
    @else
        @include('layouts.notValidateUser')
    @endif
@else
    @include('layouts.noUser')
@endif
