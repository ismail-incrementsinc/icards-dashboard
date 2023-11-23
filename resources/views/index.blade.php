@extends('layouts.master')
@section('common-title')
    Insights
@endsection
@section('insights')
    active
@endsection
@section('content')
    <section class="content">
        <div class="container-fluid">
            <!-- Main row -->
            <div class="row">
                <!-- Left col -->
                <section class="col-lg-6 connectedSortable">
                    <!-- Custom tabs (Charts with tabs)-->
                    <div class="card">
                        <div class="card-header">
                            <div class="total-user-heading">
                                <div class="title">
                                    <h4>Total users over time</h4>
                                </div>
                                <div class="searchbar text-right">
                                    <form action="{{route('dashboard')}}" method="GET" id="user-month-form" style="display: inline-block">
                                        <label for="count_month"></label>
                                        <select name="user_count_month" id="count_month" class="mr-1" onChange="getUserMonth()">
                                            <option>Month</option>
                                            <option value="1">January</option>
                                            <option value="2">February</option>
                                            <option value="3">March</option>
                                            <option value="4">April</option>
                                            <option value="5">May</option>
                                            <option value="6">June</option>
                                            <option value="7">July</option>
                                            <option value="8">August</option>
                                            <option value="9">September</option>
                                            <option value="10">October</option>
                                            <option value="11">November</option>
                                            <option value="12">December</option>
                                        </select>
                                    </form>
                                        <form action="{{route('dashboard')}}" method="GET" id="user-year-form" style="display: inline-block">
                                            <label for="count_year"></label>
                                            <select name="user_count_year" id="count_year" onChange="getUserYear()">
                                                <option>Year</option>
                                                <option value="2020">2020</option>
                                                <option value="2021">2021</option>
                                                <option value="2022">2022</option>
                                                <option value="2023">2023</option>
                                                <option value="2024">2024</option>
                                                <option value="2025">2025</option>
                                                <option value="2026">2026</option>
                                                <option value="2027">2027</option>
                                            </select>
                                        </form>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div id="chart"></div>
                        </div>
                    </div>
                    <!-- /.card -->

                    <!-- TO DO List -->
                    <div class="card">
                        <div class="card-header">
                            <div class="total-user-heading">
                                <div class="title">
                                    <h4>Most scanned users</h4>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead style="background: #EFFFF5; color: #004C33">
                                    <tr>
                                        <th>Image</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($users as $user)
                                        <tr>
                                            <td><img src="{{$user->image}}" style="width: 50px; height: 50px; border-radius: 50%" alt="image not found"></td>
                                            <td>{{$user->name !=null ? $user->name : ''}}</td>
                                            <td>{{$user->email !=null ? $user->email : ''}}</td>
                                            <td>{{optional($user->info)->phone}}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                    <tfoot style="background: #EFFFF5; color: #004C33">
                                    <tr>
                                        <th>Image</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                    </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </section>
                <!-- /.Left col -->
                <!-- right col (We are only adding the ID to make the widgets sortable)-->
                <section class="col-lg-6 connectedSortable">

                    <!-- solid sales graph -->
                    <div class="card">
                        <div class="card-header">
                            <div class="total-user-heading">
                                <div class="title">
                                    <h4>Card scan analysis</h4>
                                </div>
                                <div class="searchbar text-right">
                                    <form action="{{route('dashboard')}}" method="GET" id="scan-month-form" style="display: inline-block">
                                        <label for="month"></label>
                                        <select name="card_scan_month" id="count_month" class="mr-1" onChange="getCardScanMonth()">
                                            <option>Month</option>
                                            <option value="1">January</option>
                                            <option value="2">February</option>
                                            <option value="3">March</option>
                                            <option value="4">April</option>
                                            <option value="5">May</option>
                                            <option value="6">June</option>
                                            <option value="7">July</option>
                                            <option value="8">August</option>
                                            <option value="9">September</option>
                                            <option value="10">October</option>
                                            <option value="11">November</option>
                                            <option value="12">December</option>
                                        </select>
                                    </form>

                                    <form action="{{route('dashboard')}}" method="GET" id="scan-year-form" style="display: inline-block">
                                        <label for="year"></label>
                                        <select name="card_scan_year" id="count_month" onChange="getCardScanYear()">
                                            <option>Year</option>
                                            <option value="2020">2020</option>
                                            <option value="2021">2021</option>
                                            <option value="2022">2022</option>
                                            <option value="2023">2023</option>
                                            <option value="2024">2024</option>
                                            <option value="2025">2025</option>
                                            <option value="2026">2026</option>
                                            <option value="2027">2027</option>
                                        </select>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div id="chart2"></div>
                        </div>
                    </div>
                    <!-- /.card -->

                    <!-- Map card -->
                    <div class="card">
                        <div class="card-header">
                            <div class="total-user-heading">
                                <div class="title">
                                    <h4><i class="fas fa-map-marker-alt mr-1"></i> Card scanned over the world</h4>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div id="world-map" style="height: 250px; width: 100%;"></div>
                        </div>
                        <!-- /.card-body-->
                    </div>
                    <!-- /.card -->
                </section>
                <!-- right col -->
            </div>
            <!-- /.row (main row) -->
        </div><!-- /.container-fluid -->
    </section>
@endsection

<script>

    function getUserYear(){
        document.getElementById("user-year-form").submit();
    }
    function getUserMonth(){
        document.getElementById("user-month-form").submit();
    }
    function getCardScanYear(){
        document.getElementById("scan-year-form").submit();
    }
    function getCardScanMonth(){
        document.getElementById("scan-month-form").submit();
    }


</script>

@push('script')
<script>
    var options_one = {
        series: [
            {
                name: 'Total user',
                data: [
                    @foreach($user_count_decode_data as $user_count)
                    {
                        x: '{{$user_count->data}}',
                        y: {{$user_count->count}},
                        goals: [
                            {
                                name: 'Expected',
                                value: 800,
                                strokeColor: 'transparent'
                            }
                        ]
                    },
                    @endforeach
                ]
            }
        ],
        chart: {
            height: 350,
            type: 'bar'
        },
        plotOptions: {
            bar: {
                columnWidth: '30%'
            }
        },
        colors: ['#207A97'],
        dataLabels: {
            enabled: false
        },
        legend: {
            show: true,
            showForSingleSeries: true,
            customLegendItems: ['User Count'],
            markers: {
                fillColors: ['#207A97']
            }
        }
    };

    var chart_one = new ApexCharts(document.querySelector("#chart"), options_one);
    chart_one.render();

    // Cart 2
    var options_two = {
        series: [
            {
                name: 'Actual',
                data: [
                     @foreach($card_scan_decode_data as $card_scan)
                        {
                            x: '{{$card_scan->data}}',
                            y: {{$card_scan->count}},
                            goals: [
                                {
                                    name: 'Expected',
                                    value: 800,
                                    strokeColor: 'transparent'
                                }
                            ]
                        },
                     @endforeach
                ]
            }
        ],
        chart: {
            height: 350,
            type: 'bar'
        },
        plotOptions: {
            bar: {
                columnWidth: '15%'
            }
        },
        colors: ['#77AB76'],
        dataLabels: {
            enabled: false
        },
        legend: {
            show: true,
            showForSingleSeries: true,
            customLegendItems: ['Scan Count'],
            markers: {
                fillColors: ['#77AB76']
            }
        }
    };

    var chart_two = new ApexCharts(document.querySelector("#chart2"), options_two);
    chart_two.render();

</script>
@endpush
