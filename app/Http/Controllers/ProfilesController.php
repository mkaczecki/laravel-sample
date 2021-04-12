<?php

namespace App\Http\Controllers;
use App\Models\Profile;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfilesController extends Controller
{
    public function create(){
        $user = Auth::user();
        if($user === null){
            return redirect()->to('/login');
        } else {
            if($user->profile()->first() != null){
                return redirect()->to('/profiles/'.$user->id);
            }
        }
        return view('/profiles/create', compact('user'));
    }


    public function store(Request $request){
        $user = Auth::user();
        if($user === null){
            return redirect()->to('/login');
        }

        $request->validate([
            'cv' => 'nullable|mimes:pdf,jpg,png|max:1024',
        ]);

        $request->validate([
            'image' => 'nullable|image|max:2048',
        ]);

        $file_cv = $request->file('cv');
        $file_image = $request->file('image');
        $storage_cv_name = null;
        $storage_image_name = null;

        if($file_cv != null){
            $storage_cv_name = time().'_'.$file_cv->getClientOriginalName();
            $file_cv->storeAs('resumes', $storage_cv_name, 'public');
        }

        if($file_image !=null){
            $storage_image_name = time().'_'.$file_image->getClientOriginalName();
            $file_image->storeAs('images', $storage_image_name, 'public');
        }

        $cv = [
            'cv' => $storage_cv_name,
        ];

        $image = [
            'image' => $storage_image_name,
        ];

        $data = $request->validate([
            'user_id' => 'required|int|min:1',
            'first_name' => 'required|max:30',
            'last_name' => 'required|max:30',
            'country' => 'required|max:30',
            'city' => 'required|max:30',
            'about_me' => 'nullable|min:10|max:5000',
            'phone' => 'nullable|regex:/^([0-9,+\s\-\(\)]*)$/|min:12|max:16',
            'website' =>'nullable|url',
            'linkedin' =>'nullable|url',
            'github' =>'nullable|url',
        ]);



        $data = array_merge($data, $cv, $image);
        $profile = Profile::create($data);
        return redirect()->to('profiles/'.$profile->id);
    }

    public function show(User $user){
        $auth = Auth::user();
        if($auth === null || $auth->id != $user->id){
            return redirect()->to('/');
        }
        $profile = $user->profile()->first();
        if($profile === null){
            return redirect()->to('/profiles/create');
        }
        $jobs = $profile->jobs()->get();
        return view('/profiles/show', compact('profile', 'jobs'));
    }



}
