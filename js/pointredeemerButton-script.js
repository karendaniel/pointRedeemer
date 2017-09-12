$(function() {

	var pointRedeemer = {

		buttonClicked : function() {

			this.getUserData(function(userData) {

			var ajaxData = {
				'token': '25dcc06cf923347978248f047cb58aca',
				'userData': userData
			};
			//showPoint
			ajaxData['url'] = pointRedeemer.getURL()+'showPoint';

			pointRedeemer.fireAjax('getUserPoints',ajaxData, function(result) {
				
				console.debug(result);
				ajaxData['url'] = pointRedeemer.getURL()+'redeemPoints';

				//redeemPoints
				pointRedeemer.fireAjax('redeemUserPoints',ajaxData, function(result) {
					console.debug(result);
				});
			});
			});

		},

		getURL: function() {

			return 'http://192.168.1.116:8080/IDoSpaPoints/api/v1/';
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