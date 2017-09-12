$(function() {
	$('#pointredeemerButton').on('click', function() {

		 $.ajax({
		 	url: pointredeemerButton_ajax.ajax_url,
		 	data: {
		 		action: 'getCurrentUserData'
		 	},
		 	type: 'post',
		 	dataType: 'json',
		 	success: function(result) {
        		console.debug(result);
        		//make api rquest
    	 	}
    	 });
	});
});