@extends('layouts.app_header')

@section('title', 'card_details')

@section('stylesheet')
<link href="{{ asset('css/admin.css') }}" rel="stylesheet">
@endsection

@section('content')
<div class="col-md-12">
    <form class="text-center" action="{{ route('admin.card_edit', $cardData->id) }}">
            
        <div class="form-group">
            <h1>{{ $cardData->name }}</h1>
        </div>

        <div class="form-group">
            <div class="bingo">
                <table class="table table-bordered">
                    
                    <tr>
                        @for( $i = 0; $i < count($placeData); $i++ )
                            <td>
                                <b>{{ $placeData[$i]->genre->name }}</b><br />
                                [ {{ $placeData[$i]->level->name }} ]
                            </td>
                            @if( $i % 5 == 4 && $i != 24 )
                            </tr>
                            <tr>
                            @endif
                        @endfor
                    </tr>
                   
                </table>
                
            </div>
        </div>

        <div class="form-group row">
            <div class="col-md-4 offset-md-2 text-md-right input_btn">
                <button type="button" class="btn btn-primary" onclick=location.href="{{ route('admin.management') }}">
                    {{ __('戻る') }}
                </button>

            </div>

            <div class="col-md-4 text-md-left input_btn">
                <button type="submit" class="btn btn-primary">
                    {{ __('編集') }}
                </button>

            </div>
        </div>

        <div class="form-group">
            <div class="col-md-12">
                <div class="card text-center my-5">
                    <div class="card-body">
                        < 対象クラス ><br />
                        @foreach( $cardData->courses as $course )
                        {{ $course->name }}<br />
                        @endforeach

                    </div>
                </div>
            </div>
        </div>

    </form>

</div>
@endsection
