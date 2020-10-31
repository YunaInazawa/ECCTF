function changeSelect( gifts_data ) {
    var gift_id = document.getElementById('selectGift').value;
    if( gift_id == '' ){
        document.getElementById('display').className = 'd-none p-2';
    } else {
        gift_id = parseInt(gift_id);
        document.getElementById('display').className = 'd-inline p-2';

        for( var i = 0; i < gifts_data.length; i++ ){
            if( gift_id == gifts_data[i]['id'] ){
                document.getElementById('giftName').innerHTML = '<h1>' + gifts_data[i]['name'] + '</h1>';
                document.getElementById('giftImage').innerHTML = '<img class="fit-image" src="images/sampleQR.png">';
                document.getElementById('giftDescription').innerHTML = '<p>' + gifts_data[i]['description'] + '</p>';
            }
        }
    }

}