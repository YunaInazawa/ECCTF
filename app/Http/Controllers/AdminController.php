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
use App\Course;
use App\Card;
use App\PlaceQuestion;
use App\Place;
use Hash;

class AdminController extends Controller
{
    private $questionItems = ['genre', 'level', 'text', 'type', 'answer', 'correct', 'commentary'];
    private $giftItems = ['giftName', 'giftDescription'];
    private $userItems = ['course', 'student_num', 'name', 'email'];
    private $cardItems = 
        [   '0', '1', '2', '3', '4', 
            '5', '6', '7', '8', '9', 
            '10', '11', '12', '13', '14', 
            '15', '16', '17', '18', '19', 
            '20', '21', '22', '23', '24', 
        ];

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
        $cardsData = Card::all();
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

        return view('admin.management', ['usersData' => $usersData, 'questionsData' => $questionsData, 'giftsData' => $giftsData, 'corrects' => $corrects, 'quantitys' => $quantitys, 'cardsData' => $cardsData]);
    }

    /**
     * 問題ページ
     */

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
     * 07_編集画面（問題）
     */
    public function question_edit( $id ) {
        $types = Type::all();
        $levels = Level::all();
        $genres = Genre::all();
        $questionData = Question::find($id);
        $correctData = Choice::where('question_id', $id)->where('is_correct', true)->get();
        
        return view('admin.question_edit', ['types' => $types, 'levels' => $levels, 'genres' => $genres, 'id' => $id, 'questionData' => $questionData, 'correctData' => $correctData]);
    }

    /**
     * 08_確認画面（問題）
     */
    public function question_check( Request $request ) {
        $request -> session() -> regenerateToken();

        $input = $request->only($this->questionItems);

        if( empty($input['correct']) ){
            return redirect()->back()->withInput($input)->with('flash_message', '正解を選択してください');
        }

        $request->session()->put('question_input', $input);

        if( !empty($request->question_id) ){
            $request->session()->put('question_id', $request->question_id);
        }

        return view('admin.question_check', ['input' => $input]);
    }

    /**
     * DB 登録（問題）
     */
    public function question_new( Request $request ) {
        $request -> session() -> regenerateToken();
        $input = $request->session()->get('question_input');
        $id = $request->session()->get('question_id');

        if( $request->has('back') ){
            // 「戻る」ボタンが押されたとき
            if( !!$id ){
                return redirect()->route('admin.question_edit', $id)->withInput($input);
            }else{
                return redirect()->route('admin.question_create')->withInput($input);
            }
        
        }

        if( !!$id ){
            // Choice 削除
            Choice::where('question_id', $id)->delete();

            // 編集
            $addQuestion = Question::find($id);

        }else{
            // 新規登録
            $addQuestion = new Question;

        }

        $addQuestion->text = $input['text'];
        $addQuestion->commentary = $input['commentary'];
        $addQuestion->genre_id = Genre::where('name', $input['genre'])->first()->id;
        $addQuestion->type_id = Type::where('name', $input['type'])->first()->id;
        $addQuestion->level_id = Level::where('name', $input['level'])->first()->id;
        $addQuestion->save();

        // Choice 追加
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
        
        $request->session()->forget('question_input');
        $request->session()->forget('question_id');

        return redirect()->route('admin.question_details', $addQuestion->id);
    }

    /**
     * 削除（問題）
     */
    public function question_del( $id ) {
        $question_id = Question::find($id)->id;

        Question::find($id)->delete();
        Choice::where('question_id', $id)->delete();
        
        return redirect()->route('admin.management')->with('flash_message', 'QUESTION < # ' . $question_id . ' ><br />削除しました');
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
     * 景品ページ
     */

    /**
     * 07_作成画面（景品）
     */
    public function gift_create() {
        
        return view('admin.gift_create');
    }

    /**
     * 07_編集画面（景品）
     */
    public function gift_edit( $id ) {
        $giftData = Gift::find($id);
        
        return view('admin.gift_edit', ['giftData' => $giftData]);
    }

    /**
     * 08_確認画面（景品）
     */
    public function gift_check( Request $request ) {
        $request -> session() -> regenerateToken();

        $input = $request->only($this->giftItems);
        $request->session()->put('gift_input', $input);

        if( empty($request->file('giftImageFile')) ){
            $giftImage = $request->giftImage;

        }else{
            $path = $request->file('giftImageFile')->store('public/gift');
            $giftImage = basename($path);
        }

        if( !empty($request->gift_id) ){
            $request->session()->put('gift_id', $request->gift_id);
        }

        return view('admin.gift_check', ['input' => $input, 'giftImage' => $giftImage]);
    }

    /**
     * DB 登録（景品）
     */
    public function gift_new( Request $request ) {
        $request -> session() -> regenerateToken();
        $input = $request->session()->get('gift_input');
        $giftImage = $request->giftImage;
        $id = $request->session()->get('gift_id');

        if( $request->has('back') ){
            // 「戻る」ボタンが押されたとき
            if( !!$id ){
                return redirect()->route('admin.gift_edit', $id)->withInput($input);
            }else{
                return redirect()->route('admin.gift_create')->withInput($input);
            }
        
        }

        if( !!$id ){
            // 編集
            $addGift = Gift::find($id);

        }else{
            // 新規登録
            $addGift = new Gift;

        }

        $addGift->name = $input['giftName'];
        $addGift->description = $input['giftDescription'];
        $addGift->image_path = ($giftImage == 'noImage' ? null : $giftImage);
        $addGift->save();
        
        $request->session()->forget('gift_input');
        $request->session()->forget('gift_id');

        return redirect()->route('admin.gift_details', $addGift->id);

    }

    /**
     * 削除（景品）
     */
    public function gift_del( $id ) {
        $gift_name = Gift::find($id)->name;

        Gift::find($id)->delete();
        
        return redirect()->route('admin.management')->with('flash_message', 'GIFT < ' . $gift_name . ' ><br />削除しました');
    }

    /**
     * 09_詳細画面（景品）
     */
    public function gift_details( $id ) {
        $giftData = Gift::find($id);
        
        return view('admin.gift_details', ['giftData' => $giftData]);
    }

    /**
     * ユーザページ
     */

    /**
     * 07_編集画面（ユーザ）
     */
    public function user_edit( $id ) {
        $userData = User::find($id);
        $courseDatas = Course::all();
        
        return view('admin.user_edit', ['userData' => $userData, 'courseDatas' => $courseDatas]);
    }
    
    /**
     * 08_確認画面（ユーザ）
     */
    public function user_check( Request $request ) {
        $request -> session() -> regenerateToken();
        $user_id = $request->user_id;

        $input = $request->only($this->userItems);
        $request->session()->put('user_input', $input);
        $request->session()->put('user_id', $user_id);

        $password = $request->password;
        $password_check = $request->password_check;
        if( $password != $password_check ){
            return redirect()->back()->withInput($input)->with('flash_message', 'パスワードと再入力が一致しません');
        }
        $request->session()->put('user_password', $password);

        $password_len = strlen($password)-1;
        $passwordStr = substr($password, 0, 1);
        for( $i = 1; $i < $password_len; $i++ ){
            $passwordStr .= '*';
        }
        $passwordStr .= substr($password, -1, 1);

        return view('admin.user_check', ['input' => $input, 'user_id' => $user_id, 'passwordStr' => $passwordStr]);
    }

    /**
     * DB 登録（ユーザ）
     */
    public function user_update( Request $request ) {
        $request -> session() -> regenerateToken();
        $input = $request->session()->get('user_input');
        $id = $request->session()->get('user_id');
        $pass = $request->session()->get('user_password');

        if( $request->has('back') ){
            // 「戻る」ボタンが押されたとき
            return redirect()->route('admin.user_edit', $id)->withInput($input);
        
        }

        
        $editUser = User::find($id);
        $editUser->name = $input['name'];
        $editUser->email = $input['email'];
        $editUser->student_num = $input['student_num'];
        $editUser->password = Hash::make($pass);
        $editUser->course_id = Course::where('name', $input['course'])->first()->id;
        $editUser->save();
        
        $request->session()->forget('user_input');
        $request->session()->forget('user_id');
        $request->session()->forget('user_password');

        return redirect()->route('admin.user_details', $editUser->id);

    }
    
    /**
     * 削除（ユーザ）
     */
    public function user_del( $id ) {
        $userData = user::find($id);

        User::find($id)->delete();
        
        return redirect()->route('admin.management')->with('flash_message', 'USER < # ' . $userData->id . ' : ' . $userData->name . ' ><br />削除しました');
    }

    /**
     * 09_詳細画面（ユーザ）
     */
    public function user_details( $id ) {
        $userData = User::find($id);
        
        return view('admin.user_details', ['userData' => $userData]);
    }

    /**
     * カード編成ページ
     */

    /**
     * 07_編集画面（カード）
     */
    public function card_edit( $id ) {
        $cardData = Card::find($id);
        $placeData = PlaceQuestion::where('card_id', $id)->orderBy('place_id')->get();

        $genresData = Genre::all();
        $levelsData = Level::all();
        
        return view('admin.card_edit', ['cardData' => $cardData, 'placeData' => $placeData, 'genresData' => $genresData, 'levelsData' => $levelsData]);
    }
    
    /**
     * 08_確認画面（カード）
     */
    public function card_check( Request $request ) {
        $request -> session() -> regenerateToken();
        $card_id = $request->card_id;
        $card_name = $request->card_name;

        $input = $request->only($this->cardItems);
        $request->session()->put('card_input', $input);
        $request->session()->put('card_id', $card_id);

        return view('admin.card_check', ['input' => $input, 'card_id' => $card_id, 'card_name' => $card_name]);
    }

    /**
     * DB 登録（カード）
     */
    public function card_update( Request $request ) {
        $request -> session() -> regenerateToken();
        $input = $request->session()->get('card_input');
        $id = $request->session()->get('card_id');

        if( $request->has('back') ){
            // 「戻る」ボタンが押されたとき
            return redirect()->route('admin.card_edit', $id)->withInput($input);
        
        }
        
        $count = 1;
        foreach( $input as $i ){
            $tmp = explode(",", $i);
            $genre = $tmp[0];
            $level = $tmp[1];

            $editCard = PlaceQuestion::where('card_id', $id)->where('place_id', $count++)->first();
            $editCard->genre_id = Genre::where('name', $genre)->first()->id;
            $editCard->level_id = Level::where('name', $level)->first()->id;
            $editCard->save();
        }
        
        $request->session()->forget('card_input');
        $request->session()->forget('card_id');

        return redirect()->route('admin.card_details', $id);

    }

    /**
     * 09_詳細画面（カード）
     */
    public function card_details( $id ) {
        $cardData = Card::find($id);
        $placeData = PlaceQuestion::where('card_id', $id)->orderBy('place_id')->get();
        
        return view('admin.card_details', ['cardData' => $cardData, 'placeData' => $placeData]);
    }

    /**
     * ルーム編成ページ
     */

    /**
     * 07_編集画面（ルーム）
     */
    public function room_edit() {
        $placeData = Place::all();
        
        return view('admin.room_edit', ['placeData' => $placeData]);
    }
    
    /**
     * 08_確認画面（ルーム）
     */
    public function room_check( Request $request ) {
        $request -> session() -> regenerateToken();

        $input = $request->only($this->cardItems);
        $request->session()->put('room_input', $input);

        return view('admin.room_check', ['input' => $input]);
    }

    /**
     * DB 登録（ルーム）
     */
    public function room_update( Request $request ) {
        $request -> session() -> regenerateToken();
        $input = $request->session()->get('room_input');

        if( $request->has('back') ){
            // 「戻る」ボタンが押されたとき
            return redirect()->route('admin.room_edit')->withInput($input);
        
        }
        
        foreach( $this->cardItems as $num ){

            $editRoom = Place::where('position_num', $num)->first();
            $editRoom->room_name = $input[$num];
            $editRoom->save();
        }
        
        $request->session()->forget('room_input');

        return redirect()->route('admin.room_details');

    }
    
    /**
     * 09_詳細画面（ルーム）
     */
    public function room_details() {
        $placeData = Place::all();
        
        return view('admin.room_details', ['placeData' => $placeData]);
    }

    function checkCorrect($type, $a, $correct) {
        if( $type == '多答クイズ' ){
            return in_array($a, $correct);
    
        }else{
            return $a == $correct[0];
        }
    }
}
