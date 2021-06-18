<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="author" content="">
    <title>Home | E-Shopper</title>
    <link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('css/font-awesome.min.css')}}" rel="stylesheet">
    <link href="{{asset('css/prettyPhoto.css')}}" rel="stylesheet">
    <link href="{{asset('css/animate.css')}}" rel="stylesheet">
    <link href="{{asset('css/app.css')}}" rel="stylesheet">
    <link href="{{asset('css/responsive.css')}}" rel="stylesheet">
    <!--[if lt IE 9]>
    <script src="{{asset('js/html5shiv.js')}}"></script>
    <script src="{{asset('js/respond.min.js')}}"></script>
    <![endif]-->
    <link rel="shortcut icon" href="{{asset('images/ico/favicon.ico')}}">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="{{asset('images/ico/apple-touch-icon-144-precomposed.png')}}">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="{{asset('images/ico/apple-touch-icon-114-precomposed.png')}}">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="{{asset('images/ico/apple-touch-icon-72-precomposed.png')}}">
    <link rel="apple-touch-icon-precomposed" href="{{asset('images/ico/apple-touch-icon-57-precomposed.png')}}">
</head><!--/head-->

<body>
<header id="header"><!--header-->
    <div class="header_top"><!--header_top-->
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    <div class="contactinfo">
                        <ul class="nav nav-pills">
                            <li><a href="#"><i class="fa fa-phone"></i> +2 95 01 88 821</a></li>
                            <li><a href="#"><i class="fa fa-envelope"></i> info@domain.com</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="social-icons pull-right">
                        <ul class="nav navbar-nav">
                            <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                            <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                            <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                            <li><a href="#"><i class="fa fa-dribbble"></i></a></li>
                            <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div><!--/header_top-->

    <div class="header-middle"><!--header-middle-->
        <div class="container">
            <div class="row">
                <div class="col-sm-4">
                    <div class="logo pull-left">
                        <a href="{{route('home')}}"><img src="{{asset('images/home/logo.png')}}" alt="" /></a>
                    </div>
                    <!--<div class="btn-group pull-right">
                        <div class="btn-group">
                            <button type="button" class="btn btn-default dropdown-toggle usa" data-toggle="dropdown">
                                Srbija
                                <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu">
                                <li><a href="#">Srbija</a></li>
                                <li><a href="#">Hrvatska</a></li>
                                <li><a href="#">BIH</a></li>
                                <li><a href="#">Crna Gora</a></li>
                            </ul>
                        </div>

                        <div class="btn-group">
                            <button type="button" class="btn btn-default dropdown-toggle usa" data-toggle="dropdown">
                                Dinar
                                <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu">
                                <li><a href="#">Dinar</a></li>
                                <li><a href="#">Kuna</a></li>
                                <li><a href="#">Marka</a></li>
                                <li><a href="#">Evro</a></li>
                            </ul>
                        </div>
                    </div>-->
                </div>
                <div class="col-sm-8">
                    <div class="shop-menu pull-right">
                        <ul class="nav navbar-nav">
                            <li><a href="{{route('login')}}"><i class="fa fa-star"></i> Lista želja</a></li>
                            <li><a href="{{route('cart')}}"><i class="fa fa-shopping-cart"></i> Korpa</a></li>
                            @if(session()->has('user'))
                                @if(session()->get('user')->role_id == 1)
                                    <li><a href="{{route('admin')}}"><i class="fa fa-shield"></i> Admin</a></li>
                                @endif
                                <li><a href="{{route('account')}}"><i class="fa fa-user"></i> Moj nalog</a></li>
                                <li><a href="{{route('logout')}}"><i class="fa fa-lock"></i> Odjava</a></li>
                            @else
                                <li><a href="{{route('login')}}"><i class="fa fa-lock"></i> Prijava</a></li>
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div><!--/header-middle-->

    <div class="header-bottom"><!--header-bottom-->
        <div class="container">
            <div class="row">
                <div class="col-sm-9">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                    </div>
                    <div class="mainmenu pull-left">
                        <ul class="nav navbar-nav collapse navbar-collapse">
                            <li><a href="{{route('home')}}">Početna</a></li>
                            <li><a href="{{route('shop')}}">Svi proizvodi</a></li>
                            <li><a href="{{route('contact')}}">Kontakt</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="search_box pull-right">
                        <input type="text" placeholder="Pretraga"/>
                    </div>
                </div>
            </div>
        </div>
    </div><!--/header-bottom-->
</header><!--/header-->
