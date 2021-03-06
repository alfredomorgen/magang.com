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
                                <div class="input-field col s6">
                                    <i class="material-icons prefix">date_range</i>
                                    <input type="date" max="{{ \Carbon\Carbon::now()->toDateString() }}" class="datepicker" id="dob" name="dob" value="{{ date('Y-m-d', strtotime($user->jobseeker->dob)) }}">
                                    <label for="date" class="active">Date of Birth</label>
                                    @if ($errors->has('date'))
                                        <strong>{{ $errors->first('date') }}</strong>
                                    @endif
                                </div>

                                <div class="input-field col s6">
                                    <i class="material-icons prefix">perm_identity</i>
                                    <select name="gender">
                                        <option value="" disabled selected>--Choose Gender--</option>
                                        <option {{ $user->jobseeker->gender == \App\Constant::gender_male ? 'selected' : '' }} value="{{ \App\Constant::gender_male }}">Male</option>
                                        <option {{ $user->jobseeker->gender == \App\Constant::gender_female ? 'selected' : '' }} value="{{ \App\Constant::gender_female }}">Female</option>
                                    </select>
                                    <label for="gender">Gender</label>
                                    @if ($errors->has('gender'))
                                        <strong>{{ $errors->first('gender') }}</strong>
                                    @endif
                                </div>
                            </div>

                            <div class="row">
                                <div class="input-field col s6">
                                    <i class="material-icons prefix">location_city</i>
                                    <input type="text" class="validate" id="university" name="university" value="{{ $user->jobseeker->university}}">
                                    <label for="location">University</label>
                                    @if ($errors->has('location'))
                                        <strong>{{ $errors->first('location') }}</strong>
                                    @endif
                                </div>

                                <div class="input-field col s4">
                                    <i class="material-icons prefix">business_center</i>
                                    <input type="text" class="validate" id="major" name="major" value="{{ $user->jobseeker->major}}">
                                    <label for="location">Major</label>
                                    @if ($errors->has('location'))
                                        <strong>{{ $errors->first('location') }}</strong>
                                    @endif
                                </div>

                                <div class="input-field col s2">
                                    <i class="material-icons prefix">assessment</i>
                                    <input type="number" min="0" max="4" step="0.01" class="validate" id="gpa" name="gpa" value="{{ $user->jobseeker->gpa}}">
                                    <label for="location">GPA</label>
                                    @if ($errors->has('location'))
                                        <strong>{{ $errors->first('location') }}</strong>
                                    @endif
                                </div>
                            </div>

                            <div class="row">
                                <div class="input-field col s12">
                                    <i class="material-icons prefix">location_on</i>
                                    <input type="text" class="validate" id="location" name="location" value="{{ $user->location}}">
                                    <label for="location">Location</label>
                                    @if ($errors->has('location'))
                                        <strong>{{ $errors->first('location') }}</strong>
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
                                <img id="photoPreview" class="responsive-img center">
                                <input type="hidden" id="photoCrop" name="photoCrop">

                                <div class="input-field col s12">
                                    <div class="file-field input-field">
                                        <div class="btn">
                                            <span><i class="material-icons">perm_media</i> Upload Photo</span>
                                            <input id="uploadPhoto" type="file" name="photo">
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

@section('scripts')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/cropper/2.3.4/cropper.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/cropper/2.3.4/cropper.min.js"></script>

    <script>
        $("#uploadPhoto").on("change", function(event){
            var filePhoto = $("#uploadPhoto")[0].files[0];
            var reader = new FileReader();
            reader.onload = function(e){
                $("#photoPreview").attr("src", e.target.result);
                $("#photoPreview").cropper({
                    aspectRatio: 1/1,
                    resizable: true,
                    zoomable: false,
                    rotatable: false,
                    multiple: true,
                    crop: function(e){
                        $("#photoCrop").val($("#photoPreview").cropper("getCroppedCanvas").toDataURL());
                    }
                });
            }

            reader.readAsDataURL(filePhoto);
        });

        $('.datepicker').pickadate({
            selectMonths: true,
            selectYears: 30,
            max: $('#dob').attr("max"),
            format: 'yyyy-mm-dd',
        });

        $('select').material_select();
    </script>
@endsection