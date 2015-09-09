$(document).ready(function(){
	
	$("#myTextArea").val('');
	chat.init();
	
});

var chat = {
	
	data : {
		lastID 		: 0
	},
	
	
	init : function(){
		
		// to prevent multiple form submissions:
		
		var working = false;
		
		// Submitting a new chat entry:
		
		$('#submitForm').submit(function(){

			var text = $('#chatText').val();
			
			if(text.length == 0){
				return false;
			}
			
			if(working) return false;
			working = true;

			var tempID = 't'+Math.round(Math.random()*1000000),
				params = {
					id			: tempID,
					text		: text.replace(/</g,'&lt;').replace(/>/g,'&gt;')
				};

			$.tzPOST('submitChat',$(this).serialize(),function(redata){
				working = false;
				$('#chatText').val('');
				//alert(redata.sql);
			});
			
			return false;
		});
		
		// user logout:
		
		$('a.logoutButton').live('click',function(){

			$.ajax({
				type:"POST",
				url:"ajax.php?action=logout",
				async: false,
				success:function(data,st){
					location.href='login.php';
				},
				dataType: "json"
			});

		});
		
		(function getChatsTimeoutFunction(){
			chat.getChats(getChatsTimeoutFunction);
		})();
		
		(function getUsersTimeoutFunction(){
			chat.getUsers(getUsersTimeoutFunction);
		})();
		
	},
	
	getChats : function(callback){
		$.tzGET('getChats',{lastID: chat.data.lastID},function(r){
			
			for(var i=0;i<r.chats.length;i++){
				$("#myTextArea").val( $("#myTextArea").val() + r.chats[i].userid + '(' + r.chats[i].updatetime + '):\n' + r.chats[i].comment + '\n');
	            var scrollTop = $("#myTextArea")[0].scrollHeight;
				$("#myTextArea").scrollTop(scrollTop);
			}

			if(r.chats.length){
				chat.data.noActivity = 0;
				chat.data.lastID = r.chats[i-1].id;
			}
			else{
				
				chat.data.noActivity++;
			}
			
			var nextRequest = 1000;
		
			setTimeout(callback,nextRequest);
		});
	},
	
	getUsers : function(callback){
		$.tzGET('getUsers',function(r){
			// alert(r.users[0].user);
			var users = [];
			
			for(var i=0; i< r.users.length;i++){
				if(r.users[i]){

					users.push('<div>' + r.users[i].user + '</div>');
				}
			}
			
			var message = '';
			
			if(r.users.length<1){
				message = 'No one is online';
			}
			else {
				message = r.users.length + 'people online';
			}
			
			users.push('<p class="count">'+message+'</p>');
			
			$('#chatUsers').html(users.join(''));
			
			setTimeout(callback,3000);
		});
	},
	
};

$.tzPOST = function(action,data,callback){
	$.post('ajax.php?action='+action,data,callback,'json');
}

$.tzGET = function(action,data,callback){
	$.get('ajax.php?action='+action,data,callback,'json');
}