@extends('layouts.admin')

@section('title', 'Add Products')

@section('style')
<link href="{{asset('coolAdmin/css/jquery.dataTables.css')}}" rel="stylesheet" type="text/css">

<style>
    .image-preview {
        width: 500px;
        min-height: 250px;
        border: 2px solid #dddddd;
        margin-top: 15px;

        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: bold;
        color: #cccccc;
    }

    .image-preview__image {
        display: none;
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
                                <li class="list-inline-item active">Add Product</li>
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
                    <h1 class="title-4">Add Product</h1>
                    <hr class="line-seprate">
                </div>
            </div>

        </div>
    </section>
    <section class="p-t-20">
        <div class="container">
            <div class="row">
                <div class="col-md-8 offset-md-2">
                    <div class="card">
                        @include('inc.message')
                        <form id="infForm" name="infForm" action="{{ route('admin.product.submit') }}" method="post"
                            enctype="multipart/form-data" class="form-horizontal">
                            @csrf
                            <div class="card-body card-block">
                                <div class="row form-group">
                                    <div class="col col-md-3">
                                        <label for="name" class=" form-control-label">Name</label>
                                    </div>
                                    <div class="col-12 col-md-9">
                                        <input type="text" id="name" name="name" placeholder="Product Name"
                                            class="form-control" value="{{ old('name') }}" required>
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col col-md-3">
                                        <label for="description" class=" form-control-label">Description</label>
                                    </div>
                                    <div class="col-12 col-md-9">
                                        <textarea name="description" id="description" rows="5"
                                            placeholder="Product Description..." class="form-control"
                                            required>{{ old('description') }}</textarea>
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col col-md-3">
                                        <label for="main-category" class=" form-control-label">Main Category</label>
                                    </div>
                                    <div class="col-12 col-md-9">
                                        <select name="main-category" id="main-category"
                                            class="form-control input-lg dynamic" data-dependent="sub-category">
                                            <option value="x">Please select</option>
                                            @foreach ($main_categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col col-md-3">
                                        <label for="sub-category" class=" form-control-label">Sub Category</label>
                                    </div>
                                    <div class="col-12 col-md-9">
                                        <select name="sub-category" id="sub-category"
                                            class="form-control input-lg dynamic" data-dependent="sub-sub-category">
                                            <option value="x">Please select</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col col-md-3">
                                        <label for="sub-sub-category" class=" form-control-label">Sub Sub
                                            Category</label>
                                    </div>
                                    <div class="col-12 col-md-9">
                                        <select name="sub-sub-category" id="sub-sub-category"
                                            class="form-control input-lg">
                                            <option value="x">Please select</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col col-md-3">
                                        <label for="price" class=" form-control-label">Price</label>
                                    </div>
                                    <div class="col-12 col-md-9">
                                        <input type="text" id="price" name="price" placeholder="Product Price"
                                            class="form-control" value="{{ old('price') }}" required>
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col col-md-3">
                                        <label for="image" class=" form-control-label">Image</label>
                                    </div>
                                    <div class="col-12 col-md-9">
                                        <input type="file" id="image" name="image" class="form-control-file" value=""
                                            required>
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col-md-6 offset-md-3">
                                        <div class="image-preview" id="imagePreview">
                                            <img src="{{ old('image') }}" alt="Image Preview"
                                                class="image-preview__image">
                                            <span class="image-preview__default-text"> Image Preview </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer" style="text-align: center">
                                <button type="submit" class="btn btn-primary btn-sm">
                                    <i class="fa fa-dot-circle-o"></i> Submit
                                </button>
                                <button type="reset" class="btn btn-danger btn-sm">
                                    <i class="fa fa-ban"></i> Reset
                                </button>
                            </div>
                        </form>
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
    const images = document.getElementById("image");
    const previewContainer = document.getElementById("imagePreview");
    const previewImage = previewContainer.querySelector(".image-preview__image");
    const previewDefaultText = previewContainer.querySelector(".image-preview__default-text");

    images.addEventListener("change", function() {
        const file = this.files[0];

        if (file) {
            const reader = new FileReader();
            previewDefaultText.style.display = "none";
            previewImage.style.display = "flex";

            reader.addEventListener("load", function() {
                previewImage.setAttribute("src", this.result);
            });
            reader.readAsDataURL(file);
        } else {
            previewDefaultText.style.display = null;
            previewImage.style.display = null;
            previewImage.setAttribute("src", "");
        }
    });
</script>
<script>
    $(document).ready(function() {
        $('.dynamic').change(function() {
            if ($(this).val() != '') {
                var select = $(this).attr("id");
                var value = $(this).val();
                var dependent = $(this).data('dependent');
                var _token = $('input[name="_token"]').val();

                $.ajax({
                    url: "{{ route('admin.subcategory.fetch') }}",
                    method:"POST",
                    data:{select:select, value:value, _token:_token, dependent:dependent},
                    success:function(result) {
                        console.log("done");
                        $('#'+dependent).html(result);
                    }
                }); 
            }
        });
    });

</script>
@endsection