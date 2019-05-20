@extends('layouts.app')
@section('content')
        <div class="container">
            <div class="row">
                <div class="col-lg-12">

                        <h2>Jobs</h2>

                        <table class="table">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th>Title</th>
                                        <th>Description</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($jobs as $job)
                                    <tr>
                                        <td><img src="http://placehold.it/80x80"></td>
                                        <td style="width: 15%">{{$job->title}}<br/>&nbsp;&nbsp;<i class="far fa-clock"></i>&nbsp;{{$job->job_type}}</td>
                                        <td>{{substr($job->description, 0, strlen($job->description)/2) }}...</td>
                                        <td><a href="{{route('job.show', [$job->id, $job->slug])}}"><button class="btn btn-success btn-sm">Apply</button></a></td>
                                    </tr>
                                    @endforeach
                                </tbody>
                        </table>

                </div>
            </div>
        </div>
@endsection
