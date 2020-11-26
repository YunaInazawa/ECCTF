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
    <form class="text-center" method="POST" action="{{ route('admin.room_check') }}">
        @csrf        

        <div class="form-group">
            <h1>ROOM - 編集</h1>
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
                                $room = old($count);
                            }else{
                                $room = $placeData[$count]->room_name;
                            }
                            ?>
                            <input type="hidden" name="{{ $count }}" value="{{ $room }}">
                            <td name="test[]" id="id{{ $count }}" onClick="cellClickRoom({{ $i }}, {{ $j }}, {{ $count++ }})" data-toggle="modal" data-target="#exampleModalCenter">
                                <b>{{ $room }}</b><br />
                            </td>
                        @endfor
                        </tr>
                    @endfor
                   
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
                    {{ __('確認') }}
                </button>
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
                                        <label for="newRoom" class="col-md-8">{{ __('ROOM_NAME') }}</label>
                                            <input id="newRoom" class="form-control" name="newRoom" autocomplete="newRoom" value="">
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">戻る</button>
                        <button type="button" class="btn btn-primary" onClick="cellChangeRoom()">変更する</button>
                    </div>
                </div>
            </div>
        </div>

    </form>

</div>
@endsection
