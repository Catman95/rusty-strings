<div class="col-sm-4">
    <div class="product-image-wrapper">
        <div class="single-products">
            <div class="productinfo text-center">
                <img src="{{asset('storage/' . $product->images[0]->name)}}" alt="" />
                <h2>${{$product->price}}</h2>
                <p>{{$product->name}}</p>
                <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
            </div>
            <div class="product-overlay">
                <div class="overlay-content">
                    <h2>${{$product->price}}</h2>
                    <p>{{$product->name}}</p>
                    <a href="/products/show/{{$product->id}}" class="btn btn-default add-to-cart"><i class="fa fa-folder-open"></i>Open</a>
                    <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                </div>
            </div>
            <!--
            <img src="images/home/new.png" class="new" alt="" />
            <img src="images/home/sale.png" class="new" alt="" />
            -->
        </div>
        <div class="choose">
            <ul class="nav nav-pills nav-justified">
                <li><a href=""><i class="fa fa-plus-square"></i>Add to wishlist</a></li>
                <li><a href=""><i class="fa fa-plus-square"></i>Add to compare</a></li>
            </ul>
        </div>
    </div>
</div>
