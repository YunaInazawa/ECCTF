function changeSelect( arr_name, arr_description ) {
    var gift_num = document.getElementById('selectGift').value;
    if( gift_num == '' ){
        document.getElementById('display').className = 'd-none p-2';
    } else {
        gift_num = parseInt(gift_num);
        document.getElementById('display').className = 'd-inline p-2';

        document.getElementById('giftName').innerHTML = '<h1>' + arr_name[gift_num] + '</h1>';
        document.getElementById('giftImage').innerHTML = '<img class="fit-image" src="images/sampleQR.png">';
        document.getElementById('giftDescription').innerHTML = '<p>' + arr_description[gift_num] + '</p>';
    }
}