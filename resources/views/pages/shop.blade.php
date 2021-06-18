@extends('layouts.main')
@section('content')
    <input type="hidden" value="shop" id="currentPage">
    <section id="advertisement">
        <div class="container">
            <img src="images/shop/advertisement.jpg" alt="" />
        </div>
    </section>

    <section>
        <div class="container">
            <div class="row">
                <div class="col-sm-3">
                    @component('components.left-sidebar', ['categories' => $categories, 'brands' => $brands])
                    @endcomponent
                </div>

                <div class="col-sm-9 padding-right">
                    <div class="features_items"><!--features_items-->
                    <h2 class="title text-center">Features Items</h2>
                    <div id="products"></div>
                    </div><!--features_items-->
                </div>
            </div>
        </div>
    </section>
@endsection
