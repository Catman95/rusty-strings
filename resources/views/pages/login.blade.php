@extends('layouts/main')
@section('content')
    <input type="hidden" value="login" id="currentPage">
    <section id="form"><!--form-->
        <div class="container">
            <div class="row">
                <div class="col-sm-4 col-sm-offset-1">
                    <div class="login-form"><!--login form-->
                        <h2>Prijavite se</h2>
                        @if(session()->has('error'))
                            <div class="errorDiv">
                                <p>{{ session()->get('error') }}</p>
                            </div>
                        @endif
                        <form action="{{route('do-login')}}" method="post">
                            @csrf
                            <input type="email" placeholder="Email adresa" name="email" value="{{old('email')}}"/>
                            @error('email')
                            <p class="error">{{$message}}</p>
                            @enderror
                            <input type="password" placeholder="Lozinka" name="password">
                            @error('password')
                            <p class="error">{{$message}}</p>
                            @enderror
                            <span>
								<input type="checkbox" class="checkbox">
								Ostavi me prijavljenog
							</span>
                            <button type="submit" class="btn btn-default">Prijavi se</button>
                        </form>
                    </div><!--/login form-->
                </div>
                <div class="col-sm-1">
                    <h2 class="or">ILI</h2>
                </div>
                <div class="col-sm-4">
                    <div class="signup-form"><!--sign up form-->
                        <h2>Napravite nalog</h2>
                        <form action="{{route('do-register')}}" method="post">
                            @csrf
                            <input type="text" placeholder="Ime i Prezime" name="name"/>
                            @error('name')
                            <p class="error">{{$message}}</p>
                            @enderror
                            <input type="email" placeholder="Email adresa" name="email"/>
                            @error('email')
                            <p class="error">{{$message}}</p>
                            @enderror
                            <input type="password" placeholder="Lozinka" name="password"/>
                            @error('password')
                            <p class="error">{{$message}}</p>
                            @enderror
                            <input type="password" placeholder="Lozinka ponovo" name="password_confirmation"/>
                            @error('password_confirmation')
                            <p class="error">{{$message}}</p>
                            @enderror
                            <button type="submit" class="btn btn-default">Registruj se</button>
                        </form>
                    </div><!--/sign up form-->
                </div>
            </div>
        </div>
    </section><!--/form-->
@endsection
