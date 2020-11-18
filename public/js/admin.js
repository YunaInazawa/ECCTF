jQuery(function($) {
 
  //data-hrefの属性を持つtrを選択しclassにclickableを付加
  $('tr[data-href]').addClass('clickable')
    
    //クリックイベント
    .click(function(e) {
    
      //e.targetはクリックした要素自体、それがa要素以外であれば
      if(!$(e.target).is('a')){
        
        //その要素の先祖要素で一番近いtrの
        //data-href属性の値に書かれているURLに遷移する
        window.location = $(e.target).closest('tr').data('href');}
  });
});

var typeValue = '';     // 選択中の値
function changeType() {
  // 値は選択されているか？
  if( typeValue != '' ){
    if( confirm('入力している回答がリセットされます。よろしいですか？') ){
      // 新しい値をセット
      typeValue = document.getElementById('type').value;
      changeAnswerArea(typeValue);

    }else{
      // 変更しない
      document.getElementById('type').value = typeValue;

    }
  }else{
    // 選択中の値を更新
    typeValue = document.getElementById('type').value;
    changeAnswerArea(typeValue);

  }
}

var answerId = 1;
function changeAnswerArea( type ) {
  var str = '';
  answerId = 1;

  if( type == '' ){
    document.getElementById('answerArea').innerHTML = '「回答タイプ」を選択してください';

  }else{
    if( type == '択一クイズ' ){
      str += '<div class="form-check"><input type="radio" class="form-check-input" name="answer" checked><label id="answerId' + answerId + '" class="form-check-label lie-link" onclick=answerChange("answerId' + answerId + '")>選択肢' + answerId++ + '</label></div>';
      str += '<div class="form-check"><input type="radio" class="form-check-input" name="answer"><label id="answerId' + answerId + '" class="form-check-label lie-link" onclick=answerChange("answerId' + answerId + '")>選択肢' + answerId++ + '</label></div>';
      str += '<div class="form-check"><input type="radio" class="form-check-input" name="answer"><label id="answerId' + answerId + '" class="form-check-label lie-link" onclick=answerChange("answerId' + answerId + '")>選択肢' + answerId++ + '</label></div>';
  
    }else if( type == '二択クイズ' ){
      str += '<div class="form-check"><input type="radio" class="form-check-input" name="answer" checked><label id="answerId' + answerId + '" class="form-check-label lie-link" onclick=answerChange("answerId' + answerId + '")>選択肢' + answerId++ + '</label></div>';
      str += '<div class="form-check"><input type="radio" class="form-check-input" name="answer"><label id="answerId' + answerId + '" class="form-check-label lie-link" onclick=answerChange("answerId' + answerId + '")>選択肢' + answerId++ + '</label></div>';
  
    }else if( type == '多答クイズ' ){
      str += '<div class="form-check"><input type="checkbox" class="form-check-input" name="answer" checked><label id="answerId' + answerId + '" class="form-check-label lie-link" onclick=answerChange("answerId' + answerId + '")>選択肢' + answerId++ + '</label></div>';
      str += '<div class="form-check"><input type="checkbox" class="form-check-input" name="answer"><label id="answerId' + answerId + '" class="form-check-label lie-link" onclick=answerChange("answerId' + answerId + '")>選択肢' + answerId++ + '</label></div>';
      str += '<div class="form-check"><input type="checkbox" class="form-check-input" name="answer"><label id="answerId' + answerId + '" class="form-check-label lie-link" onclick=answerChange("answerId' + answerId + '")>選択肢' + answerId++ + '</label></div>';
  
    }else{    // 穴抜けコード or 一問一答
      str = '<input type="text" class="form-control name="answer" required autocomplete="answer">';
  
    }
    document.getElementById('answerArea').innerHTML = str;

  }
}

function answerChange( id ){
  var init = document.getElementById(id).innerText;
  var newStr = prompt('選択肢を入力してください', init);
  if (newStr == null || newStr == '') newStr = init;
  document.getElementById(id).innerText = newStr;

}
