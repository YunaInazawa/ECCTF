@extends('layouts.app_header')

@section('title', 'question_check')

@section('js')
<script src="{{ asset('js/admin.js') }}" defer></script>
@endsection

@section('stylesheet')
<link href="{{ asset('css/admin.css') }}" rel="stylesheet">
@endsection

@section('content')
<div class="col-md-12">
    <div class="card text-center">
        <div class="card-body">
            <form method="POST" action="{{ route('admin.gift_new') }}">
                @csrf

                <!-- ファイル -->
                <div id="giftImage">
                    <p>< ファイル ></p>
                    <p><img src="{{ $giftImage == 'noImage' ? asset('images/noImage.png') : asset('storage/gift/' . $giftImage) }}"></p>
                    <input type="hidden" name="giftImage" value="{{ $giftImage }}">
                </div>
                <hr>

                <!-- 景品名 -->
                <p>< 景品名 ></p>
                <p>{{ $input['giftName'] }}</p>
                <hr>

                <!-- 概要 -->
                <p>< 概要 ></p>
                <p>{!! nl2br($input['giftDescription']) !!}</p>
                <hr>

                <button type="submit" name="back" class="btn btn-primary">戻る</button>
                <button type="submit" class="btn btn-primary">登録</button>
            </form>
        </div>
    </div>
</div>
@endsection
