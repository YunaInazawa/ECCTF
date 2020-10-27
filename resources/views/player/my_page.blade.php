@extends('layouts.app')

@section('title', 'my_page')

@section('content')
<div class="col-md-12">
    <div class="card text-center">
        <div class="card-header"><h1>NAME</h1></div>

        <div class="card-body">
            <form action="{{ route('player.challenge') }}">

                <h3 class="card-text">MY_INFO</h3>

                <button type="submit" class="btn btn-primary">challenge</button>
            </form>
        </div>
    </div>
</div>
@endsection
