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
            <p>所持ポイント：{{ $pointNow }}</p>
        </div>

        <button type="submit" class="btn btn-primary">challenge</button>

    </form>

    <div class="card text-center my-5">
        <div class="card-body">
            [ {{ Auth::user()->student_num }} ]<br />
            < {{ Auth::user()->course->name }} > {{ Auth::user()->name }}

        </div>
    </div>

    <form class="text-center">
        <div class="form-group">
            <h1>< 応募している景品一覧 ></h1>
        </div>

        @foreach( $applyGifts as $ag )
        <div class="form-group row gift-box">
            <div class="col-md-4 text-right"><img src="images/sampleQR.png" class="img-responsive fit-image"></div>
            <div class="col-md-4 text-left">
                景品名：{{ $ag->name }}<br/>
                応募数：{{ $ag->pivot->quantity }}
            </div>
            <div class="col-md-1 text-right">×</div>
        </div>
        @endforeach
         
    </form>
</div>
@endsection
