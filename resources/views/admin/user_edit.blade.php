@extends('layouts.app_header')

@section('title', 'user_edit')

@section('js')
<script src="{{ asset('js/admin.js') }}" defer></script>
@endsection

@section('stylesheet')
<link href="{{ asset('css/admin.css') }}" rel="stylesheet">
@endsection

@section('content')
    <div class="col-md-12">
        <div class="card">
            <div class="card-header"><img class="title_ic" src="{{ asset('images/momizi_3.png') }}"><span class="title"><span>Ｕ</span>ｕｓｅｒ - 編集</span></div>

            <div class="card-body">
                <form method="POST" action="{{ route('admin.user_check') }}">
                    @csrf

                    <!-- フラッシュメッセージ -->
                    @if (session('flash_message'))
                        <div class="flash_message text-center">
                            <h4><font color="red">{{ session('flash_message') }}</font></h4>
                            <hr>
                        </div>
                    @endif

                    <div class="form-group row">
                        <label for="course" class="col-md-4 col-form-label text-md-right input_label">{{ __('コース') }}</label>

                        <div class="col-md-6">
                            <select id="course" class="form-control @error('course') is-invalid @enderror" name="course" required autocomplete="course" autofocus>
                                <option value="">選択してください</option>
                                @foreach( $courseDatas as $data )
                                <option value="{{ $data->name }}" @if(old('course', $userData->course->name) == $data->name) selected @endif>{{ $data->name }}</option>
                                @endforeach
                            </select>

                            @error('course')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="student_num" class="col-md-4 col-form-label text-md-right input_label">{{ __('学籍番号') }}</label>

                        <div class="col-md-6">
                            <input id="student_num" type="text" class="form-control @error('student_num') is-invalid @enderror" name="student_num" value="{{ old('student_num', $userData->student_num) }}" required autocomplete="student_num" autofocus>

                            @error('student_num')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="name" class="col-md-4 col-form-label text-md-right input_label">{{ __('名前') }}</label>

                        <div class="col-md-6">
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name', $userData->name) }}" required autocomplete="name" autofocus>

                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="email" class="col-md-4 col-form-label text-md-right input_label">{{ __('メールアドレス') }}</label>

                        <div class="col-md-6">
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email', $userData->email) }}" required autocomplete="email">

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="password" class="col-md-4 col-form-label text-md-right input_label">{{ __('パスワード') }}</label>

                        <div class="col-md-6">
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="password">

                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="password_check" class="col-md-4 col-form-label text-md-right input_label">{{ __('再入力') }}</label>

                        <div class="col-md-6">
                            <input id="password_check" type="password" class="form-control @error('password_check') is-invalid @enderror" name="password_check" required autocomplete="password_check">

                            @error('password_check')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row mb-0">
                        <div class="col-md-4 offset-md-2 text-md-left input_btn">
                            <button type="button" class="btn btn-primary" onclick=location.href="{{ route('admin.user_details', $userData->id) }}">
                                {{ __('戻る') }}
                            </button>

                        </div>

                        <div class="col-md-4 input_btn">
                            <button type="submit" class="btn btn-primary">
                                {{ __('確認') }}
                            </button>
                            <input type="hidden" name="user_id" value="{{ $userData->id }}">

                        </div>
                    </div>
                    
                </form>
            </div>
        </div>
    </div>
@endsection
