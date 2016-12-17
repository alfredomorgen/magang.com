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
            <li>
                <a href="{{ url('/logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                    {{ csrf_field() }}
                </form>
            </li>
        </ul>

        <li><a id="notificationBox" class="dropdown-button" data-constrainwidth="false" data-activates="dropdownNotifications2">
                <div class="row">
                    <div class="col l3"><i class="material-icons">chat_bubble_outline</i></div>

                    <div id="notificationCount" class="col l1">@if(Auth::user()->notification->where('read_at','=',NULL)->count() != 0)
                        <span class="new badge red" data-badge-caption="">{{Auth::user()->notification->where('read_at','=',NULL)->count()}}@endif</span>
                    </div>
                </div>
            </a>

        <li><a class="dropdown-button" href="#!" data-activates="dropdown6">{{ Auth::user()->name }}</a>
        </li>

        <ul id="dropdownNotifications2" class="dropdown-content lighten-4"
            style="margin-top:64px; width:200px;">
            @if(Auth::user()->notification->count() ==0)
                <li class="collection-tem avatar">
                    <span class="grey-text">No Notification</span>
                </li>
            @else
                @foreach (Auth::user()->notification as $notification)
                    <li class="collection-item avatar">

                        <p class="hide">{{ $jobseeker = \App\Jobseeker::find($notification->notifiable_id)}}
                            {{$job = \App\Job::find($notification->data)}}
                        </p>

                        <a href="{{ route('jobseeker.index', $jobseeker->user->id) }}" style="padding:0px;"><img src="{{asset('images/'.$jobseeker->user->photo)}}" onerror="this.src='{{ asset('images/profile_default.jpg') }}'" class="circle hoverable"></a>
                        <p>
                            {{$jobseeker->user->name}}<br>
                            <a  href="{{route('job.index',$job->id)}}" class="blue-text" style="padding:0px;">has applied as {{$job->name}}</a>
                        <p class="grey-text right">{{ $notification->created_at}}</p>
                        </p>
                    </li>
                @endforeach
            @endif
        </ul>
    @endif
</ul>