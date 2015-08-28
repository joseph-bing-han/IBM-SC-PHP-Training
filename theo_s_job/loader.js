/**
 * 
 */

var chat = {
	enter_key : "13",	
		
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
		try{
			var obj = jQuery.parseJSON(message);
		}catch (e){
			chat.comunicationloop();
			return;
		}
		
		if (obj[0] != 'TIMEOUT') {
			for (var i = 0; i < obj.length; i++) {
				try{
					var o = jQuery.parseJSON(obj[i]);
					$('#message_loader').append(
							'<div>' + o.from + ' [' + o.time + ']: ' + o.body
									+ '</div>');
					console.log('Json:');
					console.log(o);
				}catch(e){
					return;
				}
				
			}
		}

	},

	sendmessage : function() {
		$
				.ajax({
					type : 'POST',
					url : 'http://chat.localhost.lc/IBM-SC-PHP-Training/theo_s_job/index.php',
					data : {
						router_id : '4',
						email : $('#cu_email').val(),
						load : $('#to_send').val()
					},
				});
		$('#to_send').val('');
		$('#to_send').focus();
	}
};

$('doucment').ready(chat.comunicationloop);

$('#send_m').click(chat.sendmessage);

$('#to_send').bind('keypress', function(event){
	if(event.keyCode == chat.enter_key){
		chat.sendmessage();
	}
});