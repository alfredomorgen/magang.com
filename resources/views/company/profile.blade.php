@extends('layouts.app')
@section('title', $user->name)
@section('content')
    <div class="container">
        <div class="row">
            <!-- Grey navigation panel -->
            @section('navbar')
                @include('layouts.navbar')
            @show
        </div>
        <div class="row">
            <div class="col s12 m12">
                <div class="card">
                    <span class="center truncate card-title grey-text text-darken-2" style="padding-top: 20px"><b>{{ $user->name }}</b></span>
                    <div class="card-content grey-text text-darken-2">
                        <div class="row">
                            <div class="col">
                                @if($user->photo == NULL)
                                    <img src="{{ asset(\App\Constant::default_photo) }}" style="width:150px; height:150px">
                                @else
                                    <img src="{{ asset('images/'.$user->photo) }}" style="width:150px; height:150px">
                                @endif
                                {{--wait--}}
                                <div class="row">
                                    <div class="center-align">
                                        @if(Auth::guest())
                                        @elseif($user->id == Auth::user()->id)
                                            <a href="{{ route('company.edit', $user->id) }}" class="btn-floating btn-small red tooltipped" data-tooltip="Edit Profile">
                                                <i class="material-icons">mode_edit</i>
                                            </a>
                                        @endif
                                    </div>
                                </div>
                                {{--wait--}}

                                @if(Auth::guest())
                                @elseif(Auth::user()->role == \App\Constant::user_jobseeker)
                                <div class="center">
                                    @if(\App\Bookmark::where('user_id', '=', Auth::user()->id)->where('target', '=', $user->company->id)->where('type', '=', \App\Constant::user_company)->first() == null)
                                        <a class="tooltipped btn-floating btn-small waves-effect waves-light grey" data-tooltip="Bookmark Company" href="{{ route('jobseeker.bookmark_add_company', $user->id) }}"><i class="material-icons">star</i></a>
                                    @else
                                        <a class="tooltipped btn-floating btn-small waves-effect waves-light yellow darken-2" data-tooltip="Company already bookmarked" href="{{ route('jobseeker.bookmark_remove_company', $user->id) }}"><i class="material-icons">star</i></a>
                                    @endif
                                </div>
                                @endif
                            </div>

                            <div class="col l9">
                                <ul class="collapsible" data-collapsible="expandable">
                                    <li>
                                        <div class="collapsible-header cyan-text hoverable active"><i class="material-icons">contacts</i>Information</div>
                                        <div class="collapsible-body">
                                            <p>
                                                <i class="tiny material-icons">work</i>Company Name: {{ $user->name }}<br>
                                                <br>
                                                <i class="tiny material-icons">location_on</i> {{ $user->location }}<br>
                                                <i class="tiny material-icons">mail</i> {{ $user->email }}<br>
                                                <i class="tiny material-icons">phone</i> {{ $user->phone }}<br>
                                                <i class="tiny material-icons">label_outline</i> {{ $user->company->industry }}<br>
                                                <i class="tiny material-icons">supervisor_account</i> {{ $user->company->size }} people<br>
                                                <i class="tiny material-icons">language</i> {{ $user->company->website }}<br>
                                            </p>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="collapsible-header cyan-text hoverable active"><i class="material-icons">receipt</i>Description</div>
                                        <div class="collapsible-body"><p>{{$user->description}}</p></div>
                                    </li>
                                    <li>
                                        <div class="collapsible-header cyan-text hoverable active"><i class="material-icons">list</i>Jobs</div>
                                        <div class="collapsible-body red">
                                            @foreach($jobs as $job)
                                                <div class="card" style="margin:0px">
                                                    <div class="card-content">
                                                        <span class="card-title activator orange-text text-darken-4">{{$job->name}}<i class="material-icons right">more_vert</i></span><br>
                                                        <span><i class="material-icons tiny">location_on</i> {{$job->location}}</span><br>
                                                        <span><i class="material-icons tiny">av_timer</i>@if($job->type ==\App\Constant::job_fulltime) Full Time @else Part Time @endif</span><br>
                                                        <span><i class="material-icons tiny">schedule</i> {{$job->period}} Months</span><br>
                                                        <span><i class="material-icons tiny">payment</i>@if($job->salary ==\App\Constant::job_paid) Paid @else Not Paid @endif</span><br>
                                                        <button class="btn orange "><a class="white-text" href="{{route('job.index',$job->id)}}">View</a></button>
                                                        <span class="right">Posted : {{$job->created_at}}</span>
                                                    </div>
                                                    <div class="card-reveal">
                                                        <span class="card-title grey-text text-darken-4">Job Description<i class="material-icons right">close</i></span>
                                                        {{$job->description}}
                                                    </div>
                                                </div>
                                            @endforeach

                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function () {
            $('.collapsible').collapsible();
            Materialize.toast('{{ session('message') }}', 3000, 'rounded');
        });
    </script>
@endsection
