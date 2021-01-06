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
        <div class="card_head"><img class="title_ic" src="images/yukidaruma.png"><span class="title"><span>企</span>画説明</span></div>
        <div class="card-body">

            <p><button class="btn" onclick=location.href="{{ route('register') }}">参加登録</button></p>

            <p><h2>ECCTF について</h2></p>

            <p>【 概要 】<br /><br />
            クイズに答えて豪華景品GET！<br /><br />
            学内各所にあるQRコードを読み込み、<br />
            表示されるクイズに正解すると、<br />
            カードにスタンプが押されます<br /><br />
            <img style="width:30%;" src="{{ asset('images/first_sei.jpg') }}"><br /><br />
            縦横ナナメの、<br />
            どこか１列が揃うごとに１Ｐ<br /><br />
            ポイントを使用して応募すると、<br />
            抽選で豪華景品を獲得！<br /><br />
            <img style="width:80%;" src="{{ asset('images/first_bingo.png') }}"><br />
            <br /></p>

            <p>【 ECCTF の流れ 】<br /><br />
            1. 参加登録をする<br />
            2. 学内各所にあるQRコードにアクセスする<br />
            3. クイズに回答する<br />
            4. 縦横ナナメ１列揃うごとにポイントGET<br />
            5. ポイントを使用して景品に応募する<br />
            <br /></p>

            <p>【 開催期間 】<br /><br />
            1/12(火) ～ 1/29(金)<br />
            <br /></p>

            <p>【 結果発表・景品受渡期間 】<br /><br />
            [ 結果発表 ]<br />
            2/1(月)<br />
            （登録メールアドレスに送信）<br /><br />
            [ 景品受渡期間 ]<br />
            2/1(月) ～ 2/3(水)<br />
            （学校にて受渡※郵送不可）<br />
            <br /></p>

            <p><button class="btn" onclick=location.href="{{ route('register') }}">参加登録</button></p>

            <p>【 Ｑ＆Ａ 】<br /><br />
            
            [ Q. ユーザ情報を間違えて登録してしまった ]<br />
            A. 「クラス」「学籍番号」「名前」と、<br />
            「間違えた項目」「正しい情報」を本文に記載し、<br />
            下記の問い合わせ先まで連絡お願い致します。<br /><br />

            その他、ご意見・ご質問などございましたら、<br />
            お気軽にお問い合わせください。<br />
            <br /></p>

            <p>【 問い合わせ 】<br />
            ecc.gakuseikai.ecctf@gmail.com<br />
            [ 担当: IE4A 稲澤 <いなざわ> ]<br />
            <br /></p>
        </div>
    </div>


</div>
@endsection
