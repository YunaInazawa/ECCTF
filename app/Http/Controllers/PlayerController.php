<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Gift;
use App\UserGift;
use App\Question;
use App\Choice;
use App\Place;
use App\Answer;

class PlayerController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * 03_問題画面
     */
    public function question() {
        $questionData = Question::find(5);

        return view('player.question', ['questionData' => $questionData, 'question_type' => $questionData->type->name]);
    }

    /**
     * 正解 / 不正解 判定
     */
    public function check( Request $request ) {
        $request -> session() -> regenerateToken();
        $questionId = $request->question_id;

        $questionData = Question::find($questionId);
        if( $questionData->type->name == '択一クイズ' || $questionData->type->name == '二択クイズ' ){
            $choiceId = $request->answerRadio;
            $answerData = Choice::find($choiceId);

            // 正解 or 不正解 判定
            if( $answerData->is_correct ){
                $result = true;
            }else{
                $result = false;
            }

        } elseif( $questionData->type->name == '多答クイズ' ) {
            $answer = $request->answerChecks;
            $choiceData = Choice::where('question_id', $questionId)->get();

            // 正解 or 不正解 判定
            if( $this->checkAnswer( $choiceData, $answer ) ){
                $result = true;
            }else{
                $result = false;
            }    

        } else {
            $answerData = $request->answerText;
            $choiceData = Choice::where('question_id', $questionId)->first();

            // 正解 or 不正解 判定
            if( $choiceData->text == $answerData ){
                $result = true;
            }else{
                $result = false;
            }

        }

        if( $result ) {
            return redirect()->route('player.commentary', $questionId);
        } else {
            return redirect()->route('player.question')
                ->with('flash_message', '不正解です');
        }
        
    }

    /**
     * 04_解説画面
     */
    public function commentary( $id ) {
        $questionData = Question::find($id);
        $correctDatas = Choice::where('question_id', $id)->where('is_correct', true)->get();
        $correct = '';

        foreach( $correctDatas as $data ){
            $correct .= $data->text . '<br />';
        }
        
        return view('player.commentary', ['questionData' => $questionData, 'correct' => $correct]);
    }

    /**
     * 05_マイページ画面
     */
    public function my_page() {
        $places = Place::where('card_id', Auth::user()->course->card->id)->orderBy('position_num')->get();
        $applyGifts = Auth::user()->gifts;
        $placeDatas = array();
        $usePoint = 0;

        foreach($places as $place){
            if( Answer::where('user_id', Auth::id())->where('place_id', $place->id)->count() ){
                $placeDatas[] = 'ok';
            }else{
                $placeDatas[] = $place->room_name;
            }
            
        }

        foreach( $applyGifts as $ag ){
            $usePoint += $ag->pivot->quantity;
        }
        $pointNow = (Auth::user()->point) - $usePoint;
        
        return view('player.my_page', ['applyGifts' => $applyGifts, 'pointNow' => $pointNow, 'placeDatas' => $placeDatas]);
    }

    /**
     * 応募取消
     */
    public function delete( Request $request ) {
        $request -> session() -> regenerateToken();
        $giftId = $request->delete_id;
        $deleteNum = $request->delete_num;

        $delGift = UserGift::where('user_id',  Auth::id())->where('gift_id', $giftId)->first();
        $nowNum = $delGift->quantity;
        $delGift->quantity = ($nowNum - $deleteNum);
        $delGift->save();

        $msg = '「 ' . $delGift->gift->name . ' 」<br />' . $deleteNum . ' P 応募を取り消しました';

        return redirect()->route('player.my_page')
            ->with('flash_message', $msg);
    }

    /**
     * 06_抽選申込画面
     */
    public function challenge() {
        $giftsData = Gift::all();
        $applyGifts = UserGift::where('user_id', Auth::id())->get();
        $usePoint = 0;

        foreach( $applyGifts as $ag ){
            $usePoint += $ag->quantity;
        }
        $pointNow = (Auth::user()->point) - $usePoint;
        
        return view('player.challenge', ['giftsData' => $giftsData, 'pointNow' => $pointNow]);
    }

    /**
     * 抽選に応募する
     */
    public function apply( Request $request ) {
        $request -> session() -> regenerateToken();
        $giftId = $request->gift_id;
        $applyNum = $request->apply_num;

        if( UserGift::where('user_id', Auth::id())->where('gift_id', $giftId)->count() ){
            $applyData = UserGift::where('user_id', Auth::id())->where('gift_id', $giftId)->first();
            $quantityNow = $applyData->quantity;
            $applyData->quantity = ($quantityNow + $applyNum);
            $applyData->save();
        }else{
            $applyData = new UserGift;
            $applyData->quantity = $applyNum;
            $applyData->user_id = Auth::id();
            $applyData->gift_id = $giftId;
            $applyData->save();
        }

        $msg = '「 ' .  $applyData->gift->name . ' 」<br />' . $applyNum . 'P 応募しました';

        return redirect()->route('player.challenge')
            ->with('flash_message', $msg);
    }

    /**
     * 多答クイズ : 正解 / 不正解 チェック
     */
    function checkAnswer( $choiceData, $answer ) {
        if ( is_null($answer) ) return false;

        foreach( $choiceData as $data ){
            if( in_array($data->id, $answer) ) {
                if( !$data->is_correct ) return false;
            } else {
                if( $data->is_correct ) return false;
            }
            
        }
        return true;
    }

}
