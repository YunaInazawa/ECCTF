@extends('layouts.app_header')

@section('title', 'my_page')

@section('js')
<script src="{{ asset('js/my_page.js') }}" defer></script>
@endsection

@section('stylesheet')
<link href="{{ asset('css/my_page.css') }}" rel="stylesheet">
@endsection

@section('content')
<div class="col-md-12">
    <form class="text-center" action="{{ route('player.challenge') }}">
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
            <h1>ＢＩＮＧＯ</h1>
        </div>

        <div class="form-group ">
            <div class="bingo">
                <table class="table table-bordered">
                    <!-- <tr>
                        @for( $i = 0; $i < 25; $i++ )
                            <td>33{{ $i }}</td>
                            @if( $i % 5 == 4 && $i != 24 )
                            </tr>
                            <tr>
                            @endif
                        @endfor
                    </tr> -->
                    
                        <tr>
                        @for( $i = 0; $i < count($placeDatas); $i++ )

                            @if( $placeDatas[$i] == 'ok' )
                            <td><span class="place_none">{{ $placeDatas[$i] }}</span><div class="sei"><img class="sei_img" src="{{ asset('images/sei.png') }}"></div></td>
                            @else
                            <td>{!! nl2br($placeDatas[$i]) !!}</td>
                            @endif

                            @if( $i % 5 == 4 && $i != 24 )
                            </tr>
                            <tr>
                            @endif

                        @endfor
                    </tr>
                   
                </table>
                <img class="title_ic bingo_momizi" src="images/yukidaruma.png">
            </div>
        </div>

        <div class="form-group">
            <p>所持ポイント：{{ $pointNow }}</p>
        </div>

        <button type="submit" class="btn btn-primary">応募</button>

    </form>

    <div class="card text-center my-5">
        <div class="card-body">
            [ {{ Auth::user()->student_num }} ]<br />
            < {{ Auth::user()->course->name }} > {{ Auth::user()->name }}<br />
            <a href="{{ route('player.pass_reset') }}">パスワード変更</a>

        </div>
    </div>

    <form class="text-center" method="post" action="{{ route('player.delete') }}">
        @csrf
        
        <div class="form-group">
            <h2>< 応募している景品一覧 ></h2>
        </div>

        @foreach( $applyGifts as $ag )
        @if( $ag->pivot->quantity != 0 )
        <div class="form-group row gift-box">
            <div class="col-md-4 col-sm-4 text-right"><img src="{{ $ag->image_path == null ? 'images/noImage.png' : asset('storage/gift/' . $ag->image_path) }}" class="img-responsive fit-image"></div>
            <div class="col-md-8 col-sm-4 pt-2 text-left">
                <button type="button" class="btn btn_deleate" data-toggle="modal" data-target="#exampleModalCenter" onClick="clickDelete({{ $ag }}, {{ $ag->pivot->quantity }})">
                    <i class="far fa-times-circle fa-lg"></i>
                </button>
                <h4>{{ $ag->name }}</h4><br/>
                <p>応募数：{{ $ag->pivot->quantity }}</p>
            </div>
        </div>
        @endif
        @endforeach

        <!-- Modal -->
        <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="modal-title">Modal title</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="container-fluid">
                            <div class="col-md-12">
                                <div class="row">
                                    <div id="modal-image" class="col-md-6"></div>
                                    <div class="form-group col-md-6 row pt-3">
                                        <label for="inputDeleteNum" class="col-md-10 col-form-label text-left"><h5>削除数 :</h5></label>
                                        <div class="col-md-10">
                                            <select class="form-control" id="delete_num" name="delete_num"></select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div id="hide"></div>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">戻る</button>
                        <button type="submit" class="btn btn-primary">削除する</button>
                    </div>
                </div>
            </div>
        </div>

    </form>
</div>
@endsection
