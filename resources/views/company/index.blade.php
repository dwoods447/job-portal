@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Company </div>
                    <div class="card-body">

                        <div class="row">
                            <div class="col-lg-6">
                                <ul class="list-group">
                                    <li class="list-group-item">Company:&nbsp;{{$company->company_name}}</li>
                                    <li class="list-group-item">Slogan:&nbsp;{{$company->slogan}}</li>
                                    <li class="list-group-item">Address:&nbsp;{{$company->address}}</li>
                                    <li class="list-group-item">Phone:&nbsp;{{$company->phone}}</li>
                                    <li class="list-group-item">Website:&nbsp;{{$company->website}}</li>
                                </ul>
                                @if(Auth::check())
                                <ul>
                                    <li>
                                        <a href="{{ route('company.profile') }}">Back to Company Profile</a>
                                    </li>
                                </ul>
                                @endif
                            </div>
                            <div class="col-lg-6">
                                @if($company->cover_photo)
                                <img src="{{asset('uploads/coverphoto')}}/{{$company->cover_photo}}" style="width: 100%;">
                                @else
                                <img src="http://placehold.it/225x225" style="width: 100%;">
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <p>{{$company->description}}<p>
                            </div>
                        </div>
                        <div>
                            <h2>Active Jobs</h2>
                            <table class="table">
                                <thead>
                                <tr>
                                    <th scope="col"></th>
                                    <th scope="col"></th>
                                    <th scope="col"></th>
                                    <th scope="col"></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($jobs as $job)
                                    <tr>
                                        <td ><img src="http://placehold.it/80x80"></td>
                                        <td>{{$job->position}}<br/><i class="far fa-clock" aria-hidden="true"></i>&nbsp;{{ $job->job_type}}</td>
                                        <td><i class="fa fa-map-marker" aria-hidden="true"></i>&nbsp;{{$job->address}}</td>
                                        <td>{{$job->created_at->diffForHumans()}}</td>
                                        <td><a href="{{route('job.show', [$job->id, $job->slug]) }}"><button class="btn btn-success btn-sm">Apply</button></a></td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
