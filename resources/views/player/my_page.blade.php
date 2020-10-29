<?php  
$user_name = 'hoge';
$user_num = '2170001';
$user_course = 'IE3A';
$user_point = 0;

$gift_name = ['gift01', 'gift02', 'gift03'];
$gift_num = [1, 2, 1];

?>

@extends('layouts.app')

@section('title', 'my_page')

@section('stylesheet')
<link href="{{ asset('css/my_page.css') }}" rel="stylesheet">
@endsection

@section('content')
<div class="col-md-12">
    <form class="text-center" action="http://localhost:8000/challenge">
        <div class="form-group">
            <h1>リーーーーチ☆</h1>
        </div>

        <div class="form-group">
            <p>ここに表</p>
        </div>

        <div class="form-group">
            <p>所持ポイント：{{ $user_point }}</p>
        </div>

        <button type="submit" class="btn btn-primary">challenge</button>

    </form>

    <div class="card text-center my-5">
        <div class="card-body">
            [ {{ $user_num }} ]<br />
            < {{ $user_course }} > {{ $user_name }}

        </div>
    </div>

    <form class="text-center">
        <div class="form-group">
            <h1>< 応募している景品一覧 ></h1>
        </div>

        @for( $i = 0; $i < count($gift_name); $i++ )
        <div class="form-group row gift-box">
            <div class="col-md-4 text-right"><img src="images/sampleQR.png" class="img-responsive fit-image"></div>
            <div class="col-md-4 text-left">
                景品名：{{ $gift_name[$i] }}<br/>
                応募数：{{ $gift_num[$i] }}
            </div>
            <div class="col-md-1 text-right">×</div>
        </div>
        @endfor
                
        <div class="form-group">
            <p>所持ポイント：0</p>
        </div>

        <button type="button" class="btn btn-primary">challenge</button>

    </form>
</div>
@endsection
