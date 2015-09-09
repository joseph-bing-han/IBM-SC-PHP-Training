<?php /* Smarty version Smarty-3.1.19, created on 2014-07-20 15:04:51
         compiled from "/home/wwwroot/lottery.iheard.me/iphone/server/views/checkIn.view.html" */ ?>
<?php /*%%SmartyHeaderCode:205440914953cb667ea5e9c1-14461335%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'c50eb6378430e0b95cd216c8240ee6ccff2fb378' => 
    array (
      0 => '/home/wwwroot/lottery.iheard.me/iphone/server/views/checkIn.view.html',
      1 => 1405839889,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '205440914953cb667ea5e9c1-14461335',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_53cb667eacc2f4_00544972',
  'variables' => 
  array (
    'BASE_URL' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_53cb667eacc2f4_00544972')) {function content_53cb667eacc2f4_00544972($_smarty_tpl) {?><!-- 签到抽奖页面 -->
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
        <title>签到抽奖页面</title>
        <meta name="renderer" content="webkit">
    
        <!-- 加载 bootstrap css -->
        <link rel="stylesheet" type="text/css" href="<?php echo $_smarty_tpl->tpl_vars['BASE_URL']->value;?>
css/bootstrap.min.css">
        <script src="<?php echo $_smarty_tpl->tpl_vars['BASE_URL']->value;?>
js/jquery-2.0.3.min.js"></script>
        <style type="text/css">
            .container-fluid{
                padding-left: 0px;
                padding-right: 0px;
            }

            .btn{
                border-radius: 0px !important;
                background-color: #edaf34;
            }

            .form-horizontal .form-group{
                margin-left: 0px;
                margin-right: 0px;
            }

            .submit_btn{
                margin-top: 7px;
            }

            .input-group-addon{
                min-width: 85px;
                background-color:#7dc6e7;
                border-top-left-radius: 0;
                border-bottom-left-radius: 0;
            }

            .form-control{
                border-top-right-radius: 0;
                border-bottom-right-radius: 0;
            }

            .user_info{
                padding-top: 24px;
             }

            .need{
                color:rgb(224, 82, 139);
                font-size: 17px;
            }

            body{
                font-size: 18px;
                background-color:#1a2b56;
                font-family: 'KaiTi','Microsoft YaHei','KaiTi_GB2312',sans-serif;
            }

            .title{
                padding-left: 0px;
                padding-right: 0px;
                font-size:20px;
                background-color:#7dc6e7;
                text-align: center;
                padding-top: 3px;
                padding-bottom: 3px;
            }

            .noshow{
                visibility: hidden;
            }

            .footer{
                color: #fff;
                font-size: 15px;
                margin-bottom: 10px;
            }

            .footer a{
                color: #05F55B;
            }

            .error_msg{
                color:rgb(224, 82, 139);
                float:right;
                margin-top: 5px;
                display: hidden; 
            }

            p{
                text-indent: 2em;
                text-align: justify;
                margin-top: 45px;
            }

            img{
                width: 100%;
            }

        </style>
    </head>
  <body>
    
        <div class="container-fluid">
            <img src="../img/register.jpg">
        </div>

        <!-- 
        <div class="container-fluid">
            <div class="col-xs-12 title">
               活动规则7dc6e7  黄色：edaf34
            </div>
            <div class="col-md-12 rule">
              <p>本公司将依法运营活动，但如活动受政府机关指令需要停止举办的，或者活动遭受严重网络攻击或系统故障需要暂停举办的，则活动可能无法顺利进行，此种情况视为活动故障，本公司及其关联公司均无须为活动故障承担赔偿或进行补偿。</p>
            </div>
        </div>
         -->

        <div class="container-fluid">
            <div class="col-xs-12 title">
               签到表
            </div>
    
            <div class="container-fluid" >
                <form class="col-xs-12 form-horizontal user_info" role="form" action="<?php echo $_smarty_tpl->tpl_vars['BASE_URL']->value;?>
server/route.php?c=iphone&m=checkIn" method="post">
                        
                    <input type="hidden" name="activity_code" value="first" >

                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-addon"><span class="need">* </span>姓名</div>
                            <input type="text" class="form-control" id="user_name" name="user_name" >
                        </div>
                        <span class="col-md-12 error_msg" data-name="user_name"></span>
                    </div>

                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-addon"><span class="need">* </span>手机号</div>
                            <input type="number" class="form-control" id="iphone" name="iphone">
                        </div>
                        <span class="col-md-12 error_msg" data-name="iphone"></span>
                    </div>

                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-addon"><span class="need">* </span>公司</div>
                            <input type="text" class="form-control" id="company" name="company">
                        </div>
                        <span class="col-md-12 error_msg" data-name="company"></span>
                    </div>

                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-addon"><span class="need">* </span>职位</div>
                            <input type="text" class="form-control" id="job" name="job">
                        </div>
                        <span class="col-md-12 error_msg" data-name="job"></span>
                    </div>

                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-addon"><span class="need noshow">* </span>邮箱</div>
                            <input type="email" class="form-control" id="email" name="email">
                        </div>
                        <span class="col-md-12 error_msg" data-name="email"></span>
                    </div>
                   
                    <div class="form-group submit_btn">
                        <button type="submit" class="btn btn-block" name="submit">签到</button>
                    </div>
                </form>
            </div>

            <div class="col-xs-12 footer">
                <em style="float:right"><a href="http://www.juweitang.net/index.php?g=Wap&m=Index&a=index&token=sqcwdm1402837582">杭为科技</a>提供技术支持</em>
            </div>
        </div>

        <script type="text/javascript">
            function name_legal(){
                var user_name = $('#user_name').val();
                if(user_name == ''){
                    $('.error_msg[data-name=user_name]').text('请填写姓名');
                    $('.error_msg[data-name=user_name]').show();
                    return false;
                }else{
                    $('.error_msg[data-name=user_name]').hide();
                    return true;
                }               
            }

            function iphone_legal(){
                var iphone = $('#iphone').val();
                var reg = /^1[3|4|5|8|7][0-9]\d{8}$/;
                if(iphone == ''){
                    $('.error_msg[data-name=iphone]').text('请填写手机号码');
                    $('.error_msg[data-name=iphone]').show();
                    return false;
                }else if(!reg.test(iphone)){
                    $('.error_msg[data-name=iphone]').text('手机号码格式错误');
                    $('.error_msg[data-name=iphone]').show();
                    return false;
                }else{
                    $('.error_msg[data-name=iphone]').hide();
                    return true;
                }               
            }



            function company_legal(){
                var company = $('#company').val();
                if(company == ''){
                    $('.error_msg[data-name=company]').text('请填写公司名称');
                    $('.error_msg[data-name=company]').show();
                    return false;
                }else{
                    $('.error_msg[data-name=company]').hide();
                    return true;
                }   
            }

            function job_legal(){
                var job = $('#job').val();
                if(job == ''){
                    $('.error_msg[data-name=job]').text('请填写公司名称');
                    $('.error_msg[data-name=job]').show();
                    return false;
                }else{
                    $('.error_msg[data-name=job]').hide();
                    return true;
                }
            }

            function email_legal(){
                var email = $('#email').val();
                var reg = /\w+([-+.]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*/;
                if(email==''){
                    return true;
                }else if(!reg.test(email)){
                    $('.error_msg[data-name=email]').text('邮箱格式不正确');
                    $('.error_msg[data-name=email]').show();
                    return false;
                }else{
                    $('.error_msg[data-name=email]').hide();
                    return true;
                }
            }

            $('#user_name').blur(function(){
                var legal=name_legal();
                if(!legal){
                    $(this).focus();
                }
            });

            $('#iphone').blur(function(){
                var iphone=iphone_legal();
                if(!iphone){
                    $(this).focus();
                }
            });

            $('#company').blur(function(){
                var company=company_legal();
                if(!company){
                    $(this).focus();
                }
            });

            $('#job').blur(function(){
                var job=job_legal();
                if(!job){
                    $(this).focus();
                }
            });

            $('#email').blur(function(){
                var email=email_legal();
                if(!email){
                    $(this).focus();
                }
            });

            $('form').submit(function(){
                var nameLegal = name_legal();
                var iphoneLegal = iphone_legal();
                var companyLegal = company_legal();
                var jobLegal = job_legal();
                var emailLegal = job_legal();
                if(nameLegal&&iphoneLegal&&companyLegal&&jobLegal&&emailLegal){
                    return true;
                }else{
                    return false;
                }
            });


        </script>
  </body>
</html><?php }} ?>
