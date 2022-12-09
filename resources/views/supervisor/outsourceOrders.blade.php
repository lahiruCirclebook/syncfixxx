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
                                        <h4 class="mb-sm-0 font-size-18">Outsource Orders</h4>

                                        <div class="page-title-right">
                                            <ol class="breadcrumb m-0">
                                                <li class="breadcrumb-item"><a href="javascript: void(0);"></a>Outsource
                                                    Orders</li>
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
                                        data-bs-target="#outsourceOrderAddModal">Add Outsource Order</button>
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
                                                            <th>Type</th>
                                                            <th>Worker Name</th>
                                                            <th>Worker Id</th>
                                                            <th>Date</th>
                                                            <th>Umbrella Code</th>
                                                            <th>Cover Amount</th>
                                                            <th>Frame Count</th>
                                                            <th>Thred Count</th>
                                                            <th>Expected Umbrella</th>
                                                            <th>Rejected Umbrella</th>
                                                            <th>Actions</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @if (!empty($data))
                                                            @foreach ($data as $item)
                                                                <tr>
                                                                    <td>{{ $item->type }}</td>
                                                                    <td>{{ $item->workerName }}</td>
                                                                    <td>{{ $item->workerId }}</td>
                                                                    <td>{{ $item->date }}</td>
                                                                    <td>{{ $item->umbrellaCode }}</td>
                                                                    <td>{{ $item->coverAmount }}</td>
                                                                    <td>{{ $item->frameAmount }}</td>

                                                                    <td>{{ $item->threadAmount }}</td>
                                                                    <td>{{ $item->expectedUmbrella }}</td>
                                                                    <td>{{ $item->rejectedUmbrella }}</td>

                                                                    <td>
                                                                        <button class="btn btn-primary btn-sm"
                                                                            data-bs-toggle="modal"
                                                                            data-bs-target="#outsourceViewModal"
                                                                            data-type="{{ $item->type }}"
                                                                            data-workername="{{ $item->workerName }}"
                                                                            data-workerid="{{ $item->workerId }}"
                                                                            data-date="{{ $item->date }}"
                                                                            data-umbrellacode="{{ $item->umbrellaCode }}"
                                                                            data-coveramount="{{ $item->coverAmount }}"
                                                                            data-frameamount="{{ $item->frameAmount }}"
                                                                            data-threadamount="{{ $item->threadAmount }}"
                                                                            data-expectedumbrella="{{ $item->expectedUmbrella }}"
                                                                            data-rejectedumbrella="{{ $item->rejectedUmbrella }}">View</button>
                                                                        @if ($role == 'Admin')
                                                                            <button
                                                                                class="btn btn-outline-info  btn-sm waves-effect waves-light"
                                                                                data-bs-toggle="modal"
                                                                                data-bs-target="#outsourceEditModal"
                                                                                data-type="{{ $item->type }}"
                                                                                data-workername="{{ $item->workerName }}"
                                                                                data-workerid="{{ $item->workerId }}"
                                                                                data-date="{{ $item->date }}"
                                                                                data-umbrellacode="{{ $item->umbrellaCode }}"
                                                                                data-coveramount="{{ $item->coverAmount }}"
                                                                                data-frameamount="{{ $item->frameAmount }}"
                                                                                data-threadamount="{{ $item->threadAmount }}"
                                                                                data-expectedumbrella="{{ $item->expectedUmbrella }}"
                                                                                data-rejectedumbrella="{{ $item->rejectedUmbrella }}">Edit</button>

                                                                            <a href="{{ url('deleteOutsource') . $item->id }}"
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
                    <div id="outsourceOrderAddModal" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title mt-0" id="myModalLabel">Add Outsource Orders</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{ url('addOutsource') }}" method="post"
                                        enctype="multipart/form-data">
                                        {{ csrf_field() }}

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="" class="form-label">Type</label>
                                                    <select name="type" id="type" class="form-select">
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
                                                    <label for="" class="form-label">Worker Name</label>
                                                    <input type="text" class="form-control" id="workerName"
                                                        name="workerName" required>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="" class="form-label">Worker Id</label>
                                                    <input type="text" class="form-control" id="workerId"
                                                        name="workerId">
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
                                                    <label for="" class="form-label">Umbrella Code</label>
                                                    <input type="text" class="form-control" id="umbrellaCode"
                                                        name="umbrellaCode">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="" class="form-label">Cover Amount</label>
                                                    <input type="number" class="form-control" id="coverAmount"
                                                        name="coverAmount" required>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="" class="form-label">Frame Amount</label>
                                                    <input type="number" class="form-control" id="frameAmount"
                                                        name="frameAmount">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="" class="form-label">Thread Amount</label>
                                                    <input type="number" class="form-control" id="threadAmount"
                                                        name="threadAmount" required>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="" class="form-label">Expected Umbrella</label>
                                                    <input type="number" class="form-control" id="expectedUmbrella"
                                                        name="expectedUmbrella">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="" class="form-label">Rejected Umbrella</label>
                                                    <input type="number" class="form-control" id="rejectedUmbrella"
                                                        name="rejectedUmbrella" required>
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
                    <div id="outsourceEditModal" class="modal fade" tabindex="-1" role="dialog"
                        aria-labelledby="outsourceEditModal" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title mt-0" id="myModalLabel">Edit Outsource</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{ url('editOutsource') }}" method="post"
                                        enctype="multipart/form-data">
                                        {{ csrf_field() }}

                                        <input type="number" class="form-control" id="workerId" name="workerId"
                                            hidden>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="" class="form-label">Type</label>
                                                    <select name="type" id="type" class="form-select">
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
                                                    <label for="" class="form-label">Worker Name</label>
                                                    <input type="text" class="form-control" id="workerName"
                                                        name="workerName" required>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="" class="form-label">Worker Id</label>
                                                    <input type="text" class="form-control" id="workerId"
                                                        name="workerId" required>
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
                                                    <label for="" class="form-label">Umbrella Code</label>
                                                    <input type="text" class="form-control" id="umbrellaCode"
                                                        name="umbrellaCode" required>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="" class="form-label">Cover Amount</label>
                                                    <input type="number" class="form-control" id="coverAmount"
                                                        name="coverAmount" required>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="" class="form-label">Frame Amount</label>
                                                    <input type="number" class="form-control" id="frameAmount"
                                                        name="frameAmount" required>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="" class="form-label">Thread Amount</label>
                                                    <input type="number" class="form-control" id="threadAmount"
                                                        name="threadAmount" required>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="" class="form-label">Expected Umbrella</label>
                                                    <input type="number" class="form-control" id="expectedUmbrella"
                                                        name="expectedUmbrella" required>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="" class="form-label">Rejected Umbrella</label>
                                                    <input type="number" class="form-control" id="rejectedUmbrella"
                                                        name="rejectedUmbrella" required>
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
                    <div id="outsourceViewModal" class="modal fade" tabindex="-1" role="dialog"
                        aria-labelledby="outsourceViewModal" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title mt-0" id="myModalLabel">View Outsource</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{ url('#') }}" method="post" enctype="multipart/form-data">
                                        {{ csrf_field() }}
                                        <input type="text" class="form-control" id="id" name="id"
                                            hidden>


                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="" class="form-label">Type</label>
                                                    <input type="text" class="form-control" id="type"
                                                        name="type" readonly>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="" class="form-label">Worker Name</label>
                                                    <input type="text" class="form-control" id="workerName"
                                                        name="workerName" readonly>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="" class="form-label">Worker Id</label>
                                                    <input type="text" class="form-control" id="workerId"
                                                        name="workerId" readonly>
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
                                                    <label for="" class="form-label">Umbrella Code</label>
                                                    <input type="text" class="form-control" id="umbrellaCode"
                                                        name="umbrellaCode" readonly>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="" class="form-label">Cover Amount</label>
                                                    <input type="number" class="form-control" id="coverAmount"
                                                        name="coverAmount" readonly>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="" class="form-label">Frame Amount</label>
                                                    <input type="number" class="form-control" id="frameAmount"
                                                        name="frameAmount" readonly>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="" class="form-label">Thread Amount</label>
                                                    <input type="number" class="form-control" id="threadAmount"
                                                        name="threadAmount" readonly>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="" class="form-label">Expected Umbrella</label>
                                                    <input type="number" class="form-control" id="expectedUmbrella"
                                                        name="expectedUmbrella" readonly>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="" class="form-label">Rejected Umbrella</label>
                                                    <input type="number" class="form-control" id="rejectedUmbrella"
                                                        name="rejectedUmbrella" readonly>
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
                $('#outsourceEditModal').on('show.bs.modal', function(event) {

                    let button = $(event.relatedTarget)
                    let type = button.data('type')
                    let workerName = button.data('workername')
                    let workerId = button.data('workerid')
                    let date = button.data('date')
                    let umbrellaCode = button.data('umbrellacode')
                    let coverAmount = button.data('coveramount')
                    let frameAmount = button.data('frameamount')
                    let threadAmount = button.data('threadamount')

                    let expectedUmbrella = button.data('expectedumbrella')
                    let rejectedUmbrella = button.data('rejectedumbrella')


                    let modal = $(this)
                    modal.find('.modal-body #type').val(type);
                    modal.find('.modal-body #workerName').val(workerName);
                    modal.find('.modal-body #workerId').val(workerId);
                    modal.find('.modal-body #date').val(date);
                    modal.find('.modal-body #umbrellaCode').val(umbrellaCode);
                    modal.find('.modal-body #coverAmount').val(coverAmount);
                    modal.find('.modal-body #frameAmount').val(frameAmount);
                    modal.find('.modal-body #threadAmount').val(threadAmount);

                    modal.find('.modal-body #expectedUmbrella').val(expectedUmbrella);
                    modal.find('.modal-body #rejectedUmbrella').val(rejectedUmbrella);
                })
            </script>

            <script>
                $('#outsourceViewModal').on('show.bs.modal', function(event) {

                    let button = $(event.relatedTarget)
                    let type = button.data('type')
                    let workerName = button.data('workername')
                    let workerId = button.data('workerid')
                    let date = button.data('date')
                    let umbrellaCode = button.data('umbrellacode')
                    let coverAmount = button.data('coveramount')
                    let frameAmount = button.data('frameamount')
                    let threadAmount = button.data('threadamount')

                    let expectedUmbrella = button.data('expectedumbrella')
                    let rejectedUmbrella = button.data('rejectedumbrella')


                    let modal = $(this)
                    modal.find('.modal-body #type').val(type);
                    modal.find('.modal-body #workerName').val(workerName);
                    modal.find('.modal-body #workerId').val(workerId);
                    modal.find('.modal-body #date').val(date);
                    modal.find('.modal-body #umbrellaCode').val(umbrellaCode);
                    modal.find('.modal-body #coverAmount').val(coverAmount);
                    modal.find('.modal-body #frameAmount').val(frameAmount);
                    modal.find('.modal-body #threadAmount').val(threadAmount);

                    modal.find('.modal-body #expectedUmbrella').val(expectedUmbrella);
                    modal.find('.modal-body #rejectedUmbrella').val(rejectedUmbrella);
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
