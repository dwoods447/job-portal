@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-12">

                <h2>Jobs</h2>

                <form class="form-inline" style="padding: 0.5em;" method="GET" action="{{route('all.jobs')}}">
                    <div class="form-group">
                        <label class="title" for="keyword">Keyword</label>&nbsp;
                        <input type="text" class="form-control mr-sm-2" id="title" name="title" placeholder="Keyword">
                    </div>
                    <div class="form-group">
                        <label class="employment" for="employment">Employment Type</label>&nbsp;
                        <select name="employment" class="form-control" id="employment">
                            <option value="full-time">Full-Time</option>
                            <option value="contract">Contract</option>
                            <option value="part-time">Part-time</option>
                            <option value="temporary">Temporary</option>
                            <option value="internship">Internship</option>
                            <option value="commission">Commission</option>
                        </select>
                    </div>
                    &nbsp;
                    &nbsp;
                    <div class="form-group">
                        <label class="category" for="category">Job Category</label>&nbsp;&nbsp;
                        <select name="category" class="form-control" id="category">
                            <option value=""></option>
                            @foreach(App\Category::all() as $cat)
                                <option value="{{$cat->id}}">{{$cat->cat_name}}</option>
                            @endforeach
                        </select>
                    </div>
                    &nbsp;
                    &nbsp;
                    <button type="submit" class="btn btn-outline-success">Search</button>
                </form>
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
        </div> <!-- end of row -->

        <div class="row">
            <div class="col-lg-12"> <center>{{ $jobs->appends(request()->except(['page']))->links() }}</center></div>
        </div>

    </div><!--  end of container  -->

@endsection
