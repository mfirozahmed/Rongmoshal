@extends('backend.admin')

@section('title', 'Individual Order')

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
                                <li class="list-inline-item">
                                    <a href="{{ route('admin.orders') }}">Orders</a>
                                </li>
                                <li class="list-inline-item seprate">
                                    <span>/</span>
                                </li>
                                <li class="list-inline-item active">Individual Order</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="welcome p-t-10">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h1 class="title-4">Order No.
                        <span> {{ $order->id }}!
                        </span>
                    </h1>
                    <hr class="line-seprate">
                </div>
            </div>
        </div>
    </section>

    <section class="statistic-chart">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-lg-4">
                    <div class="au-card m-b-30">
                        <div class="au-card-inner">
                            <h3 class="title-3 m-b-30">Billing Details</h3>
                            <div class="table-responsive">
                                <table class="table table-top-campaign">
                                    <tbody>
                                        <tr>
                                            <td style="text-align: left"> Name: </td>
                                            <td style="text-align: left">{{ $order->user->name }}</td>
                                        </tr>
                                        <tr>
                                            <td style="text-align: left"> Email: </td>
                                            <td style="text-align: left">{{ $order->user->email }}</td>
                                        </tr>
                                        <tr>
                                            <td style="text-align: left"> Phone: </td>
                                            <td style="text-align: left">{{ $order->user->phone }}</td>
                                        </tr>
                                        <tr>
                                            <td style="text-align: left"> Address: </td>
                                            <td style="text-align: left">{{ $order->user->address }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="au-card m-b-30">
                        <div class="au-card-inner">
                            <h3 class="title-3 m-b-30">Shipping Details</h3>
                            <div class="table-responsive">
                                <table class="table table-top-campaign">
                                    <tbody>
                                        <tr>
                                            <td style="text-align: left"> Name: </td>
                                            <td style="text-align: left">{{ $order->shipping_name }}</td>
                                        </tr>
                                        <tr>
                                            <td style="text-align: left"> Phone: </td>
                                            <td style="text-align: left">{{ $order->shipping_phone }}</td>
                                        </tr>
                                        <tr>
                                            <td style="text-align: left"> Address: </td>
                                            <td style="text-align: left">{{ $order->shipping_address }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="au-card m-b-30">
                        <div class="au-card-inner">
                            <h3 class="title-3 m-b-30">Order Details</h3>
                            <div class="table-responsive">
                                <table class="table table-top-campaign">
                                    <tbody>
                                        <tr>
                                            <td style="text-align: left"> Total Products: </td>
                                            <td style="text-align: left">{{ $order->quantity }}</td>
                                        </tr>
                                        <tr>
                                            <td style="text-align: left"> Total Price (without any charge): </td>
                                            <td style="text-align: left">&#x9f3; {{ $order->price }}</td>
                                        </tr>
                                        <tr>
                                            <td style="text-align: left"> Payment Method: </td>
                                            <td style="text-align: left">{{ $order->payment_method }}</td>
                                        </tr>
                                        <tr>
                                            <td style="text-align: left"> Transection ID: </td>
                                            @if ($order->payment_method == "Cash On Delivery")
                                            <td style="text-align: left">N/A</td>
                                            @else
                                            <td style="text-align: left">{{ $order->transection }}</td>
                                            @endif
                                        </tr>
                                        <tr>
                                            <td style="text-align: left"> Payment Status: </td>
                                            <td style="text-align: left">
                                                <label class="switch switch-3d switch-success mr-3">
                                                    <input type="checkbox" class="switch-input" id="payment_status"
                                                        value="{{ $order->payment_status }}"
                                                        {{ $order->payment_status == 1 ? 'checked="true"' : '' }}>
                                                    <span data-on="Yes" data-off="No" class="switch-label"></span>
                                                    <span class="switch-handle"></span>
                                                </label>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="text-align: left"> Delivery Method: </td>
                                            @if ($order->delivery_method == "inside")
                                            <td style="text-align: left">Inside Dhaka</td>
                                            @else
                                            <td style="text-align: left">Outside Dhaka</td>
                                            @endif

                                        </tr>
                                        <tr>
                                            <td style="text-align: left"> Delivery Status: </td>
                                            <td style="text-align: left">
                                                <label class="switch switch-3d switch-success mr-3">
                                                    <input type="checkbox" class="switch-input" id="delivery_status"
                                                        value="{{ $order->delivery_status }}"
                                                        {{ $order->delivery_status == 1 ? 'checked="true"' : '' }}>
                                                    <span data-on="Yes" data-off="No" class="switch-label"></span>
                                                    <span class="switch-handle"></span>
                                                </label>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>


    <section class="p-t-20">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-default">
                        @csrf
                        <h3 class="title-5 m-b-35">Products</h3>
                        <div class="panel-body">
                            <table class="table table-data3" style="text-align: center">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th>image</th>
                                        <th>name</th>
                                        <th>quantity</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($order != null)
                                    @foreach ($order->carts as $cart)
                                    <tr class="tr-shadow">

                                        <td></td>
                                        <td><img src="/storage/images/{{ $cart->product->image }}" width="100px"></td>
                                        <td>{{ $cart->product->name }}</td>
                                        <td>{{ $cart->quantity }}</td>
                                        <td></td>

                                    </tr>
                                    <tr class="spacer"></tr>
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
<script>
    $(document).ready(function() {
        $('#payment_status').on('change', function() {
            if ($(this).val() != '') {
                var value = $(this).val();
                var id = {{ $order->id }};
                var status = 'payment';
                var _token = $('input[name="_token"]').val();

                console.log("before ", value);
                $.ajax({
                    url: "{{ route('admin.order.status') }}", 
                    method:"POST",
                    data:{id:id, value:value, status:status, _token:_token},
                    success:function(result) {
                        console.log("db ", result);
                        $('#payment_status').val(result);
                        console.log("after ", $('#payment_status').val());
                    }
                })
            }
        });

        $('#delivery_status').on('change', function() {
            if ($(this).val() != '') {
                var value = $(this).val();
                var id = {{ $order->id }};
                var status = 'delivery';
                var _token = $('input[name="_token"]').val();

                console.log("before ", value);
                $.ajax({
                    url: "{{ route('admin.order.status') }}", 
                    method:"POST",
                    data:{id:id, value:value, status:status, _token:_token},
                    success:function(result) {
                        console.log("db ", result);
                        $('#delivery_status').val(result);
                        console.log("after ", $('#delivery_status').val());
                    }
                })
            }
        });
    });
</script>
@endsection