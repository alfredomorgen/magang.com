@extends('layouts.app')

@section('content')

    <div class="container" style="background-color: white;margin-top:30px">

        <div class="row" style="padding:60px;">

            <div class="col l8 push-l2">
                <h4 class="col s12 valign blue-text">Post Job</h4>

                    @if(session('success'))
                    <div class="green-text">
                        {{session('success')}}
                    </div>
                    @elseif(session('error'))
                    <div class="red-text">
                        {{session('error')}}
                    </div>
                    @endif

                <form class="col s12" method="POST" action="{{ url('/company/post_job/update/   '.$job->id) }}"
                      enctype="multipart/form-data" files="true">
                    {{ csrf_field() }}

                    {{--<div class="form-group{{ $errors->has('user_name') ? ' has-error' : '' }}">--}}
                    <h6>Name</h6>
                    <div class="row">
                        <div class="input-field col s12">
                            <input id="name" type="text" name="name" placeholder="Job Title"
                                  value="{{$job->name}}">
                            @if ($errors->has('name'))
                                <strong>{{ $errors->first('name') }}</strong>
                            @endif
                        </div>
                    </div>
                    {{--</div>--}}

                    <h6>Job Category</h6>
                    <div class="row">
                        <div class="input-field col s12">
                            <select name="job_category_id" id="job_category_id">
                                <option {{($job->job_category_id==0) ? 'selected="selected"':''}} value="0">IT</option>
                                <option {{($job->job_category_id==1) ? 'selected="selected"':''}} value="1">Accounting</option>
                                <option {{($job->job_category_id==2) ? 'selected="selected"':''}} value="2">Marketing</option>
                                <option {{($job->job_category_id==3) ? 'selected="selected"':''}} value="3">Media/Communication</option>
                            </select>
                        </div>
                    </div>


                    <h6>Job Type</h6>
                    <div class="row">
                        <div class="input-field col s12">
                            <select name="type" id="type">
                                <option {{($job->type==0) ? 'selected="selected"':''}} value="0">Part Time</option>
                                <option {{($job->type==1) ? 'selected="selected"':''}} value="1">Full Time</option>
                            </select>
                        </div>
                    </div>

                    <h6>Salary</h6>
                    <div class="row">
                        <div class="input-field col s12">
                            <select name="salary" id="salary">
                                <option {{($job->salary==0) ? 'selected="selected"':''}} value="0">Paid</option>
                                <option {{($job->salary==1) ? 'selected="selected"':''}} value="1">Not Paid</option>
                            </select>
                        </div>
                    </div>


                    <h6>Period (Months)</h6>
                    <div class="row">
                        <div class="input-field col s12">
                            <input id="period" type="number"
                                   name="period" placeholder="In Months"
                                   value="{{ $job->period }}" min="1">
                            @if ($errors->has('period'))
                                <strong>{{ $errors->first('period') }}</strong>
                            @endif
                        </div>
                    </div>

                    <h6>Benefit</h6>
                    <div class="row">
                        <div class="input-field col s12">
                            <textarea cols="50" rows="8" name="benefit" id="benefit" class="materialize-textarea"
                                      value="{{ $job->benefit }}" placeholder="Your Benefit(s) here . . ."
                                      style="resize:none">{{ $job->benefit }}</textarea>
                            @if ($errors->has('benefit'))
                                <strong>{{ $errors->first('benefit') }}</strong>
                            @endif
                        </div>
                    </div>

                    <h6>Requirement</h6>
                    <div class="row">
                        <div class="input-field col s12">
                            <textarea cols="50" rows="8" name="requirement" id="requirement"
                                      class="materialize-textarea" value="{{ $job->requirement }}"
                                      placeholder="Your requirement(s) here . . ." style="resize:none">{{ $job->requirement }}</textarea>
                            @if ($errors->has('requirement'))
                                <strong>{{ $errors->first('requirement') }}</strong>
                            @endif
                        </div>
                    </div>

                    <h6>Description</h6>
                    <div class="row">
                        <div class="input-field col s12">
                            <textarea cols="50" rows="8" name="description" id="description"
                                      class="materialize-textarea" value="{{ $job->description }}"
                                      placeholder="Your Description here . . ." style="resize:none">{{ $job->description }}</textarea>
                            @if ($errors->has('description'))
                                <strong>{{ $errors->first('description') }}</strong>
                            @endif
                        </div>
                    </div>

                    <div class="col-md-8 col-md-offset-4 center-align">
                        <button type="submit" class="btn blue">
                            Update Post Job
                        </button>
                        <a href="{{ url()->previous() }}" class="btn btn-default">Cancel</a>
                    </div>


                </form>
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

        $(document).ready(function () {
            $('select').material_select();
        });
    </script>
@endsection


