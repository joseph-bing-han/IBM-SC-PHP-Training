/**
 * app.js for chat project
 */
(function(){

   $('input#c-room-send').on('click', function () {
     var content = $('input#c-room-input').val();
     if (!$.trim(content)) {
         alert('Please input a word!')
         return;
     }
     var currentUser = $('div#c-room-left:first').find('span').html();
     var currentUserId = $('input#currentuserid').val();

     var date = new Date().Format("yyyy-MM-dd hh:mm:ss");
     var text = '<div class="c-room-content-item">'
                + '<span>' + currentUser + '</span>'
                + '<span> [' + date + ']: </span>'
                + '<span>' + content + '</span>'
                + '</div>';
     //$('div#c-room-content').append(text);

     $.ajax({
         type: "POST",
         url: "/Chat/router.php",
         data: {
             'action': 'save',
             'actionUser': currentUser,
             'date': date,
             'content': content
         },
         success: function (msg) {

         }
     });
     $('input#c-room-input').val('');
 });


    var es = new EventSource("/Chat/class/im.class.php?id="+$('input#currentuserid').val());
    es.onmessage = function (e) {
       var retmsg = $.parseJSON(e.data)
       if(retmsg.msg && retmsg.msg.length > 0){
             $.each(retmsg.msg,function(key,value){
                var text = '<div class="c-room-content-item">' + value + '</div>';
                $('div#c-room-content').append(text);
            });
        }

        if(retmsg.list && retmsg.list.length > 0){
            $('div#c-room-left-list>ul>li').remove()
           $.each(retmsg.list,function(key,value){

               $('div#c-room-left-list>ul').append('<li>'+value+'</li>');
           })
        }
    };
 /* es.addEventListener("message", function (e) {
       //console.log(e);
      $('div#c-room-content').append(e.data);

       //document.getElementById("c-room-content").innerHTML += "\n" + e.data;

   }, false);*/

 })()



// (new Date()).Format("yyyy-MM-dd hh:mm:ss.S") ==> 2006-07-02 08:09:04.423
// (new Date()).Format("yyyy-M-d h:m:s.S")      ==> 2006-7-2 8:9:4.18
Date.prototype.Format = function(fmt)
{
  var o = {
    "M+" : this.getMonth()+1,                 //月
    "d+" : this.getDate(),                    //日
    "h+" : this.getHours(),                   //小时
    "m+" : this.getMinutes(),                 //分
    "s+" : this.getSeconds(),                 //秒
    "s+" : this.getSeconds()                  //秒

  };
  if(/(y+)/.test(fmt))
    fmt=fmt.replace(RegExp.$1, (this.getFullYear()+"").substr(4 - RegExp.$1.length));
  for(var k in o)
    if(new RegExp("("+ k +")").test(fmt))
  fmt = fmt.replace(RegExp.$1, (RegExp.$1.length==1) ? (o[k]) : (("00"+ o[k]).substr((""+ o[k]).length)));
  return fmt;
}
