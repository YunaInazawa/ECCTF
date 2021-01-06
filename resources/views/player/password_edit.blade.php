@extends('layouts.app_header')

@section('title', 'pass_reset')

@section('content')
<div class="col-md-8">
    <div class="card">
        <div class="card_head"><img class="title_ic" src="images/yukidaruma.png"><span class="title"><span>パ</span>スワード変更</span></div>

        <div class="card-body">
            <form method="POST" action="{{ route('player.pass_update') }}">
                @csrf

                <!-- フラッシュメッセージ -->
                @if (session('flash_message'))
                <div class="form-group row input_item">
                    <div class="flash_message col-md-8 text-center">
                    <hr>
                        <label class="col-form-label text-md-center input_label">
                            <font color="red">--- {!! nl2br(session('flash_message')) !!} ---</font>
                        </label>
                        <hr>
                    </div>
                </div>
                @endif

                <div class="form-group row input_item">
                    <label for="password" class="col-md-4 col-form-label text-md-right input_label">{{ __('新しいパスワード') }}</label>

                    <div class="col-md-6">
                        <input id="password" type="password" class="form-control" name="password" required>
                    </div>
                </div>

                <div class="form-group row input_item">
                    <label for="password_check" class="col-md-4 col-form-label text-md-right input_label">{{ __('新しいパスワード再入力') }}</label>

                    <div class="col-md-6">
                        <input id="password_check" type="password" class="form-control" name="password_check" required>
                    </div>
                </div>

                <div class="form-group row mb-0">
                    <div class="col-md-8 offset-md-4 input_btn">
                    <button type="button" class="btn btn-primary" onclick=location.href="{{ route('player.my_page') }}">
                            {{ __('戻る') }}
                        </button>
                        <button type="submit" class="btn btn-primary">
                            {{ __('変更') }}
                        </button>


                    </div>
                </div>
                
            </form>
        </div>
    </div>
</div>
@endsection
