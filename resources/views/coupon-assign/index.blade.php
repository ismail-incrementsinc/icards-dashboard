@extends('layouts.master')
@section('common-title')
    Coupon assign
@endsection
@section('coupon')
    active
@endsection
@section('content')
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-3">
                                <div class="coupons-count w-100">
                                    <p>Total Coupons</p>
                                    <h3>{{$analytics_data->total_coupons}}</h3>
                                </div>
                                <div class="coupons-count w-100">
                                    <p>Total Scanned</p>
                                    <h3>{{$analytics_data->total_scanned}}</h3>
                                </div>
                            </div>
                            <div class="col-9">
                                <div id="chart"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="custom-tab-section d-flex justify-content-lg-between">
                    <ul class="nav nav-pills" id="pills-tab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">Participants</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="pills-manager-tab" data-toggle="pill" href="#pills-manager" role="tab" aria-controls="pills-manager" aria-selected="true">Coupon manager</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">Scanner</a>
                        </li>
                    </ul>
                    <div class="custom-table-header">
                        <div class="add-button">
                            <a href="{{route('export-excel-file')}}"><button  class="custom-icon-btn" title="Sample download"><i class="fa-solid fa-download"></i></button></a>
                            <button onClick="Show('Upload excel file','{{ route('participant.upload.create') }}')" class="custom-icon-btn" title="Upload excel file"><i class="fa-solid fa-upload"></i></button>
                        </div>
                    </div>

                </div>

                <div class="tab-content" id="pills-tabContent">
                    {{--  Participants section start--}}
                    <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                        <div class="card">
                            <div class="card-header">
                                <div class="custom-table-header">
                                    <div class="search-bar"></div>
                                    <div class="add-button">
                                        <button class="custom-icon-btn" id="deleteAllSelectRecords"> <i class="fa-solid fa-trash-can"></i></button>
                                        <span class="submit-btn">
                                    <button class="custom-btn" onClick="Show('Assign coupon','{{ route('coupon-assign.create') }}')"><i class="fa-solid fa-plus"></i> Assign</button>
                                </span>
                                        <div class="dropdown d-inline-block">
                                            <button class="custom-icon-btn dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="fa-solid fa-ellipsis-vertical"></i>
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-right btn-sm mt-2" aria-labelledby="dropdownMenu2">
                                                <button class="dropdown-item"><i class="fa-solid fa-arrows-rotate mr-2" ></i> Refresh</button>
                                                <button class="dropdown-item" id="exportParticipants"><i class="fa-solid fa-download mr-2"></i> Export</button>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead style="background: #EFFFF5; color: #004C33">
                                    <tr>
                                        <th><input type="checkbox" id="chkCheckAll"></th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Organization</th>
                                        <th>Collect By</th>
                                        <th>Assigned To</th>
                                        <th>Coupon Type</th>
                                        <th>Number Of Coupon</th>
                                        <th>Coupon Redeemed</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($assign_users as $assign_user)
                                        <tr id="sid{{$assign_user->id}}">
                                            <td><input type="checkbox" name="ids" class="checkBoxClass" value="{{$assign_user->id}}"></td>
                                            <td>{{$assign_user->name !=null ? $assign_user->name : ''}}</td>
                                            <td>{{$assign_user->email !=null ? $assign_user->email : ''}}</td>
                                            <td>{{$assign_user->organization !=null ? $assign_user->organization : ''}}</td>
                                            <td>{{$assign_user->collected_by !=null ? $assign_user->collected_by : ''}}</td>
                                            <td>{{optional($assign_user->assign_to)->email}}</td>
                                            <td>{{optional($assign_user->category)->name}}</td>
                                            <td>{{$assign_user->number_of_coupon !=null ? $assign_user->number_of_coupon : ''}}</td>
                                            <td>{{$assign_user->coupon_redeemed !=null ? $assign_user->coupon_redeemed : ''}}</td>
                                            <td>
                                                <a onclick="Show('Edit coupon assign','{{ route('coupon-assign.edit', $assign_user->id) }}')" style="color: #2E9A57; margin-right: 10px; cursor: pointer">
                                                    <i class="fa-solid fa-arrow-right"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                    <tfoot style="background: #EFFFF5; color: #004C33">
                                    <tr>
                                        <th></th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Organization</th>
                                        <th>Collect By</th>
                                        <th>Assigned To</th>
                                        <th>Coupon Type</th>
                                        <th>Number Of Coupon</th>
                                        <th>Coupon Redeemed</th>
                                        <th>Action</th>
                                    </tr>
                                    </tfoot>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>
                    </div>
                    {{--  Participants section end--}}

                    {{--  Coupon manager section start--}}
                    <div class="tab-pane fade" id="pills-manager" role="tabpanel" aria-labelledby="pills-manager-tab">
                        <div class="card">
                            <div class="card-header">
                                <div class="custom-table-header">
                                    <div class="search-bar"></div>
                                    <div class="add-button">
                                        <button class="custom-icon-btn" id="deleteAllSelectManagerRecords"> <i class="fa-solid fa-trash-can"></i></button>
                                        <span class="submit-btn">
                                    <button class="custom-btn" onClick="Show('Assign manager coupon','{{ route('coupon-assign.create') }}')"><i class="fa-solid fa-plus"></i> Assign</button>
                                </span>
                                        <div class="dropdown d-inline-block">
                                            <button class="custom-icon-btn dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="fa-solid fa-ellipsis-vertical"></i>
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-right btn-sm" aria-labelledby="dropdownMenu2">
                                                <button class="dropdown-item" type="button"><i class="fa-solid fa-arrows-rotate mr-2"></i> Refresh</button>
                                                <button class="dropdown-item" type="button"><i class="fa-solid fa-download mr-2"></i> Export</button>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body table-responsive">
                                <table id="example2" class="table table-bordered table-striped">
                                    <thead style="background: #EFFFF5; color: #004C33">
                                    <tr>
                                        <th><input type="checkbox" id="managerChkCheckAll"></th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Organization</th>
                                        <th>Collect By</th>
                                        <th>Assigned To</th>
                                        <th>Coupon Type</th>
                                        <th>Number Of Coupon</th>
                                        <th>Coupon Redeemed</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($assign_users as $assign_user)
                                        <tr id="msid{{$assign_user->id}}">
                                            <td><input type="checkbox" name="mids" class="managerCheckBoxClass" value="{{$assign_user->id}}"></td>
                                            <td>{{$assign_user->name !=null ? $assign_user->name : ''}}</td>
                                            <td>{{$assign_user->email !=null ? $assign_user->email : ''}}</td>
                                            <td>{{$assign_user->organization !=null ? $assign_user->organization : ''}}</td>
                                            <td>{{$assign_user->collected_by !=null ? $assign_user->collected_by : ''}}</td>
                                            <td>{{optional($assign_user->assign_to)->email}}</td>
                                            <td>{{optional($assign_user->category)->name}}</td>
                                            <td>{{$assign_user->number_of_coupon !=null ? $assign_user->number_of_coupon : ''}}</td>
                                            <td>{{$assign_user->coupon_redeemed !=null ? $assign_user->coupon_redeemed : ''}}</td>
                                            <td>
                                                <a onclick="Show('Edit manager coupon','{{ route('coupon-assign.edit', $assign_user->id) }}')" style="color: #2E9A57; margin-right: 10px; cursor: pointer">
                                                    <i class="fa-solid fa-arrow-right"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                    <tfoot style="background: #EFFFF5; color: #004C33">
                                    <tr>
                                        <th></th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Organization</th>
                                        <th>Collect By</th>
                                        <th>Assigned To</th>
                                        <th>Coupon Type</th>
                                        <th>Number Of Coupon</th>
                                        <th>Coupon Redeemed</th>
                                        <th>Action</th>
                                    </tr>
                                    </tfoot>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>
                    </div>
                    {{--  Coupon manager section end--}}

                    {{--  Scanner section start--}}
                    <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                        <div class="card">
                            <div class="card-header">
                                <div class="custom-table-header">
                                    <div class="search-bar"></div>
                                    <div class="add-button">
                                        <button class="custom-icon-btn" id="deleteAllSelectScannerRecords"> <i class="fa-solid fa-trash-can"></i></button>
                                        <span class="submit-btn">
                                    <button class="custom-btn" onClick="Show('Add Scanner','{{ route('scanner-create') }}')"><i class="fa-solid fa-plus"></i> Add Scanner</button>
                                </span>
                                        <div class="dropdown d-inline-block">
                                            <button class="custom-icon-btn dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="fa-solid fa-ellipsis-vertical"></i>
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenu2">
                                                <button class="dropdown-item" ><i class="fa-solid fa-arrows-rotate mr-2"></i> Refresh</button>
                                                <button class="dropdown-item" id="exportScanner"><i class="fa-solid fa-download mr-2"></i> Export</button>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body table-responsive">
                                <table id="example3" class="table table-bordered table-striped">
                                    <thead style="background: #EFFFF5; color: #004C33">
                                    <tr>
                                        <th><input type="checkbox" id="scannerChkCheckAll"></th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Organization</th>
                                        <th>Notes</th>
                                        <th>Total Scanned</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($scanner_decode_users as $scanner_decode_user)
                                        <tr id="ssid{{$assign_user->id}}">
                                            <td><input type="checkbox" name="sids" class="scannerCheckBoxClass" value="{{$scanner_decode_user->id}}"></td>
                                            <td>{{$scanner_decode_user->name !=null ? $scanner_decode_user->name : ''}}</td>
                                            <td>{{$scanner_decode_user->email !=null ? $scanner_decode_user->email : ''}}</td>
                                            <td>{{optional($scanner_decode_user->info)->company }}</td>
                                            <td>{{$scanner_decode_user->note !=null ? $scanner_decode_user->note : ''}}</td>
                                            <td>{{$scanner_decode_user->coupon_scan_count !=null ? $scanner_decode_user->coupon_scan_count : '0'}}</td>
                                            <td>
                                                <a onclick="Show('Edit Scanner','{{ route('scanner-edit', $scanner_decode_user->id) }}')" style="color: #2E9A57; margin-right: 10px; cursor: pointer">
                                                    <i class="fa-solid fa-arrow-right"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                    <tfoot style="background: #EFFFF5; color: #004C33">
                                    <tr>
                                        <th></th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Organization</th>
                                        <th>Notes</th>
                                        <th>Total Scanned</th>
                                        <th>Action</th>
                                    </tr>
                                    </tfoot>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>
                    </div>
                    {{--  Scanner section end--}}
                </div>


                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </section>
    <!-- /.content -->
    <form id="create-form"> @csrf </form>

