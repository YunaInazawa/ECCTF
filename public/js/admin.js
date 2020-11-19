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

function changeType() {
  var typeValue = document.getElementById('typeValue').value;

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

  document.getElementById('typeValue').value = typeValue;
}

var answerId = 1;
function changeAnswerArea( type ) {
  var str = '';
  answerId = 1;

  if( type == '' ){
    document.getElementById('answerArea').innerHTML = '「回答タイプ」を選択してください';

  }else{
    if( type == '択一クイズ' ){
      str += '<input type="hidden" id="answerIdHidden' + answerId + '" name="answer[]" value="選択肢' + answerId + '">';
      str += '<div class="form-check"><input type="radio" class="form-check-input" name="correct[]" value="選択肢' + answerId + '" checked><label id="answerId' + answerId + '" class="form-check-label lie-link" onclick=answerChange(' + answerId + ')>選択肢' + answerId++ + '</label></div>';
      str += '<input type="hidden" id="answerIdHidden' + answerId + '" name="answer[]" value="選択肢' + answerId + '">';
      str += '<div class="form-check"><input type="radio" class="form-check-input" name="correct[]" value="選択肢' + answerId + '"><label id="answerId' + answerId + '" class="form-check-label lie-link" onclick=answerChange(' + answerId + ')>選択肢' + answerId++ + '</label></div>';
      str += '<input type="hidden" id="answerIdHidden' + answerId + '" name="answer[]" value="選択肢' + answerId + '">';
      str += '<div class="form-check"><input type="radio" class="form-check-input" name="correct[]" value="選択肢' + answerId + '"><label id="answerId' + answerId + '" class="form-check-label lie-link" onclick=answerChange(' + answerId + ')>選択肢' + answerId++ + '</label></div>';
  
    }else if( type == '二択クイズ' ){
      str += '<input type="hidden" id="answerIdHidden' + answerId + '" name="answer[]" value="選択肢' + answerId + '">';
      str += '<div class="form-check"><input type="radio" class="form-check-input" name="correct[]" value="選択肢' + answerId + '" checked><label id="answerId' + answerId + '" class="form-check-label lie-link" onclick=answerChange(' + answerId + ')>選択肢' + answerId++ + '</label></div>';
      str += '<input type="hidden" id="answerIdHidden' + answerId + '" name="answer[]" value="選択肢' + answerId + '">';
      str += '<div class="form-check"><input type="radio" class="form-check-input" name="correct[]" value="選択肢' + answerId + '"><label id="answerId' + answerId + '" class="form-check-label lie-link" onclick=answerChange(' + answerId + ')>選択肢' + answerId++ + '</label></div>';
  
    }else if( type == '多答クイズ' ){
      str += '<input type="hidden" id="answerIdHidden' + answerId + '" name="answer[]" value="選択肢' + answerId + '">';
      str += '<div class="form-check"><input type="checkbox" class="form-check-input" name="correct[]" value="選択肢' + answerId + '"><label id="answerId' + answerId + '" class="form-check-label lie-link" onclick=answerChange(' + answerId + ')>選択肢' + answerId++ + '</label></div>';
      str += '<input type="hidden" id="answerIdHidden' + answerId + '" name="answer[]" value="選択肢' + answerId + '">';
      str += '<div class="form-check"><input type="checkbox" class="form-check-input" name="correct[]" value="選択肢' + answerId + '"><label id="answerId' + answerId + '" class="form-check-label lie-link" onclick=answerChange(' + answerId + ')>選択肢' + answerId++ + '</label></div>';
      str += '<input type="hidden" id="answerIdHidden' + answerId + '" name="answer[]" value="選択肢' + answerId + '">';
      str += '<div class="form-check"><input type="checkbox" class="form-check-input" name="correct[]" value="選択肢' + answerId + '"><label id="answerId' + answerId + '" class="form-check-label lie-link" onclick=answerChange(' + answerId + ')>選択肢' + answerId++ + '</label></div>';
  
    }else{    // 穴抜けコード or 一問一答
      str = '<input type="text" class="form-control" name="correct[]" required autocomplete="answer">';
  
    }
    document.getElementById('answerArea').innerHTML = str;

  }
}

function answerChange( num ){
  var init = document.getElementById('answerId' + num).innerText;
  var newStr = prompt('選択肢を入力してください', init);
  if (newStr == null || newStr == '') newStr = init;
  document.getElementById('answerId' + num).innerText = newStr;

  document.getElementById('answerIdHidden' + num).value = newStr;

  document.getElementsByName('correct[]')[num-1].value = newStr;

}

function clearImage() {
  document.getElementById('imageDisplay').innerHTML = '<input type="file" id="giftImage" name="giftImageFile">';
  document.getElementsByName('giftImage')[0].value = 'noImage';
  
}
