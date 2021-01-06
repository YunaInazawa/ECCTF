<?php
$course_list = ['IE3A', 'IE4A'];
?>

@extends('layouts.app_header')

@section('stylesheet')
<link href="{{ asset('css/app_guest.css') }}" rel="stylesheet">
@endsection

@section('content')
<div class="momizi_drop col-lg-12">
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
        <div class="card_head"><img class="title_ic" src="images/yukidaruma.png"><span class="title"><span>参</span>加登録</span></div>

        <div class="card-body">
            <form method="POST" action="{{ route('register') }}">
                @csrf

                <div class="form-group row input_item">
                    <label for="course" class="col-md-4 col-form-label text-md-right input_label">{{ __('コース') }}</label>

                    <div class="col-md-6">
                        <select id="course" class="form-control @error('course') is-invalid @enderror" name="course" value="{{ old('course') }}" required autocomplete="course" autofocus>
                            <option value="">選択してください</option>
                            @foreach( $courseDatas as $data )
                            <option value="{{ $data->name }}">{{ $data->name }}</option>
                            @endforeach
                        </select>

                        @error('course')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row input_item">
                    <label for="student_num" class="col-md-4 col-form-label text-md-right input_label">{{ __('学籍番号') }}</label>

                    <div class="col-md-6">
                        <input id="student_num" type="text" class="form-control @error('student_num') is-invalid @enderror" name="student_num" value="{{ old('student_num') }}" required autocomplete="student_num" autofocus>

                        @error('student_num')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row input_item">
                    <label for="name" class="col-md-4 col-form-label text-md-right input_label">{{ __('名前') }}</label>

                    <div class="col-md-6">
                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row input_item">
                    <label for="email" class="col-md-4 col-form-label text-md-right input_label">{{ __('メールアドレス') }}</label>

                    <div class="col-md-6">
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

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
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row input_item">
                    <label for="password-confirm" class="col-md-4 col-form-label text-md-right input_label">{{ __('パスワード再入力') }}</label>

                    <div class="col-md-6">
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                    </div>
                </div>

                <div class="form-group row mb-0">
                    <div class="col-md-6 offset-md-4 input_btn">
                        <button type="submit" class="btn btn-primary">
                            {{ __('登録') }}
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
