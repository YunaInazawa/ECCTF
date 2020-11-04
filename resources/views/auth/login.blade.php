@extends('layouts.app_header')



@section('stylesheet')
<link href="{{ asset('css/app_guest.css') }}" rel="stylesheet">
@endsection

@section('content')
<div class="momizi_drop" col-lg-12">
    <div class="momizi1 momizi"></div>
    <div class="momizi2 momizi"></div>
    <div class="momizi3 momizi"></div>
    <div class="momizi4 momizi"></div>
    <div class="momizi5 momizi"></div>
    <div class="momizi6 momizi"></div>
    <div class="momizi7 momizi"></div>
    <div class="momizi8 momizi"></div>
    <div class="momizi9 momizi"></div>
    <div class="momizi10 momizi"></div>
</div>
    <div class="col-md-8">
        <div class="card">
            <div class="card_head"><img class="title_ic" src="images/momizi_3.png"><span class="title"><span>ロ</span>グイン</span></div>

            <div class="card-body">
                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="form-group row input_item">
                        <label for="email" class="col-md-4 col-form-label text-md-right input_label">{{ __('メールアドレス') }}</label>

                        <div class="col-md-6">
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row input_item">
                        <label for="password" class="col-md-4 col-form-label text-md-right input_label">{{ __('パスワード') }}</label>

                        <div class="col-md-6">
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row input_item">
                        <div class="col-md-6 offset-md-4">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                <label class="form-check-label input_label" for="remember">
                                    {{ __('保存する') }}
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="form-group row mb-0">
                        <div class="col-md-8 offset-md-4 input_btn">
                            <button type="submit" class="btn btn-primary">
                                {{ __('ログイン') }}
                            </button>

 
                        </div>
                        <div class="col-lg-12">
                                @if (Route::has('password.request'))
                                <a class="" href="{{ route('password.request') }}">
                                    {{ __('パスワードを忘れた') }}
                                </a>
                            @endif
                        </div>
                    </div>
                    
                </form>
            </div>
        </div>
    </div>
@endsection
