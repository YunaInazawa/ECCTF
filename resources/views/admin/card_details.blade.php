@extends('layouts.app_header')

@section('title', 'card_details')

@section('js')
<script src="{{ asset('js/admin.js') }}" defer></script>
@endsection

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
                <table id="bingoTable" class="table table-bordered">
                    
                    <tr>
                        @for( $i = 0; $i < count($placeData); $i++ )
                            @if( $questions[$placeData[$i]->place->position_num] == 'nothing' )
                            <td style="background-color: red;">
                            @else
                            <td class="defaultCell" onClick="clickCellShowQuestions({{ $placeData[$i]->place->position_num }})">
                            @endif
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
                        {{ $course->name }} 
                        @endforeach
                        <br /><br />

                        < 出題 QUESTION 一覧 >
                        <div id="showQuestions"></div>

                    </div>
                </div>
            </div>
        </div>

    </form>

</div>

<script type="text/javascript">
var questions = @json($questions);
</script>
@endsection
