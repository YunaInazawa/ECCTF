@extends('layouts.app_header')

@section('title', 'commentary')

@section('content')
<div class="col-md-12">
    <div class="card text-center">
        <div class="card-header"><h2>正解です</h2></div>

        <div class="card-body">
            <form action="{{ route('player.my_page') }}">

                <h4 class="card-text">{!! nl2br($questionData->text) !!}</h4>
                <hr>
                <p>< 正解 ><br />{!! nl2br($correct) !!}</p>
                <hr>
                <p>{!! nl2br($questionData->commentary) !!}</p>

                <button type="submit" class="btn btn-primary">マイページ</button>
            </form>
        </div>
    </div>
</div>
@endsection
