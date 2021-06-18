@extends('layouts.main')
@section('content')
    <input type="hidden" value="account" id="currentPage">
    <section>
        <div class="container">
            <h3>Vaši podaci:</h3>
            <form action="{{route('user-update', ['id' => session()->get('user')->id])}}" class="customForm" method="post">
                @if(session()->has('success'))
                    <p class="successMsg">{{session()->get('success')}}</p>
                @endif
                <p>Ukoliko želite da promenite vaše podatke, moraćete da unesete lozinku.</p>
                @csrf
                <label for="name">Ime i prezime</label>
                <input type="text" placeholder="Ime i prezime" value="{{session()->get('user')->name}}" id="name" name="name">
                @error('name')

                @enderror
                <label for="email">E-mail</label>
                <input type="text" placeholder="E-mail" value="{{session()->get('user')->email}}" id="email" name="email">
                @error('email')
                <p class="error">{{$message}}</p>
                @enderror
                <div>
                    <label for="changePassCheckbox">Promeni lozinku</label>
                    <input type="checkbox" id="changePassCheckbox">
                </div>
                <div id="changePassDiv">
                    <label for="newPass">Nova lozinka</label>
                    <input type="password" id="newPass" placeholder="Unesi novu lozinku" name="password">
                    @error('password')
                    <p class="error">{{$message}}</p>
                    @enderror
                    <label for="confirmPass">Potvrdi novu lozinku</label>
                    <input type="password" id="confirmPass" placeholder="Unesi je ponovo" name="password_confirmation">
                    @error('password_confirmation')
                    <p class="error">{{$message}}</p>
                    @enderror
                </div>
                <label for="currentPass">Trenutna lozinka</label>
                <input type="password" id="currentPass" placeholder="Unesi trenutnu lozinku" name="current_password">
                @error('current_password')
                <p class="error">{{$message}}</p>
                @enderror
                <input type="submit">
            </form>
            <!--<h3>Podrazumevani podaci za slanje</h3>
            <form action="" class="customForm">
                <input type="text" placeholder="Ulica i broj">
                <input type="text" placeholder="Poštanski broj">
                <input type="text" placeholder="Grad">
                <input type="text" placeholder="Broj telefona">
                <input type="submit">
            </form>-->
            <h2>Your orders:</h2>
            <table class="customTable">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Address</th>
                    <th>Phone</th>
                    <th colspan="2">Time</th>
                </tr>
                </thead>
                <tbody>
                @foreach($orders as $order)
                    <tr>
                        <td>{{$order->id}}</td>
                        <td>{{$order->address}}, {{$order->zip_code}} {{$order->city}}</td>
                        <td>{{$order->phone}}</td>
                        <td>{{$order->created_at}}</td>
                        <td><a target="_blank" href="/order/show/{{$order->id}}">Open</a></td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </section>
@endsection
