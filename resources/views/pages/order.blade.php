@extends('layouts/main')
@section('content')
<section>
    <div class="container">
        <div id="orderWrapper">
            <div class="header">
                <p>Order No. {{$order->id}}</p>
                <p>At {{$order->created_at}}</p>
            </div>
            <table class="customTable">
                <tbody>
                <tr>
                    <td><strong>Name</strong></td>
                    <td>{{$order->user->name}}</td>
                </tr>
                <tr>
                    <td><strong>E-mail</strong></td>
                    <td>{{$order->user->email}}</td>
                </tr>
                <tr>
                    <td><strong>Address</strong></td>
                    <td>{{$order->address}}, {{$order->zip_code}} {{$order->city}}</td>
                </tr>
                </tbody>
            </table>
            <div class="yellow">
                <p>Products <i class="fa fa-arrow-down"></i></p>
            </div>
            <table class="customTable">
                <thead>
                <tr>
                    <th>Name</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Total</th>
                </tr>
                </thead>
                <tbody>
                @foreach($order->items as $item)
                    <tr>
                        <td><a target="_blank" href="/products/show/{{$item->product_id}}">{{$item->name}}</a></td>
                        <td>{{$item->quantity}}</td>
                        <td>${{$item->price_then}}</td>
                        <td>${{$item->price_then * $item->quantity}}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <div class="green">
                <p>You'll be charged ${{$order->total}}</p>
            </div>
        </div>
    </div>
</section>
@endsection
