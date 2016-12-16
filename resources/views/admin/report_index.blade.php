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

    @if($reports->count() == 0)
        <ul class="collection z-depth-1 grey-text text-darken-2">
            <div class="collection-item orange darken-1 center white-text">
                <h6><strong>REPORTS</strong></h6>
            </div>

            <li class="collection-item center grey-text white">
                <h5>No Reports</h5>
            </li>
        </ul>
    @else
        <ul class="collection z-depth-1 grey-text text-darken-2">
            <div class="collection-item orange darken-1 center white-text">
                <h6><strong>REPORTS</strong></h6>
            </div>

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

                            <div class="row">
                                <div class="col m4 l4">
                                    <a href="{{ route('job.index', $report->job->id) }}" class="waves-effect waves-light btn orange darken-2">View Job</a>
                                </div>

                                <div class="col m4 l4">
                                    @if($report->status == \App\Constant::report_status_pending)
                                        <a href="{{ route('admin.report_close', $report->id) }}" class="waves-effect waves-light btn green darken-2">Close Report</a>
                                    @else
                                        <a href="{{ route('admin.report_close', $report->id) }}" disabled class="waves-effect waves-light btn green darken-2">Report closed</a>
                                    @endif
                                </div>

                                <div class="col m4 l4">
                                    @if($report->status == \App\Constant::report_status_pending)
                                        <a href="{{ url('/admin/delete_job/'.$report->job->id) }}" class="waves-effect waves-light btn red darken-2">Delete Job</a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
            @endforeach
        </ul>
    @endif
</div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function () {
            Materialize.toast('{{ session('message') }}', 3000, 'rounded');
        });
    </script>
@endsection