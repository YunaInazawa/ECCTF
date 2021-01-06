@extends('layouts.app_header')

@section('title', 'User_details')

@section('content')
<div class="col-md-12">
    <div class="card text-center">
        <div class="card-header"><h4># {{ $user_id }}</h4></div>

        <div class="card-body">
            <form method="POST" action="{{ route('admin.user_update') }}">
                @csrf

                <!-- 学籍番号 -->
                <p>< 学籍番号 ></p>
                <p>{{ $input['student_num'] }}</p>
                <hr>

                <!-- クラス・ユーザ名 -->
                <p>< クラス・ユーザ名 ></p>
                <p>[{{ $input['course'] }}] {{ $input['name'] }}</p>
                <hr>

                <!-- メールアドレス -->
                <p>< メールアドレス ></p>
                <p>{{ $input['email'] }}</p>
                <hr>

                <button type="submit" name="back" class="btn btn-primary">戻る</button>
                <button type="submit" class="btn btn-primary">登録</button>

            </form>
        </div>
    </div>
</div>
@endsection
