<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\News;
use App\History;
use Carbon\Carbon;

class NewsController extends Controller


{
 public function add(){
    return view('admin.news.create');
}


public function create(Request $request){
    
    //valitation
    $this->validate($request, News::$rules);
    $news = new News;
    $form = $request->all();
    
    //画像があったら保存、なかったらnullを返す
    if(isset($form['image'])){
        //$formの中にimageはある？
        $path = $request -> file('image') ->store('public/image');
        //ある場合、imageをアップロードして/public/image/'ファイル名'というパスで保存
        $news -> image_path = basename($path);
        //Newsテーブルのimage_pathに、imageを保存したパスの最後、'ファイル名'の部分だけを書き込む
        
    } else {
        $news -> image_path = null;
        //imageがない場合、image_pathにはnullを返す
    }
    
    unset($form['_token']);
    unset($form['image']);
    //一緒にformにくっついてた2項目を削除
    
   $news->fill($form);
    //Newsテーブルの中にformの内容を代入
    $news->save();
    //保存
    
    return redirect('admin/news/');
}

public function index(Request $request){
    
    $cond_title = $request->cond_title;
    if ($cond_title !=''){
        //$cond_titleが「空ではない＝指定された」場合、Newsモデル⇒newsテーブルにアクセスし、タイトルが指定のものと一致するものを取得する
        //$posts="表示するもの"⇒index.bladeでは$post=>$$newsに入れ替えてforeachで順に表示
        $posts = News::where('title',$cond_title) -> get();
    } else {
        //$cond_titleが指定されていない場合、全てを表示
        $posts = News::all();
    }
    //ページを再表示、
    return view('admin.news.index',['posts' =>$posts, 'cond_title' => $cond_title]);
}

Public function edit(Request $request){
    $news = News::find($request -> id);
    if (empty($news)){
        abort(404);
    }
    
    return view('admin.news.edit',['news_form' => $news]);
}


public function update(Request $request){
    $this->validate($request,News::$rules);
    $news = News::find($request->id);
    $news_form = $request->all();
   
    if($request->remove == 'true'){
        //画像が削除されている場合は何もなし
        $news_form['image_path'] = 'null';
    } elseif($request->file('image')){
        //画��がリクエストされた（更新された）場合は保存して新しい画像のパスを反映
        $path = $request->file('image')->store('public/image');
        $news_form['image_path'] = basename('path');
    } else {
        //その他（画像がすでに設定されており変更がない）の場合は、現在設定されている画像のパスを反映
        $news_form['image_path'] = $news->image_path;
        
    unset($news_form['image']);
    unset($news_form['_token']);
    unset($news_form['remove']);
    
    //$newsの中身を、上記の更新終了後の$news_formの内容にして、保存
    $news->fill($news_form)->save();
    
    $history = new History;
    $history->news_id = $news->id;
    $history->edited_at = Carbon::now();
    $history->save();
    
    return redirect('admin/news/');
    }
    
}

public function delete(Request $request){
    $news = News::find($request->id);
    $news->delete();

    return redirect ('admin/news/');
}

}

