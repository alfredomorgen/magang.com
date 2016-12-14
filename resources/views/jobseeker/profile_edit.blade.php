@extends('layouts.app')
@section('title', 'Edit Profile')
@section('content')
    <div class="container">
        <div class="row">
            @section('navbar')
                @include('layouts.navbar')
            @show
        </div>

        <div class="row">
            <div class="s12">
                <div class="card-panel content">
                    <div class="row">
                        <div class="section">
                            <h4 class="center-align">Edit Profile</h4>
                        </div>

                        <form class="col s12" method="POST" action="{{ route('jobseeker.update', $user->id) }}" enctype="multipart/form-data" files="true">
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
                                    <label for="phone">Phone</label>
                                    @if ($errors->has('phone'))
                                        <strong>{{ $errors->first('phone') }}</strong>
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

                            <div class="row">
                                <div class="input-field col s12">
                                    <div class="file-field input-field">
                                        <div class="btn">
                                            <span><i class="material-icons">note_add</i> Upload Resume</span>
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

@endsection
