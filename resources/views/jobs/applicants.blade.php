@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
          @if(!empty($applicants))
            @foreach($applicants as $applicant)
                    <div class="card">
                            <div class="card-header">Position: {{ $applicant->title }}</div>
                            <div class="card-body">
                               @foreach($applicant->users as $user)
                                <table class="table">
                                    <thead>
                                    <tr>

                                        <th scope="col">Name</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Address</th>
                                        <th scope="col">Gender</th>
                                        <th scope="col">Bio</th>
                                        <th scope="col">Experience</th>
                                        <th scope="col">Resume</th>
                                        <th scope="col">Cover Letter</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>

                                        <td>{{$user->name}}</td>
                                        <td>{{$user->email}}</td>
                                        <td>{{$user->profile->address}}</td>
                                        <td>{{$user->profile->gender}}</td>
                                        <td style="width: 25%;">{{$user->profile->bio}}</td>
                                        <td>{{$user->profile->experience}}</td>
                                        @if(!empty($user->profile->resume))
                                        <td><a href="{{Storage::url($user->profile->resume)}}">Resume</a></td>
                                        @else
                                        <td class="text-danger"><strong>No Resume</strong></td>
                                        @endif
                                        @if(!empty($user->profile->resume))
                                        <td><a href="{{Storage::url($user->profile->cover_letter)}}">CoverLetter</a></td>
                                        @else
                                          <td class="text-danger"><strong>No Cover Letter</strong></td>
                                        @endif
                                    </tr>

                                    </tbody>
                                </table>

                              @endforeach

                            </div>
                    </div><!--  end of card -->
                   <br/>
               @endforeach
            @else
              No Applicants Yet!
            @endif
            </div> <!-- end of row  -->
        </div> <!-- end of row -->
    </div><!-- end of container -->
@endsection
