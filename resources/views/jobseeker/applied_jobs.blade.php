@extends('layouts.app')
@section('title', 'Applied Jobs')
@section('content')
<style>
    ul li span{
        font-size:20px;
    }
    ul li .active{
        padding-left: 8px;
        padding-right:8px;
    }
</style>

<div class="container">
    <div class="row">
        @section('navbar')
            @include('layouts.navbar')
        @show
    </div>

    {{--<div class="container">--}}
        {{--<div class="row center">--}}
            {{--<h4 class="col s12 valign white-text">Applied Jobs</h4>--}}
        {{--</div>--}}
    {{--</div>--}}

    <ul class="collection z-depth-1 grey-text text-darken-2">
        <div class="collection-item orange darken-1 center white-text">
            <h6><strong>APPLIED JOBS</strong></h6>
        </div>
        <table class="centered bordered highlight responsive-table white">
            <thead>
                <tr>
                    <th>Transaction ID</th>
                    <th>Company Name</th>
                    <th>Title</th>
                    <th>Apply Date</th>
                    <th>Status</th>
                </tr>
            </thead>

            <tbody>
            @foreach($transactions as $transaction)
                <tr>
                    <td>{{ $transaction->id }}</td>
                    <td>{{ $transaction->job->company->user->name }}</td>
                    <td><a class="tooltipped" data-position="bottom" data-delay="50" data-tooltip="View job" href="{{ route('job.index', $transaction->job) }}">{{ $transaction->job->name }}</a></td>
                    <td>{{ $transaction->created_at }}</td>
                    <td><span style="float:none"class=" new badge {{ $transaction->status ? "green" : "blue" }}" data-badge-caption="">{{ $transaction->status ? "Accepted" : "Pending" }}</span></td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </ul>

    <ul class="pagination center">
        <li class="waves-effect"></li>
    </ul>
</div>
@endsection