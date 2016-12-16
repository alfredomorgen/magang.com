@extends('layouts.app')
@section('title', 'Reports')
@section('content')
<style>
    ul li span{
        font-size:20px;
    }
</style>

<div class="container">
    <div class="row">
        @section('navbar')
            @include('layouts.navbar')
        @show
    </div>

    <ul class="collection z-depth-1 grey-text text-darken-2">
        <div class="collection-item orange darken-1 center white-text">
            <h6><strong>REPORTS</strong></h6>
        </div>

        @if($reports->count() == 0)
            <li class="collection-item center grey-text white">
                <h5>No Reports</h5>
            </li>
        @else
            @foreach($reports as $report)
                <li class="collection-item avatar" style="padding-left:10px">
                    <div class="row" style="margin-bottom:auto">
                        <div class="col s3 m2 l2">
                            <img src="{{ asset('images/'.$report->job->company->user->photo) }}" class="responsive-img">
                        </div>

                        <div class="col s9 m10 l10">
                            <span>{{ $report->job->name }}</span>
                            <div class="row">
                                <div class="col m7 l7">
                                    <i class="material-icons">work</i></a> {{ $report->job->company->user->name }}<br>
                                    <i class="material-icons">location_on</i></a>{{ $report->job->location }}
                                </div>
                                <div class="col m5 l5">
                                    <i class="material-icons">av_timer</i></a>@if($report->job->type == \App\Constant::job_parttime) Part Time @else Full Time @endif<br>
                                    <i class="material-icons">payment</i></a>@if($report->job->salary == \App\Constant::job_paid) Paid @else Not Paid @endif
                                </div>
                            </div>

                            <div class="row">
                                <div class="col m12 l12">
                                    <i class="material-icons">assignment_ind</i></a>
                                    <strong>Reported By:</strong>
                                    <a href="{{ route('jobseeker.index', $report->jobseeker->user->id) }}">{{ $report->jobseeker->user->name }}</a>
                                </div>
                                <div class="col m12 l12">
                                    <i class="material-icons">assignment</i></a>
                                    <strong>Description:</strong> {{ $report->description }}
                                </div>
                            </div>

                            <a href="{{ route('job.index', $report->job->id) }}" class="waves-effect waves-light btn orange darken-2">View</a>

                            <a href="{{ url('/admin/delete_job/'.$report->job->id) }}"><i class="tooltipped material-icons right red-text lighten-1" data-tooltip="Delete Job">delete</i></a>
                            <a href="{{ route('admin.report_close', $report->id) }}"><i class="tooltipped material-icons right red-text lighten-1" data-tooltip="Dismiss Report">not_interested</i></a>
                        </div>
                    </div>
                </li>
            @endforeach
        @endif
    </ul>
</div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function () {
            Materialize.toast('{{ session('message') }}', 3000, 'rounded');
        });
    </script>
@endsection