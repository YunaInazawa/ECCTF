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
        
        return view('player.my_page');
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
    public function apply() {

        return redirect()->route('player.challenge')
            ->with('flash_message', '応募が完了しました');
    }
}
