@extends('layouts.app')
@section('title', 'Register Jobseeker')
@section('content')

    <div class="valign-wrapper" style="margin-top:30px">

        <div class="row z-depth-1" style="background-color: white;">
            <div class="col l12">
                <h4 class="col s12 valign blue-text center">Register</h4>
                <form class="col s12" style="padding-bottom:20px" method="POST" action="{{ url('/register') }}" enctype="multipart/form-data"
                      files="true">
                    {{ csrf_field() }}

                    {{--<div class="form-group{{ $errors->has('user_name') ? ' has-error' : '' }}">--}}
                    <div class="row">
                        <div class="input-field col s12">
                            <input id="name" type="text" class="validate" name="name"
                                   value="{{ old('name') }}">
                            <label for="name">Name</label>
                            @if ($errors->has('name'))
                                <strong>{{ $errors->first('name') }}</strong>
                            @endif
                        </div>
                    </div>
                    {{--</div>--}}

                    <div class="row">
                        <div class="input-field col s12">
                            <input id="email" type="email" class="validate" name="email"
                                   value="{{ old('email') }}">
                            <label for="email">Email</label>
                            @if ($errors->has('email'))
                                <strong>{{ $errors->first('email') }}</strong>
                            @endif
                        </div>
                    </div>

                    <div class="row">
                        <div class="input-field col s12">
                            <input id="password" type="password" class="validate" name="password"
                                   value="{{ old('password') }}">
                            <label for="password">Password</label>
                            @if ($errors->has('password'))
                                <strong>{{ $errors->first('password') }}</strong>
                            @endif
                        </div>
                    </div>

                    <div class="row">
                        <div class="input-field col s12">
                            <input id="password_confirmation" type="password" class="validate"
                                   name="password_confirmation"
                                   value="{{ old('password_confirmation') }}">
                            <label for="password_confirmation">Password Confirmation</label>
                            @if ($errors->has('password_confirmation'))
                                <strong>{{ $errors->first('password_confirmation') }}</strong>
                            @endif
                        </div>
                    </div>

                    {{--<div class="row">--}}
                        {{--<div class="input-field col s12">--}}
                            {{--<select id="role" name="role">--}}
                                {{--<option value="" disabled selected>Choose your option</option>--}}
                                {{--<option value="{{\App\Constant::user_jobseeker}}">Jobseeker</option>--}}
                                {{--<option value="{{\App\Constant::user_company}}">Company</option>--}}
                            {{--</select>--}}
                            {{--<label for="role">Role</label>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                    <input type="hidden" name="role" value="{{\App\Constant::user_jobseeker}}">


                    <div class="col-md-8 col-md-offset-4 center-align">
                        <button type="submit" class="btn blue">
                            Register
                        </button>
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


