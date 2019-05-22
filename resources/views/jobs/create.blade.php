@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">Post a new Job</div>
                    <div class="card-body">
                        @if(Session::has('error'))
                            <div class="alert alert-danger">
                                <p>{{Session::get('error')}}</p>
                            </div>
                        @endif

                            @if(Session::has('message'))
                                <div class="alert alert-success">
                                    <p>{{Session::get('message')}}</p>
                                </div>
                            @endif

                        <form action="{{route('post.job')}}" method="post">@csrf
                            <div class="form-group">
                                <label>Job Title</label>
                                <input type="text" value="{{old('title')}}" name="title" class="form-control">
                                @if($errors->has('title'))
                                    <span class="text-danger error">{{ $errors->first('title') }}</span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label>Description</label>
                                <textarea name="description" rows="5" class="form-control">{{old('description')}}</textarea>
                                @if($errors->has('description'))
                                    <span class="text-danger error">{{ $errors->first('description') }}</span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label>Role</label>
                                <textarea name="roles" rows="5" class="form-control">{{old('roles')}}</textarea>
                                @if($errors->has('roles'))
                                    <span class="text-danger error">{{ $errors->first('roles') }}</span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label>Category</label>
                                <select name="category" class="form-control">
                                    <option value=""></option>
                                    @foreach(App\Category::all() as $cat)
                                        <option value="{{$cat->id}}">{{$cat->cat_name}}</option>
                                    @endforeach
                                </select>
                                @if($errors->has('category'))
                                    <span class="text-danger error">{{ $errors->first('category') }}</span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label>Position</label>
                                <input type="text" value="{{old('position')}}" name="position" class="form-control">
                                @if($errors->has('position'))
                                    <span class="text-danger error">{{ $errors->first('position') }}</span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label>Address</label>
                                <input type="text" value="{{old('address')}}" name="address" class="form-control">
                                @if($errors->has('address'))
                                    <span class="text-danger error">{{ $errors->first('address') }}</span>
                                @endif
                            </div>

                            <div class="form-group">
                                <label>Position Type</label>
                                <select name="job_type" class="form-control">
                                    <option value="full-time">Full-Time</option>
                                    <option value="contract">Contract</option>
                                    <option value="part-time">Part-time</option>
                                    <option value="temporary">Temporary</option>
                                    <option value="internship">Internship</option>
                                    <option value="commission">Commission</option>
                                </select>
                                @if($errors->has('job_type'))
                                    <span class="text-danger error">{{ $errors->first('job_type') }}</span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label>Status</label>
                                <select name="status" class="form-control">
                                    <option value=""></option>
                                    <option value="1">Live</option>
                                    <option value="0">Draft</option>
                                </select>
                                @if($errors->has('status'))
                                    <span class="text-danger error">{{ $errors->first('status') }}</span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label>Post Date</label>
                                <input type="date" value="{{old('last_date')}}" name="last_date" class="form-control">
                                @if($errors->has('last_date'))
                                    <span class="text-danger error">{{ $errors->first('last_date') }}</span>
                                @endif
                            </div>

                            <div class="form-group">
                                <button class="btn btn-primary" type="submit" style="width: 100%;">Post</button>
                            </div>

                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
