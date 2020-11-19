@extends('layouts.app_header')

@section('title', 'gift_create')

@section('content')
    <div class="col-md-12">
        <div class="card">
            <div class="card-header"><img class="title_ic" src="images/momizi_3.png"><span class="title"><span>Ｇ</span>ｉｆｔ - 新規作成</span></div>

            <div class="card-body">
                <form method="POST" action="{{ route('admin.gift_check') }}" enctype='multipart/form-data'>
                    @csrf

                    <!-- 景品名 -->
                    <div class="form-group">
                        <label for="giftName" class="col-md-8 offset-md-2 col-form-label input_label">{{ __('景品名') }}</label>

                        <div class="col-md-8 offset-md-2">
                            <input id="giftName" type="giftName" class="form-control @error('giftName') is-invalid @enderror" name="giftName" value="{{ old('giftName') }}" required autocomplete="giftName" autofocus>

                            @error('giftName')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <!-- 概要 -->
                    <div class="form-group">
                        <label for="giftDescription" class="col-md-8 offset-md-2 col-form-label input_label">{{ __('概要') }}</label>

                        <div class="col-md-8 offset-md-2">
                            <textarea id="giftDescription" class="form-control" name="giftDescription" autocomplate="giftDescription">{{ old('giftDescription') }}</textarea>
                        </div>
                    </div>

                    <!-- 画像 -->
                    <div class="form-group">
                        <input type="file" class="md-8 offset-md-2" id="giftImage" name="giftImage">
                        
                    </div>

                    <div class="form-group row mb-0">
                        <div class="col-md-8 offset-md-4 input_btn">
                            <button type="submit" class="btn btn-primary">
                                {{ __('確認') }}
                            </button>

                        </div>
                    </div>
                    
                </form>
            </div>
        </div>
    </div>
@endsection
