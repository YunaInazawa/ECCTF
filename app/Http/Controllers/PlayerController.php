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
}