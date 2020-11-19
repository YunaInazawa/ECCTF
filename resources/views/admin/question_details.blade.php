@extends('layouts.app_header')

@section('title', 'question_details')

@section('content')
<div class="col-md-12">
    <div class="card text-center">
        <div class="card-header"><h4># {{ $questionData->id }}</h4></div>

        <div class="card-body">

            <!-- 問題文 -->
            <p>< 問題文 ></p>
            <p>{{ $questionData->text }}</p>
            <hr>

            <!-- 選択肢 -->
            @if( $questionData->type->name == '択一クイズ' || $questionData->type->name == '二択クイズ' || $questionData->type->name == '多答クイズ' )
            <p>< 選択肢 ></p>
            <p>
                @foreach( $choicesData as $choice )
                {{ $choice->text }}<br />
                @endforeach
            </p>
            <hr>
            @endif

            <!-- 正解 -->
            <p>< 正解 ></p>
            <p>{!! nl2br($correct) !!}</p>
            <hr>

            <!-- 解説 -->
            <p>< 解説 ></p>
            <p>{!! nl2br($questionData->commentary) !!}</p>

            <button class="btn btn-primary" onclick=location.href="{{ route('admin.management') }}">一覧</button>
            <button class="btn btn-primary" onclick=location.href="{{ route('admin.question_edit', $questionData->id) }}">編集</button>
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
                                    <div class="col-md-12">
                                        <div class="form-group pt-3">
                                        < # {{ $questionData->id }} ><br />
                                        {!! nl2br($questionData->text) !!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">戻る</button>
                            <button type="submit" class="btn btn-primary" onclick=location.href="{{ route('admin.question_delete', $questionData->id) }}">削除する</button>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
