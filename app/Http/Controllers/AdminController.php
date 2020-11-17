<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Question;
use App\Gift;

class AdminController extends Controller
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
     * 06_TOP画面
     */
    public function index() {
        $usersData = User::where('is_admin', 0)->get();
        $questionsData = Question::all();
        $GiftsData = Gift::all();

        return view('admin.management', ['usersData' => $usersData, 'questionsData' => $questionsData, 'giftsData' => $GiftsData]);
    }
}
