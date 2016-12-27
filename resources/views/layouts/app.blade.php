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
    <link type="text/css" rel="stylesheet" href="{{ asset('css/materialize.min.css') }}" media="screen,projection"/>
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
            animation-name: animatebottom;
            animation-duration: 1s
        }

        @keyframes animatebottom {
            from {
                bottom: -100px;
                opacity: 0
            } to {
                bottom: 0;
                opacity: 1
            }
        }

        body {
            display: flex;
            min-height: 100vh;
            flex-direction: column;
        }

        main {
            flex: 1 0 auto;
        }
    </style>
</head>

<body style="background-image: url({{ asset('images/office.jpg') }}); background-color: #eeeeee; background-repeat: no-repeat; background-attachment: fixed; background-size: 100% auto;">
    <nav class="@if(Auth::guest() || Auth::user()->role == \App\Constant::user_jobseeker) light-blue lighten-1 @elseif(Auth::user()->role == \App\Constant::user_admin) red @else orange darken-3  @endif" role="navigation">
        <div class="nav-wrapper container">
            <a id="logo-container" href="/" class="brand-logo">Magang</a>
            <ul class="right hide-on-med-and-down">
                @if (Auth::guest())
                    <li><a class="dropdown-button" href="#" data-activates="dropdownLogin" data-constrainwidth="false" data-beloworigin="true">Login</a></li>

                    <ul id="dropdownLogin" class="dropdown-content white">
                        <li><a href="{{ url('/login/1') }}" class="black-text"><h6>As Company</h6></a></li>
                        <li><a href="{{ url('/login/2') }}" class="black-text"><h6>As Jobseeker</h6></a></li>
                    </ul>

                    <li><a class="dropdown-button" href="#!" data-activates="dropdownRegister" data-beloworigin="true">Register</a></li>

                    <ul id="dropdownRegister" class="dropdown-content white">
                        <li><a href="{{ url('/register/1') }}" class="black-text"><h6>Company</h6></a></li>
                        <li><a href="{{ url('/register/2') }}" class="black-text"><h6>Jobseeker</h6></a></li>
                    </ul>
                @else
                    <li>
                        <a id="notificationBox" class="dropdown-button" data-activates="dropdownNotifications" data-beloworigin="true" data-constrainwidth="false">
                            <div class="row">
                                <i class="material-icons left">chat_bubble_outline</i>
                                @if(Auth::user()->notification->where('read_at','=',NULL)->count() != 0)
                                    <span class="new badge white red-text" id="notificationCount" data-badge-caption="">{{Auth::user()->notification->where('read_at','=',NULL)->count()}}</span>
                                @endif
                            </div>
                        </a>
                    </li>

                    <ul id="dropdownNotifications" class="dropdown-content lighten-4" style="width:420px;">
                        <ul class="collection" style="margin:0px">
                            @if(Auth::user()->notification->count() ==0)
                                <li class="collection-tem avatar">
                                    <span class="grey-text">No Notification</span>
                                </li>
                            @else
                                @foreach (Auth::user()->notification->sortByDesc('created_at') as $notification)
                                    <li class="collection-item avatar">
                                        @if(Auth::user()->role == \App\Constant::user_company)
                                            <p class="hide">{{ $jobseeker = \App\Jobseeker::find($notification->notifiable_id)}}
                                            {{$job = \App\Job::find($notification->data)}}</p>

                                            <a href="{{ route('jobseeker.index', $jobseeker->user->id) }}" style="padding:0px;"><img src="{{asset('images/'.$jobseeker->user->photo)}}" onerror="this.src='{{ asset('images/profile_default.jpg') }}'" class="circle hoverable"  style="width:42px;height:42px;"></a>
                                            <p>
                                                {{$jobseeker->user->name}}<br>
                                                <a  href="{{route('job.index',$job->id)}}" class="blue-text" style="padding:0px;">has applied as {{$job->name}}</a>
                                                <p class="grey-text right">{{ $notification->created_at->diffForHumans()}}</p>
                                            </p>
                                        @elseif(Auth::user()->role ==\App\Constant::user_jobseeker)
                                            <p class="hide">{{ $company = \App\Company::find($notification->notifiable_id)}}
                                                {{$job = \App\Job::find($notification->data)}}</p>

                                            <a href="{{ route('company.index', $company->user->id) }}" style="padding:0px;"><img src="{{asset('images/'.$company->user->photo)}}" onerror="this.src='{{ asset('images/profile_default.jpg') }}'" class="circle hoverable" style="width:42px;height:42px;"></a>
                                            <p>
                                                You has been approved as<br>
                                                <a  href="{{route('job.index',$job->id)}}" class="blue-text" style="padding:0px;">{{$job->name}}</a>
                                                {{$company->user->name}}<br>
                                                <p class="grey-text text-accent-3">Please wait for the information from the company</p>
                                            <p class="grey-text right">{{ $notification->created_at->diffForHumans()}}</p>
                                            </p>
                                        @elseif(Auth::user()->role ==\App\Constant::user_admin)
                                            <p class="hide">
                                                {{$job = \App\Job::find($notification->data)}}
                                                {{$jobseeker = \App\User::find($notification->notifiable_id)}}</p>

                                            <a href="{{ route('company.index', $jobseeker->name) }}" style="padding:0px;"><img src="{{asset('images/'.$jobseeker->photo)}}" onerror="this.src='{{ asset('images/profile_default.jpg') }}'" class="circle hoverable" style="width:42px;height:42px;"></a>
                                            <p>
                                                {{$jobseeker->name}}
                                                <a  href="{{route('job.index',$job->id)}}" class="blue-text" style="padding:0px;">has reported {{$job->name}}</a>
                                                {{$job->company->user->name}}<br>
                                            <p class="grey-text right">{{ $notification->created_at->diffForHumans()}}</p>
                                            </p>
                                        @endif
                                    </li>
                                @endforeach
                            @endif
                        </ul>
                    </ul>

                    <li><a class="dropdown-button" href="#!" data-activates="dropdownLogout" data-beloworigin="true">{{ Auth::user()->name }}</a></li>

                    <ul id="dropdownLogout" class="dropdown-content orange lighten-4">
                        <li>
                            <a href="{{ url('/logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                            <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                            </form>
                        </li>
                    </ul>
                @endif
            </ul>

            @include('layouts.nav-mobile')
            <a href="#" data-activates="nav-mobile" class="button-collapse"><i class="material-icons">menu</i></a>
        </div>
    </nav>

    <main class="animate-bottom">
        @yield('content')
    </main>

    <footer class="page-footer" style="display: none; background-image: url({{ asset('images/footers7.jpg') }}); background-repeat: no-repeat; background-size: 100% auto;">
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

    @yield('scripts')

    <script>
        $(document.body).ready(function(){
            $(".animate-bottom").css("display", "block");
            setTimeout(function(){
                $("footer").fadeIn(1000);
            }, 100);
        });

        $(document).ready(function () {
            $("#notificationBox").on("click", function () {
                $.ajax({
                    method: "get",
                    url: '/home/readNotifications',
                }).done(function () {
                    $("#notificationCount").remove();
                });
            });
        });
    </script>
</body>
</html>
