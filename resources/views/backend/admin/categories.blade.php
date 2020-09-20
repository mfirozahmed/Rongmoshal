@extends('layouts.admin')

@section('title', 'Categories')

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
                                <li class="list-inline-item active">Categories</li>
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
                        <h1 class="title-4">Main Categories</h1>
                        <div class="table-data__tool-right">
                            <form action="{{ route('admin.category.add', 'main') }}" method="get">
                                <button class="au-btn au-btn-icon au-btn--green au-btn--small" type="submit">
                                    <i class="zmdi zmdi-plus"></i>add</button>
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
                @if (count($main_categories) > 0)
                @foreach ($main_categories as $category)
                <div class="col-md-6 col-lg-3">
                    <div class="au-card m-b-30">
                        <div class="au-card-inner">
                            <div class="table-responsive">
                                <table class="table table-top-campaign">
                                    <tbody>
                                        <tr>
                                            <td style="text-align: center"><a
                                                    href="{{ route('admin.category.edit', $category->id)}}">{{ $category->name }}</a>
                                            </td>
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
                    <h3>No Main Categories Available.</h3>
                </div>
                @endif
            </div>
        </div>
    </section>

    <section class="welcome p-t-10">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="table-data__tool">
                        <h1 class="title-4">Sub Categories</h1>
                        <div class="table-data__tool-right">
                            <form action="{{ route('admin.category.add', 'sub') }}" method="get">
                                <button class="au-btn au-btn-icon au-btn--green au-btn--small" type="submit">
                                    <i class="zmdi zmdi-plus"></i>add item</button>
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
                @if (count($sub_categories) > 0)
                @foreach ($sub_categories as $category)
                <div class="col-md-6 col-lg-3">
                    <div class="au-card m-b-30">
                        <div class="au-card-inner">
                            <div class="table-responsive">
                                <table class="table table-top-campaign">
                                    <tbody>
                                        <tr>
                                            <td style="text-align: center"><a
                                                    href="{{ route('admin.category.edit', $category->id)}}">{{ $category->main($category->id)->name }}
                                                    > {{ $category->name }}</a>
                                            </td>
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
                    <h3>No Sub Categories Available.</h3>
                </div>
                @endif
            </div>
        </div>
    </section>

    <section class="welcome p-t-10">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="table-data__tool">
                        <h1 class="title-4">Sub Sub Categories</h1>
                        <div class="table-data__tool-right">
                            <form action="{{ route('admin.category.add', 'sub-sub') }}" method="get">
                                <button class="au-btn au-btn-icon au-btn--green au-btn--small" type="submit">
                                    <i class="zmdi zmdi-plus"></i>add item</button>
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
                @if (count($sub_sub_categories) > 0)
                @foreach ($sub_sub_categories as $category)
                <div class="col-md-6 col-lg-3">
                    <div class="au-card m-b-30">
                        <div class="au-card-inner">
                            <div class="table-responsive">
                                <table class="table table-top-campaign">
                                    <tbody>
                                        <tr>
                                            <td style="text-align: center"><a
                                                    href="{{ route('admin.category.edit', $category->id)}}">{{ $category->main($category->id)->name }}
                                                    > {{ $category->sub($category->id)->name }} >
                                                    {{ $category->name }}</a>
                                            </td>
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
                    <h3>No Sub Sub Categories Available.</h3>
                </div>
                @endif
            </div>
        </div>
    </section>
</div>
@endsection



@section('script')

@endsection