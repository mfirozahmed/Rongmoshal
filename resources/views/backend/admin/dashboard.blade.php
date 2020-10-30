@extends('backend.admin')

@section('title', 'Dashboard')

@section('style')
@endsection

@section('content')
<div class="page-content--bgf7">
    <!-- BREADCRUMB-->
    <section class="au-breadcrumb2">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="au-breadcrumb-content">
                        <div class="au-breadcrumb-left">
                            <span class="au-breadcrumb-span">You are here:</span>
                            <ul class="list-unstyled list-inline au-breadcrumb__list">
                                <li class="list-inline-item active">
                                    <a href="{{ route('admin.dashboard') }}">Home</a>
                                </li>
                                <li class="list-inline-item seprate">
                                    <span>/</span>
                                </li>
                                <li class="list-inline-item">Dashboard</li>
                            </ul>
                        </div>
                        <form class="au-form-icon--sm" action="" method="post">
                            <input class="au-input--w300 au-input--style2" type="text"
                                placeholder="Search for datas &amp; reports...">
                            <button class="au-btn--submit2" type="submit">
                                <i class="zmdi zmdi-search"></i>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- END BREADCRUMB-->

    <!-- WELCOME-->
    <section class="welcome p-t-10">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h1 class="title-4">Welcome back,
                        <span>{{ Auth::user()->name }}!
                        </span>
                    </h1>
                    <hr class="line-seprate">
                </div>
            </div>
        </div>
    </section>
    <!-- END WELCOME-->

    <!-- STATISTIC-->
    <section class="statistic statistic2">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-lg-3">
                    <div class="statistic__item statistic__item--green">
                        <h2 class="number">{{ $user_count }}</h2>
                        <span class="desc">members registered
                        </span>
                        <div class="icon">
                            <i class="zmdi zmdi-account-o"></i>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="statistic__item statistic__item--orange">
                        <h2 class="number">{{ $total_items }}</h2>
                        <span class="desc">items sold</span>
                        <div class="icon">
                            <i class="zmdi zmdi-shopping-cart"></i>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="statistic__item statistic__item--blue">
                        <h2 class="number">1,086</h2>
                        <span class="desc">this week</span>
                        <div class="icon">
                            <i class="zmdi zmdi-calendar-note"></i>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="statistic__item statistic__item--red">
                        <h2 class="number">&#x9f3; {{ $total_earns }} TK</h2>
                        <span class="desc">total earnings</span>
                        <div class="icon">
                            <i class="zmdi zmdi-money"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- END STATISTIC-->

    <!-- STATISTIC CHART-->
    <section class="statistic-chart">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h3 class="title-5 m-b-35">statistics</h3>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 col-lg-6">
                    <div class="au-card m-b-30">
                        <div class="au-card-inner">
                            <h3 class="title-3 m-b-30">Total Orders</h3>
                            <canvas id="order-stat"></canvas>
                            <input type="hidden" value="{!!json_encode($order_stat)!!}" id="order-stat-value">
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-6">
                    <div class="au-card m-b-30">
                        <div class="au-card-inner">
                            <h3 class="title-3 m-b-30">top customers
                            </h3>
                            <div class="table-responsive">
                                <table class="table table-top-campaign">
                                    <thead>
                                        <th scope="col" style="text-align: center">#</th>
                                        <th scope="col" style="text-align: center">Name</th>
                                        <th scope="col" style="text-align: center">ID</th>
                                        <th scope="col" style="text-align: center">Quantity</th>
                                    </thead>
                                    <tbody>
                                        @foreach ($id_quantity as $key=>$value)
                                        <tr>
                                            <td style="text-align: center"> {{ $loop->iteration }}</td>
                                            <td style="text-align: center">{{ $name_quantity[$loop->iteration - 1] }}
                                            </td>
                                            <td style="text-align: center">{{ $key }}</td>
                                            <td style="text-align: center">{{ $value }}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- END TOP CAMPAIGN-->
                </div>
            </div>
        </div>
    </section>
    <!-- END STATISTIC CHART-->

    <!-- DATA TABLE-->
    <section class="p-t-20">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h3 class="title-5 m-b-35">Top Orders</h3>
                    <div class="table-data__tool">

                        <div class="table-data__tool-left">
                            <div class="rs-select2--light rs-select2--md">
                                <select class="js-select2" name="property" id="property" onchange="propertyChanged()">
                                    <option selected value="all">All Properties</option>
                                    <option value="not_del">Not Delivered</option>
                                    <option value="not_paid">Not Paid</option>
                                </select>
                                <div class="dropDownSelect2"></div>
                            </div>
                            <div class="rs-select2--light rs-select2--sm">
                                <select class="js-select2" name="time" id="time" onchange="timeChanged()">
                                    <option selected value="today">Today</option>
                                    <option value="week">Last 7 Days</option>
                                    <option value="month">Last 30 Days</option>
                                </select>
                                <div class="dropDownSelect2"></div>
                            </div>

                        </div>

                    </div>
                    <div class="table-responsive table-responsive-data2">
                        <table class="table table-data2" style="text-align: center" id="orderTable">
                            @include('backend.admin.fetch_data')
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- END DATA TABLE-->
</div>
@endsection


