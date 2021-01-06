@extends('layouts.app_header')

@section('title', 'card_edit')

@section('js')
<script src="{{ asset('js/admin.js') }}" defer></script>
@endsection

@section('stylesheet')
<link href="{{ asset('css/admin.css') }}" rel="stylesheet">
@endsection

@section('content')
<div class="col-md-12">
    <form class="text-center" method="POST" action="{{ route('admin.card_check') }}">
        @csrf        

        <div class="form-group">
            <h1>{{ $cardData->name }} - 編集</h1>
        </div>

        <div class="form-group">
            <div class="bingo">
                <table id="card" class="table table-bordered">
                    
                    <?php $count = 0; ?>
                    @for( $i = 0; $i < 5; $i++ )
                        <tr>
                        @for( $j = 0; $j < 5; $j++ )
                            <?php
                            if( !empty(old($count)) ){
                                $tmp = explode(",", old($count));
                                $genre = $tmp[0];
                                $level = $tmp[1];
                            }else{
                                $genre = $placeData[$count]->genre->name;
                                $level = $placeData[$count]->level->name;
                            }
                            ?>
                            <input type="hidden" name="{{ $count }}" value="{{ $genre }},{{ $level }}">
                            <td name="test[]" id="id{{ $count }}" onClick="cellClick({{ $i }}, {{ $j }}, {{ $count++ }})" data-toggle="modal" data-target="#exampleModalCenter">
                                <b>{{ $genre }}</b><br />
                                [ {{ $level }} ]
                            </td>
                        @endfor
                        </tr>
                    @endfor
                   
                </table>
                
            </div>
        </div>

        <div class="form-group row">
            <div class="col-md-4 offset-md-2 text-md-right input_btn">
                <button type="button" class="btn btn-primary" onclick=location.href="{{ route('admin.card_details', $cardData->id) }}">
                    {{ __('戻る') }}
                </button>

            </div>

            <div class="col-md-4 text-md-left input_btn">
                <button type="submit" class="btn btn-primary">
                    {{ __('確認') }}
                </button>
                <input type="hidden" name="card_id" value="{{ $cardData->id }}">
                <input type="hidden" name="card_name" value="{{ $cardData->name }}">
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

        <!-- Modal -->
        <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="modal-title">○ 列 ○ 行</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group pt-3">

                                        <input type="hidden" id="selectCell" value="">

                                        <div class="form-group">
                                        <label for="newGenre" class="col-md-8">{{ __('ジャンル') }}</label>
                                            <select id="newGenre" class="form-control" name="newGenre" autocomplete="newGenre">
                                                <option value="">選択してください</option>
                                                @foreach( $genresData as $data )
                                                <option value="{{ $data->name }}">{{ $data->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="form-group">
                                        <label for="newLevel" class="col-md-8">{{ __('レベル') }}</label>
                                            <select id="newLevel" class="form-control" name="newLevel" autocomplete="newLevel">
                                                <option value="">選択してください</option>
                                                @foreach( $levelsData as $data )
                                                <option value="{{ $data->name }}">{{ $data->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">戻る</button>
                        <button type="button" class="btn btn-primary" onClick="cellChange()">変更する</button>
                    </div>
                </div>
            </div>
        </div>

    </form>

</div>
@endsection
