@extends('backend.admin')

@section('title', 'Product')

@section('style')
<style>
    .admin-product {
        width: 100%;
        height: 100%;
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
                                <li class="list-inline-item">
                                    <a href="{{ route('admin.products') }}">Products</a>
                                </li>
                                <li class="list-inline-item seprate">
                                    <span>/</span>
                                </li>
                                <li class="list-inline-item active">Individual Product</li>
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
                    <h1 class="title-4">{{ $product->name }}</h1>
                    <hr class="line-seprate">
                </div>
            </div>
        </div>
    </section>
    <section class="p-t-20">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-lg-6">
                    <div class="au-card m-b-30">
                        <div class="au-card-inner">
                            <div style="text-align: center">
                                <img src="/storage/images/{{ $product->image }}" class="admin-product">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-6">
                    <div class="au-card m-b-30">
                        <div class="au-card-inner">
                            <div class="table-responsive">
                                <table class="table table-data2">
                                    <tbody>
                                        <tr>
                                            <td>Name</td>
                                            <td style="text-align: left">{{ $product->name }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Description</td>
                                            <td style="text-align: left">{{ $product->description }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Price</td>
                                            <td style="text-align: left">{{ $product->price }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Main Category</td>
                                            <td style="text-align: left">
                                                {{ $product->categoryName($product->id, 'main')->name }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Sub Category</td>
                                            <td style="text-align: left">
                                                {{ $product->categoryName($product->id, 'sub')->name }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Sub Sub Category</td>
                                            <td style="text-align: left">
                                                {{ $product->categoryName($product->id, 'sub_sub')->name }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <form>
                                                @csrf
                                                <td>Status</td>
                                                <td style="text-align: left">
                                                    <label class="switch switch-3d switch-success mr-3">
                                                        <input type="checkbox" class="switch-input" id="status"
                                                            value="{{ $product->status }}"
                                                            {{ $product->status == 1 ? 'checked="true"' : '' }}>
                                                        <span class="switch-label"></span>
                                                        <span class="switch-handle"></span>
                                                    </label>
                                                </td>
                                            </form>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <br> <br>
                            <button type="button" id="edit" class="btn btn-outline-warning btn-lg"
                                style="margin-left: 20%; padding: .5rem 1.9rem;">Edit</button>
                            <button type="button" id="delete" class="btn btn-outline-danger btn-lg"
                                style="margin-left: 25%;">Delete</button>
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
        $(document).on('change', '.switch-input', function() {
            if ($(this).val() != '') {
                var value = $(this).val();
                var id = {{ $product->id }};
                var _token = $('input[name="_token"]').val();

                console.log("before ", value);
                $.ajax({
                    url: "{{ route('admin.product.status') }}", 
                    method:"POST",
                    data:{id:id, value:value, _token:_token},
                    success:function(result) {
                        console.log("db ", result);
                        $('#status').val(result);
                        console.log("after ", $('#status').val());
                    }
                })
            }
        });
    });

    $('#delete').click(function() {
        console.log("Delete clicked");

        var id = {{ $product->id }};
        var _token = $('input[name="_token"]').val();
        
        $.ajax({
            url: "{{ route('admin.delete.submit') }}", 
            method:"POST",
            data:{id:id, _token:_token},
            success:function() {
                console.log('ok');
            }
            
        });
        window.location.href = "{{ route('admin.products') }}";
    });

    $('#edit').click(function() {
        window.location.href = "{{ route('admin.product.edit', $product->id) }}";
    });

</script>
@endsection