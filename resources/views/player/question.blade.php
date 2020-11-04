@extends('layouts.app_header')

@section('title', 'question')

@section('content')
<div class="col-md-12">
    <div class="card text-center">
        <div class="card-body">
            <form method="POST" action="{{ route('player.check') }}">
                @csrf

                <div class="form-group">
                    <!-- フラッシュメッセージ -->
                    @if (session('flash_message'))
                        <div class="flash_message">
                            {!! nl2br(session('flash_message')) !!}
                            <hr>
                        </div>
                    @endif
                </div>

                <div class="form-group">
                    {{ $questionData->text }}
                </div>

                <div class="form-group row">
                    <div class="col-md-6 mx-auto">
                        @if( $question_type == '択一クイズ' || $question_type == '二択クイズ' )
                            @foreach( $questionData->choices as $choice )
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="answerRadio" id="answerRadio" value="{{ $choice->id }}">
                                <label class="form-check-label" for="answerRadio">
                                    {{ $choice->text }}
                                </label>
                            </div>
                            @endforeach
                        @elseif( $question_type == '多答クイズ' )
                            @foreach( $questionData->choices as $choice )
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="answerChecks[]" id="answerChecks" value="{{ $choice->id }}">
                                <label class="form-check-label" for="answerChecks">
                                    {{ $choice->text }}
                                </label>
                            </div>
                            @endforeach
                        @else
                            <input id="answerText" type="text" class="form-control @error('answerText') is-invalid @enderror" name="answerText" required autocomplete="answerText" placeholder="回答を入力してください">
                            @error('answerText')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        @endif
                    </div>
                </div>

                <input type="hidden" name="question_id" value="{{ $questionData->id }}">
                <button type="submit" class="btn btn-primary">
                    {{ __('回答') }}
                </button>

            </form>
        </div>
    </div>
</div>
@endsection
