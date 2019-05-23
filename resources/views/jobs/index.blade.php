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
            </div> <!-- end of row -->
        </div><!--  end of container  -->
        <br/><br/>

        <div class="container">
                <h1>Featured Companies</h1>
            <div class="row">
                <div class="col-lg-3">
                    <div class="card" style="width: 18rem;">
                        <img class="card-img-top" src="..." alt="Card image cap">
                        <div class="card-body">
                          <h5 class="card-title">Card title</h5>
                          <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                          <a href="#" class="btn btn-primary">Go somewhere</a>
                        </div>
                      </div>

                </div><!--  end of column -->
            </div>
        </div>
@endsection
