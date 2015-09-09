<?php /* Smarty version Smarty-3.1.19, created on 2014-07-20 15:07:46
         compiled from "/home/wwwroot/lottery.iheard.me/iphone/server/views/register_feedback.view.html" */ ?>
<?php /*%%SmartyHeaderCode:178577617953cb6ac258fd68-61036969%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '606dda97cf5fc47ed017f4746a94d6612b837468' => 
    array (
      0 => '/home/wwwroot/lottery.iheard.me/iphone/server/views/register_feedback.view.html',
      1 => 1405840032,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '178577617953cb6ac258fd68-61036969',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'BASE_URL' => 0,
    'checkIn_ed' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_53cb6ac25d1d33_43866007',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_53cb6ac25d1d33_43866007')) {function content_53cb6ac25d1d33_43866007($_smarty_tpl) {?><!-- 签到抽奖页面 -->
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
        <title>签到反馈页面</title>
        <meta name="renderer" content="webkit">
    
        <!-- 加载 bootstrap css -->
        <link rel="stylesheet" type="text/css" href="<?php echo $_smarty_tpl->tpl_vars['BASE_URL']->value;?>
css/bootstrap.min.css">
        <style type="text/css">
            .container-fluid{
                padding-left: 0px;
                padding-right: 0px;
            }

        
            body{
                font-size: 18px;
                background-color:#7dc6e7;;
                font-family: 'KaiTi','Microsoft YaHei','KaiTi_GB2312',sans-serif;
            }

            
            .footer{
                color: #fff;
                font-size: 15px;
                position: fixed;
                bottom: 20px;
            }

            .footer a{
                color:#06A03D;
            }

            img{
                width: 100%;
            }

            .feedback_wrapper{
                height:240px;
                box-shadow: inset 0px 0px 100px 10px rgba(253, 248, 248, 0.45);
                padding: 88px 0px;
                font-size: 45px;
                color: #fff;
                text-align: center;
            }

        </style>
    </head>
  <body>
    
        <div class="container-fluid">
            <img src="../img/register.jpg">
        </div>

        <div class="container-fluid">
            <!-- 
            <div class="col-xs-12 title">
               签到表
            </div> 
            -->
    
            <div class="col-xs-12 feedback_wrapper">
                <?php if ($_smarty_tpl->tpl_vars['checkIn_ed']->value) {?>
                <div class="col-xs-8 col-xs-offset-2 feedback">
                    请勿重复签到
                </div>
                <?php } else { ?>
                <div class="col-xs-8 col-xs-offset-2 feedback">
                    签到成功
                </div>
                <?php }?>

            </div>

            <div class="col-xs-12 footer">
                <em style="float:right"><a href="http://www.juweitang.net/index.php?g=Wap&m=Index&a=index&token=sqcwdm1402837582">杭为科技</a>提供技术支持</em>
            </div>
        </div>

  </body>
</html><?php }} ?>