@section('script')
<script src="{{ asset('js/jquery-3.5.1.min.js') }}"></script>

<script>
    "use strict";
    
    try {
        
        //Teamx chart
        var ctx = document.getElementById("order-stat");
        var order_stat = {!! json_encode($order_stat) !!};
        //console.log(order_stat);
        if (ctx) {
        ctx.height = 150;
        var myChart = new Chart(ctx, {
            type: 'line',
            data: {
            labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
            type: 'line',
            defaultFontFamily: 'Poppins',
            datasets: [{
                data: order_stat,
                label: "Orders",
                backgroundColor: 'rgba(0,103,255,.15)',
                borderColor: 'rgba(0,103,255,0.5)',
                borderWidth: 3.5,
                pointStyle: 'circle',
                pointRadius: 5,
                pointBorderColor: 'transparent',
                pointBackgroundColor: 'rgba(0,103,255,0.5)',
            },]
            },
            options: {
            responsive: true,
            tooltips: {
                mode: 'index',
                titleFontSize: 12,
                titleFontColor: '#000',
                bodyFontColor: '#000',
                backgroundColor: '#fff',
                titleFontFamily: 'Poppins',
                bodyFontFamily: 'Poppins',
                cornerRadius: 3,
                intersect: false,
            },
            legend: {
                display: false,
                position: 'top',
                labels: {
                usePointStyle: true,
                fontFamily: 'Poppins',
                },


            },
            scales: {
                xAxes: [{
                display: true,
                gridLines: {
                    display: false,
                    drawBorder: false
                },
                scaleLabel: {
                    display: false,
                    labelString: 'Month'
                },
                ticks: {
                    fontFamily: "Poppins"
                }
                }],
                yAxes: [{
                display: true,
                gridLines: {
                    display: false,
                    drawBorder: false
                },
                scaleLabel: {
                    display: true,
                    labelString: 'Value',
                    fontFamily: "Poppins"
                },
                ticks: {
                    fontFamily: "Poppins"
                }
                }]
            },
            title: {
                display: false,
            }
            }
        });
        }


    } catch (error) {
        console.log(error);
    }
    
</script>

<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN' : $('meta[name="csrf-token"').attr('content')
        }
    }); 

    function propertyChanged() {
        var property = $('#property').val();
        var time = $('#time').val();
        var value = document.getElementById("order-stat-value");
        
        console.log(value.value);

        $.ajax({
            url: "/admin/dashboard/data",
            data: {property: property, time: time},
            success: function(data) {
                //console.log(data);
                $('#orderTable').html(data);
            }
        });
    };

    function timeChanged() {
        var property = $('#property').val();
        var time = $('#time').val();
        console.log(property, time);

        $.ajax({
            url: "/admin/dashboard/data",
            data: {property: property, time: time},
            success: function(data) {
                //console.log(data);
                $('#orderTable').html(data);
            }
        });
    };

</script>
@endsection