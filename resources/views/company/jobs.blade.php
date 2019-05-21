@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ Auth::user()->company->company_name }}'s: Active Jobs</div>

                    <div class="card-body">
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
                            @if(!empty($jobs))
                                @foreach($jobs as $job)
                                <tr>
                                    @if(!empty(Auth::user()->company->logo))
                                        <td><img src="{{ asset('uploads/logos') }}/{{ Auth::user()->company->logo }}" width="50%"></td>
                                    @else
                                        <td><img src="http://placehold.it/200x200" width="100%"></td>
                                    @endif
                                    <td>{{ $job->title }}</td>
                                    <td>{{ substr($job->description, 0, strlen($job->description)/3) }}</td>
                                    <td>{{ date('m-d-Y',  strtotime($job->last_date)) }}</td>
                                    <td><a href="{{route('edit.job', [$job->user_id, $job->company_id])}}"><button class="btn btn-warning btn-sm">Edit</button></a></td>
                                </tr>
                               @endforeach
                             @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
