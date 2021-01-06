@extends('layouts.app_header')

@section('title', 'gift_details')

@section('stylesheet')
<link href="{{ asset('css/challenge.css') }}" rel="stylesheet">
<link href="{{ asset('css/admin.css') }}" rel="stylesheet">
@endsection

@section('content')
<div class="col-md-12">

    <div class="card text-center">
        <div class="card-body">

            <div class="col-md-6 offset-3">
                <p>
                    @if( is_null($giftData->image_path) )
                    <img class="fit-image giftDetailsImgCenter" src="{{ asset('images/noImage.png') }}">
                    @else
                    <img class="fit-image giftDetailsImgCenter" src="{{ asset('storage/gift/' . $giftData->image_path) }}">
                    @endif
                </p>
            </div>

            <p>< 景品名 ></p>
            <p>{{ $giftData->name }}</p>

            <p>< 詳細 ></p>
            <p>{!! nl2br($giftData->description) !!}</p>

            <p>< 応募者 ></p>
            <p>
                @foreach( $giftData->users as $user )
                {{ $user->name }} : {{ $user->pivot->quantity }} P<br />
                @endforeach
            </p>

            <button class="btn btn-primary" onclick=location.href="{{ route('admin.management') }}">戻る</button>
            <button class="btn btn-primary" onclick=location.href="{{ route('admin.gift_edit', $giftData->id) }}">編集</button>
            <button class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">削除</button>

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
                                    <div id="modal-image-admin" class="col-md-6">
                                        <img src="{{ $giftData->image_path == null ? asset('images/noImage.png') : asset('storage/gift/' . $giftData->image_path) }}">
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group pt-3">
                                        < {{ $giftData->name }} ><br />
                                        {!! nl2br($giftData->description) !!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">戻る</button>
                            <button type="submit" class="btn btn-primary" onclick=location.href="{{ route('admin.gift_delete', $giftData->id) }}">削除する</button>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

</div>
@endsection
