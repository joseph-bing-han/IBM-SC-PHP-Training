$(function() {
	chat.getMsgs();
	$('#btnMsg').click(chat.sendMsg);
	$('#btnOut').click(chat.logout);
	
});

var chat = {

	getMsgs : function() {
		$.ajax({
			type : "POST",
			url : _request + "index.php/chat/getMsgs",
			dataType : "json",
			//timeout:10000,  
			data : {
				time : "10000"
			},
			success : function(data, textStatus) {
				if (data != "") {
					var userlist = data.user;
					var message = data.message;
					if (userlist != "") {
						$('#user').html("");
					}
					for ( var i = 0; i < userlist.length; i++) {
						$('#user').append(userlist[i].name + "<br>");
					}
					if (message != null) {
						for (var i = 0; i < message.length; i++) {
							$('#msgs').append(message[i] + "<br>");
						}
					}
				}
				chat.getMsgs();
			},

			error : function(XMLHttpRequest, textStatus, errorThrown) {

			}
		});
	},
	sendMsg : function() {
		var msg = $('#msg').val();
		$.ajax({
			type : "POST",
			url : _request + "index.php/chat/sendMsg",
			dataType : "json",
			data : {
				msg : msg
			},
			success : function(data, textStatus) {
				$('#msg').val('');
				$('#msg').focus();
			},
			error : function(XMLHttpRequest, textStatus, errorThrown) {
				if (textStatus == "timeout")
					alert("timeout!");
			}
		});
	},
	logout:function(){
		window.location.href=_request + "index.php/chat/logout";
	}

}