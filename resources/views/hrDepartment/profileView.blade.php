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

            <style>
                .box {
                    border-radius: 30px;
                    height: 40px;
                    display: flex;
                    align-items: center;
                    padding: 20px;
                    border: none;
                }

                .box>i {
                    font-size: 20px;
                }

                .box>input {
                    flex: 1;
                    height: 40px;
                    border: none;
                    outline: none;
                    padding-left: 10px;
                }

                .dropdown {
                    position: relative;


                }

                .dropdown-content {

                    position: absolute;

                    min-width: 100%;
                    box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
                    padding: 12px 16px;
                    z-index: 1;
                    text-align: left;
                    font-weight: bold;
                    overflow-y: scroll;
                    overflow-y: auto;
                    max-height: 360px;
                }
            </style>

        </head>

        <body data-sidebar="dark">

            <!-- <body data-layout="horizontal" data-topbar="dark"> -->

            <!-- Begin page -->
            <div id="layout-wrapper">


                {{--    Header --}}
                @include('Layouts.header')
                <!-- ========== Left Sidebar Start ========== -->
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
                                        <h4 class="mb-sm-0 font-size-18">Search Employee</h4>

                                        <div class="page-title-right">
                                            <ol class="breadcrumb m-0">
                                                <li class="breadcrumb-item"><a href="javascript: void(0);">Search
                                                        Employee
                                                    </a></li>
                                                <li class="breadcrumb-item active">Hr Management</li>
                                            </ol>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-8">

                                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                        <div class="box form-control">
                                            <i class='bx bx-search-alt bx-tada bx-rotate-90'></i>
                                            <input type="text" id="search" class="form-control search"
                                                autocomplete="off" placeholder="Search" autofocus>
                                        </div>
                                    </div>
                                    <div class="dropdown">

                                        <div class="dropdown-content  form-control " id="browsers"
                                            style="cursor: pointer">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- end page title -->

                            @if (!empty($message))
                                <div class="col-md-4">
                                    <div class="alert alert-dismissible alert-success">
                                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                                            aria-label="Close">&times;</button>
                                        <p class="mr-auto"> {{ $message }} </p>
                                    </div>
                                </div>
                            @endif

                            @if (!empty($error))
                                <div class="col-md-4">
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        {{ $error }}
                                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                                            aria-label="Close"></button>
                                    </div>
                                </div>
                            @endif
                            <!-- container-fluid -->
                            <br>
                            <hr>
                            <div class="row">
                                <div class="col xxl-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <img src="{{ URL::asset('/assets/images/round.gif') }}" alt=""
                                                style="height: 60%; width: 60%; margin-left: 150px">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End Page-content -->
                        {{-- start example model --}}
                        {{-- start example model --}}
                        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">

                                        <h4>View Profile</h4>
                                    </div>
                                    <div class="modal-body">

                                        <form action="" method="post" enctype="multipart/form-data">
                                            {{ csrf_field() }}




                                            <div class="form-group">
                                                <input type="text" id="randomempid" name="randomempid" hidden>
                                            </div>

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
                                                        <label for="" class="form-label">Employee Id</label>
                                                        <input type="text" class="form-control" id="employeeid"
                                                            name="employeeid" readonly>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label for="" class="form-label">Full Name</label>
                                                        <input type="text" class="form-control" id="fullname"
                                                            name="fullname" readonly>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label for="" class="form-label">Date of Birth</label>
                                                        <input type="date" class="form-control" id="dateofbirth"
                                                            name="dateofbirth" readonly>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label for="" class="form-label">Living Status</label>
                                                        <input type="text" class="form-control" id="livingstatus"
                                                            name="livingstatus" readonly>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label for="" class="form-label">NIC No</label>
                                                        <input type="text" class="form-control" id="nicno"
                                                            name="nicno" readonly>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label for="" class="form-label">EPF No</label>
                                                        <input type="text" class="form-control" id="epfno"
                                                            name="epfno" readonly>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label for="" class="form-label">Department</label>
                                                        <input type="text" class="form-control" id="department"
                                                            name="department" readonly>

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
                                                        <label for="" class="form-label">Designation</label>
                                                        <input type="text" class="form-control" id="designation"
                                                            name="designation" readonly>
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
                        {{-- end example model --}}
                        {{-- end example model --}}


                        @include('Layouts.footer')
                    </div>
                    <!-- end main content-->

                </div>
                <!-- END layout-wrapper -->

                <!-- Right Sidebar -->
                @include('Layouts.rightSideBar')

                <!-- /Right-bar -->

                <!-- Right bar overlay-->
                <div class="rightbar-overlay"></div>

                <!-- JAVASCRIPT -->
                @include('Layouts.appJs')

                <script type="text/javascript">
                    $('#browsers').hide();

                    $('body').on('keyup', '#search', function() {


                        let searchText = $(this).val();

                        if (searchText.length == 0 || searchText == null) {
                            $('#browsers').empty();
                            $('#browsers').hide();
                        } else {
                            $('#browsers').show();
                            $.ajax({
                                method: 'POST',
                                url: '{{ url('/searchEmployee') }}',
                                data: {
                                    '_token': '{{ csrf_token() }}',
                                    searchText: searchText,
                                },
                                success: function(res) {
                                    console.log(res)
                                    const list = JSON.parse(res);
                                    $('#browsers').empty();

                                    for (let i = 0; i < list.length; i++) {


                                        $('#browsers').append(
                                            '<a class="exampleModal" data-bs-toggle="modal" style="color:black" data-randomempid="' +
                                            list[i].randomEmpId + '" data-date="' + list[i].date +
                                            '" data-fullname="' + list[i].fullName + '" data-dateofbirth="' +
                                            list[i].dateOfBirth + '" data-livingstatus="' + list[i]
                                            .livingStatus + '" data-nicno="' + list[i].nicNo +
                                            '" data-epfno="' + list[i].epfNo + '" data-department="' + list[i]
                                            .department + '" data-unit="' + list[i]
                                            .unit + '" data-designation="' + list[i]
                                            .designation + '" data-employeeid="' + list[i]
                                            .employeeId +
                                            '" data-bs-target="#exampleModal"><p>' + list[i].employeeId +
                                            '</p></a><hr>');


                                    }

                                    $('.exampleModal').on("click", function() {
                                        let randomempid = $(this).data('randomempid');
                                        let date = $(this).data('date')
                                        let fullname = $(this).data('fullname')
                                        let dateofbirth = $(this).data('dateofbirth')
                                        let livingstatus = $(this).data('livingstatus')


                                        let nicno = $(this).data('nicno');
                                        let epfno = $(this).data('epfno')
                                        let department = $(this).data('department')
                                        let unit = $(this).data('unit')
                                        let designation = $(this).data('designation')
                                        let employeeid = $(this).data('employeeid')





                                        $(".modal-body #randomempid").val(randomempid);
                                        $('.modal-body #nicno').val(nicno);
                                        $('.modal-body #date').val(date);
                                        $('.modal-body #fullname').val(fullname);
                                        $('.modal-body #dateofbirth').val(dateofbirth);
                                        $('.modal-body #livingstatus').val(livingstatus);

                                        $('.modal-body #epfno').val(epfno);
                                        $('.modal-body #department').val(department);
                                        $('.modal-body #unit').val(unit);
                                        $('.modal-body #designation').val(designation);
                                        $('.modal-body #employeeid').val(employeeid);


                                    });


                                }

                            });
                        }


                    });


                    $('#btnAQtyEdit').on('click', function() {


                        $('#aQtyText').hide()
                        $('#aQtyInput').show()
                    })

                    $('#btnNQtyEdit').on('click', function() {


                        $('#nQtyText').hide()
                        $('#nQtyInput').show()
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
