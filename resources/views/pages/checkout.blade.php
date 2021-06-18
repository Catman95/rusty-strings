@extends('layouts.main')
@section('content')
    <input type="hidden" value="checkout" id="currentPage">
    <section id="cart_items">
        <div class="container">
            <div class="breadcrumbs">
                <ol class="breadcrumb">
                    <li><a href="#">Home</a></li>
                    <li class="active">Check out</li>
                </ol>
            </div><!--/breadcrums-->

            <div>
                <table id="checkoutTable">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>

            <div class="shopper-informations">
                <div class="row">
                    <div class="col-sm-6 clearfix">
                        <div class="bill-to">
                            <p>Podaci o porudžbini</p>
                            <div class="form-one">
                                <form>
                                    <input type="text" placeholder="Ulica i broj *" id="street_and_no">
                                    <input type="text" placeholder="Poštanski broj *" id="zip_code">
                                    <input type="text" placeholder="Grad *" id="city">
                                    <input type="text" placeholder="Telefon *" id="phone">
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="payment-options">
                <p>Trenutno je omogućeno samo plaćanje pouzećem</p>
            </div>
            <button class="btn btn-primary btn-order">Poruči</button>
        </div>
    </section> <!--/#cart_items-->
@endsection
