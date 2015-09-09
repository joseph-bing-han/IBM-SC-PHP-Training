$(function () {
	Backbone.emulateJSON=true;
    //构建登录对象模型
    var Login = Backbone.Model.extend({
		url : _request+'index.php/home/check',
        validate: function (attrData) {
        	var msg=""
            for (var obj in attrData) {
                if (attrData[obj] == '') {
                	if(obj=="username"){
						msg+= "<li>用户名不能为空</li>";
					}
					if(obj=="userpwd"){
						msg+= "<li>密码不能为空</li>";
					}
                }
            }
			if(msg!="")
				return msg;
        }
    });
   
    //构建主页视图
    var LoginAppView = Backbone.View.extend({
    	el: $("#main"),
        events: {
            "click #btnLogin": "login"
        },
        login: function (e) {
            var login = new Login();
            var objData = {};
            $('#username,#userpwd').each(function () {//model数据获得
                objData[$(this).attr('id')] = $(this).val();
            });
            login.bind('invalid', function (model, error) {//绑定报错方法
                $("#errorid").show().html(error);
            });
            if (login.set(objData, { 'validate': true })) {//提交
                $("#errorid").hide();
				login.save(null,{success:function(model,response){
					 $("#errorid").show().html(response.tip);
					 if(response.code=="1"){
						 $(this).ShowMask();
						 var url="window.location.href='"+_request+"index.php/home/login'";
						 setTimeout(url, 1000);
					 }
	            }},{error:function(err){  
	            	 $("#errorid").show().html(err); 
	            }});
            }
        }
    });
    //实例化一个主页视图对象
    var LoginAppView = new LoginAppView();
});