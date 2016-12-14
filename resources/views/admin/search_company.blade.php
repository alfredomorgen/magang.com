@extends('layouts.app')


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
        <div class="row">
            <div class="col s12 l12 m12">
                <nav style="background-color: white">
                    <div class="nav-wrapper">
                        <form action="{{url('admin/search_company/search') }}" role="search" accept-charset="UTF-8">
                            <div class="input-field">
                                <input class="tooltipped" data-position="bottom" data-delay="50" data-tooltip="Search Company" name="search" id="search" placeholder="Search a user" type="search" required>
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
                {{$search}}

                <ul class="collection z-depth-1 grey-text text-darken-2">
                    <table class="centered bordered highlight responsive-table white">
                        <thead>
                        <tr>
                            <th data-field="id">User Id</th>
                            <th data-field="user_id">Company Id</th>
                            <th data-field="user">Company</th>
                            <th data-field="email">Email</th>
                            <th data-field="status">Status</th>
                            <th data-field="action">Action</th>
                        </tr>
                        </thead>

                        <tbody>

                        @foreach($users as $user)
                            <tr>
                                <td>{{ $user->id }}</td>
                                <td>{{ $user->company->id}}</td>
                                <td><a class="tooltipped" data-position="bottom" data-delay="50" data-tooltip="View Profile" href="{{route('company.index',$user->id)}}">{{ $user->name }}</a></td>
                                <td>{{ $user->email }}</td>
                                <td>@if($user->status == \App\Constant::status_inactive)<span class="red-text">Inactive</span> @else <span class="blue-text">Active</span> @endif</td>
                                @if($user->status== \App\Constant::status_active)<td>
                                    <a class="waves-effect waves-light btn red" href="#modal{{$user->id}}">Inactive</a>
                                    <!-- Modal Structure -->
                                    <div id="modal{{$user->id}}" class="modal">
                                        <div class="modal-content">
                                            <h4>Confirmation</h4>
                                            <p>Are you sure about delete <span class="red-text">{{$user->name}}</span>?</p>
                                        </div>
                                        <div class="modal-footer">
                                            <a href="{{url('/admin/delete_company/'.$user->id)}}" class=" modal-action modal-close waves-effect waves-green btn-flat">Yes</a>
                                        </div>
                                    </div>
                                    </td>
                                @else <td></td>@endif
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </ul>
                <ul class="pagination center">
                <li class="waves-effect">{{ $users->render() }}</li>
                </ul>
            @else
                <ul class="collection z-depth-1 grey-text text-darken-2">

                    <table class="centered bordered highlight responsive-table white">
                        <thead>
                        <tr>
                            <th data-field="id">User Id</th>
                            <th data-field="user_id">Company Id</th>
                            <th data-field="user">Company</th>
                            <th data-field="email">Email</th>
                            <th data-field="status">Status</th>
                            <th data-field="action">Action</th>

                        </tr>
                        </thead>

                        <tbody>

                        @foreach($users as $user)
                            <tr>
                                <td>{{ $user->id }}</td>
                                <td>{{ $user->company->id}}</td>
                                <td><a class="tooltipped" data-position="bottom" data-delay="50" data-tooltip="View Profile" href="{{route('company.index',$user->id)}}">{{ $user->name }}</a></td>
                                <td>{{ $user->email }}</td>
                                <td>@if($user->status == \App\Constant::status_inactive)<span class="red-text">Inactive</span> @else <span class="blue-text">Active</span> @endif</td>
                                @if($user->status == \App\Constant::status_active)<td>
                                    <a class="waves-effect waves-light btn red" href="#modal{{$user->id}}">Inactive</a>
                                    <!-- Modal Structure -->
                                    <div id="modal{{$user->id}}" class="modal">
                                        <div class="modal-content">
                                            <h4>Confirmation</h4>
                                            <p>Are you sure about delete <span class="red-text">{{$user->name}}</span>?</p>
                                        </div>
                                        <div class="modal-footer">
                                            <a href="{{url('/admin/delete_company/'.$user->id)}}" class=" modal-action modal-close waves-effect waves-green btn-flat">Yes</a>
                                        </div>
                                    </div>
                                </td>
                                @else <td></td>@endif
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </ul>
                <ul class="pagination center">
                    <li class="waves-effect">{{ $users->render() }}</li>
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



