@extends('layouts.app')
@section('title', $job->company->user->name.' - '.$job->name)
@section('content')
    <style>
        .card-action .row {
            margin-bottom: 0px;
        }
    </style>

    <div class="container">
        <div class="row">
            @section('navbar')
                @include('layouts.navbar')
            @show
        </div>
    </div>

    <div id="modal" class="modal">
        <form method="POST" action="{{ route('jobseeker.report_job', $job->id) }}" enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="modal-content">
                <h4>Report</h4>
                <p>Please tell us why you are reporting this job:</p>

                <div class="input-field col s12">
                    <textarea class="materialize-textarea validate" id="description" name="description"></textarea>
                    @if ($errors->has('description'))
                        <span class="help-block"><strong>{{ $errors->first('description') }}</strong></span>
                    @endif
                </div>
            </div>

            <div class="modal-footer">
                <button type="submit" class="modal-action modal-close waves-effect waves-green btn-flat">Submit Report</button>
            </div>
        </form>
    </div>

    @if(Auth::guest())
    @elseif(Auth::User())

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
        <div id="modal2" class="modal">
            <form method="POST" action="{{ route('jobseeker.upload_resume', Auth::user()->id) }}" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="modal-content">
                    <p>Please upload your Resume</p>
                    <div class="input-field col s12">
                        <div class="file-field input-field">
                            <div class="btn">
                                <span>Upload Resume</span>
                                <input id="resume" type="file" name="resume" multiple>
                            </div>
                            <div class="file-path-wrapper">
                                <input class="file-path validate" type="text" name="resume">
                            </div>
                        </div>
                        @if ($errors->has('resume'))
                            <strong>{{ $errors->first('resume') }}</strong>
                        @endif
                    </div>
                </div>

                <input type="hidden" name="job_id" value="{{ $job->id }}">

                <div class="modal-footer">
                    <button type="submit"  class="modal-action modal-close waves-effect waves-green btn-flat apply_submit">Save</button>
                </div>
            </form>
        </div>
    @endif

    <div class="container">
        <div class="row">
            <div class="col s12 m12 l12">
                <div class="card white darken-1 hoverable">
                    <div class="card-content orange darken-1 center white-text">
                        @if(Auth::guest())
                        @elseif(Auth::user()->role == \App\Constant::user_jobseeker)
                            @if(\App\Bookmark::where('user_id', '=', Auth::user()->id)->where('target', '=', $job->id)->where('type', '=', \App\Constant::job)->where('type', '=', \App\Constant::job)->first() == null)
                                <a class="tooltipped btn-floating btn-large waves-effect waves-light grey" data-tooltip="Bookmark Job" href="{{ route('jobseeker.bookmark_add_job', $job->id) }}" style="position: absolute; right: 2%; margin-top: -1.4%;"><i class="material-icons">star</i></a>
                            @else
                                <a class="tooltipped btn-floating btn-large waves-effect waves-light yellow darken-2" data-tooltip="Bookmark Job" href="{{ route('jobseeker.bookmark_remove_job', $job->id) }}" style="position: absolute; right: 2%; margin-top: -1.6%;"><i class="material-icons">star</i></a>
                            @endif
                        @endif
                        <h6>VIEW POST</h6>
                    </div>
                    <div class="card-content grey-text text-darken-2" style="padding-left:50px;padding-right:50px;">
                        <div class="right-align">
                            <a class="grey-text tooltipped right-align" data-position="bottom" data-delay="10" data-tooltip="Deadline Time"><i class="tiny material-icons">schedule </i> {{ $job->deadline}}</a>
                        </div>
                        <div class="center"><h4 class="">{{ $job->name }}</h4></div>
                        <br>
                        <div class="card-action">
                            <h6 class="blue-text"><b>Company</b></h6>
                            <p>
                                <i class="tiny material-icons">work</i>
                                <a href="{{route('company.index',$job->company->user->id)}}"class="yellow-text text-darken-4 tooltipped" data-position="right" data-delay="10" data-tooltip="View Company">{!!  nl2br($job->company->user->name) !!}</a>
                            </p>
                        </div>
                        <div class="card-action">
                            <h6 class="blue-text"><b>Job Description</b></h6>
                            <p>{!! nl2br ($job->description) !!}</p>
                        </div>

                        <div class="card-action">
                            <h6 class="blue-text"><b>Requirement</b></h6>
                            <p>{!! nl2br($job->requirement) !!}</p>
                        </div>
                        @if(Auth::guest())
                            <div class="card-action grey-text">
                                <h6 class="blue-text"><b>Benefit</b></h6>
                                <p>Login to view</p>
                            </div>
                            <div class="card-action grey-text">
                                <h6 class="blue-text"><b>Employment Type</b></h6>
                                <p>Login to view</p>
                            </div>
                            <div class="card-action grey-text">
                                <h6 class="blue-text"><b>Salary</b></h6>
                                <p><i class="tiny material-icons">payment</i> Login to view</p>
                            </div>
                            <div class="card-action grey-text">
                                <h6 class="blue-text"><b>Period</b></h6>
                                <p><i class="tiny material-icons">schedule</i> Login to view</p>
                            </div>
                        @else
                            <div class="card-action">
                                <h6 class="blue-text"><b>Benefit</b></h6>
                                <p>{!! nl2br($job->benefit) !!}</p>
                            </div>
                            <div class="card-action">
                                <h6 class="blue-text"><b>Employment Type</b></h6>
                                <p><i class="tiny material-icons">av_timer</i>@if($job->type == \App\Constant::job_fulltime) Full Time @else Part Time @endif</p>
                            </div>
                            <div class="card-action">
                                <h6 class="blue-text"><b>Salary</b></h6>
                                <p><i class="tiny material-icons">payment</i> @if($job->salary == \App\Constant::job_paid) Paid @else Not Paid @endif</p>
                            </div>
                            <div class="card-action">
                                <h6 class="blue-text"><b>Period</b></h6>
                                <p><i class="tiny material-icons">schedule</i> {!! nl2br($job->period) !!} Months</p>
                            </div>
                        @endif
                        <div class="card-action">
                            <h6 class="blue-text"><b>Company Information</b></h6>
                            @if($job->company->website!= NULL)
                                <p><i class="tiny material-icons"> language</i><b> Website :</b> {!! nl2br($job->company->website) !!}</p>
                            @endif
                            <p><i class="tiny material-icons">business</i><b> Industry :</b> {!! nl2br($job->company->industry) !!}</p>
                            <p><i class="tiny material-icons">perm_identity</i><b> Company Size :</b> {!! nl2br($job->company->size) !!} Employees</p>
                        </div>
                    </div>
                    <div class="card-action">
                        <div class="row">
                            <div class="col s6 left-align">
                                @if(Auth::guest())
                                @elseif(Auth::user()->role == App\Constant::user_jobseeker)
                                    <a href="#modal" class="tooltipped btn-floating waves-effect waves-light red" data-tooltip="Report"><i class="material-icons">error_outline</i></a>
                                @endif
                            </div>
                            <div class="col s6 right-align">
                                @if(Auth::guest())
                                @elseif(Auth::user()->role == \App\Constant::user_company)
                                @elseif(Auth::user()->jobseeker->resume == null)
                                    <a href="#modal2" class="btn btn-default orange waves-effect" id="btnApply">Apply</a>
                                @else
                                    <a href="{{ route('jobseeker.apply', $job->id) }}" class="btn btn-default orange waves-effect apply_submit" id="btnApply">Apply</a>
                                @endif
                            </div>


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
    <script>
        $(document).ready(function () {
            @if(Auth::guest())
                $('#btnApply').click(function (event) {
                    event.preventDefault();
                    Materialize.toast('Please login as Jobseeker...', 3000, 'rounded');
                });
            @elseif(Auth::user()->role != \App\Constant::user_jobseeker)
                $('#btnApply').click(function (event) {
                    event.preventDefault();
                    Materialize.toast('Only Jobseeker can apply...', 3000, 'rounded');
                });
            @elseif(Auth::user()->jobseeker->resume == null)
                $('#btnApply').click(function (event) {
                    event.preventDefault();
                    Materialize.toast('Please upload your CV on Profile', 3000, 'rounded');
                });
            @endif

            @if($errors->has('resume'))
                Materialize.toast('Resume format must be .pdf', 3000, 'rounded');
            @endif


            $('.modal').modal();
            Materialize.toast('{{ session('message') }}', 3000, 'rounded');

            $('.apply_submit').click(function (event){
                $('#loading').modal({
                    dismissible: false,
                });
                $('#loading').modal('open');
            });
        });
    </script>
@endsection