@endsection

@push('script')
    <script>

        $(document).on('click','#exportParticipants',function (event) {
            event.preventDefault();

            // Set header if need any otherwise remove setup part
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="token"]').attr('value')
                }
            });
            $.ajax({
                url: "{{route('export-participants-download')}}",// your request url
                processData: false,
                contentType: false,
                type: 'GET',
                success: function (data) {
                    const link = document.createElement('a');
                    link.href = data;
                    link.setAttribute('download', 'participants_data.xlsx');
                    link.click();
                },
                error: function (err) {
                    console.log(err);
                }
            });

        });
        $(document).on('click','#exportScanner',function (event) {
            event.preventDefault();

            // Set header if need any otherwise remove setup part
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="token"]').attr('value')
                }
            });
            $.ajax({
                url: "{{route('export-scanner-download')}}",// your request url
                processData: false,
                contentType: false,
                type: 'GET',
                success: function (data) {
                    const link = document.createElement('a');
                    link.href = data;
                    link.setAttribute('download', 'scanner_data.xlsx');
                    link.click();
                },
                error: function (err) {
                    console.log(err);
                }
            });

        });



        $(function (e){

            $("#chkCheckAll").click(function(){
                $(".checkBoxClass").prop('checked',$(this).prop('checked'))
            });

            $("#deleteAllSelectRecords").click(function(e){
                e.preventDefault();
                let allIds = [];
                $("input:checkbox[name=ids]:checked").each(function (){
                    allIds.push($(this).val())
                });
                let form = $('#create-form')[0];
                let formData = new FormData(form);
                formData.append('ids',allIds);

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="token"]').attr('value'),
                    }
                });

                $.ajax({
                    url: "{{route('coupon-assign.destroy')}}",// your request url
                    dataType: "json",
                    data: formData,
                    processData: false,
                    contentType: false,
                    type: 'POST',
                    success: function (response) {
                        toastr.options ={ "closeButton" : true, "progressBar" : true }
                        toastr.success("Assign coupon deleted successfully");

                        setTimeout(function() {
                            location.reload();
                        }, 2000);
                    },
                    error: function (err) {
                        toastr.options ={ "closeButton" : true, "progressBar" : true }
                        toastr.success("Assign coupon deleted successfully");

                        setTimeout(function() {
                            location.reload();
                        }, 2000);

                    }
                });


            });
        })

        $(function (e){
            $("#managerChkCheckAll").click(function(){
                $(".managerCheckBoxClass").prop('checked',$(this).prop('checked'))
            });

            $("#deleteAllSelectManagerRecords").click(function(e){
                e.preventDefault();
                let allIds = [];
                $("input:checkbox[name=mids]:checked").each(function (){
                    allIds.push($(this).val())
                });
                let form = $('#create-form')[0];
                let formData = new FormData(form);
                formData.append('ids',allIds);

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="token"]').attr('value'),
                    }
                });

                $.ajax({
                    url: "{{route('coupon-assign.destroy')}}",// your request url
                    dataType: "json",
                    data: formData,
                    processData: false,
                    contentType: false,
                    type: 'POST',
                    success: function (response) {
                        toastr.options ={ "closeButton" : true, "progressBar" : true }
                        toastr.success("Coupon manager successfully");

                        setTimeout(function() {
                            location.reload();
                        }, 2000);
                    },
                    error: function (err) {
                        toastr.options ={ "closeButton" : true, "progressBar" : true }
                        toastr.success("Coupon manager successfully");

                        setTimeout(function() {
                            location.reload();
                        }, 2000);

                    }
                });


            });
        })

        $(function (e){
            $("#scannerChkCheckAll").click(function(){
                $(".scannerCheckBoxClass").prop('checked',$(this).prop('checked'))
            });

            $("#deleteAllSelectScannerRecords").click(function(e){
                e.preventDefault();
                let allIds = [];
                $("input:checkbox[name=sids]:checked").each(function (){
                    allIds.push($(this).val())
                });
                let form = $('#create-form')[0];
                let formData = new FormData(form);
                formData.append('ids',allIds);

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="token"]').attr('value'),

                    }
                });

                $.ajax({
                    url: "{{route('scanner.destroy')}}",// your request url
                    dataType: "json",
                    data: formData,
                    processData: false,
                    contentType: false,
                    type: 'POST',
                    success: function (response) {
                        toastr.options ={ "closeButton" : true, "progressBar" : true }
                        toastr.success("Coupon scanner deleted successfully");

                        setTimeout(function() {
                            location.reload();
                        }, 2000);
                    },
                    error: function (err) {
                        toastr.options ={ "closeButton" : true, "progressBar" : true }
                        toastr.success("Coupon scanner deleted successfully");

                        setTimeout(function() {
                            location.reload();
                        }, 2000);

                    }
                });


            });
        })


        var options = {
            series: [{
                name: 'series1',
                data: [5, 10, 15, 20, 25, 22, 30, 35, 40]
            }],
            chart: {
                height: 350,
                type: 'area'
            },
            dataLabels: {
                enabled: false
            },
            stroke: {
                curve: 'smooth'
            },
            xaxis: {
                type: 'datetime',
                categories: ["2018-09-19T00:00:00.000Z", "2018-09-19T01:30:00.000Z", "2018-09-19T02:30:00.000Z", "2018-09-19T03:30:00.000Z", "2018-09-19T04:30:00.000Z", "2018-09-19T05:30:00.000Z", "2018-09-19T06:30:00.000Z", "2018-09-19T06:30:00.000Z",  "2018-09-19T06:30:00.000Z"]
            },
            tooltip: {
                x: {
                    format: 'dd/MM/yy'
                },
            },
        };

        var chart = new ApexCharts(document.querySelector("#chart"), options);
        chart.render();
    </script>
@endpush
<script>

    function delete_function(objButton) {
        var url = objButton.value;
        $.ajax({
            method: 'DELETE',
            url: url,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (data) {
                toastr.options ={ "closeButton" : true, "progressBar" : true }
                toastr.success("Employee deleted successfully");

                setTimeout(function() {
                    location.reload();
                }, 2000);
            },
            error: function (data) {
                console.log(data);

            }
        })
    }

</script>

<script>



</script>
