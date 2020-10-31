<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PlayerController extends Controller
{
    /**
     * 03_問題画面
     */
    public function question() {

        return view('player.question');
    }

    /**
     * 正解 / 不正解 判定
     */
    public function answer() {

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
        
        return view('player.challenge');
    }

    /**
     * 抽選に応募する
     */
    public function apply() {

        return redirect()->route('player.challenge')
            ->with('flash_message', '応募が完了しました');
    }
}
