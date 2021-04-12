<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    protected $guarded = [];



    public function company(){
        return $this->belongsTo(Company::class);
    }

    public function profiles(){
        return $this->belongsToMany(Profile::class, 'jobs_profiles', 'job_id', 'profile_id');
    }

    public function languages(){
        return $this->belongsToMany(Language::class, 'jobs_languages', 'job_id', 'language_id');
    }

    public function technologies(){
        return $this->belongsToMany(Technology::class, 'jobs_technologies', 'job_id', 'technology_id');
    }

}
