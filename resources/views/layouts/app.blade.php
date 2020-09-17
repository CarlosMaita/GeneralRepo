<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    @yield('captcha')
</head>
<body>
    <div id="app">
        @if(isset($navbar_null))

        @else
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">

                <a class="navbar-brand" href="{{ url('/') }}">
                    @if(isset($logo))
                        <img src="{{asset('storage/'.$logo->image)}}" width="40" height="40" alt="logo">
                    @else
                        LOGO
                    @endif
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item">
                            <a href="{{route('productos')}}" class="nav-link">Productos</a>
                        </li>
                        <li class="nav-item dropdown" id="cart_main">
                            <a id="carritoDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                Carrito
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" id="cart_body" aria-labelledby="carritoDropdown">
                            </div>
                        </li>
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <!--ul class="navbar-nav ml-auto"-->
                        <!-- Authentication Links -->
                        @guest
                            <!--li-- class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </!--li-->
                            @if (Route::has('register'))
                                <!--li-- class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </!--li-->
                            @endif
                        @else
                            <!--li-- class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <!--div-- class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </!--div-->
                            <!--/li-->
                        @endguest
                    <!--/ul-->
                </div>
            </div>
        </nav>
        @endif
        <main class="">
            @yield('content')
        </main>
    </div>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script type="text/javascript">
        document.addEventListener('DOMContentLoaded', () => {
            let cart_main = document.getElementById('cart_main'),
                cart_body = document.getElementById('cart_body');

            if(cart_main)
            {
               //getCart()
            }else {
                console.log('no existe');
            }

        });

        function getCart()
        {
            cart_body.innerHTML = ''
            axios.get('/cart')
             .then(response => {
                 updateCart(response.data, cart_body);
             })
        }


        function updateCart(details, body)
        {
            if(details.length > 0)
            {
                let contador = 0;

                details.forEach(detail => {
                    body.innerHTML += `
                    <div class="text-center p-2">
                        <h6 >${detail.title}</h6>
                    </div>
                `
                });


            }else {
                body.innerHTML = `
                    <p>No hay productos </p>
                `
            }
        }
    </script>
</body>
</html>
