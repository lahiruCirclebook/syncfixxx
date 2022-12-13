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
                @include('hrDepartment.hrSidebar')
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
                                        <h4 class="mb-sm-0 font-size-18">Employee Management</h4>

                                        <div class="page-title-right">
                                            <ol class="breadcrumb m-0">
                                                <li class="breadcrumb-item"><a href="javascript: void(0);">Hr
                                                        Department</a></li>
                                                <li class="breadcrumb-item active">Employee Management</li>
                                            </ol>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <!-- end page title -->

                            <div class="row">
                                <div class="col-md-3">
                                    <button class="btn btn-primary waves-effect waves-light" data-bs-toggle="modal"
                                        data-bs-target="#studentAddModal">Add New Student</button>
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
                                                            <td>Student Name</td>
                                                            <td>Student Dob</td>
                                                            <td>Address</td>
                                                            <td>Action</td>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @if (!empty($student))
                                                            @foreach ($student as $item)
                                                                <tr>
                                                                    <td>{{ $item->studentName }}</td>
                                                                    <td>{{ $item->dob }}</td>
                                                                    <td>{{ $item->address }}</td>
                                                                    <td>
                                                                        <button class="btn btn-primary btn-sm"
                                                                            data-bs-toggle="modal"
                                                                            data-bs-target="#studentViewModal"
                                                                            data-id="{{ $item->id }}"
                                                                            data-studentid="{{ $item->studentId }}"
                                                                            data-studentname="{{ $item->studentName }}"
                                                                            data-address="{{ $item->address }}"
                                                                            data-dob="{{ $item->dob }}">View</button>

                                                                        <button
                                                                            class="btn btn-outline-info  btn-sm waves-effect waves-light"
                                                                            data-bs-toggle="modal"
                                                                            data-bs-target="#studentEditModal"
                                                                            data-id="{{ $item->id }}"
                                                                            data-studentid="{{ $item->studentId }}"
                                                                            data-studentname="{{ $item->studentName }}"
                                                                            data-address="{{ $item->address }}"
                                                                            data-dob="{{ $item->dob }}">Edit</button>

                                                                        <a href="{{ url('deleteStudent') . $item->studentId }}"
                                                                            class="btn btn-outline-danger btn-sm waves-effect waves-light">Delete</a>

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
                    <div id="studentAddModal" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title mt-0" id="myModalLabel">Add New Student</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{ url('/newStudent') }}" method="post"
                                        enctype="multipart/form-data">
                                        {{ csrf_field() }}

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="" class="form-label">Student Name</label>
                                                    <input type="text" class="form-control" id="studentName"
                                                        name="studentName" required>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="" class="form-label">Dob</label>
                                                    <input type="date" class="form-control" id="dob"
                                                        name="dob" required>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="mb-3">
                                                    <label for="" class="form-label">Address</label>
                                                    <input type="text" class="form-control" id="address"
                                                        name="address">
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
                    <div id="studentEditModal" class="modal fade" tabindex="-1" role="dialog"
                        aria-labelledby="studentEditModal" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title mt-0" id="myModalLabel">Edit Student</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{ url('/editStudent') }}" method="post"
                                        enctype="multipart/form-data">
                                        {{ csrf_field() }}
                                        <input type="text" class="form-control" id="studentId" name="studentId"
                                            hidden>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="" class="form-label">Student Name</label>
                                                    <input type="text" class="form-control" id="studentName"
                                                        name="studentName" required>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="" class="form-label">Dob</label>
                                                    <input type="date" class="form-control" id="dob"
                                                        name="dob" required>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="mb-3">
                                                    <label for="" class="form-label">Address</label>
                                                    <input type="text" class="form-control" id="address"
                                                        name="address">
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
                    <div id="studentViewModal" class="modal fade" tabindex="-1" role="dialog"
                        aria-labelledby="employeeViewModal" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title mt-0" id="myModalLabel">View Student</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{ url('#') }}" method="post" enctype="multipart/form-data">
                                        {{ csrf_field() }}
                                        <input type="text" class="form-control" id="studentId" name="studentId"
                                            hidden>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="" class="form-label">Student Name</label>
                                                    <input type="text" class="form-control" id="studentName"
                                                        name="studentName" readonly>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="" class="form-label">Dob</label>
                                                    <input type="date" class="form-control" id="dob"
                                                        name="dob" readonly>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="mb-3">
                                                    <label for="" class="form-label">Address</label>
                                                    <input type="text" class="form-control" id="address"
                                                        name="address" readonly>
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
                $('#studentViewModal').on('show.bs.modal', function(event) {

                    let button = $(event.relatedTarget)
                    let id = button.data('id')
                    let studentId = button.data('studentid')
                    let studentName = button.data('studentname')
                    let address = button.data('address')
                    let dob = button.data('dob')


                    let modal = $(this)
                    modal.find('.modal-body #id').val(id);
                    modal.find('.modal-body #studentId').val(studentId);
                    modal.find('.modal-body #studentName').val(studentName);
                    modal.find('.modal-body #address').val(address);
                    modal.find('.modal-body #dob').val(dob);

                })
            </script>

            <script>
                $('#studentEditModal').on('show.bs.modal', function(event) {

                    let button = $(event.relatedTarget)
                    let id = button.data('id')
                    let studentId = button.data('studentid')
                    let studentName = button.data('studentname')
                    let address = button.data('address')
                    let dob = button.data('dob')


                    let modal = $(this)
                    modal.find('.modal-body #id').val(id);
                    modal.find('.modal-body #studentId').val(studentId);
                    modal.find('.modal-body #studentName').val(studentName);
                    modal.find('.modal-body #address').val(address);
                    modal.find('.modal-body #dob').val(dob);

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
