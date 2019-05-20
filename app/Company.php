<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    //
    protected $fillable = [
        'user_id',
        'company_name',
        'slug',
        'address',
        'phone',
        'website',
        'logo',
        'cover_photo',
        'slogan',
        'description',
    ];

    public function jobs(){
        return $this->hasMany('App\Job');
    }

    public function getRouteKeyName()
	{
		return 'slug';
	}

}
