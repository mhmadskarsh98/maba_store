{{-- <!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
</html> --}}


<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Page Title</title>

    <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
          rel="stylesheet" />
    <link rel="stylesheet" href="https://bootswatch.com/4/materia/bootstrap.min.css">
</head>
<body>
    <nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-primary">
        <a class="navbar-brand" href="/">Maba</a>
        <button class="navbar-toggler"
                type="button"
                data-toggle="collapse"
                data-target="#navbarColor01"
                aria-controls="navbarColor01"
                aria-expanded="false"
                aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarColor01">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="/">Home<span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item"><a href="/" class="nav-link">Products</a></li>
                <li class="nav-item"><a href="/about" class="nav-link">About</a></li>
            </ul>
            <div class="form-inline my-2 my-lg-0">
                <input id="search" class="form-control mr-sm-2 ml-15"
                       type="text"
                       placeholder="Search" />
                <a href="/cart" class="p-cart">
                    <span class="material-icons md-48 " style="color: black;">shopping_cart</span>
                    @guest
                    <span class="badge badge-light bg-secondary">0</span>
                    @else
                    <span class="badge badge-light bg-secondary">{{Auth::user()->products()->sum('count')}}</span>
                    @endguest
                </a>
                @guest
                <a href="/register" class="btn btn-secondary my-2 my-sm-0 ml-4">Sign up</a>
                <a href="/login" class="btn btn-secondary my-2 my-sm-0 ml-2">Login</a>
                @else
                <div class="form-inline my-2 my-lg-0">
                        <a href="/profile" class="btn btn-secondary my-2 my-sm-0 ml-4">Profile</a>
                        <a href="/logout" class="btn btn-danger my-2 my-sm-0 ml-2">LogOut</a>
                </div>
                @endguest


            </div>
        </div>
    </nav>

    <div class="container" style="margin-top:100px">
        @yield('content')

        <footer class="my-5 pt-5 text-muted text-center text-small">
            <p class="mb-1">© 2017-2018 Maba</p>
            <ul class="list-inline">
                <li class="list-inline-item"><a href="#">Privacy</a></li>
                <li class="list-inline-item"><a href="#">Terms</a></li>
                <li class="list-inline-item"><a href="#">Support</a></li>
            </ul>
        </footer>
    </div>
    <input type="hidden" id="token" value="{{ csrf_token() }}">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script>
            $("#search").keyup(function(){
                var text = $("#search").val();
                var token = $("#token").val();
                $.post('/search' , {text : text , _token : token}).done(function(data){
                    $("#products").replaceWith(data);
                });
            });
            $("#add").click(function(){
                var data = $("#addUserForm").serialize();
                $.post("/admin/users" , data).done(function(data){
                       $("#myModal").modal("hide");
                       $("#users").replaceWith(data);
                });
            });

            $(".edit").click(function(){
                var id = $(this).data("id");
                $.get(`/admin/users/${id}/edit`).done(function(data){
                    $("#editModal").replaceWith(data);
                    $("#editModal").modal("show");
                });
            });

            $(document).on('click' ,'#edit' , function(){
                var data = $("#editUserForm").serialize();
                var id = $("#editUserForm").data('id');
                $.post(`/admin/users/${id}` , data).done(function(data){
                    $("#users").replaceWith(data);
                    $("#editModal").modal("hide");
                });
            });


            // $(".delete").click(function(){
            //     var id = $(this).data("id");
            //     var token = $("#token").val();
            //     $.post(`/admin/users/${id}`, { "_method" : "delete" , "_token" : token}).done(function(data){
            //         $("#users").replaceWith(data);
            //     });
            // });

           $(document).on('click' ,'.delete' , function(){
                var id = $(this).data("id");
                $.get(`/admin/users/delete/${id}`).done(function(data){
                    $("#users").replaceWith(data);
                });
            });
    </script>
</body>
</html>
