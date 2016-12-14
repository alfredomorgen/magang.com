@extends('layouts.app')

@section('content')
    <style>
        ul li span {
            font-size: 20px;
        }

        ul li .active {
            padding-left: 8px;
            padding-right: 8px;
        }

        .collection .collection-item.avatar .circle{
            width:120px;
            height:120px;
        }
    </style>
    <div class="container">
        <div class="row">
            <!-- Grey navigation panel -->
            @section('navbar')
                @include('layouts.navbar')
            @show
        </div>
    </div>
    <div class="container" style="background-color: transparent;margin-top:30px">
        @if(session('success'))
            <script>Materialize.toast('{{session('success')}}', 5000, 'rounded');</script>
        @elseif(session('error'))
            <div class="red-text">
                {{session('error')}}
            </div>
        @endif
        {{--<div class="row center">--}}
            {{--<div class="col l8 push-l2">--}}
                {{--<h4 class="col s12 valign white-text">Bookmark Job Seeker</h4>--}}
            {{--</div>--}}
        {{--</div>--}}
    </div>

    <div class="container">
        <div class="row">
            <ul class="collection z-depth-1 grey-text text-darken-2">
                <div class="collection-item orange darken-1 center white-text">
                    <h6><strong>BOOKMARK</strong></h6>
                </div>
                @if($bookmarks->count() == 0)
                    <li class="collection-item avatar center grey-text" style="padding-left:10px">
                        <span>No Bookmark</span>
                    </li>
                @else
                    @foreach($bookmarks as $bookmark)
                    <li class="collection-item avatar" style="padding-left:10px">
                        <div class="row" style="margin-bottom:auto">
                            <div class="col m2 l2">
                                @if(\App\Jobseeker::find($bookmark->target)->user->photo == NULL)
                                    <img src="{{ asset('images/profile_default.jpg') }}" class="circle materialboxed" width="650" >
                                @else
                                    <img src="{{ asset('images/'.\App\Jobseeker::find($bookmark->target)->user->photo) }}" class="circle materialboxed" width="650">
                                @endif
                            </div>

                            <div class="col m10 l10">
                                <span class="title"><i class="tiny material-icons blue-text darken-1">perm_identity</i><strong>Name : </strong>{{ \App\Jobseeker::find($bookmark->target)->user->name }}</span>
                                <p>
                                    <i class="tiny material-icons blue-text darken-1">supervisor_account</i><strong>Study At :</strong>
                                    @if(\App\Jobseeker::find($bookmark->target)->university == NULL)
                                        -
                                    @else
                                        {{ \App\Jobseeker::find($bookmark->target)->university}}
                                    @endif
                                </p>
                                <p>
                                    <i class="tiny material-icons blue-text darken-1">loyalty</i><strong>Major :</strong>
                                    @if(\App\Jobseeker::find($bookmark->target)->major == NULL)
                                        -
                                    @else
                                        {{ \App\Jobseeker::find($bookmark->target)->major}}
                                    @endif
                                </p>
                                <p><i class="tiny material-icons blue-text darken-1">location_on</i><strong>Location :</strong> {{ \App\Jobseeker::find($bookmark->target)->user->location }}</p>
                                <a href="{{ url('jobseeker/'.\App\Jobseeker::find($bookmark->target)->user->id) }}" class="waves-effect waves-light btn orange darken-2">View Profile</a>
                                <a href="{{ route('company.delete_bookmark_jobseeker',$bookmark->id) }}"><i class="tooltipped material-icons right red-text lighten-1" data-tooltip="Delete this Bookmark">not_interested</i></a>
                            </div>
                        </div>
                    </li>
                    @endforeach
                @endif
            </ul>
            <ul class="pagination center">
                <li class="waves-effect white">{{ $bookmarks->render() }}</li>
            </ul>
        </div>
    </div>

@endsection

@section('scripts')
    <script>
        $(document).ready(function(){
            $('.materialboxed').materialbox();
        });
    </script>
@endsection
