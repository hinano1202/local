<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\News;
use App\History;

class NewsController extends Controller
{
    //
    public function index(Request $request){
        $posts = News::all()->sortbyDesc('updated_at');
        
        if(count($posts) >0){
            $headline = $posts->shift();
        }else{
            $headline = null;
        }
    
    return view('news.index' , [ 'headline' => $headline , 'posts' => $posts]);
    }
}
