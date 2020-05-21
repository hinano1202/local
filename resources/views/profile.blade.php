@extends('layouts.userprof')

@section('content')
<div class="container">
    <div class="row">
        <dic class="col-md-10 mx-auto">
            <div class="row">
            <div class="title col-md-8 mx-auto">
                <h2 align="center">ユーザーのプロフィール</h2>
                </div>
    </div>            
        <div class="row">       
        <div class="col-md-8 mx-auto">
            <hr color="#b0c4d pt-3">
            <div class="row">
            <div class="col-md-4 pt-3 mx-auto">
                <p align="center">氏名</p>
            </div>
            <div class="col-md-8 pt-3">
                <p>{{ $user_prof->name}}</p>
            </div>  
            </div>
        </div>
        </div>
        <div class="row">       
        <div class="col-md-8 mx-auto">
            <hr color="#b0c4d pt-3">
            <div class="row">
            <div class="col-md-4 pt-3 mx-auto">
                <p align="center">性別</p>
            </div>
            <div class="col-md-8 pt-3">
                <p>{{ $user_prof->gender}}</p>
            </div>  
            </div>
        </div>
        </div>
        <div class="row">       
        <div class="col-md-8 mx-auto">
            <hr color="#b0c4d pt-3">
            <div class="row">
            <div class="col-md-4 pt-3 mx-auto">
                <p align="center">趣味</p>
            </div>
            <div class="col-md-8 pt-3">
                <p>{{ $user_prof->hobby}}</p>
            </div>  
            </div>
        </div>
        </div>
      <div class="row">       
        <div class="col-md-8 mx-auto">
            <hr color="#b0c4d pt-3">
            <div class="row">
            <div class="col-md-4 pt-3 mx-auto">
                <p align="center">自己紹介</p>
            </div>
            <div class="col-md-8 pt-3">
                <p>{{ $user_prof->introduction}}</p>
            </div>  
            </div>
        </div>
        </div>   
        </div>
        
    </div>
</div>
</div>
@endsection