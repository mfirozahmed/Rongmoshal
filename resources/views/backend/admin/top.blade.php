@extends('backend.admin')

@section('title', 'Top')

@section('style')

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
                                <li class="list-inline-item active">Top</li>
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
                    <div class="table-data__tool">
                        <h1 class="title-4">Signature Products</h1>
                        <div class="table-data__tool-right">
                            <form action="{{ route('admin.top.add', 'signature') }}" method="get">
                                <button class="au-btn au-btn-icon au-btn--green au-btn--small" type="submit">
                                    <i class="zmdi zmdi-plus"></i>add item</button>
                                <button class="au-btn au-btn-icon au-btn--red au-btn--small" type="submit"
                                    formaction="{{ route('admin.top.remove', 'signature') }}">
                                    <i class="zmdi zmdi-minus"></i>remove item</button>
                            </form>
                        </div>
                    </div>
                    <hr class="line-seprate">
                </div>
            </div>
        </div>
    </section>

    <section class="p-t-20">
        <div class="container">
            <div class="row">
                @if (count($signature_products) > 0)
                @foreach ($signature_products as $product)
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
                                                    href="{{ route('admin.product.specific', $product->id)}}">{{ $product->name }}</a>
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
                <h3>No Products Available.</h3>
                @endif
            </div>
        </div>
    </section>

    <section class="welcome p-t-10">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="table-data__tool">
                        <h1 class="title-4">New Arrivals</h1>
                        <div class="table-data__tool-right">
                            <form action="{{ route('admin.top.add', 'new') }}" method="get">
                                <button class="au-btn au-btn-icon au-btn--green au-btn--small" type="submit">
                                    <i class="zmdi zmdi-plus"></i>add item</button>
                                <button class="au-btn au-btn-icon au-btn--red au-btn--small" type="submit"
                                    formaction="{{ route('admin.top.remove', 'new') }}">
                                    <i class="zmdi zmdi-minus"></i>remove item</button>
                            </form>
                        </div>
                    </div>
                    <hr class="line-seprate">
                </div>
            </div>
        </div>
    </section>
    <section class="p-t-20">
        <div class="container">
            <div class="row">
                @if (count($new_arrivals) > 0)
                @foreach ($new_arrivals as $product)
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
                                                    href="{{ route('admin.product.specific', $product->id)}}">{{ $product->name }}</a>
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
                <h3>No Products Available.</h3>
                @endif
            </div>
        </div>
    </section>

    <section class="welcome p-t-10">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="table-data__tool">
                        <h1 class="title-4">Most Sell</h1>
                    </div>
                    <hr class="line-seprate">
                </div>
            </div>
        </div>
    </section>
    <section class="p-t-20">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-lg-3">
                    @if (count($most_sell) > 0)
                    @foreach ($most_sell as $product)
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
                                                    href="{{ route('admin.product.specific', $product->id)}}">{{ $product->name }}</a>
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
                    @endforeach
                    @else
                    <h3>No Products Available.</h3>
                    @endif
                </div>
            </div>
        </div>
    </section>
</div>
@endsection



@section('script')

@endsection