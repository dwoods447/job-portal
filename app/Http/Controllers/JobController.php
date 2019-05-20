<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Job;
use App\User;
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

}
