<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@if(View::hasSection('title')) @yield('title') @else {{ config('app.name', 'Magang.com') }} @endif</title>
    <!--Import Google Icon Font-->
    <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <!-- Styles -->
    <link type="text/css" rel="stylesheet" href="{{asset('css/materialize.min.css')}}" media="screen,projection"/>
    <link rel="shortcut icon" href="{{ asset('images/favicon.ico') }}">
{{--<div>Icons made by <a href="http://www.flaticon.com/authors/icon-works" title="Icon Works">Icon Works</a> from <a href="http://www.flaticon.com" title="Flaticon">www.flaticon.com</a> is licensed by <a href="http://creativecommons.org/licenses/by/3.0/" title="Creative Commons BY 3.0" target="_blank">CC 3.0 BY</a></div>--}}

<!-- Scripts -->
    <script>
        window.Laravel = <?php echo json_encode(['csrfToken' => csrf_token(),]); ?>
    </script>

    <script type="text/javascript" src="{{ asset('https://code.jquery.com/jquery-2.1.1.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/materialize.min.js') }}"></script>
    <script src="{{asset('/js/init.js')}}"></script>

    <style>
        /* Add animation to "page content" */
        .animate-bottom {
            display: none;
            position: relative;
            -webkit-animation-name: animatebottom;
            -webkit-animation-duration: 1s;
            animation-name: animatebottom;
            animation-duration: 1s
        }

        @-webkit-keyframes animatebottom {
            from { bottom:-100px; opacity:0 }
            to { bottom:0px; opacity:1 }
        }

        @keyframes animatebottom {
            from{ bottom:-100px; opacity:0 }
            to{ bottom:0; opacity:1 }
        }

        body #myDiv {
            display: flex;
            min-height: 100vh;
            flex-direction: column;
        }

        main {
            flex: 1 0 auto;
        }
    </style>

</head>

<body style="background-image: url({{asset('images/office.jpg')}}); background-color:#eeeeee; background-repeat:no-repeat;background-attachment: fixed; background-size:  1600px 768px;" onload="myFunction()">
<div id="myDiv" class="animate-bottom">
    <nav class="@if(Auth::guest() || Auth::user()->role == \App\Constant::user_jobseeker) light-blue lighten-1 @elseif(Auth::user()->role == \App\Constant::user_admin) red @else orange darken-3  @endif" role="navigation">
        <div class="nav-wrapper container">
            <a id="logo-container" href="/" class="brand-logo">Magang</a>
            <ul class="right hide-on-med-and-down" >
                @if (Auth::guest())
                    <ul id="dropdown2" class="dropdown-content white" style="margin-top:64px;">
                        <li><a href="{{ url('/login/1') }}" class="black-text"><h6>As Company</h6></a></li>
                        <li><a href="{{ url('/login/2') }}" class="black-text"><h6>As Jobseeker</h6></a></li>
                    </ul>

                    <li><a class="dropdown-button" href="#!" data-activates="dropdown2">Login</a></li>

                    <ul id="dropdown3" class="dropdown-content white" style="margin-top:64px;">
                        <li><a href="{{ url('/register/1') }}" class="black-text"><h6>Company</h6></a></li>
                        <li><a href="{{ url('/register/2') }}" class="black-text"><h6>Jobseeker</h6></a></li>
                    </ul>

                    <li><a class="dropdown-button" href="#!" data-activates="dropdown3">Register</a></li>
                @else
                    <ul id="dropdown2" class="dropdown-content orange lighten-4" style="margin-top:64px;">
                        {{--<li><a href="{{ url('/logout') }}" class="black-text">Logout</a></li>--}}
                        <li>
                            <a href="{{ url('/logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                            <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                            </form>
                        </li>

                    </ul>

                    <ul id="dropdownNotifications" class="dropdown-content orange lighten-4" style="margin-top:64px;">
                        <li><a href="#!" class="black-text">Notifications</a></li>
                    </ul>

                    <li><a class="dropdown-button" href="#!" data-activates="dropdownNotifications"><i class="material-icons">chat_bubble_outline</i></a></li>
                    <li><a class="dropdown-button" href="#!" data-activates="dropdown2">{{ Auth::user()->name }}</a></li>
                @endif
            </ul>

            <ul id="nav-mobile" class="side-nav">
                @if (Auth::guest())
                    <ul id="dropdown4" class="dropdown-content white" style="margin-top:64px;">
                        <li><a href="{{ url('/login/1') }}" class="black-text"><h6>As Company</h6></a></li>
                        <li><a href="{{ url('/login/2') }}" class="black-text"><h6>As Jobseeker</h6></a></li>
                    </ul>

                    <li><a class="dropdown-button" href="#!" data-activates="dropdown4">Login</a></li>

                    <ul id="dropdown5" class="dropdown-content white" style="margin-top:64px;">
                        <li><a href="{{ url('/register/1') }}" class="black-text"><h6>Company</h6></a></li>
                        <li><a href="{{ url('/register/2') }}" class="black-text"><h6>Jobseeker</h6></a></li>
                    </ul>

                    <li><a class="dropdown-button" href="#!" data-activates="dropdown5">Register</a></li>
                @else
                    <ul id="dropdown6" class="dropdown-content orange lighten-4" style="margin-top:64px;">
                        <li><a href="{{ url('/logout') }}" class="black-text">Logout</a></li>
                    </ul>

                    <a class="dropdown-button" href="#!" data-activates="dropdown6">{{ Auth::user()->name }}</a>
                @endif
            </ul>

            <a href="#" data-activates="nav-mobile" class="button-collapse"><i class="material-icons">menu</i></a>
        </div>
    </nav>

    <main>
        @yield('content')
    </main>

    <footer class="page-footer" style=" background-image: url({{asset('images/footers7.jpg')}}); background-repeat:no-repeat; background-size: 100% auto;">
        <div class="container">
            <div class="row">
                <div class="col l6 s12">
                    <h5 class="white-text">Magang Internship</h5>
                    <p class="white-text text-lighten-4">We help you find the right place for Internship.</p>
                </div>
                <div class="col l4 offset-l2 s12">
                    <h5 class="white-text">Contact</h5>
                    <ul>
                        <li><a class="white-text text-lighten-4" href="https://www.facebook.com/AlfredoMorgen">Alfredo (alfredo7romero@gmail.com)</a></li>
                        <li><a class="white-text text-lighten-4" href="https://www.facebook.com/axel.soedarsono">Axel (axelso@live.com)</a></li>
                        <li><a class="white-text text-lighten-4" href="https://www.facebook.com/hashner.edward">Hashner (edwardhashner@gmail.com)</a></li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="footer-copyright">
            <div class="container white-text text-lighten-4">
                © 2016 Copyright Magang Internship
                <a class="white-text text-lighten-4 right" href="#!"></a>
            </div>
        </div>
    </footer>
</div>
@yield('scripts')
<script>
    var myVar;

    function myFunction() {
        myVar = setTimeout(showPage, 100);
    }

    function showPage() {
        document.getElementsByClassName("animate-bottom")[0].style.display = "block";
    }
</script>
</body>
</html>
