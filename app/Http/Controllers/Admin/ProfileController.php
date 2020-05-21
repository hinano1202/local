<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Profile;
use App\Proflog;
use Carbon\Carbon;

class ProfileController extends Controller
{
    public function add(){
        return view('admin.profile.create');
}

    public function create(Request $request){
        
        $this -> validate($request, Profile::$rules);
        $profile = new Profile;
        $form = $request -> all();
        
        unset($form['_token']);
        unset($form['image']);
        
        $profile->fill($form);
        $profile->save();
        
        return redirect('admin/profile/');
    }
    
    public function index(){
        //profileモデルから、最新の1つだけを取得
        $latest_prof = Profile::latest()->first();
        
        if($latest_prof->gender == 'male'){
            $latest_prof->gender = "男性";
        } else if($latest_prof->gender == 'female'){
            $latest_prof->gender = "女性";
        } else {
            $latest_prof->gender = "無回答";
        }
        
       $late_log = Proflog::latest()->get();
     
        
        return view('admin.profile.index',['latest_prof'=>$latest_prof,'late_log'=>$late_log]);
    }
    
    public function edit(){
        $profile_now = Profile::latest()->first();
        return view('admin.profile.edit',['profile_now'=>$profile_now]);
    }
    
    public function update(Request $request){
       $this -> validate($request, Profile::$rules);
        $profile = new Profile;
        $form = $request -> all();
        
        unset($form['_token']);
        unset($form['image']);
        
        $profile->fill($form);
        $profile->save();
        
         $proflog = new Proflog;
        $proflog->edit_at = Carbon::now();
        $proflog->save();
        
        return redirect('admin/profile/');
        
    }
}

