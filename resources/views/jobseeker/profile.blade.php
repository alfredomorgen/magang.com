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
        @endif
        <div class="row">
            <div class="col s12">
                <div class="row">
                    <div class="col s12 m12">
                        <div class="card">
                            <div class="card-content grey-text text-darken-2">
                                <div class="row">
                                    @if(Auth::user()->role == \App\Constant::user_company)
                                        <div class="right">
                                            @if(\App\Bookmark::where('target','=',\App\User::find($user->id)->jobseeker->id)
                                                ->where('user_id','=',Auth::user()->id)
                                                ->first() == null)
                                                <a class="tooltipped btn-floating btn-large waves-effect waves-light grey" data-tooltip="Bookmark Company" href="{{ route('company.add_bookmark_jobseeker',$user->id) }}" style="position: absolute; right: 1%;"><i class="material-icons">star</i></a>
                                            @else
                                                <a class="tooltipped btn-floating btn-large waves-effect waves-light yellow darken-2" data-tooltip="Bookmark Company" href="{{ route('company.remove_bookmark_jobseeker',$user->id) }}" style="position: absolute; right: 1%"><i class="material-icons">star</i></a>
                                            @endif
                                        </div>
                                    @endif
                                    <div class="col l2">
                                        @if($user->photo == NULL)
                                            <img src="{{ asset('images/profile_default.jpg') }}" class="responsive-img">
                                        @else
                                            <img src="{{ asset('images/'.$user->photo) }}"class="responsive-img">
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
                                    <li class="collection-header amber darken-4 white-text"><h6><b>Job Interest</b></h6></li>
                                    <li class="collection-item">
                                        @if(Auth::guest())
                                        @elseif($user->id == Auth::user()->id)
                                            <div class="chips chips-placeholder" id="chipsJobInterest"></div>
                                        @else
                                            @foreach ($user->jobseeker->job_interest as $job_interest)
                                                <div class="chip">{{$job_interest->name}}</div>
                                            @endforeach
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
                                        <li class="collection-header  amber darken-4 white-text"><h6><b>Resume</b></h6></li>
                                        <li class="collection-item center">
                                            <a class="waves-effect blue btn center" target="_blank" href="{{ asset('uploads/'.$user->jobseeker->resume) }}">Download</a>
                                            <p></p>
                                            <object data="{{ asset('uploads/'.$user->jobseeker->resume) }}" type="application/pdf" width="100%" height="600px"></object>
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

{{--Add this user's job interests to an array (to be passed to jQuery--}}
@php $job_interest_arr = []; @endphp
@foreach ($user->jobseeker->job_interest as $job_interest)
    @php
        array_push($job_interest_arr, $job_interest->name)
    @endphp
@endforeach

@section('scripts')
    <script>
        $(document).ready(function ()
        {
            $('#btnBookmark').click(function (event)
            {
                window.location.href += '/add_bookmark_jobseeker';
            });

            Materialize.toast('{{ session('message') }}', 5000, 'rounded');

            $('#chipsJobInterest').material_chip({
                placeholder: 'Enter a Job Interest',
                secondaryPlaceholder: '+Job Interest',
                data: [
                    <?php foreach ($job_interest_arr as $job_interest_item) {
                        echo "{ tag: '".$job_interest_item."',},";
                    }?>
                ],
            });

            $('.chips').on('chip.add', function(e, chip){
                $.ajax({
                    method: "get",
                    data: {
                        name: chip.tag,
                    },
                    url: "{{ route('jobseeker.job_interest_add', $user) }}"
                });
            });

            $('.chips').on('chip.delete', function(e, chip){
                $.ajax({
                    method: "get",
                    data: {
                        name: chip.tag,
                    },
                    url: "{{ route('jobseeker.job_interest_remove', $user) }}"
                });
            });

        });
    </script>
@endsection
