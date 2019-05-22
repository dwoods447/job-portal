<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Job extends Model
{
    //
    protected  $fillable = [
        'user_id',
        'company_id',
        'title',
        'slug',
        'description',
        'roles',
        'category_id',
        'position',
        'address',
        'job_type',
        'status',
        'last_date',

    ];


    public function getRouteKeyName()
    {
        return 'slug';
    }
    public function company(){
        return $this->belongsTo('App\Company');
    }

    public function users(){
        return  $this->belongsToMany(User::class)->withTimestamps();
    }


    public function checkJobApplication(){
        $user_id = auth()->user()->id;
        return DB::table('job_user')
            ->where('user_id', $user_id)
            ->where('job_id', $this->id)
            ->exists();
    }
}
