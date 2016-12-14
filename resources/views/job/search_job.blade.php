@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <!-- Grey navigation panel -->
            @section('navbar')
                @include('layouts.navbar')
            @show
        </div>
    </div>
    <div class="container" style="background-color: transparent;margin-top:30px">
        <div class="row center">
            <div class="col l8 push-l2">
                <h4 class="col s12 valign blue-text">View Posts</h4>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <ul class="collection z-depth-1 grey-text text-darken-2">

                @foreach($jobs as $job)
                    <li class="collection-item avatar" style="padding-left:10px">
                        <div class="row" style="margin-bottom:auto">
                            <div class="col m2 l2">
                                <img src="images/samsung.png" alt="" class="rounded" style="width:70px; height:70px">
                            </div>

                            <div class="col m10 l10">
                                <span class="title"><strong>Available Job :</strong> "{{ $job->name }}"</span>
                                <p><a href="#!"><i class="material-icons">equalizer</i></a>{{ $job->company->user->name }}</p>
                                <p><a href="#!"><i class="material-icons">location_on</i></a>{{ $job->location }}</p>
                                <a href="{{ url('job/'.$job->id) }}" class="waves-effect waves-light btn orange darken-2">View</a>
                                <a href="#!"><i class="tooltipped material-icons right" data-tooltip="Report">report_problem</i></a>
                                <a href="#!"><i class="tooltipped material-icons right" data-tooltip="Share">person_pin</i></a>
                                <a href="#!"><i class="tooltipped material-icons right" data-tooltip="Add to Saved Jobs">grade</i></a>
                            </div>
                        </div>
                    </li>
                @endforeach

            </ul>
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


