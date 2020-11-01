<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Gift;
use App\UserGift;

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

        return view('player.question');
    }

    /**
     * 正解 / 不正解 判定
     */
    public function check() {

        return redirect()->route('player.commentary');
    }

    /**
     * 04_解説画面
     */
    public function commentary() {
        
        return view('player.commentary');
    }

    /**
     * 05_マイページ画面
     */
    public function my_page() {
        $applyGifts = Auth::user()->gifts;
        $usePoint = 0;

        foreach( $applyGifts as $ag ){
            $usePoint += $ag->pivot->quantity;
        }
        $pointNow = (Auth::user()->point) - $usePoint;
        
        return view('player.my_page', ['applyGifts' => $applyGifts, 'pointNow' => $pointNow]);
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
}
