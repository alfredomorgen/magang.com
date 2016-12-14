<style>
    .tabs .indicator{
        background-color: white;
    }
</style>
<div class="nav-extended">
    <div class="nav-wrapper">
        <ul class="tabs tabs-fixed-width z-depth-1">
            @if(Auth::guest())
                <li class="tab"><a target="_self" href="{{url('/')}}" style="color:#757575">Home</a></li>
                <li class="tab"><a target="_self" href="{{route('index_company')}}" style="color:#757575">Search Company</a></li>
            @elseif(Auth::user()->role == \App\Constant::user_admin)
                <li class="tab"><a target="_self" href="{{url('/home')}}" style="color:#757575">Home</a></li>
                <li class="tab"><a target="_self" href="{{url('/admin/search_jobseeker') }}" style="color:#757575">Search Jobseeker</a></li>
                <li class="tab"><a target="_self" href="{{url('/admin/search_company')}}" style="color:#757575">Search Company</a></li>
                <li class="tab"><a target="_self" href="{{url('/admin/search_job')}}" style="color:#757575">Search Job</a></li>
            @elseif(Auth::user()->role == \App\Constant::user_company)
                <li class="tab"><a target="_self" href="{{url('/home')}}" style="color:#757575">Home</a></li>
                <li class="tab"><a target="_self" href="{{url('/company/search_jobseeker')}}" style="color:#757575">Search Job Seeker</a></li>
                <li class="tab"><a target="_self" href="{{ url('/company/bookmark_jobseeker') }}" style="color:#757575">Bookmark Job Seeker</a></li>
                <li class="tab"><a target="_self" href="{{ url('/company/manage_post') }}" style="color:#757575">Manage Posts</a></li>
                <li class="tab"><a target="_self" href="{{ route('company.index', Auth::user()->id) }}" style="color:#757575">Profile</a></li>
            @elseif(Auth::user()->role == \App\Constant::user_jobseeker)
                <li class="tab"><a target="_self" href="{{url('/home')}}" style="color:#757575">Home</a></li>
                <li class="tab"><a target="_self" href="{{route('index_company')}}" style="color:#757575">Search Company</a></li>
                <li class="tab"><a target="_self" href="{{ route('jobseeker.bookmark_index') }}" style="color:#757575">Bookmarks</a></li>
                <li class="tab"><a target="_self" href="{{ route('jobseeker.index', Auth::user()->id) }}" style="color:#757575">Profile</a></li>
                <li class="tab"><a target="_self" href="{{ route('jobseeker.applied_jobs') }}" style="color:#757575">Applied Jobs </a></li>
            @endif
        </ul>
    </div>
</div>

