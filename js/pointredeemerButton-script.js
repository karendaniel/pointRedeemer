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

		fireJasonp: function() {

			$.ajax({
		        type: 'GET',
		        dataType: 'jsonp',
		        data: {},
		        url: "http://point.1s.my/api/v1/showPoint?token=25dcc06cf923347978248f047cb58aca&current_user="+userData+"&callback=?",
		        error: function (jqXHR, textStatus, errorThrown) {
		            console.log(jqXHR)
		        },
		        success: function (msg) {
		            console.log(msg);
		        }
		    });
		},

		fireAjax: function(actionString, data, callback) {

			// var test = {"currency":"MYR","users":{"ID":"100","user_login":"karen","user_pass":"$P$ByoXIIIQlPCQKY1S3I0TN5VcXXmsKt0","user_nicename":"karen","user_email":"karen00daniel@gmail.com","user_url":"","user_registered":"2017-09-11 09:46:13","user_modified_gmt":"0000-00-00 00:00:00","user_activation_key":"","user_status":"0","display_name":"karen"}};
			
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