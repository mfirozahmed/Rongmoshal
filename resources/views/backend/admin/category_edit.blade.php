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
                                <li class="list-inline-item active">Edit Category</li>
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
                        @if ($type == 'main')
                        <h1 class="title-4">Edit Main Category</h1>
                        @elseif ($type == 'sub')
                        <h1 class="title-4">Edit Sub Category</h1>
                        @else
                        <h1 class="title-4">Edit Sub Sub Category</h1>
                        @endif
                        <div class="table-data__tool-right">
                            <form action="{{ route('admin.category.delete') }}" method="post">
                                @csrf
                                <input type="hidden" name="id" value="{{ $category->id }}">
                                <button class="au-btn au-btn-icon au-btn--red au-btn--small" type="submit">
                                    <i class="zmdi zmdi-minus"></i>Delete</button>
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
                <div class="col-md-8 offset-md-2">
                    <div class="card">
                        <div class="card-body card-block">
                            @include('inc.message')
                            <div class="row form-group">
                                <div class="col col-md-3">
                                    <label for="name" class=" form-control-label">Name</label>
                                </div>
                                <div class="col-12 col-md-9">
                                    <input type="text" id="name" name="name" placeholder="Category Name"
                                        class="form-control" value="{{ $category->name }}" required>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer" style="text-align: center">
                            <button type="submit" class="btn btn-primary btn-sm" id="update">
                                <i class="fa fa-dot-circle-o"></i> Update
                            </button>
                        </div>
                    </div>
                </div>

                @if ($sub_categories != null)
                @for ($i = 0; $i < $sub_categories->count(); $i++)
                    <div class="col-md-6 col-lg-4">
                        <div class="au-card m-b-30">
                            <div class="au-card-inner">
                                <div class="table-responsive">
                                    <table class="table table-top-campaign">
                                        <tbody>
                                            <tr>
                                                <td style="text-align: center">
                                                    <div class="vue-lists">
                                                        <h4 class="mb-4"><a
                                                                href="{{ route('admin.category.edit', $sub_categories[$i]->id)}}">
                                                                {{ $sub_categories[$i]->name }}</a></h4>
                                                        @if ($sub_sub_categories != null)
                                                        @for ($j = 0; $j < $sub_sub_categories[$sub_categories[$i]->
                                                            id]->count(); $j++)
                                                            <li>{{ $sub_sub_categories[$sub_categories[$i]->id][$j]->name }}
                                                            </li>
                                                            @endfor
                                                            @endif
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endfor
                    @else
                    @if ($type == 'main')
                    <div>
                        <h3>No Sub Categories</h3>
                    </div>
                    @endif
                    @endif
            </div>
        </div>
    </section>
</div>
@endsection



@section('script')

<script>
    $('#update').click(function() {
        console.log("Update clicked");

        var value = $('#name').val();
        var id = {{$category->id}};
        console.log(id);

        $.ajax({
            url: "/admin/category/"+id+"/update/"+value, 
            method:"GET",
            data:{value:value},
            success:function(result) {
                console.log(result);
                alert('Name Updated');
            }
            
        });
        //window.location.href = "{{ route('admin.products') }}";
    });
    

</script>
@endsection