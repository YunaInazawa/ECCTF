<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Question;
use App\Gift;
use App\Choice;
use App\UserGift;

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
        $giftsData = Gift::all();
        $corrects = array();
        $quantitys = array();

        foreach( $questionsData as $question ){
            $corrects[$question->id] = Choice::where('question_id', $question->id)->where('is_correct', true)->get();
        }

        foreach( $giftsData as $gift ){
            $sum = 0;
            foreach( UserGift::where('gift_id', $gift->id)->get() as $data ){
                $sum += $data->quantity;
            }

            $quantitys[$gift->id] = $sum;
        }

        return view('admin.management', ['usersData' => $usersData, 'questionsData' => $questionsData, 'giftsData' => $giftsData, 'corrects' => $corrects, 'quantitys' => $quantitys]);
    }

    /**
     * 09_詳細画面（問題）
     */
    public function question_details( $id ) {
        $questionData = Question::find($id);
        $choicesData = Choice::where('question_id', $id)->get();
        $correct = '';

        foreach( $choicesData as $choice ){
            if( $choice->is_correct == 1 ){
                $correct .= $choice->text . '<br />';
            }
        }
        
        return view('admin.question_details', ['questionData' => $questionData, 'choicesData' => $choicesData, 'correct' => $correct]);
    }

    /**
     * 09_詳細画面（景品）
     */
    public function gift_details( $id ) {
        $giftData = Gift::find($id);
        
        return view('admin.gift_details', ['giftData' => $giftData]);
    }

    /**
     * 09_詳細画面（ユーザ）
     */
    public function user_details( $id ) {
        $userData = User::find($id);
        
        return view('admin.user_details', ['userData' => $userData]);
    }
}
