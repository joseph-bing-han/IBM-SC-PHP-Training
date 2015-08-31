/**
 * 
 */

var chat = {
	enter_key : "13",
	on_line_message : '[Get online]',

	comunicationloop : function() {
		$.ajax({
			type : 'POST',
			url : './index.php',
			data : {
				router_id : '3'
			},
			success : function(data) {
				chat.messagedecode(data);
				chat.comunicationloop();
			}
		});
	},

	messagedecode : function(message) {
		console.log('Message:');
		console.log(message);
		try {
			var obj = jQuery.parseJSON(message);
		} catch (e) {
			return;
		}

		if (obj[0] != 'TIMEOUT') {
			for (var i = 0; i < obj.length; i++) {
				try {
					var o = jQuery.parseJSON(obj[i]);
					$('#message_loader').append(
							'<div>' + o.from + ' [' + o.time + ']: ' + o.body
									+ '</div>');
					console.log('Json:');
					console.log(o);
				} catch (e) {
					console.log(e.message);
					return;
				}

			}
		}
	},

	sendmessage : function(message) {

		if (message == null) {
			message = $('#to_send').val();
		}

		$.ajax({
			type : 'POST',
			url : './index.php',
			data : {
				router_id : '4',
				load : message
			},
		});
		$('#to_send').val('');
		$('#to_send').focus();
	}
};

$('doucment').ready(function() {
	chat.comunicationloop();
	chat.sendmessage('Get Online');
});

$('#send_m').click(chat.sendmessage);

$('#to_send').bind('keypress', function(event) {
	if (event.keyCode == chat.enter_key) {
		chat.sendmessage();
	}
});