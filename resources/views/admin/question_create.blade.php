@extends('layouts.app_header')

@section('title', 'question_create')

@section('js')
<script src="{{ asset('js/admin.js') }}" defer></script>
@endsection

@section('stylesheet')
<link href="{{ asset('css/admin.css') }}" rel="stylesheet">
@endsection

@section('content')
    <div class="col-md-12">
        <div class="card">
            <div class="card-header"><img class="title_ic" src="images/momizi_3.png"><span class="title"><span>Ｑ</span>ｕｅｓｔｉｏｎ - 新規作成</span></div>

            <div class="card-body">
                <form method="POST" action="{{ route('admin.question_new') }}">
                    @csrf

                    <div class="row">
                        <!-- ジャンル -->
                        <div class="form-group col-md-6">
                            <label for="genre" class="col-md-8 offset-md-4 col-form-label input_label">{{ __('ジャンル') }}</label>

                            <div class="col-md-8 offset-md-4">
                                <select id="genre" class="form-control @error('genre') is-invalid @enderror" name="genre" value="{{ old('genre') }}" required autocomplete="genre">
                                    <option value="">選択してください</option>
                                    @foreach( $genres as $genre )
                                    <option value="{{ $genre->id }}">{{ $genre->name }}</option>
                                    @endforeach
                                </select>

                                @error('genre')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <!-- レベル -->
                        <div class="form-group col-md-6">
                            <label for="level" class="col-md-8 col-form-label input_label">{{ __('レベル') }}</label>

                            <div class="col-md-8">
                                <select id="level" class="form-control @error('level') is-invalid @enderror" name="level" value="{{ old('level') }}" required autocomplete="level">
                                    <option value="">選択してください</option>
                                    @foreach( $levels as $level )
                                    <option value="{{ $level->name }}">{{ $level->name }}</option>
                                    @endforeach
                                </select>

                                @error('level')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- 問題文 -->
                    <div class="form-group">
                        <label for="text" class="col-md-8 offset-md-2 col-form-label input_label">{{ __('問題文') }}</label>

                        <div class="col-md-8 offset-md-2">
                            <textarea id="text" class="form-control @error('text') is-invalid @enderror" name="text" required autocomplate="text" autofocus>{{ old('text') }}</textarea>

                            @error('text')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <!-- 回答タイプ -->
                    <div class="form-group">
                        <label for="type" class="col-md-4 offset-md-2 col-form-label input_label">{{ __('回答タイプ') }}</label>

                        <div class="col-md-4 offset-md-2">
                            <select id="type" class="form-control @error('type') is-invalid @enderror" name="type" value="{{ old('type') }}" required autocomplete="type" onChange="changeType()">
                                <option value="">選択してください</option>
                                @foreach( $types as $type )
                                <option value="{{ $type->name }}">{{ $type->name }}</option>
                                @endforeach
                            </select>

                            @error('type')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <!-- 回答（タイプによって変更） -->
                    <div class="form-group">
                        <label for="answer" class="col-md-8 offset-md-2 col-form-label input_label">{{ __('回答') }}</label>

                        <div class="col-md-8 offset-md-2">
                            <div id="answerArea">「回答タイプ」を選択してください</div>

                            @error('answer')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <!-- 解説 -->
                    <div class="form-group">
                        <label for="commentary" class="col-md-8 offset-md-2 col-form-label input_label">{{ __('解説') }}</label>

                        <div class="col-md-8 offset-md-2">
                            <textarea id="commentary" class="form-control" name="commentary" required autocomplate="commentary">{{ old('commentary') }}</textarea>
                        </div>
                    </div>

                    <div class="form-group row mb-0">
                        <div class="col-md-8 offset-md-4 input_btn">
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
