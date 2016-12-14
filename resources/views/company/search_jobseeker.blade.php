@extends('layouts.app')


@section('content')
    <style>
        ul li span{
            font-size:20px;
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
                        <form action="{{ route('company.search_jobseeker') }}" role="search" method="get" accept-charset="UTF-8">
                            <div class="input-field">
                                <input class="tooltipped" data-position="bottom" data-delay="50"
                                       data-tooltip="Search Job" name="search" id="search" placeholder="Search jobseeker"
                                       type="search">
                                <label for="search"><i class="material-icons grey-text">search</i></label>

                                <i class="material-icons">close</i>
                            </div>
                            <div class="row">
                                <div class="col l12">
                                    <ul class="collapsible" data-collapsible="expandable"
                                        style="margin:0px; border: 0px;">
                                        <li style="width:100%" class="white">
                                            <div class="collapsible-header grey white-text" style="border: 0px;">
                                                Advanced Search
                                            </div>
                                            <div class="collapsible-body grey-text">
                                                <div class="row" style="padding:10px 0px 0px 20px; margin-bottom: 0px;">
                                                    <div class="input-field col l2">
                                                        <label for="university"><i class=" tiny material-icons orange-text">business</i></label>
                                                        <input name="university" id="university" type="text"
                                                               class="validate" placeholder="University">
                                                    </div>
                                                    <div class="input-field col l2">
                                                        <label for="major"><i class=" tiny material-icons orange-text">class</i></label>
                                                        <input name="major" id="major" type="text"
                                                               class="validate" placeholder="Major">
                                                    </div>
                                                    <div class="input-field col l4">
                                                        <div class="row" style="margin:0px">
                                                            <div class="col l1">
                                                                <i class=" tiny material-icons orange-text">perm_identity</i>
                                                            </div>
                                                            <div class="col l11">
                                                                <select name="gender" id="gender">
                                                                    <option value="" disabled selected> Gender
                                                                    </option>
                                                                    <option value="{{\App\Constant::jobseeker_male}}">Male
                                                                    </option>
                                                                    <option value="{{\App\Constant::jobseeker_female}}">Female
                                                                    </option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </li>
                                    </ul>
                                </div>
                                <p hidden>
                                    <button class="btn right" type="submit">Search</button>
                                    </phidden>
                            </div>

                        </form>
                    </div>
                </nav>
            </div>
        </div>
        @if(!isset($message))
            @if(isset($search))
                {{$search}}

                <ul class="collection z-depth-1 grey-text text-darken-2">
                    <table class="centered bordered highlight responsive-table white">
                        <thead>
                        <tr>
                            <th data-field="photo">Photo</th>
                            <th data-field="jobseeker">Jobseeker Name</th>
                            <th data-field="university">University</th>
                            <th data-field="major">Major</th>
                            <th data-field="email">Gender</th>
                        </tr>
                        </thead>

                        <tbody>

                        @foreach($users as $user)
                            <tr>
                                <td>
                                    @if($user->photo == NULL)
                                        <img src="{{ asset('images/profile_default.jpg') }}" class="circle" style="width:80px; height:80px">
                                    @else
                                        <img src="{{ asset('images/'.$user->photo) }}" class="circle" style="width:80px; height:80px">
                                    @endif
                                </td>
                                <td><a class="tooltipped" data-position="bottom" data-delay="50" data-tooltip="View Profile" href="{{ route('jobseeker.index', $user->id) }}">{{ $user->name }}</a></td>
                                <td>
                                    @if($user->jobseeker->university == NULL)
                                        -
                                    @else
                                        {{ $user->jobseeker->university }}
                                    @endif
                                </td>
                                <td>
                                    @if($user->jobseeker->major == NULL)
                                        -
                                    @else
                                        {{ $user->jobseeker->major }}
                                    @endif
                                </td>
                                <td>
                                    @if($user->jobseeker->gender == \App\Constant::gender_male)
                                        Male
                                    @else
                                        Female
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </ul>
                <ul class="pagination center">
                    <li class="waves-effect white">{{ $users->appends(\Illuminate\Support\Facades\Input::except('page'))->render() }}</li>
                </ul>
            @else
                <ul class="collection z-depth-1 grey-text text-darken-2">
                    <table class="centered bordered highlight responsive-table white">
                        <thead>
                        <tr>
                            <th data-field="photo">Photo</th>
                            <th data-field="jobseeker">Jobseeker Name</th>
                            <th data-field="university">University</th>
                            <th data-field="major">Major</th>
                            <th data-field="email">Gender</th>
                        </tr>
                        </thead>

                        <tbody>

                        @foreach($users as $user)
                            <tr>
                                <td>
                                    @if($user->photo == NULL)
                                        <img src="{{ asset('images/profile_default.jpg') }}" class="circle" style="width:80px; height:80px">
                                    @else
                                        <img src="{{ asset('images/'.$user->photo) }}" class="circle" style="width:80px; height:80px">
                                    @endif
                                </td>
                                <td><a class="tooltipped" data-position="bottom" data-delay="50" data-tooltip="View Profile" href="{{ route('jobseeker.index', $user->id) }}">{{ $user->name }}</a></td>
                                <td>
                                    @if($user->jobseeker->university == NULL)
                                        -
                                    @else
                                        {{ $user->jobseeker->university }}
                                    @endif
                                </td>
                                <td>
                                    @if($user->jobseeker->major == NULL)
                                        -
                                    @else
                                        {{ $user->jobseeker->major }}
                                    @endif
                                </td>
                                <td>
                                    @if($user->jobseeker->gender == \App\Constant::gender_male)
                                        Male
                                    @else
                                        Female
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
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
        $(document).ready(function () {
            $('select').material_select();
        });
    </script>
@endsection

