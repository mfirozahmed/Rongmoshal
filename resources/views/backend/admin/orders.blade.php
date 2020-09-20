@extends('layouts.admin')

@section('title', 'Orders')

@section('style')
<link href="{{asset('coolAdmin/css/jquery.dataTables.css')}}" rel="stylesheet" type="text/css">
@endsection

@section('content')
<div class="page-content--bgf7">
    <section class="au-breadcrumb2">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="au-breadcrumb-content">
                        <div class="au-breadcrumb-left">
                            <span class="au-breadcrumb-span">You are here:</span>
                            <ul class="list-unstyled list-inline au-breadcrumb__list">
                                <li class="list-inline-item">
                                    <a href="{{ route('admin.dashboard') }}">Home</a>
                                </li>
                                <li class="list-inline-item seprate">
                                    <span>/</span>
                                </li>
                                <li class="list-inline-item active">Orders</li>
                            </ul>
                        </div>
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
                    <h1 class="title-4">All Orders</h1>
                    <hr class="line-seprate">
                </div>
            </div>
        </div>
    </section>
    <section class="p-t-20">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <table class="table table-data2" style="text-align: center" id="datatable">
                                <thead>
                                    <tr>
                                        <th>date</th>
                                        <th>name</th>
                                        <th>payment method</th>
                                        <th>payment status</th>
                                        <th>delivery status</th>
                                        <th>price</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (count($orders) > 0)
                                    @foreach ($orders as $order)
                                    <tr class="tr-shadow">
                                        <td>{{ $order->created_at }}</td>
                                        <td>{{ $order->user->name }}</td>
                                        <td><span class="block-email">{{ $order->payment_method }}</span></td>
                                        @if ($order->payment_status == 0)
                                        <td>
                                            <span class="status--denied">Not Paid</span>
                                        </td>
                                        @else
                                        <td>
                                            <span class="status--process">Paid</span>
                                        </td>
                                        @endif
                                        @if ($order->delivery_status == 0)
                                        <td>
                                            <span class="status--denied">Not Delivered</span>
                                        </td>
                                        @else
                                        <td>
                                            <span class="status--process">Delivered</span>
                                        </td>
                                        @endif
                                        <td>&#x9f3; {{ $order->price }}</td>
                                        <td>
                                            <div class="table-data-feature">
                                                <form method="GET"
                                                    action="{{ route('admin.order.details', App\Code::getOrderCode($order->id)) }}">
                                                    <button class="item" data-toggle="tooltip" data-placement="top"
                                                        title="Details">
                                                        <i class="zmdi zmdi-mail-send"></i>
                                                    </button>
                                                </form>
                                                <button class="item" data-toggle="tooltip" data-placement="top"
                                                    title="Cancel">
                                                    <i class="zmdi zmdi-delete"></i>
                                                </button>

                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                    @else
                                    <tr class="tr-shadow">
                                        <td></td>
                                        <td></td>
                                        <td>
                                            <span class="block-email"></span>
                                        </td>
                                        <td>
                                            <h3>There is no order!</h3>
                                        </td>
                                        <td>
                                            <span class="status--denied"></span>
                                        </td>
                                        <td>
                                            <span class="status--process"></span>
                                        </td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection



@section('script')

<script src="{{asset('js/jquery.dataTables.min.js')}}"></script>

<script>
    $(document).ready( function () {
        $('#datatable').DataTable({
            "order": [[ 0, "desc" ]]
        });
    });
</script>
@endsection