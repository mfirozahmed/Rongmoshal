@extends('layouts.admin')

@section('title', 'Products')

@section('style')
<link href="{{asset('coolAdmin/css/jquery.dataTables.css')}}" rel="stylesheet" type="text/css">
<style>
    .admin-product {
        width: 100%;
        height: 275px;
    }
</style>
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
                                <li class="list-inline-item active">Add {{ $id }}</li>
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
                    <div class="table-data__tool">
                        <h1 class="title-4">All {{$id}}</h1>
                    </div>
                    <hr class="line-seprate">
                </div>
            </div>

        </div>
    </section>
    <section class="p-t-20">
        <div class="container">
            <div class="row">
                @if (count($products) > 0)
                @foreach ($products as $product)
                <div class="col-md-6 col-lg-3">
                    <div class="au-card m-b-30">
                        <div class="au-card-inner">
                            <div class="table-responsive">
                                <table class="table table-top-campaign">
                                    <tbody>
                                        <tr>
                                            <td style="text-align: center">
                                                <img src="/storage/images/{{ $product->image }}" width="200px"
                                                    class="admin-product" height="275px"></td>
                                        </tr>
                                        <tr>
                                            <td style="text-align: center"><a
                                                    href="{{ route('admin.top.add.submit', [$product->id, $id]) }}">{{ $product->name }}</a>
                                            </td>
                                        </tr>
                                        <tr>
                                            @if ($product->status == 0)
                                            <td style="text-align: center"><span class="status--denied"> Not In Stock
                                                </span></td>
                                            @else
                                            <td style="text-align: center"><span class="status--process"> In Stock
                                                </span></td>
                                            @endif
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
                @else
                <div class="col-md-6 col-lg-3">
                    <h3>No Products Available.</h3>
                </div>
                @endif
            </div>
        </div>
    </section>
</div>
@endsection



@section('script')

<script src="{{asset('js/jquery.dataTables.min.js')}}"></script>
<script>
    function addItem() {
        alert("Hello");
    }
</script>

@endsection