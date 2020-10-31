<?php  
$gift_name = ['gift01', 'gift02', 'gift03'];
$gift_description = 
    [
        'Description01.<br>' . 
        '---------------------------------<br>' . 
        '---------------------------------',
        'Description02.<br>' . 
        '---------------------------------<br>' . 
        '---------------------------------',
        'Description03.<br>' . 
        '---------------------------------<br>' . 
        '---------------------------------'

    ];
$point = 5;

$json_name = json_encode($gift_name);
$json_description = json_encode($gift_description);

?>

@extends('layouts.app')

@section('title', 'challenge')

@section('stylesheet')
<script src="{{ asset('js/challenge.js') }}" defer></script>
@endsection

@section('stylesheet')
<link href="{{ asset('css/challenge.css') }}" rel="stylesheet">
@endsection

@section('content')
<div class="col-md-12">

    <div class="card text-center">
        <div class="card-body">
            <form method="POST" class="text-center" action="{{ route('player.apply') }}">
                @csrf

                <div class="form-group">
                    <!-- フラッシュメッセージ -->
                    @if (session('flash_message'))
                        <div class="flash_message">
                            {{ session('flash_message') }}
                        </div>
                    @endif
                </div>

                <div class="form-group">
                    <select class="form-control" id="selectGift" onChange="changeSelect({{ $giftsData }})">
                        <option value="">選択してください</option>
                        @foreach( $giftsData as $data )
                        <option value="{{ $data->id }}">{{ $data->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div id="display" class="d-none p-2">

                    <div id="giftName" class="form-group"></div>

                    <div id="giftImage" class="gift-image form-group"></div>

                    <div id="giftDescription" class="form-group"></div>

                    <div class="form-group row">
                        <div class="offset-4 col-md-3">
                            <select class="form-control" id="exampleFormControlSelect1">
                                @for( $i = 1; $i <= $pointNow; $i++ )    
                                <option value="{{ $i }}">{{ $i }} P</option>
                                @endfor
                            </select>
                        </div>
                        <div class="col-md-5 text-left">
                            <button type="submit" class="btn btn-primary mb-2">応募</button>
                        </div>
                    </div>
                    
                </div>
            </form>
        </div>
    </div>
    <div class="text-right">
        <a href="{{ route('player.my_page') }}">マイページへ戻る</a>
    </div>

</div>
@endsection
