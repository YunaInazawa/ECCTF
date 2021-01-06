<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FirstController extends Controller
{
    /**
     * 企画紹介ページ
     */
    public function description() {
        return view('player.description');
    }
}
