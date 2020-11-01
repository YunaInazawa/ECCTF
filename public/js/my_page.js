function clickDelete( giftData, applyNum ) {
    var hide = '<input type="hidden" name="delete_id" value="' + giftData['id'] + '">';

    document.getElementById('hide').innerHTML = 
    document.getElementById('modal-title').innerHTML = giftData['name'];

    var select = document.getElementById('delete_num');
    removeChildren(select);
    for( var i = 1; i <= applyNum; i++ ){
        var option = document.createElement('option');
        option.text = i;
        option.value = i;
        select.appendChild(option);

    }

}

function removeChildren( x ){
	if ( x.hasChildNodes() ) {
		while (x.childNodes.length > 0) {
			x.removeChild(x.firstChild)
		}
	}
}