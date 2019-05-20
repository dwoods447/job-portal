<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Profile;
class ProfileController extends Controller
{
    //

    public function create(){
        return view('profile.index');
    }

    public function store(Request $request){

        $validatedData = $request->validate([
            'address' => 'required',
            'phone' => 'required|min:10|regex:/^([0-9\s\-\+\(\)]*)$/',
            'experience'  => 'required',
            'bio' => 'required|min:20|max:140',
        ]);
        $user_id =  Auth()->user()->id;

        if($user_id) {
            $address = $request->input('address');
            $experience = $request->input('experience');
            $bio = $request->input('bio');
            $phone = $request->input('phone');

            Profile::where('user_id', $user_id)->update([
                'address' => $address,
                'phone' => $phone,
                'experience' => $experience,
                'bio' => $bio,

            ]);
            return redirect('/jobseeker/profile')->with('message', 'Profile information successfully saved!');
        }
        return redirect('/jobseeker/profile')->with('error', 'Error saving profile information!');
    }


    public function uploadAvatar(Request $request){
        $user_id =  Auth()->user()->id;
        if($user_id){

            if($request->hasFile('avatar')){
                $file  = $request->file('avatar');

                $file_ext = $file->getClientOriginalExtension();

                $filename = time() . '.' . $file_ext;

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
            return redirect('/user/profile')->with('message','Resume uploaded successfully.');
        }
        return redirect('/jobseeker/profile')->with('error', 'Error: resume upload unsuccessful!');
    }


    public function uploadCoverLetter(Request $request)
    {
        $validatedData = $request->validate([
            'cover_letter' => 'bail|required|mimes:pdf,doc,docx|max:20000'
        ]);
        $user_id = Auth()->user()->id;
        if ($user_id) {
            $coverletter = $request->file('cover_letter')->store('public/files');

            Profile::where('user_id', $user_id)->update([
                'cover_letter' => $coverletter
            ]);

            return redirect('/jobseeker/profile')->with('message', 'Cover Letter successfully uploaded!');
        }
        return redirect('/jobseeker/profile')->with('error', 'Error: Cover Letter upload unsuccessful!');
    }





 }
