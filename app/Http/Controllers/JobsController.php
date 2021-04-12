<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\Language;
use App\Models\Technology;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JobsController extends Controller
{
    public function show(Job $job){
        return view('jobs/show', compact('job'));
    }

    public function index(){
        $jobs = Job::paginate(5);
        return view('jobs/index', compact('jobs'));
    }

    public function create(){
        $user=Auth::user();
        if($user === null) {
            return redirect()->to('/login');
        } else {
            $company = $user->company()->first();
            if($company === null){
                return redirect()->to('/companies/create');
            }
        }
        $langs = Language::all();
        $techs = Technology::all();
        return view('jobs/create', compact('langs', 'techs', 'company'));
    }

    public function store(Request $request){
        $user = Auth::user();
        if($user === null){
            return redirect()->to('/login');
        }
        $data = $request->validate([
            'title' => 'required|max:30',
            'company_id' => 'required|int|min:1',
            'work_time' => 'required|min:8|max:15',
            'work_type' => 'required|min:8|max:15',
            'age' => 'required|min:6|max:15',
            'experience' => 'required|min:5|max:15',
            'description' => 'required|min:15|max:5000',
            'min_price' => 'required|int|min:1',
            'max_price' => 'required|int|min:1',
            'currency' => 'required|min:3|max:3',
            'valid_from' => 'required|date',
            'valid_until' => 'required|date',
        ]);
        $job = Job::create($data);
        $this->attachFeatures($job, $request->except('_token'));
        return redirect()->to('/');
    }

    public function apply(Job $job){
        $user = Auth::user();
        if($user === null){
            return redirect()->to('/login');
        }
        $company = $user->company()->first();
        $profile = $user->profile()->first();
        $employer = $job->company()->first();
        if($company != null) {
            if ($company->id === $employer->id) {
                return redirect()->back();
            }
        }

        if($profile === null){
            return redirect()->to('/profiles/create');
        }
        $application = $job->profiles()->find($profile->id);
        if($application != null){
            return redirect()->to('/profiles/'.$user->id);
        }
        $job->profiles()->attach($profile->id);
        return redirect()->to('/profiles/'.$user->id);
    }

    public function candidates(Job $job){
        $user = Auth::user();
        if($user === null){
            return redirect()->to('/login');
        }
        $company = $user->company()->first();
        $employer = $job->company()->first();
        if($company === null || $employer === null){
            return redirect()->to('/');
        }
        if($company->id != $employer->id){
            return redirect()->to('/companies/'.$user->id);
        }
        $candidates = $job->profiles()->get();
        return view('jobs/candidates', compact('candidates', 'job'));
    }

    public function search(Request $request){
        $search = $request->get('title');

        $data =  Job::where('title', 'like', '%'.$search.'%')->get();
        return response($data, 200)
            ->header('Content-Type', 'application/json');

    }


    private function attachFeatures($job, $array){
        foreach($array as $key => $part){
            if(substr($key, 0, 4) === 'lang'){
                $job->languages()->attach($part);
            }
            if(substr($key, 0, 4) === 'tech'){
                $job->technologies()->attach($part);
            }
        }
    }



}
