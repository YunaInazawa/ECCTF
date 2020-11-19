@extends('layouts.app_header')

@section('title', 'gift_edit')

@section('js')
<script src="{{ asset('js/admin.js') }}" defer></script>
@endsection

@section('stylesheet')
<link href="{{ asset('css/admin.css') }}" rel="stylesheet">
@endsection

@section('content')
    <div class="col-md-12">
        <div class="card">
            <div class="card-header"><img class="title_ic" src="{{ asset('images/momizi_3.png') }}"><span class="title"><span>Ｇ</span>ｉｆｔ - 編集</span></div>

            <div class="card-body">
                <form method="POST" action="{{ route('admin.gift_check') }}" enctype='multipart/form-data'>
                    @csrf

                    <!-- 景品名 -->
                    <div class="form-group">
                        <label for="giftName" class="col-md-8 offset-md-2 col-form-label input_label">{{ __('景品名') }}</label>

                        <div class="col-md-8 offset-md-2">
                            <input id="giftName" type="giftName" class="form-control @error('giftName') is-invalid @enderror" name="giftName" value="{{ old('giftName', $giftData->name) }}" required autocomplete="giftName" autofocus>

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
                            <textarea id="giftDescription" class="form-control" name="giftDescription" autocomplate="giftDescription">{{ old('giftDescription', $giftData->description) }}</textarea>
                        </div>
                    </div>

                    <!-- 画像 -->
                    <div class="form-group">
                        <label for="giftImage" class="col-md-8 offset-md-2 col-form-label input_label">{{ __('画像') }}</label>

                        <input type="hidden" name="giftImage" value="{{ $giftData->image_path == null ? 'noImage' : $giftData->image_path }}">
                        <div class="md-8 offset-md-2" id="imageDisplay">
                            @if( is_null($giftData->image_path) )
                                <input type="file" id="giftImage" name="giftImageFile">
                            @else
                                <button class="btn" onClick="clearImage()">現在の画像を削除する</button>
                                <div id="giftImage"><img src="{{ asset('storage/gift/' . $giftData->image_path) }}"></div>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row mb-0">
                        <div class="col-md-4 offset-md-2 text-md-left input_btn">
                            <button type="button" class="btn btn-primary" onclick=location.href="{{ route('admin.gift_details', $giftData->id) }}">
                                {{ __('戻る') }}
                            </button>

                        </div>

                        <div class="col-md-4 input_btn">
                            <button type="submit" class="btn btn-primary">
                                {{ __('確認') }}
                            </button>
                            <input type="hidden" name="gift_id" value="{{ $giftData->id }}">

                        </div>
                    </div>
                    
                </form>
            </div>
        </div>
    </div>
@endsection
