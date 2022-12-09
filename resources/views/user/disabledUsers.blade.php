@php
 $id = session('id');
 $role = session('role');
@endphp

@if(!empty($id))

@if(\Illuminate\Support\Facades\Auth::id()==$id && $role=='Admin')

<!doctype html>
<html lang="en">

<head>

    @include('Layouts.appStyles')

</head>

<body data-sidebar="dark">

<!-- Begin page -->
<div id="layout-wrapper">


{{--    Header--}}
@include('Layouts.header')

{{--    End Header--}}

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
                            <h4 class="mb-sm-0 font-size-18">disabled Users</h4>

                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">

                                    <li class="breadcrumb-item active">disabled Users</li>
                                </ol>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- end page title -->

                <br>
                @if(session()->has('message'))
                        <div class="col-md-4">
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session()->get('message') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        </div>
                        @endif
                        @foreach ($errors->all() as $error)
                        <div class="col-md-4">
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                {{ $error }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        </div>



                    @endforeach

                <br>

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">

                                <div class="scrollme">
                                    <table id="datatable-buttons" class="table table-responsive nowrap w-100">
                                    <thead>
                                    <tr>
                                        <th>Employee Id</th>
                                        <th>Name</th>
                                        <th>SyncFix Role</th>
                                        <th>Department</th>
                                        <th>Reporting Manager</th>
                                        <th>Email</th>
                                        <th>Contact Number</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if(!empty($data))
                                        @foreach($data as $item)
                                                <tr>
                                                    <td>{{$item->empId}}</td>
                                                    <td>{{$item->name}}</td>
                                                    <td>{{$item->role}}</td>
                                                    <td>{{$item->department}}</td>
                                                    <td>{{$item->reportingManager}}</td>
                                                    <td>{{$item->email}}</td>
                                                    <td>{{$item->contact}}</td>
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

        {{--        Footer--}}
        @include('Layouts.footer')
        {{--        End Footer--}}
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
    $('#resetPassword').on('show.bs.modal', function (event) {
        let button = $(event.relatedTarget)
        let id = button.data('id')

        let modal = $(this)
        modal.find('.modal-body #id').val(id);
    });

</script>

<script>
    $(document).ready(function(){
        $("#demo #selectAll").click(function(){
            $("#demo input[type='checkbox']").prop('checked',this.checked);
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
