@extends('layouts.app')

<!-- Main Content -->
@section('content')
    <div class="valign-wrapper" style="margin-top:70px">

        <div class="row z-depth-3" style="background-color: white; width:340px;">

            <div class="col l12">
                <h4 class="col s12 valign grey-text text-darken-2 center">Reset Password</h4>
                <div class="red-text text-lighten-1">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                </div>
                <form class="form-horizontal" role="form" method="POST" action="{{ url('/password/email') }}">
                    {{ csrf_field() }}

                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                        <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                        <div class="col-md-6">
                            <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

                            @if ($errors->has('email'))
                                <span class="help-block">
                                        <strong class="red-text text-lighten-1">{{ $errors->first('email') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-4 center">
                            <button type="submit" class="btn btn-primary">
                                Send Password Reset Link
                            </button>
                        </div>
                    </div>
                    <div class="row"></div>
                </form>
            </div>
        </div>
    </div>
@endsection
