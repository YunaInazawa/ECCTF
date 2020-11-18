@extends('layouts.app_header')

@section('title', 'question_details')

@section('content')
<div class="col-md-12">
    <div class="card text-center">
        <div class="card-header"><h4># {{ $questionData->id }}</h4></div>

        <div class="card-body">

            <!-- 問題文 -->
            <p>< 問題文 ></p>
            <p>{{ $questionData->text }}</p>
            <hr>

            <!-- 選択肢 -->
            @if( $questionData->type->name == '択一クイズ' || $questionData->type->name == '二択クイズ' || $questionData->type->name == '多答クイズ' )
            <p>< 選択肢 ></p>
            <p>
                @foreach( $choicesData as $choice )
                {{ $choice->text }}<br />
                @endforeach
            </p>
            <hr>
            @endif

            <!-- 正解 -->
            <p>< 正解 ></p>
            <p>{!! nl2br($correct) !!}</p>
            <hr>

            <!-- 解説 -->
            <p>< 解説 ></p>
            <p>{!! nl2br($questionData->commentary) !!}</p>

            <button class="btn btn-primary" onclick=location.href="{{ route('admin.management') }}">戻る</button>
            <button class="btn btn-primary">編集</button>
            <button class="btn btn-primary">削除</button>

        </div>
    </div>
</div>
@endsection
