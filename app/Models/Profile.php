<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $guarded = [];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function jobs(){
        return $this->belongsToMany(Job::class, 'jobs_profiles', 'profile_id', 'job_id');
    }
}
