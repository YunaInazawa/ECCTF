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

?>

@extends('layouts.app')

@section('title', 'challenge')

@section('stylesheet')
<link href="{{ asset('css/challenge.css') }}" rel="stylesheet">
@endsection

@section('content')
<div class="col-md-12">

    <div class="card text-center">
        <div class="card-body">
            <form class="text-center" action="応募する画面">
                <div class="form-group">
                    <select class="form-control" id="exampleFormControlSelect1">
                        <option>1</option>
                        <option>2</option>
                        <option>3</option>
                        <option>4</option>
                        <option>5</option>
                    </select>
                </div>

                <div class="d-inline p-2">

                    <div class="form-group">
                        <h1>{{ $gift_name[0] }}</h1>
                    </div>

                    <div class="gift-image form-group">
                        <img class="fit-image" src="images/sampleQR.png">
                    </div>

                    <div class="form-group">
                        <p>{!! nl2br( $gift_description[0] ) !!}</p>
                    </div>

                    <div class="form-group row">
                        <div class="offset-4 col-md-3">
                            <select class="form-control" id="exampleFormControlSelect1">
                                @for( $i = 1; $i <= $point; $i++ )    
                                <option>{{ $i }}</option>
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
