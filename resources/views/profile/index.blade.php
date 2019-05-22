@extends('layouts.app')
@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-3">
                @if(!empty(Auth::user()->profile->avatar))
                    <img src="{{ asset('uploads/avatars') }}/{{ Auth::user()->profile->avatar }}" width="100%">
                @else
                    <img src="http://placehold.it/200x200" width="100%">
                @endif
                <form action="{{route('upload.avatar')}}" method="post" enctype="multipart/form-data">@csrf
                    <div class="card">
                        <div class="card-header">
                            Update Photo
                        </div>
                        <div class="card-body">
                            <input type="file" class="form-control" name="avatar">
                            @if($errors->has('avatar'))
                                <span class="text-danger error">{{ $errors->first('avatar') }}</span>
                            @endif
                        </div>
                    </div>
                    <br/>
                    <button class="btn btn-success btn sm">Update</button>

                </form>

            </div>
            <div class="col-md-5">
                <form action="{{route('profile.store')}}" method="post" >@csrf
                    <div class="card">
                        <div class="card-header">
                            Update Your Profile
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label>Address</label>
                                @if(!empty(Auth::user()->profile->address))
                                    <input type="text" name="address" class="form-control" value="{{Auth::user()->profile->address}}">
                                    @else
                                    <input type="text" name="address" class="form-control" value="">
                                @endif
                                @if($errors->has('address'))
                                    <span class="text-danger error">{{ $errors->first('address') }}</span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label>Phone</label>
                                @if(!empty(Auth::user()->profile->phone))
                                <input type="text" name="phone" class="form-control" value="{{Auth::user()->profile->phone}}">
                                @else
                                <input type="text" name="phone" class="form-control" value="">
                                @endif
                                @if($errors->has('phone'))
                                    <span class="text-danger error">{{ $errors->first('phone') }}</span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label>Gender</label>
                                @if(empty(Auth::user()->profile->gender))
                                <select name="gender">
                                    <option></option>
                                    <option value="M">Male</option>
                                    <option value="F">Female</option>
                                </select>
                                @else
                                    <select name="gender">
                                        <option></option>
                                        <option value="{{Auth::user()->profile->gender}}" selected>{{ Auth::user()->profile->gender == 'M' ? 'Male':'Female' }}</option>
                                    </select>
                                @endif
                            </div>
                            <div class="form-group">
                                <label>Experience</label>
                                @if(!empty(Auth::user()->profile->experience))
                                <input type="text" name="experience" class="form-control" value="{{Auth::user()->profile->experience}}">
                                @else
                                <input type="text" name="experience" class="form-control" value="">
                                @endif
                                @if($errors->has('experience'))
                                    <span class="text-danger error">{{ $errors->first('experience') }}</span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label>Bio</label>
                                @if(!empty(Auth::user()->profile->bio))
                                <textarea class="form-control" rows="5" name="bio" style=>{{Auth::user()->profile->bio}}</textarea>Max 140 Characters
                                @else
                                <textarea class="form-control" rows="5" name="bio" style=></textarea>Max 140 Characters
                                @endif
                                @if($errors->has('bio'))
                                    <span class="text-danger error">{{ $errors->first('bio') }}</span>
                                @endif
                            </div>
                            <div class="form-group">
                                <button class="btn btn-success">Update</button>
                            </div>
                        </div>
                    </div>
                </form>

                @if(Session::has('message'))
                    <div class="alert alert-success">
                        <p>{{Session::get('message')}}</p>
                    </div>
                @endif
            </div><!--  end of column -->

            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        Your information
                    </div>
                    <div class="card-body">
                        <ul class="list-group">
                            <li class="list-group-item">Name:&nbsp;{{Auth::user()->name}}</li>
                            <li class="list-group-item">Email:&nbsp;{{Auth::user()->email}}</li>
                            @if(!empty(Auth::user()->profile->phone))
                            <li class="list-group-item">Phone:&nbsp;{{Auth::user()->profile->phone}}</li>
                            @endif
                            @if(!empty(Auth::user()->profile->address))
                            <li class="list-group-item">Address:&nbsp;{{Auth::user()->profile->address}}</li>
                            @endif
                            @if(!empty(Auth::user()->profile->gender))
                            <li class="list-group-item">Gender:&nbsp;{{Auth::user()->profile->gender}}</li>
                            @endif
                            @if(!empty(Auth::user()->profile->created_at))
                            <li class="list-group-item">Member Since:&nbsp;{{ date('F d Y',strtotime(Auth::user()->profile->created_at))}}</li>
                            @endif
                            @if(!empty(Auth::user()->profile->cover_letter))
                                <li class="list-group-item"><a href="{{ Storage::url(Auth::user()->profile->cover_letter)  }}">CoverLetter&nbsp;</a></li>
                            @else
                                <li class="list-group-item"><span class="text-danger"><strong>Please upload cover letter.</strong></span></li>
                            @endif
                            @if(!empty(Auth::user()->profile->resume))
                                <li class="list-group-item"><a href="{{ Storage::url(Auth::user()->profile->resume)}}">Resume&nbsp;</a></li>
                            @else
                                <li class="list-group-item"><span class="text-danger"><strong>Please upload resume.</strong></span></li>
                            @endif

                        </ul>
                        <div style="padding: 1em;">
                            <h4>Experience:</h4>
                            @if(!empty(Auth::user()->profile->experience))
                            {{Auth::user()->profile->experience}}
                            @else
                                <span class="text-danger"><strong>Please fill in experience.</strong></span>
                            @endif
                        </div>
                        <div style="padding: 1em;">
                            <h4>Bio:</h4>
                            @if(!empty(Auth::user()->profile->bio))
                            <p>{{Auth::user()->profile->bio}}</p>
                            @else
                                <span class="text-danger"><strong>Please fill in bio.</strong></span>
                            @endif
                        </div>
                    </div>
                </div>
                <br/>
                <form action="{{route('upload.coverletter')}}" method="post" enctype="multipart/form-data">@csrf
                    <div class="card">
                        <div class="card-header">
                            Update Cover Letter
                        </div>
                        <div class="card-body">
                            <input type="file" class="form-control" name="cover_letter">
                            @if($errors->has('cover_letter'))
                                <span class="text-danger error">{{ $errors->first('cover_letter') }}</span>
                            @endif
                        </div>
                    </div>
                    <br/>
                    <button style="width: 100%; padding: 5px;" class="btn btn-success btn sm">Update</button>
                </form>
                <br/>
                <form action="{{route('upload.resume')}}" method="post" enctype="multipart/form-data">@csrf
                    <div class="card">
                        <div class="card-header">
                            Update Resume
                        </div>
                        <div class="card-body">
                            <input type="file" class="form-control" name="resume">
                            @if($errors->has('resume'))
                                <span class="text-danger error">{{ $errors->first('resume') }}</span>
                            @endif
                        </div>
                    </div>
                    <br/>
                    <button style="width: 100%; padding: 5px;" class="btn btn-success btn sm">Update</button>
                </form>
            </div>




        </div> <!-- end of row -->
    </div><!-- end of container -->

@endsection
