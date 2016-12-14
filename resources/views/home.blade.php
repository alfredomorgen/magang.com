@extends('layouts.app')
@section('title', 'Home')
@section('content')
    <style>
        ul li span {
            font-size: 20px;
        }

        .select-wrapper input.select-dropdown {
            border: 0px;
            height: 4.5rem;
        }
    </style>

    <div class="container">
        <div class="row">
            @section('navbar')
                @include('layouts.navbar')
            @show
        </div>

        <div class="row">
            <div class="col s12 l12 m12">
                <nav style="background-color: white">
                    <div class="nav-wrapper">
                        <form action="{{ route('home.search') }}" role="search" method="get" accept-charset="UTF-8">
                            <div class="input-field">
                                <input class="tooltipped" data-position="bottom" data-delay="50" data-tooltip="Search Job" name="search" id="search" placeholder="Search a job" type="search">
                                <label for="search"><i class="material-icons grey-text">search</i></label>
                                <i class="material-icons">close</i>
                            </div>

                            <div class="row">
                                <div class="col l12">
                                    <ul class="collapsible" data-collapsible="expandable" style="margin:0px; border: 0px;">
                                        <li style="width:100%" class="white">
                                            <div class="collapsible-header grey white-text" style="border: 0px;">Advanced Search</div>
                                            <div class="collapsible-body grey-text">
                                                <div class="row" style="padding:10px 0px 0px 20px; margin-bottom: 0px;">
                                                    <div class="input-field col l2">
                                                        <label for="company"><i class=" tiny material-icons orange-text">work</i></label>
                                                        <input name="company" id="company" type="text" class="validate" placeholder="Company">
                                                    </div>

                                                    <div class="input-field col l2">
                                                        <label for="location"><i class=" tiny material-icons orange-text">location_on</i></label>
                                                        <input name="location" id="location" type="text" class="validate" placeholder="Location">
                                                    </div>

                                                    <div class="input-field col l4">
                                                        <div class="row" style="margin:0px">
                                                            <div class="col l1">
                                                                <i class=" tiny material-icons orange-text">av_timer</i>
                                                            </div>
                                                            <div class="col l11">
                                                                <select name="type" id="type">
                                                                    <option value="" disabled selected> Employment Type</option>
                                                                    <option value="{{\App\Constant::job_parttime}}">Part Time</option>
                                                                    <option value="{{\App\Constant::job_fulltime}}">Full Time</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="input-field col l4">
                                                        <div class="row" style="margin:0px">
                                                            <div class="col l1">
                                                                <i class=" tiny material-icons orange-text">payment</i>
                                                            </div>

                                                            <div class="col l11">
                                                                <select name="salary" id="salary">
                                                                    <option value="" disabled selected>Salary</option>
                                                                    <option value="{{\App\Constant::job_notpaid}}">Not Paid</option>
                                                                    <option value="{{\App\Constant::job_paid}}">Paid</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>

                                <button class="btn right hide" type="submit">Search</button>
                            </div>
                        </form>
                    </div>
                </nav>
            </div>
        </div>

        @if(!isset($message))
            @if(isset($search))
                <span class="black-text">{{$search}}</span>
                <ul class="collection z-depth-1 grey-text text-darken-2">
                    @foreach($jobs as $job)
                        <li class="collection-item avatar" style="padding-left:10px">
                            <div class="row" style="margin-bottom:auto">
                                <div class="col l2">
                                    <img src="{{ asset('images/'.$job->company->user->photo) }}" class="responsive-img">
                                </div>
                                <div class="col s12 l10">
                                    <span class="card-title">{{ $job->job_name }}</span><br>
                                    <div class="row">
                                        <div class="col l7">
                                            <i class="material-icons">work</i></a> {{ $job->company->user->name }}<br>
                                            <i class="material-icons">location_on</i></a>{{ $job->job_location }}
                                        </div>
                                        <div class="col l5">
                                            <i class="material-icons">av_timer</i></a>@if($job->type == \App\Constant::job_parttime)Part Time @else Full Time @endif<br>
                                            <i class="material-icons">payment</i></a>@if($job->salary == \App\Constant::job_paid)Paid @else Not Paid @endif
                                        </div>
                                    </div>
                                    <a href="{{ route('job.index', $job->id) }}" class="waves-effect waves-light btn orange darken-2">View</a>
                                </div>
                            </div>
                        </li>
                    @endforeach
                </ul>

                <ul class="pagination center">
                    <li class="waves-effect white">{!! $jobs->appends(\Illuminate\Support\Facades\Input::except('page'))->render() !!}</li>
                </ul>
            @else
                <ul class="collection z-depth-1 grey-text text-darken-2">
                    @foreach($jobs as $job)
                        <li class="collection-item avatar" style="padding-left:10px">
                            <div class="row" style="margin-bottom:auto">
                                <div class="col l2">
                                    @if($job->company->user->photo == null)
                                        <img src="{{ asset(\App\Constant::default_photo) }}" class="responsive-img">
                                    @else
                                        <img src="{{ asset('images/'.$job->company->user->photo) }}" class="responsive-img">
                                    @endif
                                </div>
                                <div class="col s12 l10">
                                    <span class="card-title">{{ $job->name }}</span><br>
                                    <div class="row">
                                        <div class="col l7">
                                            <i class="material-icons">work</i></a> {{ $job->company->user->name }}<br>
                                            <i class="material-icons">location_on</i></a>{{ $job->location }}
                                        </div>
                                        <div class="col l5">
                                            <i class="material-icons">av_timer</i></a>@if($job->type == \App\Constant::job_parttime)Part Time @else Full Time @endif<br>
                                            <i class="material-icons">payment</i></a>@if($job->salary == \App\Constant::job_paid)Paid @else Not Paid @endif
                                        </div>
                                    </div>

                                    <a href="{{ route('job.index', $job->id) }}" class="waves-effect waves-light btn orange darken-2">View</a>
                                </div>
                            </div>
                        </li>
                    @endforeach
                </ul>

                <ul class="pagination center">
                    <li class="waves-effect white">{{ $jobs->render() }}</li>
                </ul>
            @endif
        @else
            <span class="black-text">{{$message}}</span>
        @endif
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function () {
            $('select').material_select();
        });
    </script>
@endsection

