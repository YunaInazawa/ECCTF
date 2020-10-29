@extends('layouts.app')

@section('title', 'challenge')

@section('content')
<div class="col-md-12">
    <div class="card text-center">
        <div class="card-header"><h1>CHALLENGE</h1></div>

        <div class="card-body">
            <form action="{{ route('player.my_page') }}">

                <h3 class="card-text">CHALLENGE</h3>

                <button type="submit" class="btn btn-primary">my_page</button>
            </form>
        </div>
    </div>
</div>
@endsection
