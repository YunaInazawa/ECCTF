@extends('layouts.app_header')

@section('title', 'User_details')

@section('content')
<div class="col-md-12">
    <div class="card text-center">
        <div class="card-header"><h4># {{ $userData->id }}</h4></div>

        <div class="card-body">

            <!-- 学籍番号 -->
            <p>< 学籍番号 ></p>
            <p>{{ $userData->student_num }}</p>
            <hr>

            <!-- クラス・ユーザ名 -->
            <p>< クラス・ユーザ名 ></p>
            <p>[{{ $userData->course->name }}] {{ $userData->name }}</p>
            <hr>

            <!-- メールアドレス -->
            <p>< メールアドレス ></p>
            <p>{{ $userData->email }}</p>
            <hr>

            <!-- ポイント -->
            <p>< ポイント ></p>
            <p>{{ $userData->point }}</p>
            <hr>

            <!-- 応募景品 -->
            <p>< 応募景品 ></p>
            <p>
                @foreach( $userData->gifts as $gift )
                {{ $gift->name }} : {{ $gift->pivot->quantity }}<br />
                @endforeach
            </p>
            <hr>

            <button class="btn btn-primary" onclick=location.href="{{ route('admin.management') }}">戻る</button>
            <button class="btn btn-primary">編集</button>
            <button class="btn btn-primary">削除</button>

        </div>
    </div>
</div>
@endsection
