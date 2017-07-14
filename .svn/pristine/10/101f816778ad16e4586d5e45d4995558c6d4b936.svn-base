<?php include_once("../lib/config.php");?>
<!--
DEC,2012 multi-user ChatRoom basic implementation
file name: sox_client.php
newbie coder:ORZtobias
blog:https://twgame.wordpress.com
-->

<html>
<head>
    <script type="text/javascript" src="<?php echo $webroot ;?>/js/jquery.js"></script>


<title>ORZtobias之AJAX+SOCKET聊天室</title>

<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

<style>
html,body{font:normal 0.9em arial,helvetica;}
#log {width:300px; height:600px; border:10px solid #7F9DB9; overflow:auto;}
#msg {width:200px;border:3px solid #555555;}
</style>


<script>

    $(document).ready(function() {
        $('#butSend').click(function(){
            doSend($('#msg').val());
            $('#msg').val('');
        })
    });


    var wsUri = "ws://<?=$wsChatAddr ?>:<?=$wsChatPort?>";

        //建立web socket
        var ws = BuildWebSocket();

    function BuildWebSocket() {
        ws = new WebSocket(wsUri);
        ws.onopen = function(evt) {
            onOpen(evt)
        };
        ws.onclose = function(evt) {
            onClose(evt)
        };
        ws.onmessage = function(evt) {
            onMessage(evt)
        };
        ws.onerror = function(evt) {
            onError(evt)
        };
        return ws;
    }

     function onOpen(evt) {
         console.log('連線已建立');
        //ar token = QueryString('token');
        // writeToScreen("CONNECTED"); 
        //doSend('{"cmd":"login" ,"token":"' + token + '"}');
        //$('#loading').fadeOut("slow", function() {});
        //render(token);
    }


    function onClose(evt) {
         console.log('離線');
        //render('closed');
        //$('#loading').show();
        //ws =  BuildWebSocket() ;
        //writeToScreen("DISCONNECTED"); 
        //window.location = 'login';
    }

    function onError(evt) {
        //writeToScreen('ERROR: ' + evt.data); 
    }

    function doSend(message) {
        //writeToScreen("SENT: " + message);
        ws.send(message);
    }

    //接收訊息
    function onMessage(evt) {
        //var obj = JSON.parse(evt.data);
        console.log(evt.data);
        var msg = evt.data;
        $('#log').append(msg +'<br>');
    }
</script>
</head>
<body>
<h3>SOCKET + AJAX 【五秒一次】Seven Style聊天室</h3>
<div id="log"></div>
<input id="msg" type="textbox" />
<button type="button" id="butSend">Send</button>
<button >Quit</button>
</body>
</html>