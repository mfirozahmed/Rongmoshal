<div class="tab-pane fade show active" id="nav-new" role="tabpanel" aria-labelledby="nav-new-tab">
    <div class="row">
        @foreach ($products as $product)
        <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6">
            <div class="single-popular-items mb-50 text-center">
                <div class="popular-img">
                    <img src="/storage/images/{{ $product->image}}" alt="" width="100px" height="400px">

                    <form method="POST" action="{{ route('cart.store') }}">
                        @csrf
                        <div class="img-cap" onclick="addtoCart({{ $product->id }})">
                            <span>Add to cart</span>
                        </div>
                    </form>


                </div>
                <div class="popular-caption">
                    <h3><a href="{{ route('specific_product', $product->id) }}">{{ $product->name}}</a></h3>
                    <span>{{ $product->price}} tk</span>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
{{ $products->links() }}