<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Company;
use App\User;
use App\Job;
use Hash;
class EmployerController extends Controller
{
    //
    public function signup(){
        return view('auth.employer-register');
    }

    public function register(Request $request){
        $this->validate($request, [
            'company_name'=>'required',
            'email' => 'required',
            'user_type' => 'required',
            'password'=> 'required'
        ]);

        $company = $request->input('company_name');
        $email = $request->input('email');
        $password  = $request->input('password');
        $user_type = $request->input('user_type');
        $slug =  str_slug($request->input('company_name'));
        $user =  User::create([
            'name' => $company,
            'email' => $email,
            'user_type' => $user_type,
            'password' => Hash::make($password),

        ]);
        $company  = Company::create([
            'user_id' =>$user->id,
            'company_name'=>$company,
            'slug'=> $slug,
        ]);
        return redirect('/login')->with('message', 'Please verify your email!');
    }

    public function getJobs(){
        $user_id = auth()->user()->id;
        $jobs = Job::where('user_id', $user_id)->get();
        return view('company.jobs', compact('jobs'));
    }

    public function editJob($user_id, $company_id){

        $job = Job::where('user_id', $user_id)->where('company_id', $company_id)->first();

            //dd($jobs);
          return view('jobs.edit', compact('job'));
    }

    public function updateJob($id, Request $request){


    		$job = Job::findorFail($id);

			$job->update($request->all());

//         Job::where('id', $id)->update([
//            'title'=> $request->input('title'),
//            'slug'=>  str_slug($request->input('title')),
//            'description'=> $request->input('description'),
//            'roles'=> $request->input('roles'),
//            'category_id'=> $request->input('category'),
//            'position'=> $request->input('position'),
//            'address'=> $request->input('address'),
//            'job_type'=> $request->input('job_type'),
//            'status'=> $request->input('status'),
//            'last_date'=> $request->input('last_date'),
//        ]);
//
//        $job = Job::where('id', $id)->get();

        return view('jobs.edit', compact('job'));
    }


}
