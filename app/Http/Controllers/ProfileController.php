<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Profile;

class ProfileController extends Controller
{
    //
    Public function index(Request $request){
        $user_prof = Profile::latest()->first();
        if($user_prof->gender == 'male'){
            $user_prof->gender = '男性';
        }elseif($user_prof->gender == 'female'){
            $user_prof->gender = '女性';
        }else{
            $user_prof = 'その他';
        }
    return view ('profile' , ['user_prof' => $user_prof]);
    }
}
