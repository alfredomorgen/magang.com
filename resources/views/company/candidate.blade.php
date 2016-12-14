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
    <div class="container">
        <div class="row">
            <!-- Grey navigation panel -->
            @section('navbar')
                @include('layouts.navbar')
            @show
        </div>
    </div>
    <div class="container" style="background-color: transparent;margin-top:30px">
        <div class="row center">
            <div class="col l8 push-l2">
                <h4 class="col s12 valign blue-text">Candidates</h4>
            </div>
        </div>
    </div>

    <div class="container">
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
                    @foreach($transactions as $transaction)
                    <tr>
                        <td>{{ $transaction->jobseeker->id }}</td>
                        <td>{{ date('d-m-Y', strtotime($transaction->created_at))}}</td>
                        <td>{{ date('H:i:s', strtotime($transaction->created_at))}}</td>
                        <td><a class="tooltipped" data-position="bottom" data-delay="50" data-tooltip="View Profile" href="{{ route('jobseeker.index',$transaction->jobseeker->user->id) }}">{{ $transaction->jobseeker->user->name}}</a></td>
                        <td><a class="btn btn-block blue" href="{{ route('company.view_candidate_resume',$transaction->jobseeker->id) }}" target="_blank">View Resume</a></td>
                        @if($transaction->status == \App\Constant::status_inactive)
                        <td><a class="btn btn-block green" href="{{ route('company.transaction_approve',$transaction->id) }}">Approve</a></td>
                        @elseif($transaction->status == \App\Constant::status_active)
                            <td><a class="btn btn-block green"href="{{ route('company.transaction_approve',$transaction->id) }}" disabled>Approve</a></td>
                        @endif
                    </tr>
                    @endforeach
                    </tbody>
                </table>
            </ul>
            <ul class="pagination center">
                <li class="waves-effect">{{ $jobs->render }}</li>
            </ul>
        </div>
        <div class="row"></div>
        <div class="row"></div>
        <div class="row">
            <div class="col-md-8 col-md-offset-4 center-align">
                {{--<a class="btn btn-block green" href="{{ url('/company/post_job/') }}">Create new Post Job</a>--}}
            </div>
        </div>
    </div>

@endsection

@section('scripts')
    <script>

        $('.datepicker').pickadate({
            selectMonths: true, // Creates a dropdown to control month
            selectYears: 15 // Creates a dropdown of 15 years to control year
        });
    </script>
@endsection


