<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Job;
use App\Company;
class CompanyController extends Controller
{
    //



    public function __construct()
    {
        //Job seeker has access to only the index, show, signup, register  methods
        //Ensures only employers have access to the createJob function
        $this->middleware(['employer', 'verified'], ['except' =>  array('index')]);
    }

    //View individual company information
    public function index($id, Company $company){
		$company = Company::findOrFail($id);
		$jobs = Job::where('company_id', $id)->get();
		return view('company.index', compact('company', 'jobs'));
    }

    //View company profile page
    public function create(){
        return view('company.create');
    }
    public function uploadLogo(Request $request){
        $user_id =  Auth()->user()->id;
        if($user_id){

            if($request->hasFile('logo')){
                $file  = $request->file('logo');

                $file_ext = $file->getClientOriginalExtension();

                $filename = time() . '.' . strtolower($file_ext);

                $file->move('uploads/logos/', $filename);

                Company::where('user_id', $user_id)->update([
                    'logo' => $filename
                ]);

                return redirect('/company/create')->with('message', 'Logo uploaded successfully');
            }else{
                return redirect('/company/create')->with('error', 'Logo upload unsuccessful');
            }
        }
        return redirect('/company/create')->with('error', 'Logo upload unsuccessful');
    }


    public function uploadCoverPhoto(Request $request){
        $user_id = auth()->user()->id;

        if($user_id){
            if($request->hasfile('cover_photo')){
                $file = $request->file('cover_photo');
                $ext = $file->getClientOriginalExtension();
                $filename = time() . '.'. strtolower($ext);
                $file->move('uploads/coverphoto/', $filename);
                Company::where('user_id', $user_id)->update([
                    'cover_photo' => $filename
                ]);
                return redirect('/company/create')->with('message', 'Cover photo uploaded successfully');
            }else{
                return redirect('/company/create')->with('error', 'Cover photo upload unsuccessful');
            }
        }
        return redirect('/company/create')->with('error', 'Cover photo upload unsuccessful');
    }




    public function store(Request $request){
        $user_id =  Auth()->user()->id;
        if($user_id){
            $address = $request->input('address');
            $phone  = $request->input('phone');
            $website = $request->input('website');
            $slogan = $request->input('slogan');
            $description = $request->input('description');

            Company::where('user_id', $user_id)->update([
                'address' =>$address,
                'phone' => $phone,
                'website' => $website,
                'slogan' => $slogan,
                'description' => $description,

            ]);

            return redirect('/company/create')->with('message', 'Company profile successfully saved.');
        }
        return redirect('/company/create')->with('error', 'Company profile unsuccessful.');
    }

}
