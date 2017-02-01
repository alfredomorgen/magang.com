@extends('layouts.app')

@section('content')
    <style>
        ul li span {
            font-size: 20px;
        }
    </style>

    <div  id="loading" class="center modal z-depth-0 valign-wrapper" style="width:50%;height:50%; background:transparent;padding-top: 200px;">
        <div class="preloader-wrapper big active">
            <div class="spinner-layer spinner-yellow-only">
                <div class="circle-clipper left">
                    <div class="circle"></div>
                </div><div class="gap-patch">
                    <div class="circle"></div>
                </div><div class="circle-clipper right">
                    <div class="circle"></div>
                </div>
            </div>
        </div>
    </div>

    {{--modals--}}
    @foreach($jobs as $job)
        <div id="modalCandidates{{ $job->id }}" class="modal" style="width:100%">
            <div class="modal-content">
                <div class="row">
                    <h4 class="center blue-text">Candidates</h4>
                </div>

                <div class="row">
                    <ul class="collection z-depth-1 grey-text text-darken-2">
                        <table class="centered bordered highlight responsive-table white" style="word-wrap:break-word">
                            <thead>
                                <tr>
                                    <th data-field="number">Jobseeker ID</th>
                                    <th data-field="created_at">Date Applied</th>
                                    <th data-field="created_at">Time Applied</th>
                                    <th data-field="name">Name</th>
                                    <th data-field="resume">Resume</th>
                                    <th data-field="action">Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach($job->transaction as $transaction)
                                    <tr>
                                        <td>{{ $transaction->jobseeker->id }}</td>
                                        <td>{{ date('d-m-Y', strtotime($transaction->created_at)) }}</td>
                                        <td>{{ date('H:i:s', strtotime($transaction->created_at)) }}</td>
                                        <td><a class="tooltipped" data-position="bottom" data-delay="50" data-tooltip="View Profile" href="{{ route('jobseeker.index', $transaction->jobseeker->user->id) }}">{{ $transaction->jobseeker->user->name}}</a></td>
                                        <td>
                                            @if($transaction->jobseeker->resume != NULL)
                                                <a class="btn btn-block blue" href="{{ route('company.view_candidate_resume', $transaction->jobseeker->id) }}" target="_blank">View Resume</a>
                                            @else
                                                <a class="btn disabled blue" href="{{ route('company.view_candidate_resume', $transaction->jobseeker->id) }}" target="_blank">View Resume</a>
                                            @endif
                                        </td>
                                        @if($transaction->status == \App\Constant::status_inactive)
                                            <td><a class="btn btn-block green apply_submit" href="{{ route('company.transaction_approve', $transaction->id) }}">Approve</a></td>
                                        @elseif($transaction->status == \App\Constant::status_active)
                                            <td><a class="btn btn-block green" href="{{ route('company.transaction_approve', $transaction->id) }}" disabled>Approved</a></td>
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
                            <th data-field="id">Job ID</th>
                            <th data-field="name">Job Title</th>
                            <th data-field="created_at">Date Created</th>
                            <th data-field="deadline">Deadline</th>
                            <th data-field="candidates">Candidates</th>
                            <th data-field="status">Status</th>
                            <th data-field="action" colspan="2">Action</th>
                        </tr>
                    </thead>

                    <tbody>
                    @foreach($jobs as $job)
                        <tr>
                            <td>{{ $job->id }}</td>
                            <td>
                                @if($job->status == \App\Constant::status_banned)
                                    <span class="tooltipped grey-text" data-position="bottom" data-delay="50" data-tooltip="Banned" href="#">{{ $job->name }}</span>
                                @else
                                    <a class="tooltipped" data-position="bottom" data-delay="50" data-tooltip="View Job" href="{{url('/job/'.$job->id)}}">{{ $job->name }}</a>
                                @endif
                            </td>
                            <td>{{ date('d-m-Y', strtotime($job->created_at)) }}</td>
                            <td>{{ date('d-m-Y', strtotime($job->deadline)) }}</td>
                            <td>
                                @if($job->status == \App\Constant::status_banned)
                                    <span class="tooltipped linkCandidates" data-position="bottom" data-delay="50" data-tooltip="Banned" href="#">{{$job->transaction->count()}}</span>
                                @else
                                    <a class="tooltipped linkCandidates" data-position="bottom" data-delay="50" data-tooltip="View Candidates" href="#modalCandidates{{$job->id}}">{{$job->transaction->count()}}</a>
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
                                <td><a class="btn btn-block blue" href="{{ url('/company/post_job/edit/'.$job->id) }}">Edit</a></td>
                                <td><a class="btn btn-block red" href="{{ route('company.manage_post_close',$job->id) }}">Close</a></td>
                            @elseif($job->status == \App\Constant::status_inactive)
                                <td><a class="btn btn-block blue" href="{{ url('/company/post_job/edit/'.$job->id) }}" disabled>Edit</a></td>
                                <td><a class="btn btn-block red" href="{{ route('company.manage_post_close',$job->id) }}" disabled>Closed</a></td>
                            @elseif($job->status == \App\Constant::status_banned)
                                <td><a class="btn btn-block blue" href="{{ url('/company/post_job/edit/'.$job->id) }}" disabled>Edit</a></td>
                                <td><a class="btn btn-block red" href="{{ route('company.manage_post_close',$job->id) }}" disabled>Closed</a></td>
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
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function () {
            $('.modal').modal();

            $('.apply_submit').click(function (event){
                $('#loading').modal({
                    dismissible: false,
                });
                $('#loading').modal('open');
            });
        });
    </script>
@endsection


