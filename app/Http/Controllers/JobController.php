<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Job;
use App\User;
use App\Company;
use App\Profile;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
class JobController extends Controller
{
    public function __construct()
{
    //Job seeker has access to only the index, show, signup, register  methods
    //Ensures only employers have access to the createJob function
    $this->middleware('employer', ['except' =>  array('index', 'show', 'signup' ,'register' ,'submitApplication')]);
}


	//List all jobs to job seeker
    public function index(){
        $jobs = Job::all();
        return view('jobs.index', compact('jobs'));
    }
	//Routes to the job creation form view for employer
	public function jobCreationForm(){
		return view('jobs.create');
	}

    //Show specific job to job seeker
    public function show($id, $slug){
        $job = Job::findOrFail($id);
        return view('jobs.show', compact('job'));
    }

    //Takes job seeker to registration form
    public function signup(){
        return view('auth.jobseeker-register');
    }


    //Saves job seeker registration information
    public function register(Request $request){



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

	// Creates new job for employer
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



		return redirect('/employer/create/job')->with('message' , 'Job created successfully');
		else:
			return redirect('/employer/create/job')->with('error' , 'Job not saved');
		endif;
	}

	public  function submitApplication(Request $request, $id){
                $jobID = Job::find($id);
                $jobID->users()->attach(Auth::user()->id);
        return redirect()->back()->with('message', 'Application submitted!');
    }


    public  function getApplicants(){
        $user_id = auth()->user()->id;
        $applicants = Job::has('users')->where('user_id', $user_id)->get();
        //dd($applicants);
        return view('jobs.applicants', compact('applicants'));
    }






}
