@extends('layouts.app')
@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-3">
                @if(!empty(Auth::user()->company->logo))
                <img src="{{ asset('uploads/logos') }}/{{ Auth::user()->company->logo }}" width="100%">
                @else
                    <img src="http://placehold.it/200x200" width="100%">
                @endif
                <form action="{{route('upload.logo')}}" method="post" enctype="multipart/form-data">@csrf
                    <div class="card">
                        <div class="card-header">
                            Update Company Logo
                        </div>
                        <div class="card-body">
                            <input type="file" class="form-control" name="logo">
                            @if($errors->has('logo'))
                            <span class="text-danger error">{{ $errors->first('logo') }}</span>
                            @endif
                        </div>
                    </div>
                    @if(Session::has('error'))
                        <div class="alert alert-danger">
                            <p>{{Session::get('error')}}</p>
                        </div>
                    @endif
                    <br/>
                    <button class="btn btn-success btn sm">Update</button>

                </form>

            </div>
            <div class="col-md-5">
                <form action="{{route('company.store')}}" method="post" >@csrf
                <div class="card">
                <div class="card-header">
                    Update Your Company Information
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label>Address</label>
                        <input type="text" name="address" class="form-control" value="{{Auth::user()->company->address}}">
                        @if($errors->has('address'))
                        <span class="text-danger error">{{ $errors->first('address') }}</span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label>Phone</label>
                        <input type="text" name="phone" class="form-control" value="{{Auth::user()->company->phone}}">
                        @if($errors->has('phone'))
                        <span class="text-danger error">{{ $errors->first('phone') }}</span>
                        @endif
                    </div>

                    <div class="form-group">
                            <label>Website</label>
                            <input type="text" name="website" class="form-control" value="{{Auth::user()->company->website}}">
                            @if($errors->has('website'))
                            <span class="text-danger error">{{ $errors->first('website') }}</span>
                            @endif
                    </div>

                    <div class="form-group">
                            <label>Slogan</label>
                            <input type="text" name="slogan" class="form-control" value="{{Auth::user()->company->slogan}}">
                            @if($errors->has('slogan'))
                            <span class="text-danger error">{{ $errors->first('slogan') }}</span>
                            @endif
                    </div>

                    <div class="form-group">
                            <label>Description</label>
                            <textarea name="description" rows="5" class="form-control">{{Auth::user()->company->description}}</textarea>
                            @if($errors->has('description'))
                            <span class="text-danger error">{{ $errors->first('description') }}</span>
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
                       About your company
                    </div>
                    <div class="card-body">
                            <ul class="list-group">
                                    <li class="list-group-item">Company Name:&nbsp;{{Auth::user()->company->company_name}}</li>
                                    <li class="list-group-item">Slogan:&nbsp;{{Auth::user()->company->slogan}}</li>
                                    <li class="list-group-item">Address:&nbsp;{{Auth::user()->company->address}}</li>
                                    <li class="list-group-item">Phone:&nbsp;{{Auth::user()->company->phone}}</li>
                                    <li class="list-group-item">Website:&nbsp;{{Auth::user()->company->website}}</li>
                            <li class="list-group-item">Company Page:&nbsp;<a href="{{route('companies.index', [Auth::user()->company->id, Auth::user()->company->company_name, ])}}">View Page</a></li>
                             </ul>
                             <div style="padding: 1em;">
                                 <h4>Description:</h4>
                                 <p>{{Auth::user()->company->description}}</p>
                             </div>
                    </div>

                <form action="{{route('upload.coverphoto')}}" method="POST" enctype="multipart/form-data">@csrf
                        <div class="card">
                            <div class="card-header">Update Cover Photo</div>
                            <div class="card-body">
                                 <input type="file" class="form-control" name="cover_photo">
                            </div>
                        </div>
                        @if(Session::has('error'))
                        <div class="alert alert-danger">
                            <p>{{Session::get('error')}}</p>
                        </div>
                    @endif
                        <br/>
                        <button class="btn btn-success btn sm">Update</button>
                    </form>
                </div>
            </div>




        </div> <!-- end of row -->
    </div><!-- end of container -->

@endsection
