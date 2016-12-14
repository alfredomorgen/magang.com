@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @section('navbar')
                @include('layouts.navbar')
            @show
        </div>

        <div class="row">
            <div class="s12">
                <div class="col l12">
                    <div class="card-panel content ">
                        <div class="row" style="margin-bottom: 0px">
                            <div class="section">
                                <h5 class="center-align">Edit Profile</h5>
                            </div>

                            <form class="col s12" method="POST" action="{{ route('company.update', $user->id) }}" enctype="multipart/form-data" files="true">
                                {{ csrf_field() }}

                                <div class="row">
                                    <div class="input-field col s6">
                                        <i class="material-icons prefix">vpn_key</i>
                                        <input id="password" type="password" name="password">
                                        <label for="password">Password</label>
                                        @if ($errors->has('password'))
                                            <strong>{{ $errors->first('password') }}</strong>
                                        @endif
                                    </div>

                                    <div class="input-field col s6">
                                        <input type="password" id="password_confirmation" name="password_confirmation">
                                        <label for="password_confirmation">Confirm Password</label>
                                        @if ($errors->has('password_confirmation'))
                                            <strong>{{ $errors->first('password_confirmation') }}</strong>
                                        @endif
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="input-field col s12">
                                        <i class="material-icons prefix">phone</i>
                                        <input type="text" class="validate" id="phone" name="phone" value="{{ $user->phone }}">
                                        <label for="phone">Company Phone</label>
                                        @if ($errors->has('phone'))
                                            <strong>{{ $errors->first('phone') }}</strong>
                                        @endif
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="input-field col s12">
                                        <i class="material-icons prefix">location_on</i>
                                        <input type="text" class="validate" id="location" name="location" value="{{ $user->location}}">
                                        <label for="website">Company Location</label>
                                        @if ($errors->has('location'))
                                            <strong>{{ $errors->first('location') }}</strong>
                                        @endif
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="input-field col s12">
                                        <i class="material-icons prefix">label_outline</i>
                                        <input type="text" class="validate" id="industry" name="industry" value="{{ $user->company->industry}}">
                                        <label for="website">Industry</label>
                                        @if ($errors->has('industry'))
                                            <strong>{{ $errors->first('industry') }}</strong>
                                        @endif
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="input-field col s12">
                                        <i class="material-icons prefix">supervisor_account</i>
                                        <input type="number" class="validate" id="size" name="size" value="{{ $user->company->size}}" min="0" placeholder="company size in number only">
                                        <label for="website">Company Size</label>
                                        @if ($errors->has('size'))
                                            <strong>{{ $errors->first('size') }}</strong>
                                        @endif
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="input-field col s12">
                                        <i class="material-icons prefix">language</i>
                                        <input type="text" class="validate" id="website" name="website" value="{{ $user->company->website }}" placeholder="www.example.com">
                                        <label for="website">Company Website</label>
                                        @if ($errors->has('website'))
                                            <strong>{{ $errors->first('website') }}</strong>
                                        @endif
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="input-field col s12">
                                        <i class="material-icons prefix">mode_edit</i>
                                        <textarea class="materialize-textarea validate" id="description" name="description">{{ $user->description }}</textarea>
                                        <label for="description">Description</label>
                                        @if ($errors->has('description'))
                                            <span class="help-block"><strong>{{ $errors->first('description') }}</strong></span>
                                        @endif
                                    </div>
                                </div>


                                <div class="section">
                                    <h4 class="center-align">Upload Files</h4>
                                </div>

                                <div class="row">
                                    <div class="input-field col s12">
                                        <div class="file-field input-field">
                                            <div class="btn">
                                                <span><i class="material-icons">perm_media</i> Upload Photo</span>
                                                <input id="photo" type="file" name="photo">
                                            </div>
                                            <div class="file-path-wrapper">
                                                <input class="file-path validate" type="text">
                                            </div>
                                        </div>
                                        @if ($errors->has('photo'))
                                            <strong>{{ $errors->first('photo') }}</strong>
                                        @endif
                                    </div>
                                </div>


                                <div class="col-md-8 col-md-offset-4 center-align">
                                    <button type="submit" class="btn blue">
                                        Save Changes
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
