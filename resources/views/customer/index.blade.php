@extends('layouts.master')
@section('common-title')
    Users
@endsection
@section('customer')
    active
@endsection
@section('content')
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead style="background: #EFFFF5; color: #004C33">
                            <tr>
                                <th>Image</th>
                                <th>Name</th>
                                <th>Designation</th>
                                <th>Department</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Date of birth</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($users as $user)
                                <tr>
                                    <td><img src="{{$user->profile_pic}}" style="width: 80px; height: 80px;" alt="image not found"></td>
                                    <td>{{$user->name !=null ? $user->name : ''}}</td>
                                    <td>{{$user->info->designation !=null ? $user->info->designation : ''}}</td>
                                    <td>Department</td>
                                    <td>{{$user->email !=null ? $user->email : ''}}</td>
                                    <td>{{$user->info->phone !=null ? $user->info->phone : ''}}</td>
                                    <td>{{$user->info->dob !=null ? $user->info->dob : ''}}</td>
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
                                <th>Date of birth</th>
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

