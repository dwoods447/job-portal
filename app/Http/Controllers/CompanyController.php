<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Job;
use App\Company;
class CompanyController extends Controller
{
    //

    public function index($id, Company $company){
		$company = Company::findOrFail($id);
		$jobs = Job::where('company_id', $id)->get();
		return view('company.index', compact('company', 'jobs'));
    }


    public function create(){

    }
    public function uploadLogo(){

    }
    public function uploadCoverPhoto(){

    }

    public function store(){

    }

}
