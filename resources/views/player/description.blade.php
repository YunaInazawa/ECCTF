@extends('layouts.app_header')

@section('title', 'my_page')

@section('js')
<script src="{{ asset('js/my_page.js') }}" defer></script>
@endsection

@section('stylesheet')
<link href="{{ asset('css/my_page.css') }}" rel="stylesheet">
@endsection

@section('content')
<div class="col-md-12">
    <div class="form-group">
        <!-- フラッシュメッセージ -->
        @if (session('flash_message'))
            <div class="flash_message">
                {!! nl2br(session('flash_message')) !!}
                <hr>
            </div>
        @endif
    </div>

    <div class="card">
        <div class="card_head"><img class="title_ic" src="images/momizi_3.png"><span class="title"><span>企</span>画説明</span></div>
        <div class="card-body">

            <p><a href="{{ route('register') }}">【参加登録】</a></p>

            <p>ECCTF について<br />
            <br /></p>

            <p>【期間】<br />
            <br /></p>

            <p>【概要】<br />
            <br /></p>

            <p>【ページ説明・回答方法】<br />
            <br /></p>

            <p><a href="{{ route('register') }}">【参加登録】</a></p>

            <p>【連絡先】<br />
            <br /></p>
        </div>
    </div>


</div>
@endsection
