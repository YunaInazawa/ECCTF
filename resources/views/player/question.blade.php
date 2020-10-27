@extends('layouts.app')

@section('title', 'question')

@section('content')
<div class="col-md-12">
    <div class="card text-center">
        <div class="card-header"><h1>QUESTION_TITLE</h1></div>

        <div class="card-body">
            <form method="POST" action="{{ route('player.answer') }}">
                @csrf

                <h3 class="card-text">QUESTION_TEXT</h3>

                <div class="form-check">
                    <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios1" value="option1" checked>
                    <label class="form-check-label" for="exampleRadios1">
                        Default radio
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios2" value="option2">
                    <label class="form-check-label" for="exampleRadios2">
                        Second default radio
                    </label>
                </div>

                <button type="submit" class="btn btn-primary">send</button>
            </form>
        </div>
    </div>
</div>
@endsection
