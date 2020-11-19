@extends('layouts.app_header')

@section('title', 'question_check')

@section('content')
<div class="col-md-12">
    <div class="card text-center">
        <div class="card-body">
            <form method="POST" action="{{ route('admin.question_new') }}">
                @csrf

                <!-- ジャンル -->
                <p>< ジャンル ></p>
                <p>{{ $input['genre'] }}</p>
                <hr>

                <!-- レベル -->
                <p>< レベル ></p>
                <p>{{ $input['level'] }}</p>
                <hr>

                <!-- 問題文 -->
                <p>< 問題文 ></p>
                <p>{!! nl2br($input['text']) !!}</p>
                <hr>

                <!-- 回答タイプ -->
                <p>< 回答タイプ ></p>
                <p>{{ $input['type'] }}</p>
                <hr>

                <!-- 選択肢 -->
                @if( $input['type'] == '択一クイズ' || $input['type'] == '二択クイズ' || $input['type'] == '多答クイズ' )
                <p>< 選択肢 ></p>
                <p>
                    @foreach( $input['answer'] as $a )
                    {{ $a }}<br />
                    @endforeach
                </p>
                <hr>
                @endif

                <!-- 正解 -->
                <p>< 正解 ></p>
                <p>
                    @foreach( $input['correct'] as $c )
                    {{ $c }}<br />
                    @endforeach
                </p>
                <hr>

                <!-- 解説 -->
                <p>< 解説 ></p>
                <p>{!! nl2br($input['commentary']) !!}</p>

                <button type="submit" name="back" class="btn btn-primary">戻る</button>
                <button type="submit" class="btn btn-primary">登録</button>
            </form>
        </div>
    </div>
</div>
@endsection
