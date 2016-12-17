@extends('layouts.app')

@section('content')
    <div class="container white" style="margin-top:30px">
        <div class="row" style="padding:60px;">
            <h4 class="col s12 center blue-text">Post Job</h4>

            <form class="col l8 offset-l2" method="POST" action="{{ url('/company/post_job/store ') }}" enctype="multipart/form-data" files="true">
                {{ csrf_field() }}

                <div class="row">
                    <div class="input-field col s12">
                        <i class="material-icons prefix">perm_identity</i>
                        <input type="text" class="validate" id="name" name="name">
                        <label for="name">Job Title</label>
                        @if ($errors->has('name'))
                            <strong>{{ $errors->first('name') }}</strong>
                        @endif
                    </div>
                </div>

                <div class="row">
                    <div class="input-field col s12">
                        <i class="material-icons prefix">work</i>
                        <select name="job_category_id" id="job_category_id">
                            <option disabled selected>Choose Job Category</option>
                            @foreach($job_categories as $job_category)
                                <option value="{{ $job_category->id }}">{{ $job_category->name }}</option>
                            @endforeach
                        </select>
                        <label for="job_category_id">Job Category</label>
                        @if ($errors->has('job_category_id'))
                            <strong>{{ $errors->first('job_category_id') }}</strong>
                        @endif
                    </div>
                </div>

                <div class="row">
                    <div class="input-field col s12">
                        <i class="material-icons prefix">location_on</i>
                        <input type="text" class="validate" id="location" name="location">
                        <label for="location">Location</label>
                        @if ($errors->has('location'))
                            <strong>{{ $errors->first('location') }}</strong>
                        @endif
                    </div>
                </div>

                <div class="row">
                    <div class="input-field col s12">
                        <i class="material-icons prefix">alarm</i>
                        <select name="type" id="type">
                            <option disabled selected>Choose Working Time</option>
                            <option value="{{ \App\Constant::job_parttime }}">Part Time</option>
                            <option value="{{ \App\Constant::job_fulltime }}">Full Time</option>
                        </select>
                        <label for="type">Working Time</label>
                    </div>
                </div>

                <div class="row">
                    <div class="input-field col s12">
                        <i class="material-icons prefix">attach_money</i>
                        <select name="salary" id="salary">
                            <option disabled selected>Choose Salary</option>
                            <option value="{{ \App\Constant::job_notpaid }}">Not Paid</option>
                            <option value="{{ \App\Constant::job_paid }}">Paid</option>
                        </select>
                        <label for="type">Salary</label>
                    </div>
                </div>

                <div class="row">
                    <div class="input-field col s12">
                        <i class="material-icons prefix">add_box</i>
                        <textarea cols="50" rows="8" name="benefit" id="benefit" class="materialize-textarea" placeholder="Your Benefit(s) here . . ." style="resize:none"></textarea>
                        <label for="benefit">Benefit</label>
                        @if ($errors->has('benefit'))
                            <strong>{{ $errors->first('benefit') }}</strong>
                        @endif
                    </div>
                </div>

                <div class="row">
                    <div class="input-field col s12">
                        <i class="material-icons prefix">playlist_add_check</i>
                        <textarea cols="50" rows="8" name="requirement" id="requirement" class="materialize-textarea" placeholder="Your requirement(s) here . . ." style="resize:none"></textarea>
                        <label for="requirement">Requirement</label>
                        @if ($errors->has('requirement'))
                            <strong>{{ $errors->first('requirement') }}</strong>
                        @endif
                    </div>
                </div>

                <div class="row">
                    <div class="input-field col s12">
                        <i class="material-icons prefix">description</i>
                        <textarea cols="50" rows="8" name="description" id="description" class="materialize-textarea" placeholder="Your Description here . . ." style="resize:none"></textarea>
                        <label for="description">Description</label>
                        @if ($errors->has('description'))
                            <strong>{{ $errors->first('description') }}</strong>
                        @endif
                    </div>
                </div>

                <div class="center">
                    <input type="submit" class="btn blue" value="Post Job Now">
                </div>
            </form>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function () {
            $('select').material_select();
        });
    </script>
@endsection


