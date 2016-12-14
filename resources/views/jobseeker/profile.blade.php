@extends('layouts.app')
@section('title', $user->name)
@section('content')
    <div class="container">
        <div class="row">
            @section('navbar')
                @include('layouts.navbar')
            @show
        </div>
        @if(session('success'))
            <script>Materialize.toast('{{session('success')}}', 5000, 'rounded');</script>
        @elseif(session('error'))
            <div class="red-text">
                {{session('error')}}
            </div>
        @endif
        <div class="row">
            <div class="col s12">
                <div class="row">
                    <div class="col s12 m12">
                        <div class="card">
                            <div class="card-content grey-text text-darken-2">
                                <div class="row">
                                    @if(Auth::user()->role == \App\Constant::user_company)
                                        <div class="right-align">
                                            @if(\App\Bookmark::where('target','=',\App\User::find($user->id)->jobseeker->id)
                                                ->where('user_id','=',Auth::user()->id)
                                                ->first() == null)
                                                <a class="tooltipped btn-floating btn-small waves-effect waves-light grey" data-tooltip="Bookmark Company" href="{{ route('company.add_bookmark_jobseeker',$user->id) }}"><i class="small material-icons">star</i></a>
                                            @else
                                                <a class="tooltipped btn-floating btn-small waves-effect waves-light yellow" data-tooltip="Bookmark Company" href="{{ route('company.remove_bookmark_jobseeker',$user->id) }}"><i class="small material-icons">star</i></a>
                                            @endif
                                        </div>
                                    @endif
                                    <div class="col l2">
                                        @if($user->photo == NULL)
                                            <img src="{{ asset('images/profile_default.jpg') }}" class="responsive-img"style="width:150px; height:150px">
                                        @else
                                            <img src="{{ asset('images/'.$user->photo) }}"class="responsive-img" style="width:150px; height:150px">
                                        @endif
                                    </div>
                                    <div class="col s12 m12 l10">
                                        @if(Auth::guest())
                                        @elseif($user->id == Auth::user()->id)
                                            <a href="{{ route('jobseeker.edit', $user->id) }}" class="btn-floating btn-large red right">
                                                <i class="material-icons">mode_edit</i>
                                            </a>
                                        @endif
                                        <span class="card-title"><b>{{ $user->name }}</b></span>
                                            @if($user->location != null)
                                                <h6><i class="tiny material-icons">location_on</i> {{$user->location}}</h6>
                                            @endif
                                        <h6><i class="tiny material-icons">mail</i> {{ $user->email }}</h6>
                                            @if($user->phone != null)
                                                <h6><i class="tiny material-icons">phone</i> {{ $user->phone }}</h6>
                                            @endif


                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col s12">
                        <ul class="tabs red">
                            <li class="tab col s3"><a class="active white-text" href="#test1">Education</a></li>
                            <li class="tab col s3"><a class="white-text" href="#test2">About</a></li>
                            <li class="tab col s3" style="width:24.8%"><a class="white-text" href="#test3">Job Interest</a></li>
                            @if($user->jobseeker->resume != NULL)
                                <li class="tab col s3"><a class="white-text" href="#test4">Resume</a></li>
                            @endif
                        </ul>
                    </div>
                    <div id="test1" class="col s12">
                        <div class="row">
                            <div class="col s12 m12">
                                <ul class="collection with-header grey-text text-darken-2 z-depth-1">
                                    <li class="collection-header blue white-text"><h6><b>Education</b></h6></li>
                                    <li class="collection-item"><p><span style="font-size:1.5em;">
                                            @if($user->jobseeker->university!= NULL)
                                                {{$user->jobseeker->university}}
                                            @else
                                                    <span class="grey-text">Not filled</span>
                                            @endif
                                            </span></p></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div id="test2" class="col s12">
                        <div class="row">
                            <div class="col s12 m12">
                                <ul class="collection with-header grey-text text-darken-2 z-depth-1">
                                    <li class="collection-header  cyan darken-1 white-text"><h6><b>About</b></h6>
                                    </li>
                                    <li class="collection-item"><p>
                                        <p>
                                            @if($user->description!= NULL)
                                                {{ $user->description }}
                                            @else
                                                <span class="grey-text">Not filled</span>
                                            @endif
                                        </p>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div id="test3" class="col s12">
                        <div class="row">
                            <div class="col s12 m12">
                                <ul class="collection with-header grey-text text-darken-2 z-depth-1">
                                    <li class="collection-header  amber darken-4 white-text"><h6><b>Job Interest</b></h6>
                                    </li>
                                    <li class="collection-item">
                                        @if($user->jobseeker->job_interest != NULL)

                                            @foreach ($user->jobseeker->job_interest as $job_interest)
                                                <p><span style="font-size: 1em"><i class="tiny material-icons blue-text">label</i> {{$job_interest->name}}</span></p>
                                            @endforeach

                                        @else
                                            <span class="grey-text">Not filled</span>
                                        @endif
                                    </li>

                                </ul>
                            </div>
                        </div>
                    </div>
                    @if($user->jobseeker->resume != NULL)
                        <div id="test4" class="col s12">
                            <div class="row">
                                <div class="col s12 m12">
                                    <ul class="collection with-header grey-text text-darken-2 z-depth-1">
                                        <li class="collection-header  amber darken-4 white-text"><h6><b>Resume</b></h6>
                                        </li>
                                        <li class="collection-item">
                                            <a class="waves-effect blue btn" href="{{ asset('uploads/'.$user->jobseeker->resume) }}">View</a>
                                        </li>

                                    </ul>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function ()
        {
            $('#btnBookmark').click(function (event)
            {
                window.location.href += '/add_bookmark_jobseeker';
            });

            Materialize.toast('{{ session('message') }}', 5000, 'rounded');
        });
    </script>
@endsection
