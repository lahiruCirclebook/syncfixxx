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
                                        <h4 class="mb-sm-0 font-size-18">Inactive Profile</h4>

                                        <div class="page-title-right">
                                            <ol class="breadcrumb m-0">
                                                <li class="breadcrumb-item"><a href="javascript: void(0);">Hr
                                                        Department</a></li>
                                                <li class="breadcrumb-item active">Inactive Profile</li>
                                            </ol>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <!-- end page title -->


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
                                                            <th>Employee Id</th>
                                                            <th>First Name</th>
                                                            <th>Sure Name</th>
                                                            <th>Full Name</th>
                                                            <th>Middle Name</th>
                                                            <th>Gender</th>
                                                            <th>Title</th>
                                                            <th>Marital Status</th>
                                                            <th>Blood Group</th>
                                                            <th>Date Of Birth</th>
                                                            <th>Nationality</th>
                                                            <th>No of Children</th>
                                                            <th>Living Status</th>

                                                            <th>NIC No</th>
                                                            <th>EPF No</th>
                                                            <th>Department</th>
                                                            <th>Unit</th>
                                                            <th>Designation</th>
                                                            <th>Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @if (!empty($data))
                                                            @foreach ($data as $item)
                                                                <tr>
                                                                    <td>{{ $item->date }}</td>
                                                                    <td>{{ $item->employeeId }}</td>
                                                                    <td>{{ $item->firstName }}</td>
                                                                    <td>{{ $item->surname }}</td>
                                                                    <td>{{ $item->fullName }}</td>
                                                                    <td>{{ $item->middleName }}</td>
                                                                    <td>{{ $item->gender }}</td>
                                                                    <td>{{ $item->title }}</td>
                                                                    <td>{{ $item->maritalStatus }}</td>

                                                                    <td>{{ $item->bloodGroup }}</td>
                                                                    <td>{{ $item->dateOfBirth }}</td>
                                                                    <td>{{ $item->nationality }}</td>
                                                                    <td>{{ $item->noOfChildren }}</td>
                                                                    <td>{{ $item->livingStatus }}</td>

                                                                    <td>{{ $item->nicNo }}</td>
                                                                    <td>{{ $item->epfNo }}</td>

                                                                    <td>{{ $item->department }}</td>
                                                                    <td>{{ $item->unit }}</td>
                                                                    <td>{{ $item->designation }}</td>

                                                                    <td>
                                                                        <button class="btn btn-primary btn-sm"
                                                                            data-bs-toggle="modal"
                                                                            data-bs-target="#employeeViewModal"
                                                                            data-randomempid="{{ $item->randomEmpId }}"
                                                                            data-date="{{ $item->date }}"
                                                                            data-firstname="{{ $item->firstName }}"
                                                                            data-surname="{{ $item->surname }}"
                                                                            data-fullname="{{ $item->fullName }}"
                                                                            data-middlename="{{ $item->middleName }}"
                                                                            data-gender="{{ $item->gender }}"
                                                                            data-title="{{ $item->title }}"
                                                                            data-maritalstatus="{{ $item->maritalStatus }}"
                                                                            data-bloodgroup="{{ $item->bloodGroup }}"
                                                                            data-dateofbirth="{{ $item->dateOfBirth }}"
                                                                            data-nationality="{{ $item->nationality }}"
                                                                            data-noofchildren="{{ $item->noOfChildren }}"
                                                                            data-livingstatus="{{ $item->livingStatus }}"
                                                                            data-employeeid="{{ $item->employeeId }}"
                                                                            data-nicno="{{ $item->nicNo }}"
                                                                            data-epfno="{{ $item->epfNo }}"
                                                                            data-department="{{ $item->department }}"
                                                                            data-unit="{{ $item->unit }}"
                                                                            data-designation="{{ $item->designation }}">View</button>
                                                                        @if ($role == 'Admin')
                                                                            <a href="{{ url('deleteInactiveProfile') . $item->id }}"
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

                    <!-- End Customer Add Model -->

                    <!-- Start Customer Edit Model -->

                    <!-- End Customer Edit Model -->

                    <!-- Start Customer View Model -->
                    <div id="employeeViewModal" class="modal fade" tabindex="-1" role="dialog"
                        aria-labelledby="employeeViewModal" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title mt-0" id="myModalLabel">View Employee</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{ url('#') }}" method="post" enctype="multipart/form-data">
                                        {{ csrf_field() }}
                                        <input type="text" class="form-control" id="randomEmpId" name="randomEmpId"
                                            hidden>


                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="" class="form-label">Date</label>
                                                    <input type="date" class="form-control" id="date"
                                                        name="date"readonly>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="" class="form-label">First Name</label>
                                                    <input type="text" class="form-control" id="firstName"
                                                        name="firstName" readonly>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="" class="form-label">Sure Name</label>
                                                    <input type="text" class="form-control" id="surname"
                                                        name="surname" readonly>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="" class="form-label">Full Name</label>
                                                    <input type="text" class="form-control" id="fullName"
                                                        name="fullName" readonly>
                                                </div>
                                            </div>
                                        </div>



                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="" class="form-label">Middle Name</label>
                                                    <input type="text" class="form-control" id="middleName"
                                                        name="middleName" readonly>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="" class="form-label">Gender</label>
                                                    <input type="text" class="form-control" id="gender"
                                                        name="gender" readonly>

                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="" class="form-label">Title</label>
                                                    <input type="text" class="form-control" id="title"
                                                        name="title" readonly>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="" class="form-label">Marital Status</label>
                                                    <input type="text" class="form-control" id="maritalStatus"
                                                        name="maritalStatus" readonly>

                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="" class="form-label">Date of Birth</label>
                                                    <input type="date" class="form-control" id="dateOfBirth"
                                                        name="dateOfBirth" readonly>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="" class="form-label">Blood Group</label>
                                                    <input type="date" class="form-control" id="bloodGroup"
                                                        name="bloodGroup" readonly>

                                                </div>
                                            </div>
                                        </div>


                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="" class="form-label">Nationality</label>
                                                    <input type="text" class="form-control" id="nationality"
                                                        name="nationality" readonly>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="" class="form-label">No of children</label>
                                                    <input type="number" class="form-control" id="noOfChildren"
                                                        name="noOfChildren" readonly>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="" class="form-label">Living Status</label>
                                                    <input type="text" class="form-control" id="livingStatus"
                                                        name="livingStatus" readonly>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="" class="form-label">Employee Id</label>
                                                    <input type="text" class="form-control" id="employeeId"
                                                        name="employeeId" readonly>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="" class="form-label">NIC No</label>
                                                    <input type="text" class="form-control" id="nicNo"
                                                        name="nicNo" readonly>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="" class="form-label">EPF No</label>
                                                    <input type="text" class="form-control" id="epfNo"
                                                        name="epfNo" readonly>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="" class="form-label">Department</label>
                                                    <input type="text" class="form-control" id="department"
                                                        name="department" readonly>

                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="" class="form-label">Unit</label>
                                                    <input type="text" class="form-control" id="unit"
                                                        name="unit" readonly>


                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label for="" class="form-label">Designation</label>
                                                <input type="text" class="form-control" id="designation"
                                                    name="designation" readonly>
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
                $('#employeeViewModal').on('show.bs.modal', function(event) {

                    let button = $(event.relatedTarget)
                    let randomEmpId = button.data('randomempid')
                    let date = button.data('date')
                    let firstName = button.data('firstname')
                    let surname = button.data('surname')
                    let fullName = button.data('fullname')
                    let middleName = button.data('middlename')
                    let gender = button.data('gender')
                    let title = button.data('title')
                    let maritalStatus = button.data('maritalstatus')

                    let bloodGroup = button.data('bloodgroup')
                    let dateOfBirth = button.data('dateofirth')
                    let nationality = button.data('nationality')
                    let noOfChildren = button.data('noofchildren')
                    let livingStatus = button.data('livingstatus')
                    let employeeId = button.data('employeeid')

                    let nicNo = button.data('nicno')
                    let epfNo = button.data('epfno')
                    let department = button.data('department')
                    let unit = button.data('unit')
                    let designation = button.data('designation')


                    let modal = $(this)
                    modal.find('.modal-body #randomEmpId').val(randomEmpId);
                    modal.find('.modal-body #date').val(date);
                    modal.find('.modal-body #firstName').val(firstName);
                    modal.find('.modal-body #surname').val(surname);
                    modal.find('.modal-body #fullName').val(fullName);
                    modal.find('.modal-body #middleName').val(middleName);
                    modal.find('.modal-body #gender').val(gender);
                    modal.find('.modal-body #title').val(title);
                    modal.find('.modal-body #maritalStatus').val(maritalStatus);

                    modal.find('.modal-body #bloodGroup').val(bloodGroup);
                    modal.find('.modal-body #dateOfBirth').val(dateOfBirth);
                    modal.find('.modal-body #nationality').val(nationality);
                    modal.find('.modal-body #noOfChildren').val(noOfChildren);
                    modal.find('.modal-body #livingStatus').val(livingStatus);
                    modal.find('.modal-body #employeeId').val(employeeId);

                    modal.find('.modal-body #nicNo').val(nicNo);
                    modal.find('.modal-body #epfNo').val(epfNo);
                    modal.find('.modal-body #department').val(department);
                    modal.find('.modal-body #unit').val(unit);
                    modal.find('.modal-body #designation').val(designation);
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
