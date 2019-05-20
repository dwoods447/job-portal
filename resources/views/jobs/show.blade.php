@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{$job->title}}</div>
                    <div class="card-body">
                        <h1>Description</h1>
                        <p>{{$job->description}}</p>
                        <br/>
                        <h1>Duties</h1>
                        <p>{{$job->roles}}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">Job Info</div>
                    <div class="card-body">
                        <p><a href="{{route('companies.index', [$job->company->id, $job->company->slug])}}">Company: {{$job->company->company_name}}</a></p>
                        <p>Employment Type: {{$job->job_type}}</p>
                        <p>Position: {{$job->position}}</p>
                        <p>Date Posted: {{$job->last_date}}</p>
                        @if(Auth::check() && Auth::user()->user_type == 'seeker')
                        <button class="btn btn-success btn-sm">Apply</button>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
