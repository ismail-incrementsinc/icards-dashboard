@extends('layouts.master')
@section('common-title')
    Coupns
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
                    <div class="card-header">
                        <div class="custom-table-header">
                            <div class="coupon-category w-100 d-flex justify-content-between">
                                <div class="category">
                                    <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active" id="pills-all-tab" data-toggle="pill" href="#pills-all" role="tab" aria-controls="pills-all" aria-selected="true">All</a>
                                        </li>
                                        @foreach($categories as $category)
                                            <li class="nav-item">
                                                <a class="nav-link" id="pills-{{$category->name}}-tab" data-toggle="pill" href="#pills-{{$category->name}}" role="tab" aria-controls="pills-{{$category->name}}" aria-selected="false">{{$category->name}}</a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                                <div class="add-button">
                                    <span class="submit-btn">
                                        <button class="custom-btn" onClick="Show('Add coupon category','{{ route('category.create') }}')" style="background: #EFFFF5; color: #2E9A57"><i class="fa-solid fa-plus"></i> Add category</button>
                                        <button class="custom-btn" onClick="Show('Add New Coupon','{{ route('coupon.create') }}')"><i class="fa-solid fa-plus"></i> Add new coupon</button>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="coupon-section">
                            <div class="row">
                                <div class="tab-content" id="pills-tabContent">
                                    <div class="tab-pane fade show active" id="pills-all" role="tabpanel" aria-labelledby="pills-all-tab">
                                        <div class="row">
                                            @foreach($coupons as $coupon)
                                            <div class="col-md-4">
                                                <div class="card-item">
                                                    <div class="card-text">
                                                        <h5><img style="width: 50px; border-radius: 50%" src="{{$coupon->logo}}" alt="logo not found"> {{$coupon->org}}</h5>
                                                        <h2>{{$coupon->name}}</h2>
                                                        <p>{{$coupon->description}} </p>
                                                    </div>
                                                    <div class="card-qr-code">
                                                        <img style="width: 70px;"  src="{{$coupon->qr_code}}" alt=""qr code not found>
                                                    </div>
                                                </div>
                                            </div>
                                            @endforeach
                                        </div>
                                    </div>
                                    @foreach($categories as $category)
                                    <div class="tab-pane fade" id="pills-{{$category->name}}" role="tabpanel" aria-labelledby="pills-{{$category->name}}-tab">
                                        <div class="row">
                                            @foreach($coupons as $coupon)
                                                @if($category->name == $coupon->category)
                                                    <div class="col-md-4">
                                                        <div class="card-item">
                                                            <div class="card-text">
                                                                <h5><img style="width: 50px; border-radius: 50%" src="{{$coupon->logo}}" alt="logo not found"> {{$coupon->org}}</h5>
                                                                <h2>{{$coupon->name}}</h2>
                                                                <p>{{$coupon->description}} </p>
                                                            </div>
                                                            <div class="card-qr-code">
                                                                <img style="width: 70px;"  src="{{$coupon->qr_code}}" alt=""qr code not found>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif
                                            @endforeach
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="card-body">
                        <div class="coupon-section">
                            <div class="row">
                                <div class="col-md-4">
                                    <a href="{{route('coupon-assign.index')}}">
                                        <div class="card-item">
                                            <div class="card-text">
                                                <h5><img style="width: 50px; border-radius: 50%" src="{{asset('assets/dist/img/job-logo.svg')}}" alt="logo not found"> Daffodil international university</h5>
                                                <h2>Free</h2>
                                                <p>Drinks for every one who scans the M3 QR. </p>
                                            </div>
                                            <div class="card-qr-code">
                                                <img style="width: 70px;"  src="{{asset('assets/dist/img/qr-code.svg')}}" alt=""qr code not found>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
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
