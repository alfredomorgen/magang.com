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
    </style>

    {{--modals--}}
    <!-- Modal Trigger -->

    <!-- Modal Structure -->
    @foreach($jobs as $job)
        <div id="modalCandidates{{$job->id}}" class="modal" style="width:100%">
            <div class="modal-content">
                {{--isi context--}}
                <div class="container" style="background-color: transparent;margin-top:30px">
                    <div class="row center">
                        <div class="col l8 push-l2">
                            <h4 class="col s12 valign blue-text">Candidates</h4>
                        </div>
                    </div>
                </div>


                <div class="row">
                    <ul class="collection z-depth-1 grey-text text-darken-2">
                        <table class="centered bordered highlight responsive-table white" style="word-wrap:break-word">
                            <thead>
                            <tr>
                                <th data-field="number">Job Seeker Id</th>
                                <th data-field="created_at">Date Applied</th>
                                <th data-field="created_at">Time Applied</th>
                                <th data-field="name">Name</th>
                                <th data-field="resume">Resume</th>
                                <th data-field="action">
                                    <div align="center">Action</div>
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($job->transaction as $job)
                                <tr>
                                    <td>{{ $job->jobseeker->id }}</td>
                                    <td>{{ date('d-m-Y', strtotime($job->created_at))}}</td>
                                    <td>{{ date('H:i:s', strtotime($job->created_at))}}</td>
                                    <td><a class="tooltipped" data-position="bottom" data-delay="50"
                                           data-tooltip="View Profile"
                                           href="{{ route('jobseeker.index',$job->jobseeker->user->id) }}">{{ $job->jobseeker->user->name}}</a>
                                    </td>
                                    <td>
                                        @if($job->jobseeker->resume != NULL)
                                            <a class="btn btn-block blue"
                                           href="{{ route('company.view_candidate_resume',$job->jobseeker->id) }}"
                                           target="_blank">View Resume</a>
                                            @else
                                            <a class="btn disabled blue"
                                                    href="{{ route('company.view_candidate_resume',$job->jobseeker->id) }}"
                                                    target="_blank">View Resume</a>
                                        @endif
                                    </td>
                                    @if($job->status == \App\Constant::status_inactive)
                                        <td><a class="btn btn-block green"
                                               href="{{ route('company.transaction_approve',$job->id) }}">Approve</a>
                                        </td>
                                    @elseif($job->status == \App\Constant::status_active)
                                        <td><a class="btn btn-block green"
                                               href="{{ route('company.transaction_approve',$job->id) }}" disabled>Approved</a>
                                        </td>
                                    @endif
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </ul>
                    <ul class="pagination center">
                        <li class="waves-effect"></li>
                    </ul>
                </div>
            </div>
            <div class="modal-footer">
                <a href="#!" class=" modal-action modal-close waves-effect waves-green btn-flat">Close</a>
            </div>
        </div>
    @endforeach
    {{--modals--}}






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
                {{--<h4 class="col s12 valign white-text">Manage Job</h4>--}}
            {{--</div>--}}
        {{--</div>--}}
            <div class="row">
                    <a class="btn waves-effect right cyan white-text" href="{{ url('/company/post_job/') }}">Create new Post Job</a>
            </div>
    </div>

    <div class="container">
        <div class="row">
            <ul class="collection z-depth-1 grey-text text-darken-2">
                <div class="collection-item orange darken-1 center white-text">
                    <h6><strong>MANAGE POST</strong></h6>
                </div>
                <table class="centered bordered highlight responsive-table white" style="word-wrap:break-word">
                    <thead>
                    <tr>
                        <th data-field="id">Job Id</th>
                        <th data-field="name">Title Job</th>
                        <th data-field="created_at">Date Created</th>
                        <th data-field="candidates">Candidates</th>
                        <th data-field="status">Status</th>
                        <th data-field="action" colspan="2">
                            <div align="center">Action</div>
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($jobs as $job)
                        <tr>
                            <td>{{ $job->id }}</td>
                            <td>
                                @if($job->status == \App\Constant::status_banned)
                                    <span class="tooltipped grey-text" data-position="bottom" data-delay="50" data-tooltip="Banned"
                                       href="#">{{ $job->name }}</span>
                                @else
                                    <a class="tooltipped" data-position="bottom" data-delay="50" data-tooltip="View Job"
                                   href="{{url('/job/'.$job->id)}}">{{ $job->name }}</a>
                                @endif
                            </td>
                            <td>{{ date('d-m-Y', strtotime($job->created_at))}}</td>
                            <td>
                                @if($job->status == \App\Constant::status_banned)
                                    <span class="tooltipped linkCandidates" data-position="bottom" data-delay="50"
                                       data-tooltip="Banned"
                                       href="#">{{$job->transaction->count()}}</span>
                                @else
                                    <a class="tooltipped linkCandidates" data-position="bottom" data-delay="50"
                                       data-tooltip="View Candidates"
                                       href="#modalCandidates{{$job->id}}">{{$job->transaction->count()}}</a>
                                @endif
                            </td>

                            @if($job->status == \App\Constant::status_active )
                                <td class="green-text text-lighten-1"><b> Open </b></td>
                            @elseif($job->status == \App\Constant::status_inactive)
                                <td class="red-text text-lighten-1"><b> Closed </b></td>
                            @elseif($job->status == \App\Constant::status_banned)
                                <td class="orange-text text-lighten-1"><b> Banned </b></td>
                            @endif

                            @if($job->status == \App\Constant::status_active)
                                <td><a class="btn btn-block blue"
                                       href="{{ url('/company/post_job/edit/'.$job->id) }}">Edit</a></td>
                                <td><a class="btn btn-block red"
                                       href="{{ route('company.manage_post_close',$job->id) }}">Close</a>
                                </td>
                            @elseif($job->status == \App\Constant::status_inactive)
                                <td><a class="btn btn-block blue"
                                       href="{{ url('/company/post_job/edit/'.$job->id) }}" disabled>Edit</a></td>
                                <td><a class="btn btn-block red"
                                       href="{{ route('company.manage_post_close',$job->id) }}" disabled>Closed</a>
                                </td>
                            @elseif($job->status == \App\Constant::status_banned)
                                <td><a class="btn btn-block blue"
                                       href="{{ url('/company/post_job/edit/'.$job->id) }}" disabled>Edit</a></td>
                                <td><a class="btn btn-block red"
                                       href="{{ route('company.manage_post_close',$job->id) }}" disabled>Closed</a>
                                </td>
                            @endif
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </ul>
            <ul class="pagination center">
                <li class="waves-effect white">{{ $jobs->render() }}</li>
            </ul>
        </div>
        <div class="row"></div>
        <div class="row"></div>

    </div>

@endsection

@section('scripts')
    <script>
        //modals
        $(document).ready(function () {
            // the "href" attribute of .modal-trigger must specify the modal ID that wants to be triggered
            $('.modal').modal();
            //$('#modalCandidates1').modal('open');
        });
    </script>
@endsection


