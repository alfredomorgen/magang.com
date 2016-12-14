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
                        <form action="{{url('admin/searchJob') }}" role="search" accept-charset="UTF-8">
                            <div class="input-field">
                                <input class="tooltipped" data-position="bottom" data-delay="50" data-tooltip="Search Job" name="search" id="search" placeholder="Search a job" type="search" required>
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
                <span class="white-text">{{$search}}</span>

                <ul class="collection z-depth-1 grey-text text-darken-2">
                    <table class="centered bordered highlight responsive-table white">
                        <thead>
                        <tr>

                            <th data-field="company_id">Company Id</th>
                            <th data-field="id">Job Id</th>
                            <th data-field="company_name">Company Name</th>
                            <th data-field="job">Title</th>
                            <th data-field="email">Created Date</th>
                            <th data-field="status">Status</th>
                            <th data-field="action">Action</th>
                        </tr>
                        </thead>

                        <tbody>
                        @foreach($jobs as $job)
                            <tr>
                                <td>{{$job->company->id}}</td>
                                <td>{{ $job->id }}</td>
                                <td>{{ $job->company->user->name }}</td>
                                <td><a class="tooltipped" data-position="bottom" data-delay="50" data-tooltip="View job" href="{{route('job.index',$job->id)}}">{{ $job->name }}</a></td>
                                <td>{{ $job->created_at }}</td>
                                <td>@if($job->status == \App\Constant::status_inactive)<span class="red-text">Deleted</span> @else <span class="blue-text">Available</span> @endif</td>
                                @if($job->status == \App\Constant::status_active)<td>
                                    <a class="waves-effect waves-light btn red" href="#modal{{$job->id}}">Delete</a>
                                    <!-- Modal Structure -->
                                    <div id="modal{{$job->id}}" class="modal">
                                        <div class="modal-content">
                                            <h4>Confirmation</h4>
                                            <p>Are you sure about delete <span class="red-text">{{$job->name}}</span> from {{$job->company->user->name}}?</p>
                                        </div>
                                        <div class="modal-footer">
                                            <a href="{{url('/admin/delete_job/'.$job->id)}}" class=" modal-action modal-close waves-effect waves-green btn-flat">Yes</a>
                                        </div>
                                    </div>
                                </td>
                                @else<td><a class="waves-effect waves-light btn red disabled" href="#">Delete</a></td>@endif
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </ul>
                <ul class="pagination center">
                    <li class="waves-effect">{{ $jobs->render() }}</li>
                </ul>
            @else
                <ul class="collection z-depth-1 grey-text text-darken-2">
                    <table class="centered bordered highlight responsive-table white">
                        <thead>
                        <tr>

                            <th data-field="company_id">Company Id</th>
                            <th data-field="id">Job Id</th>
                            <th data-field="company_name">Company Name</th>
                            <th data-field="job">Title</th>
                            <th data-field="email">Created Date</th>
                            <th data-field="status">Status</th>
                            <th data-field="action">Action</th>
                        </tr>
                        </thead>

                        <tbody>
                        @foreach($jobs as $job)
                            <tr>
                                <td>{{$job->company->id}}</td>
                                <td>{{ $job->id }}</td>
                                <td>{{$job->company->user->name}}</td>
                                <td><a class="tooltipped" data-position="bottom" data-delay="50" data-tooltip="View job" href="{{route('job.index',$job->id)}}">{{ $job->name }}</a></td>
                                <td>{{ $job->created_at }}</td>
                                <td>@if($job->status == \App\Constant::status_inactive)<span class="red-text">Deleted</span> @else <span class="blue-text">Available</span> @endif</td>
                                @if($job->status == \App\Constant::status_active)<td>
                                    <a class="waves-effect waves-light btn red" href="#modal{{$job->id}}">Delete</a>
                                    <!-- Modal Structure -->
                                    <div id="modal{{$job->id}}" class="modal">
                                        <div class="modal-content">
                                            <h4>Confirmation</h4>
                                            <p>Are you sure about delete <span class="red-text">{{$job->name}}</span> from {{$job->company->user->name}}?</p>
                                        </div>
                                        <div class="modal-footer">
                                            <a href="{{url('/admin/delete_job/'.$job->id)}}" class=" modal-action modal-close waves-effect waves-green btn-flat">Yes</a>
                                        </div>
                                    </div>
                                </td>
                                @else <td><a class="waves-effect waves-light btn red disabled" href="#">Delete</a></td>@endif
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </ul>
                <ul class="pagination center">
                    <li class="waves-effect">{{ $jobs->render() }}</li>
                </ul>
            @endif
        @else
            <span class="white-text">{{$message}}</span>
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