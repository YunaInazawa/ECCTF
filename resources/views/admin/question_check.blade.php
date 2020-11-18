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
                <p>{{ $genre }}</p>
                <input type="hidden" name="genre" value="{{ $genre }}">
                <hr>

                <!-- レベル -->
                <p>< レベル ></p>
                <p>{{ $level }}</p>
                <input type="hidden" name="level" value="{{ $level }}">
                <hr>

                <!-- 問題文 -->
                <p>< 問題文 ></p>
                <p>{!! nl2br($text) !!}</p>
                <input type="hidden" name="text" value="{{ $text }}">
                <hr>

                <!-- 回答タイプ -->
                <p>< 回答タイプ ></p>
                <p>{{ $type }}</p>
                <input type="hidden" name="type" value="{{ $type }}">
                <hr>

                <!-- 選択肢 -->
                @if( $type == '択一クイズ' || $type == '二択クイズ' || $type == '多答クイズ' )
                <p>< 選択肢 ></p>
                <p>
                    @foreach( $answer as $a )
                    {{ $a }}
                    <input type="hidden" name="answer[]" value="{{ $a }}"><br />
                    @endforeach
                </p>
                <hr>
                @else
                <input type="hidden" name="answer[]" value="{{ $answer[0] }}"><br />
                @endif

                <!-- 正解 -->
                <p>< 正解 ></p>
                <p>{!! nl2br($correct) !!}</p>
                <input type="hidden" name="correct" value="{{ $correct }}">
                <hr>

                <!-- 解説 -->
                <p>< 解説 ></p>
                <p>{!! nl2br($commentary) !!}</p>
                <input type="hidden" name="commentary" value="{{ $commentary }}">

                <button type="button" class="btn btn-primary">戻る</button>
                <button type="submit" class="btn btn-primary">登録</button>
            </form>
        </div>
    </div>
</div>
@endsection