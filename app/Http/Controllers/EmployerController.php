<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Company;
use App\User;
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



        return redirect('/login')->with('message', 'Successful Registration');

    }


}
