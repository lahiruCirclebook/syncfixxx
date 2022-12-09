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
                @include('productionManager.productionManagerSidebar')
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
                                        <h4 class="mb-sm-0 font-size-18">Chart Demonstration</h4>
                                        <div class="page-title-right">
                                            <ol class="breadcrumb m-0">
                                                <li class="breadcrumb-item"><a href="javascript: void(0);">Chart
                                                        Demonstration</a></li>
                                                <li class="breadcrumb-item active">Production Department</li>
                                            </ol>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <!-- end page title -->
                            <br><br>
                            <div class="row">
                                <div class="col-xxl-6">
                                    <div>
                                        <h5>Date: {{ $date }}</h5>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xxl-6">
                                    <hr><br>
                                    <div>
                                        <h5>Total Production</h5>
                                    </div>
                                </div>
                                <div class="col-xxl-6">
                                    <hr><br>
                                    <div>
                                        <h5>Damage Count</h5>
                                    </div>
                                </div>
                            </div>


                            <div class="row">
                                <div class="col-xxl-6">
                                    <div>
                                        <div class="border shadow-sm p-3 mb-5 bg-white rounded" id="chart">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xxl-6">
                                    <div>
                                        <div class="border shadow-sm p-3 mb-5 bg-white rounded" id="chart2">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- end row -->


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
                var options = {
                    colors: ['#7895B2'],
                    series: [{
                        name: 'value',
                        data: [
                            @foreach ($totalProduction as $item)
                                {{ $item->y }},
                            @endforeach
                        ]
                    }],
                    chart: {
                        height: 350,
                        type: 'bar',
                    },
                    plotOptions: {
                        bar: {
                            borderRadius: 10,
                            dataLabels: {
                                position: 'top', // top, center, bottom
                            },
                        }
                    },
                    dataLabels: {
                        enabled: true,
                        formatter: function(val) {
                            return val + "";
                        },
                        offsetY: -20,
                        style: {
                            fontSize: '12px',
                            colors: ["#304758"]
                        }
                    },

                    xaxis: {
                        categories: [
                            @foreach ($totalProduction as $item)
                                "{{ $item->x }}",
                            @endforeach
                        ],
                        position: 'top',
                        axisBorder: {
                            show: false
                        },
                        axisTicks: {
                            show: false
                        },
                        crosshairs: {
                            fill: {
                                type: 'gradient',
                                gradient: {
                                    colorFrom: '#D8E3F0',
                                    colorTo: '#BED1E6',
                                    stops: [0, 100],
                                    opacityFrom: 0.4,
                                    opacityTo: 0.5,
                                }
                            }
                        },
                        tooltip: {
                            enabled: true,
                        }
                    },
                    yaxis: {
                        axisBorder: {
                            show: false
                        },
                        axisTicks: {
                            show: false,
                        },
                        labels: {
                            show: false,
                            formatter: function(val) {
                                return val + "";
                            }
                        }

                    },
                    title: {
                        text: 'Total Productions',
                        floating: true,
                        offsetY: 330,
                        align: 'center',
                        style: {
                            color: '#444'
                        }
                    }
                };

                var chart = new ApexCharts(document.querySelector("#chart"), options);
                chart.render();
            </script>

            <script>
                var options2 = {
                    colors: ['#E26868'],
                    series: [{
                        name: 'value',
                        data: [
                            @foreach ($damageCount as $item)
                                {{ $item->y }},
                            @endforeach
                        ]
                    }],
                    chart: {
                        height: 350,
                        type: 'bar',
                    },
                    plotOptions: {
                        bar: {
                            borderRadius: 10,
                            dataLabels: {
                                position: 'top', // top, center, bottom
                            },
                        }
                    },
                    dataLabels: {
                        enabled: true,
                        formatter: function(val) {
                            return val + "";
                        },
                        offsetY: -20,
                        style: {
                            fontSize: '12px',
                            colors: ["#304758"]
                        }
                    },

                    xaxis: {
                        categories: [
                            @foreach ($damageCount as $item)
                                "{{ $item->x }}",
                            @endforeach
                        ],
                        position: 'top',
                        axisBorder: {
                            show: false
                        },
                        axisTicks: {
                            show: false
                        },
                        crosshairs: {
                            fill: {
                                type: 'gradient',
                                gradient: {
                                    colorFrom: '#D8E3F0',
                                    colorTo: '#BED1E6',
                                    stops: [0, 100],
                                    opacityFrom: 0.4,
                                    opacityTo: 0.5,
                                }
                            }
                        },
                        tooltip: {
                            enabled: true,
                        }
                    },
                    yaxis: {
                        axisBorder: {
                            show: false
                        },
                        axisTicks: {
                            show: false,
                        },
                        labels: {
                            show: false,
                            formatter: function(val) {
                                return val + "";
                            }
                        }

                    },
                    title: {
                        text: 'Damage Count',
                        floating: true,
                        offsetY: 330,
                        align: 'center',
                        style: {
                            color: '#444'
                        }
                    }
                };

                var chart2 = new ApexCharts(document.querySelector("#chart2"), options2);
                chart2.render();
            </script>



        </body>

        </html>
    @else
        @include('layouts.notValidateUser')
    @endif
@else
    @include('layouts.noUser')
@endif
