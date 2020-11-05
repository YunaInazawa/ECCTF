@extends('layouts.app_header')

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
                            {!! nl2br(session('flash_message')) !!}
                            <hr>
                        </div>
                    @endif
                </div>

                <div class="form-group">
                    <select class="form-control" id="selectGift" onChange="changeGift({{ $giftsData }})">
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
                            <select class="form-control" id="apply_num" name="apply_num" onChange="changeNum()">
                                @if( $pointNow == 0 )
                                    <option value="0">0 P</option>
                                @else
                                    @for( $i = 1; $i <= $pointNow; $i++ )    
                                    <option value="{{ $i }}">{{ $i }} P</option>
                                    @endfor
                                @endif
                            </select>
                        </div>
                        <div class="col-md-5 text-left">
                            <div id="hide"></div>
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter" <?php if($pointNow == 0){ echo 'disabled'; } ?>>
                                応募
                            </button>

                            <!-- Modal -->
                            <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="container-fluid">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="row">
                                                            <div id="modal-image" class="col-md-6"></div>
                                                            <div class="col-md-6 pt-5">
                                                                <span id="modal-text"></span>
                                                                <span id="apply-num">1</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">戻る</button>
                                            <button type="submit" class="btn btn-primary">応募する</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
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
