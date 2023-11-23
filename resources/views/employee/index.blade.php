@extends('layouts.master')
@section('common-title')
    Employee
@endsection
@section('employee')
    active
@endsection
@section('content')
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="custom-table-header">
                            <div class="search-bar"></div>
                            <div class="add-button">
                                <button class="custom-icon-btn" onClick="Show('Upload excel file','{{ route('employee.upload.create') }}')"><i class="fa-solid fa-upload"></i></button>
                                <button class="custom-icon-btn"><i class="fa-solid fa-download"></i></button>
                                <span class="submit-btn">
                                    <button class="custom-btn" onClick="Show('Add Employee','{{ route('employee.create') }}')"><i class="fa-solid fa-plus"></i> Add new employee</button>
                                </span>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead style="background: #EFFFF5; color: #004C33">
                            <tr>
                                <th>Image</th>
                                <th>Name</th>
                                <th>Designation</th>
                                <th>Company</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Total Scanned</th>
                                <th>Date of birth</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($employees as $employee)
                                <tr>
                                    <td><img src="{{$employee->image != null ?  $employee->image : asset('assets/dist/img/avatar.png')}}" style="width: 80px; height: 80px; border-radius: 50%" alt="image not found"></td>
                                    <td>{{$employee->name !=null ? $employee->name : ''}}</td>
                                    <td>{{$employee->info->designation !=null ? $employee->info->designation : ''}}</td>
                                    <td>{{$employee->info->company !=null ? $employee->info->company : ''}}</td>
                                    <td>{{$employee->email !=null ? $employee->email : ''}}</td>
                                    <td>{{$employee->info->phone !=null ? $employee->info->phone : ''}}</td>
                                    <td>{{$employee->scan_count !=null ? $employee->scan_count : ''}}</td>
                                    <td>{{$employee->info->dob !=null ? $employee->info->dob : ''}}</td>
                                    <td>
                                        <a onclick="Show('Edit Employee','{{ route('employee.edit', $employee->id) }}')" style="color: #2E9A57; margin-right: 10px; cursor: pointer">
                                            <i class="fa-solid fa-file-pen"></i>
                                        </a>
                                        <button style="cursor: pointer; border: none" onclick="delete_function(this)" value="{{ route('employee.delete', $employee->id) }}">
                                            <i class="fa-regular fa-trash-can text-danger"></i>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                            <tfoot style="background: #EFFFF5; color: #004C33">
                            <tr>
                                <th>Image</th>
                                <th>Name</th>
                                <th>Designation</th>
                                <th>Department</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Total Scanned</th>
                                <th>Date of birth</th>
                                <th>Action</th>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </section>
    <!-- /.content -->
@endsection

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
                    }, 3000);
                },
                error: function (data) {
                    console.log(data);

                }
            })
    }
</script>
