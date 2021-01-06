@extends('layouts.app_header')

@section('title', 'card_details')

@section('stylesheet')
<link href="{{ asset('css/admin.css') }}" rel="stylesheet">
@endsection

@section('content')
<div class="col-md-12">
    <form class="text-center" method="POST" action="{{ route('admin.room_update') }}">
        @csrf

        <div class="form-group">
            <h1>ROOM - 確認</h1>
        </div>

        <div class="form-group">
            <div class="bingo">
                <table class="table table-bordered">
                    
                    <?php $count = 0; ?>
                    @for( $i = 0; $i < 5; $i++ )
                        <tr>
                        @for( $j = 0; $j < 5; $j++ )
                            <td>
                                <b>{!! nl2br($input[$count++]) !!}</b><br />
                            </td>
                        @endfor
                        </tr>
                    @endfor
                   
                </table>
                
            </div>
        </div>

        <div class="form-group row">
            <div class="col-md-4 offset-md-2 text-md-right input_btn">
                <button type="submit" name="back" class="btn btn-primary">
                    {{ __('戻る') }}
                </button>

            </div>

            <div class="col-md-4 text-md-left input_btn">
                <button type="submit" class="btn btn-primary">
                    {{ __('登録') }}
                </button>

            </div>
        </div>

    </form>

</div>
@endsection
