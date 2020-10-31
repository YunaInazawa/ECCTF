<?php 
$question_text = '問題文';
$question_type = '穴抜けコード';
$question_answer = ['選択肢1', '選択肢2', '選択肢3'];
?>

@extends('layouts.app')

@section('title', 'question')

@section('content')
<div class="col-md-12">
    <div class="card text-center">
        <div class="card-body">
            <form method="POST" action="{{ route('player.check') }}">
                @csrf

                <div class="form-group">
                    {{ $question_text }}
                </div>

                <div class="form-group row">
                    <div class="col-md-6 mx-auto">
                        @if( $question_type == '択一クイズ' || $question_type == '二択クイズ' )
                            @foreach( $question_answer as $answer )
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios1" value="option1">
                                <label class="form-check-label" for="exampleRadios1">
                                    {{ $answer }}
                                </label>
                            </div>
                            @endforeach
                        @elseif( $question_type == '多答クイズ' )
                            @foreach( $question_answer as $answer )
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="examplechecks" id="examplechecks1" value="option1">
                                <label class="form-check-label" for="examplechecks1">
                                    {{ $answer }}
                                </label>
                            </div>
                            @endforeach
                        @else
                            <input id="my_answer_text" type="text" class="form-control @error('my_answer_text') is-invalid @enderror" name="my_answer_text" required autocomplete="my_answer_text" placeholder="回答を入力してください">
                            @error('my_answer_text')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        @endif
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">
                    {{ __('回答') }}
                </button>

            </form>
        </div>
    </div>
</div>
@endsection
