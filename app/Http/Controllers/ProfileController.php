<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Profile;
class ProfileController extends Controller
{

    public function __construct()
    {
        //Only Job seeker has access
        $this->middleware(['seeker', 'verified']);
    }





    //Job seeker profile page
	public function create(){
		return view('profile.index');
	}

	//Creates a new job seeker profile or updates an existing one
    public function store(Request $request){

        $validatedData = $request->validate([
            'address' => 'required',
            'phone' => 'required|min:10|regex:/^([0-9\s\-\+\(\)]*)$/',
            'gender' => 'required',
            'experience'  => 'required',
            'bio' => 'required|min:20|max:140',
        ]);
        $user_id =  Auth()->user()->id;

        if($user_id) {
            $address = $request->input('address');
            $experience = $request->input('experience');
            $gender = $request->input('gender');
            $bio = $request->input('bio');
            $phone = $request->input('phone');

            $profile = Profile::where('user_id', $user_id)->get();
			if(empty($profile)){
				$profileUpdate = Profile::where('user_id', $user_id)->update([
					'address' => $address,
					'phone' => $phone,
					'gender' => $gender,
					'experience' => $experience,
					'bio' => $bio,

				]);

			}else{
				$newProfile = Profile::create([
					'user_id' => $user_id,
					'address' => $address,
					'phone' => $phone,
                    'gender' => $gender,
					'experience' => $experience,
					'bio' => $bio,
				]);

			}

            return redirect('/jobseeker/profile')->with('message', 'Profile information successfully saved!');
        }
        return redirect('/jobseeker/profile')->with('error', 'Error saving profile information!');
    }

 	//Uploads avatar for job seeker
    public function uploadAvatar(Request $request){
        $user_id =  Auth()->user()->id;
        if($user_id){

            if($request->hasFile('avatar')){
                $file  = $request->file('avatar');

                $file_ext = $file->getClientOriginalExtension();

                $filename = time() . '.' . strtolower($file_ext);

                $file->move('uploads/avatars/', $filename);

                Profile::where('user_id', $user_id)->update([
                    'avatar' => $filename
                ]);

                return redirect('/jobseeker/profile')->with('message', 'Avatar uploaded successfully');
            }else{
                return redirect('/jobseeker/profile')->with('error', 'Error: avatar upload unsuccessful!');
            }
        }
        return redirect('/jobseeker/profile')->with('error', 'Error: avatar upload unsuccessful!');
    }

	//Uploads resume for job seeker
    public function uploadResume(Request $request){
        $validatedData = $request->validate([
            'resume' => 'bail|required|mimes:pdf,doc,docx|max:20000'
        ]);
        $user_id =  Auth()->user()->id;
        if($user_id){

            $resume = $request->file('resume')->store('public/resumes');

            Profile::where('user_id', $user_id)->update([
                'resume' => $resume
            ]);
            return redirect('/jobseeker/profile')->with('message','Resume uploaded successfully.');
        }
        return redirect('/jobseeker/profile')->with('error', 'Error: resume upload unsuccessful!');
    }

	//Uploads cover letter for job seeker
    public function uploadCoverLetter(Request $request)
    {
        $validatedData = $request->validate([
            'cover_letter' => 'bail|required|mimes:pdf,doc,docx|max:20000'
        ]);
        $user_id = Auth()->user()->id;
        if ($user_id) {
            $coverletter = $request->file('cover_letter')->store('public/coverletters');

            Profile::where('user_id', $user_id)->update([
                'cover_letter' => $coverletter
            ]);

            return redirect('/jobseeker/profile')->with('message', 'Cover Letter successfully uploaded!');
        }
        return redirect('/jobseeker/profile')->with('error', 'Error: Cover Letter upload unsuccessful!');
    }





 }
