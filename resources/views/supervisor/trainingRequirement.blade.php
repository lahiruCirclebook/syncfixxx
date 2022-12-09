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
                                        <h4 class="mb-sm-0 font-size-18">Training Requirements</h4>

                                        <div class="page-title-right">
                                            <ol class="breadcrumb m-0">
                                                <li class="breadcrumb-item"><a href="javascript: void(0);"></a>Training
                                                    Requirements</li>
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
                                        data-bs-target="#trainingRequirementAddModal">Add Training Requirements</button>
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
                                                            <th>Unit</th>
                                                            <th>Employee Id</th>
                                                            <th>Employee Name</th>
                                                            <th>Actions</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @if (!empty($data))
                                                            @foreach ($data as $item)
                                                                <tr>
                                                                    <td>{{ $item->date }}</td>
                                                                    <td>{{ $item->unit }}</td>
                                                                    <td>{{ $item->employeeId }}</td>
                                                                    <td>{{ $item->employeeName }}</td>
                                                                    <td>
                                                                        <button class="btn btn-primary btn-sm"
                                                                            data-bs-toggle="modal"
                                                                            data-bs-target="#trainingRequirementViewModal"
                                                                            data-unit="{{ $item->unit }}"
                                                                            data-date="{{ $item->date }}"
                                                                            data-employeeid="{{ $item->employeeId }}"
                                                                            data-employeename="{{ $item->employeeName }}">View</button>
                                                                        @if ($role == 'Admin')
                                                                            <a href="{{ url('deleteTrainingRequirement') . $item->id }}"
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
                    <div id="trainingRequirementAddModal" class="modal fade" tabindex="-1"
                        aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title mt-0" id="myModalLabel">Add Training Requirement</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{ url('addTrainingRequirement') }}" method="post"
                                        enctype="multipart/form-data">
                                        {{ csrf_field() }}

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="" class="form-label">Employee Id</label>
                                                    <select id="employeeId" name="employeeId"
                                                        class="form-control input sm">
                                                        <option value="" selected> --select employee Id--
                                                        </option>
                                                        @foreach ($employee as $item)
                                                            <option value="{{ $item->employeeId }}">
                                                                {{ $item->employeeId }}
                                                            </option>
                                                        @endforeach
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
                                                    <label for="" class="form-label">Unit</label>
                                                    <input type="text" class="form-control" id="unit"
                                                        name="unit" readonly>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="" class="form-label">Employee Name</label>
                                                    <input type="text" class="form-control" id="employeeName"
                                                        name="employeeName" readonly>
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



                    <!-- Start Customer View Model -->
                    <div id="trainingRequirementViewModal" class="modal fade" tabindex="-1" role="dialog"
                        aria-labelledby="trainingRequirementViewModal" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title mt-0" id="myModalLabel">View Training Requirement</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{ url('#') }}" method="post" enctype="multipart/form-data">
                                        {{ csrf_field() }}
                                        <input type="text" class="form-control" id="employeeId" name="employeeId"
                                            hidden>


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
                                                    <label for="" class="form-label">Employee Id</label>
                                                    <input type="text" class="form-control" id="employeeId"
                                                        name="employeeId" readonly>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="" class="form-label">Employee Name</label>
                                                    <input type="text" class="form-control" id="employeeName"
                                                        name="employeeName" readonly>
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
                $('#trainingRequirementViewModal').on('show.bs.modal', function(event) {

                    let button = $(event.relatedTarget)
                    let unit = button.data('unit')
                    let date = button.data('date')
                    let employeeId = button.data('employeeid')
                    let employeeName = button.data('employeename')



                    let modal = $(this)
                    modal.find('.modal-body #unit').val(unit);
                    modal.find('.modal-body #date').val(date);
                    modal.find('.modal-body #employeeId').val(employeeId);
                    modal.find('.modal-body #employeeName').val(employeeName);
                })
            </script>

            <script>
                $('#employeeId').click(function() {
                    let employeeId = $('#employeeId').find(":selected").val();
                    console.log(employeeId)
                    $.ajax({
                        method: 'POST',
                        url: '{{ url('/GetUsers') }}',
                        data: {
                            '_token': '{{ csrf_token() }}',
                            employeeId: employeeId,
                        },
                        success: function(res) {
                            const list = JSON.parse(res);
                            $('#employeeName').empty();
                            for (let i = 0; i < list.length; i++) {
                                $('#employeeName').val(list[i].fullName)
                            }

                            $('#unit').empty();
                            for (let i = 0; i < list.length; i++) {
                                $('#unit').val(list[i].unit)
                            }
                        }
                    });
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
