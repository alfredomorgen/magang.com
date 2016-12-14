@extends('layouts.app')
@section('title', 'Search Company')
@section('content')
    <style>
        ul li span{
            font-size:20px;
        }
        ul li .active{
            padding-left: 8px;
            padding-right:8px;
        }
        .collection .collection-item.avatar .rounded{
            width:120px;
            height:120px;
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
                        <form action="{{route('search_company') }}" role="search" accept-charset="UTF-8">
                            <div class="input-field">
                                <input class="tooltipped" data-position="bottom" data-delay="50" data-tooltip="Search Company" name="search" id="search" placeholder="Search a company" type="search" required>
                                <label for="search"><i class="material-icons grey-text">search</i></label>
                                <i class="material-icons">close</i>
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
                    @foreach($users as $user)
                        <li class="collection-item avatar" style="padding-left:10px">
                            <div class="row" style="margin-bottom:auto">
                                <div class="col m2 l2">
                                    @if($user->photo == NULL)
                                        <img src="{{ asset('images/profile_default.jpg') }}" class=" rounded"  >
                                    @else
                                        <img src="{{ asset('images/'.$user->photo) }}" class=" rounded" >
                                    @endif
                                </div>

                                <div class="col m10 l10">
                                    <span class="card-title">{{$user->name }}</span><br>
                                    <i class="tiny material-icons darken-1">location_on</i>{{$user->location}}<br>
                                    <i class="tiny material-icons darken-1">supervisor_account</i> {{$user->company->size}} Employees<br>
                                    <i class="tiny material-icons darken-1">assignment</i> {{count($user->company->job)}} Jobs Registered
                                    <a href="{{ url('company/'.$user->id) }}" class="waves-effect waves-light btn orange darken-2 right">View</a>
                                </div>
                            </div>
                        </li>
                    @endforeach
                </ul>
                <ul class="pagination center">
                    <li class="waves-effect white">{{ $users->appends(\Illuminate\Support\Facades\Input::except('page'))->render() }}</li>
                </ul>
            @else
                <ul class="collection z-depth-1 grey-text text-darken-2">
                    @foreach($users as $user)
                        <li class="collection-item avatar" style="padding-left:10px">
                            <div class="row" style="margin-bottom:auto">
                                <div class="col m2 l2" style="padding-right: 0px;">
                                    @if($user->photo == NULL)
                                        <img src="{{ asset('images/profile_default.jpg') }}" class=" rounded responsive-img"  >
                                    @else
                                        <img src="{{ asset('images/'.$user->photo) }}" class=" rounded responsive-img" >
                                    @endif
                                </div>

                                <div class="col m10 l10" style="padding-left: 0px;">
                                    <span class="card-title" style="font-size: 25px;">{{$user->name }}</span><br>
                                        <i class="tiny material-icons darken-1">location_on</i>{{$user->location}}<br>
                                        <i class="tiny material-icons darken-1">supervisor_account</i> {{$user->company->size}} Employees<br>
                                        <i class="tiny material-icons darken-1">assignment</i> {{count($user->company->job()->where('status','=',\App\Constant::status_active)->get())}} Jobs Available
                                    <a href="{{ url('company/'.$user->id) }}" class="waves-effect waves-light btn orange darken-2 right">View</a>
                                </div>
                            </div>
                        </li>
                    @endforeach
                </ul>
                <ul class="pagination center">
                    <li class="waves-effect white">{{ $users->render() }}</li>
                </ul>
            @endif
        @else
            {{$message}}
        @endif
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function(){
            // the "href" attribute of .modal-trigger must specify the modal ID that wants to be triggered
            $('.modal').modal();
        });
    </script>
@endsection



