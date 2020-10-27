<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PlayerController extends Controller
{
    public function question() {

        return view('player.question');
    }
    public function commentary() {
        
        return view('player.commentary');
    }
    public function my_page() {
        
        return view('player.my_page');
    }
    public function challenge() {
        
        return view('player.challenge');
    }
}
