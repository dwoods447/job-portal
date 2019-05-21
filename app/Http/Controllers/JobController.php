<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Job;
use App\User;
use App\Company;
use App\Profile;
use Hash;
class JobController extends Controller
{
    //

    public function index(){
        $jobs = Job::all();
        return view('jobs.index', compact('jobs'));
    }

    public function show($id, $slug){
        $job = Job::findOrFail($id);
        return view('jobs.show', compact('job'));
    }
    public function signup(){
        return view('auth.jobseeker-register');
    }

    public function register(Request $request){
        //dd($request);

        $this->validate($request, [
            'name'=>'required',
            'email' => 'required',
            'user_type' => 'required',
            'password'=> 'required'
        ]);


        $user =  User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'user_type' => $request->input('user_type'),
            'password' => Hash::make($request->input('password')),
        ]);

        Profile::create([
            'user_id'=> $user->id,
            'gender'=>$request->input('gender'),
			'dob'=>$request->input('dob'),
        ]);

        return redirect('/login')->with('message', 'Successful Registration');

    }


    public function createJob(Request $request){

		$validatedData = $request->validate([
			'title'=> 'required',
			'description'=> 'required',
			'roles'=> 'required',
			'category'=> 'required',
			'position'=> 'required',
			'address'=> 'required',
			'job_type'=> 'required',
			'status'=> 'required',
			'last_date' => 'required'
		]);


		$user_id = auth()->user()->id;
		if($user_id):
		$company = Company::select('id')->where('user_id', $user_id)->first();
		//$ids = array('id' =>$user_id, 'company_id'=>$company[0]->id);
		//dd($ids);
		$title = $request->input('title');
		$position = $request->input('position');
		$address =  $request->input('address');
		$job_type = $request->input('job_type');
		$category = $request->input('category');
		$description = $request->input('description');
		$roles = $request->input('roles');
		$status = $request->input('status');
		$last_date = date('Y-m-d', strtotime($request->input('last_date')));

		$job = Job::create([
			'user_id' =>$user_id,
			'company_id'=>$company->id,
			'title'=> $title,
			'slug' => str_slug($title),
			'description'=> $description,
			'roles'=> $roles,
			'category_id'=> $category,
			'position'=> $position,
			'address'=> $address,
			'job_type'=> $job_type,
			'status'=> $status,
			'last_date' =>  $last_date
		]);


		//dd($job);

		return redirect('/employer/create/job')->with('message' , 'Job created successfully');
		else:
			return redirect('/employer/create/job')->with('error' , 'Job not saved');
		endif;
	}

	public function jobCreationForm(){
    	return view('jobs.create');
	}

}
