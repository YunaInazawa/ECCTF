@extends('layouts.app_header')

@section('content')
    <div class="col-md-8">
        <div class="card">
            <div class="card_head"><img class="title_ic" src="images/momizi_3.png"><span class="title"><span>Ｑ</span>uestion - 新規作成</span></div>

            <div class="card-body">
                <form method="POST" action="{{ route('admin.question_new') }}">
                    @csrf

                    <!-- 問題文 -->
                    <div class="form-group row input_item">
                        <label for="text" class="col-md-4 col-form-label text-md-right input_label">{{ __('問題文') }}</label>

                        <div class="col-md-6">
                            <textarea id="text" class="form-control @error('text') is-invalid @enderror" name="text" required autocomplate="text" autofocus>{{ old('text') }}</textarea>

                            @error('text')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <!-- ジャンル -->
                    <div class="form-group row input_item">
                        <label for="password" class="col-md-4 col-form-label text-md-right input_label">{{ __('ジャンル') }}</label>

                        <div class="col-md-6">
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
                    <div class="form-group row input_item">
                        <label for="password" class="col-md-4 col-form-label text-md-right input_label">{{ __('レベル') }}</label>

                        <div class="col-md-6">
                            <select id="level" class="form-control @error('level') is-invalid @enderror" name="level" value="{{ old('level') }}" required autocomplete="level" autofocus>
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

                    <!-- タイプ -->
                    <div class="form-group row input_item">
                        <label for="password" class="col-md-4 col-form-label text-md-right input_label">{{ __('タイプ') }}</label>

                        <div class="col-md-6">
                            <select id="type" class="form-control @error('type') is-invalid @enderror" name="type" value="{{ old('type') }}" required autocomplete="type" autofocus>
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
                    <div class="form-group row input_item">
                        <label for="password" class="col-md-4 col-form-label text-md-right input_label">{{ __('回答') }}</label>

                        <div class="col-md-6">
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <!-- 解説 -->
                    <div class="form-group row input_item">
                        <label for="commentary" class="col-md-4 col-form-label text-md-right input_label">{{ __('解説') }}</label>

                        <div class="col-md-6">
                            <textarea id="commentary" class="form-control" name="commentary" required autocomplate="commentary" autofocus>{{ old('commentary') }}</textarea>
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
