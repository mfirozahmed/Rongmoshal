@extends('layouts.user')

@section('title', '| Shop')

@section('styles')

<!-- CSS -->
<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css" />
<!-- Bootstrap theme -->
<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/bootstrap.min.css" />

@endsection

@section('content'))

<div class="slider-area ">
    <div class="single-slider slider-height2 d-flex align-items-center">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="hero-cap text-center">
                        <h2>{{ $sub_category->name }}</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<section class="popular-items latest-padding">
    <div class="container">
        <div class="row product-btn justify-content-between mb-40">
            <div class="properties__button">
                <!--Nav Button  -->
                <nav>
                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                        <a class="nav-item nav-link active" id="nav-new-tab" data-toggle="tab" role="tab"
                            aria-controls="nav-new" aria-selected="true">Newest Arrivals</a>
                        <a class="nav-item nav-link" id="nav-price-tab" data-toggle="tab" role="tab"
                            aria-controls="nav-price" aria-selected="false"> Price high to low</a>
                        <a class="nav-item nav-link" id="nav-popular-tab" data-toggle="tab" role="tab"
                            aria-controls="nav-popular" aria-selected="false"> Most populer </a>
                    </div>
                </nav>
                <!--End Nav Button  -->
            </div>
            <!-- Grid and List view -->
            <div class="grid-list-view">
            </div>
            <!-- Select items -->
            <div class="select-this">
                <div class="select-itms">
                    <select name="select" id="perPage" onchange="perPageChanged()">
                        <option value="3">3 per page</option>
                        <option value="5">5 per page</option>
                        <option value="7">7 per page</option>
                    </select>
                </div>
            </div>
        </div>
        <!-- Nav Card -->
        <div class="tab-content" id="nav-tabContent">
            @include('pages.pagination_data')
            <!-- card one -->
        </div>
        <!-- End Nav Card -->
    </div>
    <input type="hidden" id="page_on" value="{{ $products->currentPage() }}">
</section>

@endsection


@section('scripts')

<script src="{{ asset('js/jquery-3.5.1.min.js') }}"></script>

<!-- JavaScript -->
<script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>

<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN' : $('meta[name="csrf-token"').attr('content')
        }
    }); 


    function addtoCart(product_id, user_id){
        //alert(product_id);
        //alert(user_id);
        
        $.post("http://127.0.0.1:8000/user/user_id/cart/store", {
            
            product_id: product_id,
            user_id: user_id
        }).done(function (data) {
            //alert("Data Loaded: " + data);
            data = JSON.parse(data);
            if (data.status == 'ok') {
                alertify.set('notifier','position', 'bottom-right');
                alertify.success('Item added to cart successfully.');


                $("#lblCartCount").html(data.totalItems)
            }
        });
    };

    function submitform() {
        document.getElementById("myForm").submit();
    };

    $(document).ready(function () {
        $(document).on('click', '.pagination a', function(event) {
            event.preventDefault();
            var page = $(this).attr('href').split('page=')[1];
            var perPage = $('#perPage').val();
            var tab = $('.nav-link.active').attr('id').split('-')[1];
            var cid = {{ $sub_category->id }};
            //console.log(cid);
            category_data(page, perPage, tab, cid);

        });

        function category_data(page, perPage, tab, cid) {
            $.ajax({
                url: "/category/"+cid+"/products?page="+page,
                data: {perPage: perPage, tab: tab, cid: cid},
                success: function(data) {
                    //console.log(data);
                    $('#nav-tabContent').html(data);
                }
            });
        }
    });

    $(document).ready(function () {
        $(document).on('click', '.nav-tabs a', function(event) {
            event.preventDefault();
            //var page = $('.pagination a').attr('href').split('page=')[1];
            var page = $('#page_on').val();
            var perPage = $('#perPage').val();
            var tab = $('.nav-link.active').attr('id').split('-')[1];
            var cid = {{ $sub_category->id }};
            //console.log(page, perPage, tab, cid);
            category_data(page, perPage, tab, cid);

        });

        function category_data(page, perPage, tab, cid) {
            $.ajax({
                url: "/category/"+cid+"/products?page="+page,
                data: {perPage: perPage, tab: tab, cid: cid},
                success: function(data) {
                    //console.log(data);
                    $('#nav-tabContent').html(data);
                }
            });
        }
    });
        
    function perPageChanged() {
        var perPage = $('#perPage').val();
        var tab = $('.nav-link.active').attr('id').split('-')[1];
        var page = 1;
        var cid = {{ $sub_category->id }};
        //console.log(perPage);

        $.ajax({
            url: "/category/"+cid+"/data",
            data: {page: page, perPage: perPage, tab: tab, cid: cid},
            success: function(data) {
                //console.log(data)
                $('#nav-tabContent').html(data);
            }
        });
    };

</script>

@endsection