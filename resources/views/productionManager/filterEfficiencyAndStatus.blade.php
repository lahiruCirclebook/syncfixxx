@php
    $id = session('id');
    $role = session('role');
@endphp

@if (!empty($id))

    @if (\Illuminate\Support\Facades\Auth::id() == $id)
        <!doctype html>
        <html lang="en">

        <head>

            @include('Layouts.appStyles')

        </head>

        <body data-sidebar="dark">

            <!-- Begin page -->
            <div id="layout-wrapper">


                {{--    Header --}}
                @include('Layouts.header')

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
                                        <h4 class="mb-sm-0 font-size-18">Daily Productions Summary</h4>

                                        <div class="page-title-right">
                                            <ol class="breadcrumb m-0">
                                                <li class="breadcrumb-item"><a href="javascript: void(0);">Production
                                                        Management</a></li>
                                                <li class="breadcrumb-item active">Daily Production Summary</li>
                                            </ol>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <!-- end page title -->


                            <div class="row">
                                <div class="col-md-6">
                                    <div class="card mini-stats-wid">
                                        <div class="card-body">
                                            <div class="d-flex">
                                                <div class="flex-grow-1">
                                                    <p class="text-muted fw-medium">Daily Production Between</p>

                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <div class="mb-1">
                                                                <h4>{{ $fromDate }}</h4>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-2 ">
                                                            <div class="mb-1">
                                                                <h4>To</h4>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4 ">
                                                            <div class="mb-0">
                                                                <h4> {{ $toDate }}</h4>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-2 ">
                                                            <div class="mb-1">
                                                                <a href="{{ URL::previous() }}"
                                                                    class="btn btn-outline-dark  waves-effect waves-light">Back</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>


                            <br>
                            @if (session()->has('message'))
                                <div class="col-md-4">
                                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                                        {{ session()->get('message') }}
                                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                                            aria-label="Close"></button>
                                    </div>
                                </div>
                            @endif
                            @if (session()->has('error'))
                                <div class="col-md-4">
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        {{ session()->get('error') }}
                                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                                            aria-label="Close"></button>
                                    </div>
                                </div>
                            @endif
                            @foreach ($errors->all() as $error)
                                <div class="col-md-4">
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        {{ $error }}
                                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                                            aria-label="Close"></button>
                                    </div>
                                </div>
                            @endforeach

                            <br>

                            <div class="row">
                                <div class="col-12">
                                    <div class="card">
                                        <div class="card-body">

                                            <div class="scrollme">
                                                <table id="datatable-buttons"
                                                    class="table table-responsive nowrap w-100">
                                                    <thead>
                                                        <tr>
                                                            <th>Date</th>
                                                            <th>Supervisor Id</th>
                                                            <th>Unit</th>

                                                            <th>Total Production</th>
                                                            <th>Damage Count</th>
                                                            <th>Meal Expenses</th>
                                                            <th>Actions</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @if (!empty($data))
                                                            @foreach ($data as $item)
                                                                <tr>
                                                                    <td>{{ $item->date }}</td>
                                                                    <td>{{ $item->empId }}</td>
                                                                    <td>{{ $item->unit }}</td>

                                                                    <td>{{ $item->totalProduction }}</td>
                                                                    <td>{{ $item->damageCount }}</td>
                                                                    <td>{{ $item->mealExpenses }}</td>

                                                                    <td>
                                                                        <button class="btn btn-primary btn-sm"
                                                                            data-bs-toggle="modal"
                                                                            data-bs-target="#dailyProductionViewModal"
                                                                            data-dailyproductionid="{{ $item->dailyProductionId }}"
                                                                            data-unit="{{ $item->unit }}"
                                                                            data-date="{{ $item->date }}"
                                                                            data-empid="{{ $item->empId }}"
                                                                            data-totalproduction="{{ $item->totalProduction }}"
                                                                            data-damagecount="{{ $item->damageCount }}"
                                                                            data-mealexpenses="{{ $item->mealExpenses }}">View</button>



                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                        @endif
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div> <!-- end col -->
                            </div>
                        </div>
                        <!-- container-fluid -->
                    </div>
                    <!-- End Page-content -->

                    <!-- Start Customer Add Model -->

                    <!-- End Customer Add Model -->

                    <!-- Start Customer Edit Model -->

                    <!-- End Customer Edit Model -->

                    <!-- Start Customer View Model -->
                    <div id="dailyProductionViewModal" class="modal fade" tabindex="-1" role="dialog"
                        aria-labelledby="dailyProductionViewModal" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title mt-0" id="myModalLabel">View Daily Production</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{ url('#') }}" method="post" enctype="multipart/form-data">
                                        {{ csrf_field() }}
                                        <input type="text" class="form-control" id="dailyProductionId"
                                            name="dailyProductionId" hidden>


                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="" class="form-label">Unit</label>
                                                    <input type="text" class="form-control" id="unit"
                                                        name="unit" readonly>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="" class="form-label">Date</label>
                                                    <input type="date" class="form-control" id="date"
                                                        name="date" readonly>
                                                </div>
                                            </div>
                                        </div>




                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="" class="form-label">Supervisor ID</label>
                                                    <input type="text" class="form-control" id="empId"
                                                        name="empId" readonly>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="" class="form-label">Meal expenses</label>
                                                    <input type="number" class="form-control" id="mealExpenses"
                                                        name="mealExpenses" readonly>
                                                </div>
                                            </div>
                                        </div>




                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="" class="form-label">Total Production</label>
                                                    <input type="number" class="form-control" id="totalProduction"
                                                        name="totalProduction" readonly>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="" class="form-label">Damage Count</label>
                                                    <input type="number" class="form-control" id="damageCount"
                                                        name="damageCount" readonly>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="modal-footer">
                                            <button type="button"
                                                class="btn btn-outline-danger waves-effect waves-light"
                                                data-bs-dismiss="modal">Close</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End Customer View Model -->

                    {{--        End Modals --}}




                    {{--        Footer --}}
                    @include('Layouts.footer')
                    {{--        End Footer --}}
                </div>
                <!-- end main content-->

            </div>
            <!-- END layout-wrapper -->

            <!-- Right Sidebar -->
            @include('Layouts.rightSideBar')
            <!-- /Right-bar -->

            <!-- Right bar overlay-->
            <div class="rightbar-overlay"></div>

            @include('Layouts.appJs')



            <script>
                $('#dailyProductionViewModal').on('show.bs.modal', function(event) {

                    let button = $(event.relatedTarget)
                    let dailyProductionId = button.data('dailyproductionid')
                    let unit = button.data('unit')
                    let date = button.data('date')
                    let empId = button.data('empid')

                    let totalProduction = button.data('totalproduction')
                    let damageCount = button.data('damagecount')
                    let mealExpenses = button.data('mealexpenses')


                    let modal = $(this)
                    modal.find('.modal-body #dailyProductionId').val(dailyProductionId);
                    modal.find('.modal-body #unit').val(unit);
                    modal.find('.modal-body #date').val(date);
                    modal.find('.modal-body #empId').val(empId);

                    modal.find('.modal-body #totalProduction').val(totalProduction);
                    modal.find('.modal-body #damageCount').val(damageCount);
                    modal.find('.modal-body #mealExpenses').val(mealExpenses);
                })
            </script>

        </body>

        </html>
    @else
        @include('Layouts.notValidateUser')
    @endif
@else
    @include('Layouts.noUser')
@endif
