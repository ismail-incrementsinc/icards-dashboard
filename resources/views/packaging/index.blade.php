@extends('layouts.master')
@section('common-title')
    Plans
@endsection
@section('plan')
    active
@endsection
@section('content')
    <!-- Main content -->
    <section class="content">
        <div class="row">
            @foreach($plans as $plan)
            <div class="col-4">
                <div class="card">
                    <div class="card-body">
                        <div class="package-item">
                            <div class="package-heading">
                                <div class="title">
                                    <h4>{{ $plan->name}} {!! $plan->tag == 'popular' ? '<span>Popular</span>' :'' !!}</h4>
                                </div>
                                <div class="price">
                                    <h3>${{$plan->price}} <sub>per month</sub></h3>
                                </div>
                            </div>
                            <div class="package-body">
                                <h2>{{$plan->title}}</h2>
                                <p>{{$plan->sub_title}}</p>
                                <ul>
                                    @foreach($plan->items as $item)
                                    <li><i class="fa-solid fa-check"></i> {{$item->title}}</li>
                                    @endforeach
                                </ul>
                            </div>
                            <div class="package-footer {{$plan->active ? 'active' : ''}}">
                                <button>Activate</button>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
            @endforeach
        </div>
        <!-- /.row -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="billing-title">
                            <h3 class="card-title">Billing history</h3>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="billing-history">
                            @foreach($billing_history as $bill)
                            <div class="billing-item">
                                <div class="billing-amount">
                                    <h3>{{$bill->package_name}} - {{$bill->currency}}  ${{$bill->amount}}</h3>
                                    <span>
                                        @php
                                            $dateTime = \Illuminate\Support\Carbon::parse($bill->created_at);
                                            echo $dateTime->format('M d, Y');
                                        @endphp
                                    </span>
                                </div>
                                <div class="billing-method">
                                    <h2><span>{{$bill->payment_method}} </span> <span>{{$bill->card_number}} </span>
                                        @if($bill->payment_method == 'MASTER')
                                        <img src="{{asset('assets/dist/img/master.svg')}}" alt="">
                                        @elseif($bill->payment_method == 'VISA')
                                            <img src="{{asset('assets/dist/img/visa.svg')}}" alt="">
                                        @endif
                                    </h2>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- /.row -->
    </section>
    <!-- /.content -->
@endsection
