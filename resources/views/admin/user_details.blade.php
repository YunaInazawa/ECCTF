@extends('layouts.app_header')

@section('title', 'User_details')

@section('content')
<div class="col-md-12">
    <!-- フラッシュメッセージ -->
    @if (session('flash_message'))
        <div class="flash_message text-center">
            {!! nl2br(session('flash_message')) !!}
            <hr>
        </div>
    @endif

    <div class="card text-center">
        <div class="card-header"><h4># {{ $userData->id }}</h4></div>

        <div class="card-body">

            <!-- 学籍番号 -->
            <p>< 学籍番号 ></p>
            <p>{{ $userData->student_num }}</p>
            <hr>

            <!-- クラス・ユーザ名 -->
            <p>< クラス・ユーザ名 ></p>
            <p>[{{ $userData->course->name }}] {{ $userData->name }}</p>
            <hr>

            <!-- メールアドレス -->
            <p>< メールアドレス ></p>
            <p>{{ $userData->email }}</p>
            <hr>

            <!-- ポイント -->
            <p>< ポイント ></p>
            <p>{{ $userData->point }}</p>
            <hr>

            <!-- 応募景品 -->
            <p>< 応募景品 ></p>
            <p>
                @foreach( $userData->gifts as $gift )
                {{ $gift->name }} : {{ $gift->pivot->quantity }}<br />
                @endforeach
            </p>
            <hr>

            <button class="btn btn-primary" onclick=location.href="{{ route('admin.management') }}">戻る</button>
            <button class="btn btn-primary" onclick=location.href="{{ route('admin.user_edit', $userData->id) }}">編集</button>
            <button class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">削除</button><br />
            <button class="btn btn-primary" data-toggle="modal" data-target="#passwordUpdateModal">パスワードリセット</button>

            <!-- DeleteModal -->
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
                                        < # {{ $userData->id }} ><br />
                                        {{ $userData->name }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">戻る</button>
                            <button type="submit" class="btn btn-primary" onclick=location.href="{{ route('admin.user_delete', $userData->id) }}">削除する</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- passwordUpdateModal -->
            <div class="modal fade" id="passwordUpdateModal" tabindex="-1" role="dialog" aria-labelledby="passwordUpdateModalTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="modal-title">{{ $userData->name }} # {{ $userData->id }}</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group pt-3">
                                        [ {{ $userData->course->name }}{{ $userData->student_num }} ]<br />
                                        「クラス＋学籍番号」に変更されます。<br />
                                        よろしいですか？
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">戻る</button>
                            <button type="submit" class="btn btn-primary" onclick=location.href="{{ route('admin.user_password_update', $userData->id) }}">変更する</button>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
