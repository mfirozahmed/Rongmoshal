@extends('backend.admin')

@section('title', 'Add Products')

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
                                <li class="list-inline-item">
                                    <a href="{{ route('admin.categories') }}">Categories</a>
                                </li>
                                <li class="list-inline-item seprate">
                                    <span>/</span>
                                </li>
                                <li class="list-inline-item active">Add Category</li>
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
                    @if ($type == 'main')
                    <h1 class="title-4">Add Main Category</h1>
                    @elseif ($type == 'sub')
                    <h1 class="title-4">Add Sub Category</h1>
                    @else
                    <h1 class="title-4">Add Sub Sub Category</h1>
                    @endif
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
                        <form id="infForm" name="infForm" action="{{ route('admin.category.submit') }}" method="post"
                            class="form-horizontal">
                            @csrf
                            <div class="card-body card-block">
                                @if ($type == 'sub-sub')
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
                                        <select name="sub-category" id="sub-category" class="form-control input-lg">
                                            <option value="x">Please select</option>
                                        </select>
                                    </div>
                                </div>
                                @elseif ($type == 'sub')
                                <div class="row form-group">
                                    <div class="col col-md-3">
                                        <label for="main-category" class=" form-control-label">Main Category</label>
                                    </div>
                                    <div class="col-12 col-md-9">
                                        <select name="main-category" id="main-category" class="form-control">
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
                                        <select name="sub-category" id="sub-category" class="form-control" disabled>
                                            <option value="x">Please select</option>
                                        </select>
                                    </div>
                                </div>
                                @else
                                <div class="row form-group">
                                    <div class="col col-md-3">
                                        <label for="main-category" class=" form-control-label">Main Category</label>
                                    </div>
                                    <div class="col-12 col-md-9">
                                        <select name="main-category" id="main-category" class="form-control" disabled>
                                            <option value="x">Please select</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col col-md-3">
                                        <label for="sub-category" class=" form-control-label">Sub Category</label>
                                    </div>
                                    <div class="col-12 col-md-9">
                                        <select name="sub-category" id="sub-category" class="form-control" disabled>
                                            <option value="x">Please select</option>
                                        </select>
                                    </div>
                                </div>
                                @endif
                                <div class="row form-group">
                                    <div class="col col-md-3">
                                        <label for="name" class=" form-control-label">Name</label>
                                    </div>
                                    <div class="col-12 col-md-9">
                                        <input type="text" id="name" name="name" placeholder="Category Name"
                                            class="form-control" value="{{ old('name') }}" required>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer" style="text-align: center">
                                <input type="hidden" value="{{ $type }}" name="type">
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
                        console.log(result)
                        console.log("done");
                        $('#'+dependent).html(result);
                    }
                });
            }
        });
    });
</script>
@endsection