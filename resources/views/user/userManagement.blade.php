@php
    $id = session('id');
    $role = session('role');
@endphp

@if (!empty($id))

    @if (\Illuminate\Support\Facades\Auth::id() == $id && $role == 'Admin')

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
                @include('user.userSidebar')
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
                                        <h4 class="mb-sm-0 font-size-18">Users</h4>

                                        <div class="page-title-right">
                                            <ol class="breadcrumb m-0">

                                                <li class="breadcrumb-item active">User Management</li>
                                            </ol>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <!-- end page title -->
                            <div class="row">
                                <div class="col-md-3">
                                    <button class="btn btn-secondary waves-effect waves-light" data-bs-toggle="modal"
                                        data-bs-target="#userAddModal">Add User</button>
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
                                                            <th>User Id</th>
                                                            <th>Name</th>
                                                            <th>SyncFix Role</th>
                                                            <th>Email</th>
                                                            <th>Contact Number</th>
                                                            <th></th>
                                                            <th></th>

                                                        </tr>
                                                    </thead>


                                                    <tbody>
                                                        @if (!empty($data))
                                                            @foreach ($data as $item)
                                                                @if ($item->id != $id)
                                                                    @if ($item->isActive == 1)
                                                                        <tr>
                                                                            <td>{{ $item->empId }}</td>
                                                                            <td>{{ $item->name }}</td>
                                                                            <td>{{ $item->role }}</td>
                                                                            <td>{{ $item->email }}</td>
                                                                            <td>{{ $item->contact }}</td>
                                                                            <td><a href="{{ url('disableUser') . $item->userId }}"
                                                                                    class="btn btn-outline-warning btn-sm waves-effect waves-light">Disable
                                                                                    User</a> </td>
                                                                            <td><button data-bs-toggle="modal"
                                                                                    data-bs-target="#resetPassword"
                                                                                    data-id="{{ $item->userId }}"
                                                                                    class="btn btn-outline-danger btn-sm waves-effect waves-light">Reset
                                                                                    Password</button> </td>
                                                                        </tr>
                                                                    @else
                                                                        <tr style="color: red">
                                                                            <td>{{ $item->name }}</td>
                                                                            <td>{{ $item->email }}</td>
                                                                            <td>{{ $item->contact }}</td>
                                                                            <td>{{ $item->role }}</td>
                                                                            <td class="text-danger">Disabled</td>
                                                                            <td></td>
                                                                        </tr>
                                                                    @endif
                                                                @endif
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


                    {{--        Modals --}}

                    {{--        Add User modal --}}

                    <div id="userAddModal" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog" style="max-width: 42%;">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title mt-0" id="myModalLabel">Add User</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{ url('addUser') }}" method="post" enctype="multipart/form-data"
                                        id="demo">
                                        {{ csrf_field() }}
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="mb-3">

                                                    <label for="" class="form-label">Employee Id</label>
                                                    <input type="text" class="form-control" id="empId"
                                                        name="empId" required>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="" class="form-label">Name</label>
                                                    <input type="text" class="form-control" id="name"
                                                        name="name" required>

                                                </div>
                                            </div>
                                        </div>

                                        <br>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="" class="form-label">SyncFix Role</label>
                                                    <select name="role" id="role" class="form-select">
                                                        <option value="Admin">Admin</option>
                                                        <option value="Supervisor">Supervisor</option>
                                                        <option value="Hr Manager">Hr Manager</option>
                                                        <option value="Product Manager">Product Manager</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="" class="form-label">Email</label>
                                                    <input type="email" class="form-control" id="email"
                                                        name="email" required>


                                                </div>
                                            </div>
                                        </div>
                                        <br>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="" class="form-label">Contact Number</label>
                                                    <input type="number" class="form-control"
                                                        oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
                                                        maxlength="10" id="contact" name="contact" required>

                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="" class="form-label">Password</label>
                                                    <input type="password" class="form-control" id="password"
                                                        name="password" required>

                                                </div>
                                            </div>
                                        </div>

                                        <br>
                                        <label for="" class="form-label">Permissions</label><br>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="mb-3">
                                                    <input type="checkbox" id="selectAll" name="selectAll"
                                                        value="1" style="margin-left: 20px;">
                                                    <label for="" class="form-label">Select All
                                                        Privileges</label><br>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="mb-3">
                                                    <div class="card">
                                                        <div class="card-body"
                                                            style="border-style: solid; border-width: 0.1px; border-radius: 8px;">
                                                            <label for=""
                                                                class="form-label">Privileges</label><br>
                                                            <input type="checkbox" id="hr" name="hr"
                                                                value="1">
                                                            <label for="hr">Hr Department</label><br>
                                                            <input type="checkbox" id="supervisor" name="supervisor"
                                                                value="1">
                                                            <label for="supervisor">Supervisor</label><br>
                                                            <input type="checkbox" id="pm" name="pm"
                                                                value="1">
                                                            <label for="pm">Product Manager</label><br>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-info waves-effect waves-light">Save
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

                    {{--        password reset modal --}}
                    <div id="resetPassword" class="modal fade" tabindex="-1" aria-labelledby="resetPassword"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title mt-0" id="myModalLabel">Reset Password</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{ url('resetPassword') }}" method="post"
                                        enctype="multipart/form-data">
                                        {{ csrf_field() }}
                                        <input type="text" class="form-control" id="id" name="userId"
                                            hidden required>

                                        <div class="mb-3">
                                            <label for="" class="form-label">Enter Password</label>
                                            <input type="password" class="form-control" id="pwd"
                                                name="pwd" required>
                                        </div>
                                        <div class="mb-3">
                                            <button type="submit"
                                                class="btn btn-primary waves-effect waves-light">Save
                                            </button>
                                        </div>
                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <button type="button"class="btn btn-outline-danger waves-effect waves-light"
                                        data-bs-dismiss="modal">Close</button>

                                </div>

                            </div>
                        </div>
                    </div>
                    {{--        End password reset modal --}}

                    {{--        End add user modal --}}


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
                $('#resetPassword').on('show.bs.modal', function(event) {
                    let button = $(event.relatedTarget)
                    let id = button.data('id')

                    let modal = $(this)
                    modal.find('.modal-body #id').val(id);
                });
            </script>

            <script>
                $(document).ready(function() {
                    $("#demo #selectAll").click(function() {
                        $("#demo input[type='checkbox']").prop('checked', this.checked);
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
