<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Question;
use App\Gift;
use App\Choice;
use App\UserGift;
use App\Type;
use App\Level;
use App\Genre;

class AdminController extends Controller
{
    private $questionItems = ['genre', 'level', 'text', 'type', 'answer', 'correct', 'commentary'];

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

    /**
     * 07_作成画面（問題）
     */
    public function question_create() {
        $types = Type::all();
        $levels = Level::all();
        $genres = Genre::all();
        
        return view('admin.question_create', ['types' => $types, 'levels' => $levels, 'genres' => $genres]);
    }

    /**
     * 08_確認画面（問題）
     */
    public function question_check( Request $request ) {
        $request -> session() -> regenerateToken();

        $input = $request->only($this->questionItems);

        if( empty($input['correct']) ){
            return redirect()->route('admin.question_create')->withInput($input)->with('flash_message', '正解を選択してください');
        }

        $request->session()->put('question_input', $input);

        // $genre = $request->genre;
        // $level = $request->level;
        // $text = $request->text;
        // $type = $request->type;
        // $answer = $request->answer;
        // $commentary = $request->commentary;
        // $correct = $request->correct;

        // if( $type == '多答クイズ' ){
        //     $correct = implode('<br />', $correct);
        // }
        
        // return view('admin.question_check', ['genre' => $genre, 'level' => $level, 'text' => $text, 'type' => $type, 'answer' => $answer, 'commentary' => $commentary, 'correct' => $correct]);
        return view('admin.question_check', ['input' => $input]);
    }

    /**
     * DB 登録（問題）
     */
    public function question_new( Request $request ) {
        $request -> session() -> regenerateToken();
        $input = $request->session()->get('question_input');

        if( $request->has('back') ){
            // 「戻る」ボタンが押されたとき
            return redirect()->route('admin.question_create')->withInput($input);
        }


        // $genre = $request->genre;
        // $level = $request->level;
        // $text = $request->text;
        // $type = $request->type;
        // $answer = $request->answer;
        // $commentary = $request->commentary;
        // $correct = $request->correct;

        // if( $type == '多答クイズ' ){
        //     $correct = explode('<br />', $correct);
        // }

        // DB 登録
        $addQuestion = new Question;
        $addQuestion->text = $input['text'];
        $addQuestion->commentary = $input['commentary'];
        $addQuestion->genre_id = Genre::where('name', $input['genre'])->first()->id;
        $addQuestion->type_id = Type::where('name', $input['type'])->first()->id;
        $addQuestion->level_id = Level::where('name', $input['level'])->first()->id;
        $addQuestion->save();

        if( empty($input['answer']) ){
            $addChoice = new Choice;
            $addChoice->text = $input['correct'][0];
            $addChoice->is_correct = true;
            $addChoice->question_id = $addQuestion->id;
            $addChoice->save();
        }else{
            foreach( $input['answer'] as $a ){
                $addChoice = new Choice;
                $addChoice->text = $a;
                $addChoice->is_correct = $this->checkCorrect($input['type'], $a, $input['correct']);
                $addChoice->question_id = $addQuestion->id;
                $addChoice->save();
            }
        }
        

        return redirect()->route('admin.question_details', $addQuestion->id);
    }

    function checkCorrect($type, $a, $correct) {
        if( $type == '多答クイズ' ){
            return in_array($a, $correct);
    
        }else{
            return $a == $correct[0];
        }
    }
}
