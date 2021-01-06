@extends('layouts.app_header')

@section('title', 'question_edit')

@section('js')
<script src="{{ asset('js/admin.js') }}" defer></script>
@endsection

@section('stylesheet')
<link href="{{ asset('css/admin.css') }}" rel="stylesheet">
@endsection

@section('content')
    <div class="col-md-12">
        <div class="card">
            <div class="card-header"><img class="title_ic" src="{{ asset('images/yukidaruma.png') }}"><span class="title"><span>Ｑ</span>ｕｅｓｔｉｏｎ - 編集</span></div>

            <div class="card-body">
                <form method="POST" action="{{ route('admin.question_check') }}">
                    @csrf

                    <div class="row">
                        <!-- ジャンル -->
                        <div class="form-group col-md-6">
                            <label for="genre" class="col-md-8 offset-md-4 col-form-label input_label">{{ __('ジャンル') }}</label>

                            <div class="col-md-8 offset-md-4">
                                <select id="genre" class="form-control @error('genre') is-invalid @enderror" name="genre" required autocomplete="genre">
                                    <option value="">選択してください</option>
                                    @foreach( $genres as $genre )
                                    <option value="{{ $genre->name }}" @if(old('genre', $questionData->genre->name) == $genre->name) selected @endif>{{ $genre->name }}</option>
                                    @endforeach
                                </select>

                                @error('genre')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <!-- レベル -->
                        <div class="form-group col-md-6">
                            <label for="level" class="col-md-8 col-form-label input_label">{{ __('レベル') }}</label>

                            <div class="col-md-8">
                                <select id="level" class="form-control @error('level') is-invalid @enderror" name="level" required autocomplete="level">
                                    <option value="">選択してください</option>
                                    @foreach( $levels as $level )
                                    <option value="{{ $level->name }}" @if(old('level', $questionData->level->name) == $level->name) selected @endif>{{ $level->name }}</option>
                                    @endforeach
                                </select>

                                @error('level')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- 問題文 -->
                    <div class="form-group">
                        <label for="text" class="col-md-8 offset-md-2 col-form-label input_label">{{ __('問題文') }}</label>

                        <div class="col-md-8 offset-md-2">
                            <textarea id="text" class="form-control @error('text') is-invalid @enderror" name="text" required autocomplate="text" autofocus>{{ old('text', $questionData->text) }}</textarea>

                            @error('text')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <!-- 回答タイプ -->
                    <input type="hidden" id="typeValue" value="{{ old('type', $questionData->type->name) }}">
                    <div class="form-group">
                        <label for="type" class="col-md-4 offset-md-2 col-form-label input_label">{{ __('回答タイプ') }}</label>

                        <div class="col-md-4 offset-md-2">
                            <select id="type" class="form-control @error('type') is-invalid @enderror" name="type" required autocomplete="type" onChange="changeType()">
                                <option value="">選択してください</option>
                                @foreach( $types as $type )
                                <option value="{{ $type->name }}" @if(old('type', $questionData->type->name) == $type->name) selected @endif>{{ $type->name }}</option>
                                @endforeach
                            </select>

                            @error('type')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <!-- 回答（タイプによって変更） -->
                    <div class="form-group">
                        <label for="answer" class="col-md-8 offset-md-2 col-form-label input_label">{{ __('回答') }}
                        @if( session('flash_message') )
                        ※ {{ session('flash_message') }}
                        @endif</label>

                        <div class="col-md-8 offset-md-2">
                            <div id="answerArea">
                                @if( empty(old('type')) )
                                    <!-- データを表示 -->
                                    <?php $count = 1; ?>
                                    @if( $questionData->type->name == '択一クイズ' )
                                        @foreach( $questionData->choices as $choice )
                                        <input type="hidden" id="answerIdHidden{{ $count }}" name="answer[]" value="{{ $choice->text }}">
                                        <div class="form-check"><input type="radio" class="form-check-input" name="correct[]" value="{{ $choice->text }}" <?php if($choice->text == $correctData[0]->text) echo 'checked'; ?>><label id="answerId{{ $count }}" class="form-check-label lie-link" onclick="answerChange({{ $count++ }})">{{ $choice->text }}</label></div>
                                        @endforeach

                                    @elseif( $questionData->type->name == '二択クイズ' )
                                        @foreach( $questionData->choices as $choice )
                                        <input type="hidden" id="answerIdHidden{{ $count }}" name="answer[]" value="{{ $choice->text }}">
                                        <div class="form-check"><input type="radio" class="form-check-input" name="correct[]" value="{{ $choice->text }}" <?php if($choice->text == $correctData[0]->text) echo 'checked'; ?>><label id="answerId{{ $count }}" class="form-check-label lie-link" onclick="answerChange({{ $count++ }})">{{ $choice->text }}</label></div>
                                        @endforeach

                                    @elseif( $questionData->type->name == '多答クイズ' )
                                        @foreach( $questionData->choices as $choice )
                                        <input type="hidden" id="answerIdHidden{{ $count }}" name="answer[]" value="{{ $choice->text }}">
                                        <div class="form-check"><input type="checkbox" class="form-check-input" name="correct[]" value="{{ $choice->text }}" <?php if($correctData->where('text', $choice->text)->count()) echo 'checked'; ?>><label id="answerId{{ $count }}" class="form-check-label lie-link" onclick="answerChange({{ $count++ }})">{{ $choice->text }}</label></div>
                                        @endforeach

                                    @else
                                        <input type="text" class="form-control" name="correct[]" required autocomplete="correct" value="{{ $correctData[0]->text }}">

                                    @endif

                                @else
                                    <!-- 「戻る」ボタンでリダイレクトしてきたとき -->
                                    @if( old('type') == '択一クイズ' )
                                        @for( $i = 1; $i <= count(old('answer')); $i++ )
                                        <input type="hidden" id="answerIdHidden{{ $i }}" name="answer[]" value="{{ old('answer.' . ($i-1)) }}">
                                        <div class="form-check"><input type="radio" class="form-check-input" name="correct[]" value="{{ old('answer.' . ($i-1)) }}" <?php if(old('answer.' . ($i-1)) == old('correct.0')) echo 'checked'; ?>><label id="answerId{{ $i }}" class="form-check-label lie-link" onclick="answerChange({{ $i }})">{{ old('answer.' . ($i-1)) }}</label></div>
                                        @endfor

                                    @elseif( old('type') == '二択クイズ' )
                                        @for( $i = 1; $i <= count(old('answer')); $i++ )
                                        <input type="hidden" id="answerIdHidden{{ $i }}" name="answer[]" value="{{ old('answer.' . ($i-1)) }}">
                                        <div class="form-check"><input type="radio" class="form-check-input" name="correct[]" value="{{ old('answer.' . ($i-1)) }}" <?php if(old('answer.' . ($i-1)) == old('correct.0')) echo 'checked'; ?>><label id="answerId{{ $i }}" class="form-check-label lie-link" onclick="answerChange({{ $i }})">{{ old('answer.' . ($i-1)) }}</label></div>
                                        @endfor

                                    @elseif( old('type') == '多答クイズ' )
                                        @for( $i = 1; $i <= count(old('answer')); $i++ )
                                        <input type="hidden" id="answerIdHidden{{ $i }}" name="answer[]" value="{{ old('answer.' . ($i-1)) }}">
                                        <div class="form-check"><input type="checkbox" class="form-check-input" name="correct[]" value="{{ old('answer.' . ($i-1)) }}" <?php if( !empty(old('correct')) ){if(in_array(old('answer.' . ($i-1)), old('correct'))) echo 'checked';} ?>><label id="answerId{{ $i }}" class="form-check-label lie-link" onclick="answerChange({{ $i }})">{{ old('answer.' . ($i-1)) }}</label></div>
                                        @endfor

                                    @else
                                        <input type="text" class="form-control" name="correct[]" required autocomplete="correct" value="{{ old('correct.0') }}">

                                    @endif

                                @endif
                                
                            </div>

                            @error('answer')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                            
                    </div>

                    <!-- 解説 -->
                    <div class="form-group">
                        <label for="commentary" class="col-md-8 offset-md-2 col-form-label input_label">{{ __('解説') }}</label>

                        <div class="col-md-8 offset-md-2">
                            <textarea id="commentary" class="form-control" name="commentary" autocomplate="commentary">{{ old('commentary', $questionData['commentary']) }}</textarea>
                        </div>
                    </div>

                    <div class="form-group row mb-0">
                        <div class="col-md-4 offset-md-2 text-md-left input_btn">
                            <button type="button" class="btn btn-primary" onclick=location.href="{{ route('admin.question_details', $questionData->id) }}">
                                {{ __('戻る') }}
                            </button>

                        </div>

                        <div class="col-md-4 input_btn">
                            <button type="submit" class="btn btn-primary">
                                {{ __('確認') }}
                            </button>
                            <input type="hidden" name="question_id" value="{{ $id }}">
                        </div>
                    </div>
                    
                </form>
            </div>
        </div>
    </div>
@endsection
