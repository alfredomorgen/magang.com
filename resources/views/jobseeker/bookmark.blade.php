@extends('layouts.app')
@section('title', 'Bookmark')
@section('content')
<style>
    ul li span{
        font-size:20px;
    }
    ul li .active{
        padding-left: 8px;
        padding-right:8px;
    }
</style>

<div class="container">
    <div class="row">
        @section('navbar')
            @include('layouts.navbar')
        @show
    </div>

    <ul class="collection z-depth-1 grey-text text-darken-2">
        <div class="collection-item orange darken-1 center white-text">
            <h6><strong>BOOKMARK</strong></h6>
        </div>

        @if($job_bookmarks->count() == 0 && $company_bookmarks->count() == 0)
            <li class="collection-item avatar center grey-text white" style="padding-left:10px">
                <span>No Bookmark</span>
            </li>
        @else
            {{---------------------}}
            {{----Job Bookmarks----}}
            {{---------------------}}
            @if($job_bookmarks->count() > 0)
                @foreach($job_bookmarks as $job_bookmark)
                    @php
                        $job = \App\Job::find($job_bookmark->target);
                    @endphp
                    <li class="collection-item avatar" style="padding-left:10px">
                        <div class="row" style="margin-bottom:auto">
                            <div class="col m2 l2">
                                <img src="{{ asset('images/'.$job->company->user->photo) }}" class="responsive-img">
                            </div>
                            <div class="col m10 l10">
                                <span class="card-title">{{ $job->name }}</span>
                                <br>
                                <div class="row">
                                    <div class="col m7 l7">
                                        <i class="material-icons">work</i></a> {{ $job->company->user->name }}<br>
                                        <i class="material-icons">location_on</i></a>{{ $job->location }}
                                    </div>
                                    <div class="col m5 l5">
                                        <i class="material-icons">av_timer</i></a>@if($job->type == \App\Constant::job_parttime) Part Time @else Full Time @endif<br>
                                        <i class="material-icons">payment</i></a>@if($job->salary == \App\Constant::job_paid) Paid @else Not Paid @endif
                                    </div>
                                </div>
                                <a href="{{ route('job.index', $job->id) }}" class="waves-effect waves-light btn orange darken-2">View</a>
                                <a href="{{ route('jobseeker.bookmark_remove', $job_bookmark->id) }}"><i class="tooltipped material-icons right red-text lighten-1" data-tooltip="Delete Bookmark">not_interested</i></a>
                            </div>
                        </div>
                    </li>
                @endforeach
            </ul>
            @endif

            {{---------------------}}
            {{--Company Bookmarks--}}
            {{---------------------}}
            @if($company_bookmarks->count() > 0)
            <ul class="collection z-depth-1 grey-text text-darken-2">
                @foreach($company_bookmarks as $company_bookmark)
                    @php
                        $company = \App\Company::find($company_bookmark->target);
                    @endphp
                    <li class="collection-item avatar" style="padding-left:10px">
                        <div class="row" style="margin-bottom:auto">
                            <div class="col m2 l2">
                                @if($company->user->photo == NULL)
                                    <img src="{{ asset('images/profile_default.jpg') }}" class="responsive-img">
                                @else
                                    <img src="{{ asset('images/'.$company->user->photo) }}" class="responsive-img">
                                @endif
                            </div>

                            <div class="col m10 l10">
                                <span class="card-title">{{ $company->user->name }}</span><br>
                                <i class="tiny material-icons darken-1">location_on</i>{{ $company->user->location }}<br>
                                <i class="tiny material-icons darken-1">supervisor_account</i> {{ $company->size }} Employees<br>
                                <i class="tiny material-icons darken-1">assignment</i> {{ count($company->job) }} Jobs Registered
                                <br>
                                <a href="{{ route('company.index', $company->user->id) }}" class="waves-effect waves-light btn orange darken-2">View</a>
                                <a href="{{ route('jobseeker.bookmark_remove', $company_bookmark->id) }}"><i class="tooltipped material-icons right red-text lighten-1" data-tooltip="Delete Bookmark">not_interested</i></a>
                            </div>
                        </div>
                    </li>
                @endforeach
            </ul>
            @endif
        @endif
</div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function () {
            Materialize.toast('{{ session('message') }}', 3000, 'rounded');
        });
    </script>
@endsection