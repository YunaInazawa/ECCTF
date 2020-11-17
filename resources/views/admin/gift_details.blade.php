@extends('layouts.app_header')

@section('title', 'gift_details')

@section('stylesheet')
<link href="{{ asset('css/challenge.css') }}" rel="stylesheet">
@endsection

@section('content')
<div class="col-md-12">

    <div class="card text-center">
        <div class="card-body">

                <p>
                    <img class="fit-image" src="../images/sampleQR.png">
                </p>

                <p>< 景品名 ></p>
                <p>{{ $giftData->name }}</p>

                <p>< 詳細 ></p>
                <p>{!! nl2br($giftData->discription) !!}</p>

                <p>< 応募者 ></p>
                <p>
                    @foreach( $giftData->users as $user )
                    {{ $user->name }} : {{ $user->pivot->quantity }} P<br />
                    @endforeach
                </p>

                <button class="btn btn-primary" onclick=location.href="{{ route('admin.management') }}">戻る</button>
                <button class="btn btn-primary">編集</button>
                <button class="btn btn-primary">削除</button>
        </div>
    </div>

</div>
@endsection
