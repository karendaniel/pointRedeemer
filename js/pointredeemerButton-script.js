$(function() {

	var pointRedeemer = {

		buttonClicked : function() {

			var showPoint = 'http://192.168.1.116:8080/IDoSpaPoints/api/v1/showPoint';
			var redeemPoint = 'http://192.168.1.116:8080/IDoSpaPoints/api/v1/redeemPoints';

			this.getUserData(function(userData) {

			var data = null;
			var token = '25dcc06cf923347978248f047cb58aca';
				//showPoint
				pointRedeemer.fireAjax('getUserPoints', {
					'token': token,
					'url': showPoint,
					'userData' : userData 
				}, function(result) {
					
					console.debug(result);

					//redeemPoints
					pointRedeemer.fireAjax('redeemUserPoints', {
					'token': token,
					'url': redeemPoint,
					'userData' : userData 
					}, function(result) {
						console.debug(result);
					});
				});
			});

		},

		getUserData: function(callback) {

			this.fireAjax('getCurrentUserData', null, function(result) {
				callback(result);
			});
		},

		fireAjax: function(actionString, data, callback) {
			
			$.ajax({
			 	url: pointredeemerButton_ajax.ajax_url,
			 	data: {
			 		'action': actionString,
			 		'data': data
			 	},
			 	type: 'post',
			 	dataType: 'json',
			 	success: function(result) {
	        		callback(result);
	    	 	}
	    	});
		}
		
	};

	$('#pointredeemerButton').on('click.redeemButton', function() {
		pointRedeemer.buttonClicked();
	});

	
});