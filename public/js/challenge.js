function changeSelect( gifts_data ) {
    var gift_id = document.getElementById('selectGift').value;
    if( gift_id == '' ){
        document.getElementById('display').className = 'd-none p-2';
    } else {
        gift_id = parseInt(gift_id);
        document.getElementById('display').className = 'd-inline p-2';

        for( var i = 0; i < gifts_data.length; i++ ){
            if( gift_id == gifts_data[i]['id'] ){
                var giftId = '<input type="hidden" name="gift_id" value="' + gifts_data[i]['id'] + '">';
                var giftName = '<h1>' + gifts_data[i]['name'] + '</h1>';
                var giftDescription = '<p>' + gifts_data[i]['description'] + '</p>'

                document.getElementById('hide').innerHTML = giftId;
                document.getElementById('giftName').innerHTML = giftName;
                document.getElementById('giftImage').innerHTML = '<img class="fit-image" src="images/sampleQR.png">';
                document.getElementById('giftDescription').innerHTML = giftDescription;
            }
        }
    }

}