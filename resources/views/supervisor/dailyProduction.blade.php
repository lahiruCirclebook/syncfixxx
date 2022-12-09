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
                                        <h4 class="mb-sm-0 font-size-18">Daily Productions</h4>

                                        <div class="page-title-right">
                                            <ol class="breadcrumb m-0">
                                                <li class="breadcrumb-item"><a href="javascript: void(0);"></a>Daily
                                                    Production</li>
                                                <li class="breadcrumb-item active">Supervisor</li>
                                            </ol>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <!-- end page title -->

                            <div class="row">
                                <div class="col-md-3">
                                    <button class="btn btn-primary waves-effect waves-light" data-bs-toggle="modal"
                                        data-bs-target="#dailyProductionAddModal">Add Daily Production</button>
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
                                                            <th>Present Employees</th>
                                                            <th>Absent Employees</th>
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
                                                                    <td>{{ $item->presentEmployees }}</td>
                                                                    <td>{{ $item->absentEmployees }}</td>
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
                                                                            data-presentemployees="{{ $item->presentEmployees }}"
                                                                            data-absentemployees="{{ $item->absentEmployees }}"
                                                                            data-totalproduction="{{ $item->totalProduction }}"
                                                                            data-damagecount="{{ $item->damageCount }}"
                                                                            data-mealexpenses="{{ $item->mealExpenses }}">View</button>
                                                                        @if ($role == 'Admin')
                                                                            <button
                                                                                class="btn btn-outline-info  btn-sm waves-effect waves-light"
                                                                                data-bs-toggle="modal"
                                                                                data-bs-target="#dailyProductionEditModal"
                                                                                data-dailyproductionid="{{ $item->dailyProductionId }}"
                                                                                data-unit="{{ $item->unit }}"
                                                                                data-date="{{ $item->date }}"
                                                                                data-empid="{{ $item->empId }}"
                                                                                data-presentemployees="{{ $item->presentEmployees }}"
                                                                                data-absentemployees="{{ $item->absentEmployees }}"
                                                                                data-totalproduction="{{ $item->totalProduction }}"
                                                                                data-damagecount="{{ $item->damageCount }}"
                                                                                data-mealexpenses="{{ $item->mealExpenses }}">Edit</button>
                                                                            <a href="{{ url('deleteDailyProduction') . $item->dailyProductionId }}"
                                                                                class="btn btn-outline-danger btn-sm waves-effect waves-light">Delete</a>
                                                                        @endif
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
                    <div id="dailyProductionAddModal" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title mt-0" id="myModalLabel">Add Daily Prodction</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{ url('addDailyProduction') }}" method="post"
                                        enctype="multipart/form-data">
                                        {{ csrf_field() }}

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="" class="form-label">Unit</label>
                                                    <select name="unit" id="unit" class="form-select">
                                                        <option value="" selected disabled>-- select unit --
                                                        </option>
                                                        <option value="Cutting Unit">Cutting Unit</option>
                                                        <option value="Sewing Unit">Sewing Unit</option>
                                                        <option value="Design  Unit">Design Unit</option>
                                                        <option value="Printing  Unit">Printing Unit</option>
                                                        <option value="Finishing  Unit">Finishing Unit</option>

                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="" class="form-label">Date</label>
                                                    <input type="date" class="form-control" id="date"
                                                        name="date" required>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="" class="form-label">Supervisor ID</label>
                                                    <select id="empId" name="empId"
                                                        class="form-control input sm">
                                                        <option value="" selected disabled>-- select supervisor
                                                            ID --
                                                        </option>
                                                        @foreach ($supervisor as $item)
                                                            <option value="{{ $item->empId }}">{{ $item->empId }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="" class="form-label">Meal expenses</label>
                                                    <input type="number" class="form-control" id="mealExpenses"
                                                        name="mealExpenses">
                                                </div>
                                            </div>
                                        </div>



                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="" class="form-label">Present Employees</label>
                                                    <input type="number" class="form-control" id="presentEmployees"
                                                        name="presentEmployees">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="" class="form-label">Absent Employees</label>
                                                    <input type="number" class="form-control" id="absentEmployees"
                                                        name="absentEmployees" required>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="" class="form-label">Total Production</label>
                                                    <input type="number" class="form-control" id="totalProduction"
                                                        name="totalProduction">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="" class="form-label">Damage Count</label>
                                                    <input type="number" class="form-control" id="damageCount"
                                                        name="damageCount" required>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="modal-footer">
                                            <button type="submit"
                                                class="btn btn-primary waves-effect waves-light">Save
                                            </button>
                                            <button type="button"
                                                class="btn btn-outline-danger waves-effect waves-light"
                                                data-bs-dismiss="modal">Close</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End Customer Add Model -->

                    <!-- Start Customer Edit Model -->
                    <div id="dailyProductionEditModal" class="modal fade" tabindex="-1" role="dialog"
                        aria-labelledby="dailyProductionEditModal" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title mt-0" id="myModalLabel">Edit Daily Producton</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{ url('editDailyProduction') }}" method="post"
                                        enctype="multipart/form-data">
                                        {{ csrf_field() }}
                                        <input type="text" class="form-control" id="dailyProductionId"
                                            name="dailyProductionId" hidden>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="" class="form-label">Unit</label>
                                                    <input type="text" class="form-control" id="unit"
                                                        name="unit" readonly>
                                                    {{-- <select name="unit" id="unit" class="form-select">
                                                        <option value="Cutting Unit">Cutting Unit</option>
                                                        <option value="Sewing Unit">Sewing Unit</option>
                                                        <option value="Design  Unit">Design Unit</option>
                                                        <option value="Printing  Unit">Printing Unit</option>
                                                        <option value="Finishing  Unit">Finishing Unit</option>

                                                    </select> --}}
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="" class="form-label">Date</label>
                                                    <input type="date" class="form-control" id="date"
                                                        name="date">
                                                </div>
                                            </div>
                                        </div>



                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="" class="form-label">Supervisor ID</label>

                                                    <select id="empId" name="empId"
                                                        class="form-control input sm">
                                                        @foreach ($supervisor as $item)
                                                            <option value="{{ $item->empId }}">{{ $item->empId }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="" class="form-label">Meal expenses</label>
                                                    <input type="number" class="form-control" id="mealExpenses"
                                                        name="mealExpenses">
                                                </div>
                                            </div>
                                        </div>



                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="" class="form-label">Present Employees</label>
                                                    <input type="number" class="form-control" id="presentEmployees"
                                                        name="presentEmployees">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="" class="form-label">Absent Employees</label>
                                                    <input type="number" class="form-control" id="absentEmployees"
                                                        name="absentEmployees" required>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="" class="form-label">Total Production</label>
                                                    <input type="number" class="form-control" id="totalProduction"
                                                        name="totalProduction">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="" class="form-label">Damage Count</label>
                                                    <input type="number" class="form-control" id="damageCount"
                                                        name="damageCount" required>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="modal-footer">
                                            <button type="submit"
                                                class="btn btn-primary waves-effect waves-light">Save
                                            </button>
                                            <button type="button"
                                                class="btn btn-outline-danger waves-effect waves-light"
                                                data-bs-dismiss="modal">Close</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
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
                                                    <label for="" class="form-label">Present Employees</label>
                                                    <input type="number" class="form-control" id="presentEmployees"
                                                        name="presentEmployees" readonly>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="" class="form-label">Absent Employees</label>
                                                    <input type="number" class="form-control" id="absentEmployees"
                                                        name="absentEmployees" readonly>
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
                $('#dailyProductionEditModal').on('show.bs.modal', function(event) {

                    let button = $(event.relatedTarget)
                    let dailyProductionId = button.data('dailyproductionid')
                    let unit = button.data('unit')
                    let date = button.data('date')
                    let empId = button.data('empid')
                    let presentEmployees = button.data('presentemployees')
                    let absentEmployees = button.data('absentemployees')
                    let totalProduction = button.data('totalproduction')
                    let damageCount = button.data('damagecount')
                    let mealExpenses = button.data('mealexpenses')


                    let modal = $(this)
                    modal.find('.modal-body #dailyProductionId').val(dailyProductionId);
                    modal.find('.modal-body #unit').val(unit);
                    modal.find('.modal-body #date').val(date);
                    modal.find('.modal-body #empId').val(empId);
                    modal.find('.modal-body #presentEmployees').val(presentEmployees);
                    modal.find('.modal-body #absentEmployees').val(absentEmployees);
                    modal.find('.modal-body #totalProduction').val(totalProduction);
                    modal.find('.modal-body #damageCount').val(damageCount);
                    modal.find('.modal-body #mealExpenses').val(mealExpenses);
                })
            </script>

            <script>
                $('#dailyProductionViewModal').on('show.bs.modal', function(event) {

                    let button = $(event.relatedTarget)
                    let dailyProductionId = button.data('dailyproductionid')
                    let unit = button.data('unit')
                    let date = button.data('date')
                    let empId = button.data('empid')
                    let presentEmployees = button.data('presentemployees')
                    let absentEmployees = button.data('absentemployees')
                    let totalProduction = button.data('totalproduction')
                    let damageCount = button.data('damagecount')
                    let mealExpenses = button.data('mealexpenses')


                    let modal = $(this)
                    modal.find('.modal-body #dailyProductionId').val(dailyProductionId);
                    modal.find('.modal-body #unit').val(unit);
                    modal.find('.modal-body #date').val(date);
                    modal.find('.modal-body #empId').val(empId);
                    modal.find('.modal-body #presentEmployees').val(presentEmployees);
                    modal.find('.modal-body #absentEmployees').val(absentEmployees);
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
