@extends('layouts.app_header')

@section('title', 'card_details')

@section('stylesheet')
<link href="{{ asset('css/admin.css') }}" rel="stylesheet">
@endsection

@section('content')
<div class="col-md-12">
    <form class="text-center" method="POST" action="{{ route('admin.card_update') }}">
        @csrf

        <div class="form-group">
            <h1>{{ $card_name }} - 確認</h1>
        </div>

        <div class="form-group">
            <div class="bingo">
                <table class="table table-bordered">
                    
                    <?php $count = 0; ?>
                    @for( $i = 0; $i < 5; $i++ )
                        <tr>
                        @for( $j = 0; $j < 5; $j++ )
                            <?php
                            $tmp = explode(",", $input[$count++]);
                            $genre = $tmp[0];
                            $level = $tmp[1];
                            ?>

                            <td>
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
