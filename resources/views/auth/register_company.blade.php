@extends('layouts.app')
@section('title', 'Register Company')
@section('content')

    <div class="valign-wrapper" style="margin-top:30px">

        <div class="row z-depth-1" style="background-color: white;">
            <div class="col l12" style="margin-bottom:20px">
                <h4 class="col s12 valign blue-text center">Register</h4>
                <form class="col s12" style="padding-bottom:20px" method="POST" action="{{ url('/register') }}"
                      enctype="multipart/form-data"
                      files="true">
                    {{ csrf_field() }}


                    <div id="step1">
                        <div class="row">
                            <div class="input-field col s12">
                                <input id="name" type="text" class="validate" name="name"
                                       value="{{ old('name') }}">
                                <label for="name">Company Name</label>
                                @if ($errors->has('name'))
                                    <strong>{{ $errors->first('name') }}</strong>
                                @endif
                            </div>
                        </div>

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
                        <input type="hidden" name="role" value="{{\App\Constant::user_company}}">


                    </div>
                    <div id="step2">
                        <div class="row">
                            <div class="input-field col s12">
                                <textarea cols="8" rows="8" name="description" id="description"
                                          class="materialize-textarea"
                                          value="{{ old('description') }}"
                                          style="resize:none"></textarea>
                                <label for="description">Description</label>
                                @if ($errors->has('description'))
                                    <strong>{{ $errors->first('description') }}</strong>
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s12">
                                <input id="phone" type="text" class="validate" name="phone"
                                       value="{{ old('phone') }}">
                                <label for="phone">Contact Number</label>
                                @if ($errors->has('phone'))
                                    <strong>{{ $errors->first('phone') }}</strong>
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s12">
                                <input id="location" type="text" class="validate" name="location"
                                       value="{{ old('location') }}">
                                <label for="location">Location</label>
                                @if ($errors->has('location'))
                                    <strong>{{ $errors->first('location') }}</strong>
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s12">
                                <input id="size" type="number" class="validate" name="size"
                                       value="{{ old('size') }}">
                                <label for="size">Company Size</label>
                                @if ($errors->has('size'))
                                    <strong>{{ $errors->first('size') }}</strong>
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s12">
                                <input id="industry" type="text" class="validate" name="industry"
                                       value="{{ old('industry') }}">
                                <label for="industry">Industry</label>
                                @if ($errors->has('industry'))
                                    <strong>{{ $errors->first('industry') }}</strong>
                                @endif
                            </div>
                        </div>

                        <div class="row">
                            <div class="input-field col s12">
                                <input id="website" type="text" class="validate" name="website"
                                       value="{{ old('website') }}">
                                <label for="website">Website</label>
                                @if ($errors->has('website'))
                                    <strong>{{ $errors->first('website') }}</strong>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-8 col-md-offset-4 center-align">
                            <button type="submit" class="btn blue">
                                Register
                            </button>
                        </div>
                    </div>

                </form>

                <div class="nav-wrapper">
                    <ul class="tabs tabs-transparent center">
                        <li class="tab">
                            <button type="button" class="btn red"><a href="#step1">Step 1</a></button>
                        </li>
                        <li class="tab">
                            <button type="button" class="btn red"><a href="#step2">Step 2</a></button>
                        </li>
                    </ul>
                </div>

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


