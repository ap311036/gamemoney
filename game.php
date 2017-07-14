<?php include_once("lib/config.php"); ?>
<?php
include_once("func/func_game.php");
//var_dump($_COOKIE);
//var_dump($_SESSION);
//var_dump($_COOKIE);
//var_dump($viewData);
//die;
global $image_url;
global $Porimage_url;

global $imagedate_url; //貼圖網址
//var_dump($image_url);
//var_dump($Porimage_url);
//var_dump($target_image_uploade);
//var_dump($target_personal_avatar);
?>
<!DOCTYPE html>
<html>

    <head>
        <meta charset="UTF-8">
        <title>遊戲 | Game Money</title>
        <style type="text/css">
            body {
                opacity: 0;
                transition: opacity 0.5s;
            }
        </style> 
        <link rel="stylesheet" href="css/reset.css">
        <link rel="stylesheet" href="css/jquery-ui.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.min.css">

        <!-- CSS -->
        <link rel="stylesheet" href="css/all.css">
        <link rel="stylesheet" href="css/game.css?0713">
        <script src="<?php echo $webroot; ?>/js/tabs/jquery-1.8.3.js"></script>

<!--         <script src="http://gamemoney.sammicorner.com/password_manager/js/jquery-ui-1.10.3.custom.min.js"></script>  //by Lin-->
        <!-- JS by Chris -->
<!--        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>-->
        <!-- <script type="text/javascript" src="<?php echo $webroot; ?>/js/jquery.js"></script> -->
<!--         <script type="text/javascript" src="<?php echo $webroot; ?>/js/common.js"></script>-->

        <script>

            $(function () {
                function resetBlock(){
                    $("#main_hall").show();
                    $("#main_content").css("padding"," 10px 20px");
                    $(".new_iframe").hide();
                    $("#main_game").css("width", "100%");
                }
                $(document).on("click", ".closeGame", function () {
                    $("#main_game").empty();
                    $("#main_game").hide();
                    // $("#main_game2").css("width", "100%");
                    //如果兩個遊戲都關閉了 執行這裡
                    if($("#main_game").children().length < 1 && $("#main_game2").children().length < 1) {
                        resetBlock();
                    }
                })
                $(document).on("click", ".closeGame2", function () {
                    $("#main_game2").empty();
                    $("#main_game2").hide();
                    $("#main_game").css("width", "100%");
                    //如果兩個遊戲都關閉了 執行這裡
                    if($("#main_game").children().length < 1 && $("#main_game2").children().length < 1) {
                        resetBlock();
                    }
                })
                var mainGame_height = $("#left").height() - 128 + "px";
                function mainGameHeight() {
                    $("#main_game").css("height", mainGame_height);
                    $("#main_game2").css("height", mainGame_height);
                }
                window.addEventListener("load", mainGameHeight);
                window.addEventListener("resize", mainGameHeight);

                //JP外移至iframe
                refresh_jp();
                function refresh_jp() {
                    $("#lt_top_md_money").load("iframe/JpotDataiframe.php");
                }
                setInterval(refresh_jp, 300000);
                //遊戲多開控制項目
                function showGame() {
                    $("#lt_top_md_money").css("width", "80%");
                    $("#main_game").css("display", "block");
                    $("#main_hall").css("display", "none");
                    $("#main_func").css("display", "none");
                    $("#butLogout").css("display", "none");
                    $("#btn_leave").css("display", "inline-block");
                    $(".new_iframe").css("display", "inline-block");
                }
                var frame_key = 0;
                $("#game_1").click(function () {
                    //                $("#main_game").load("iframe/game_1.php",function () {
                    $("#main_content").css("padding","0");
                    $("#main_game").load("iframe/game_1.php?key=" + frame_key, function () {
                        showGame();
                        mainGameHeight();
                        $(window.frames['iframe1'].document).ready(function () {
                            var $iframe1 = $(this).find("#iframe1");
                            $(".new_iframe").click(function () {
                                frame_key++;
                                $(".new_iframe").hide();
                                $("#lt_top_md_money").css("width","97%");

                                $("#choose_game").css("display", "inline-block");
                                $("#main_game").css({"width": "49%", "display": "inline-block"});
                                mainGameHeight();
                                // $iframe1.get(0).contentWindow.iframeCanvas();
                                // $("#main_game>#iframe1").css("height", "375");
                                $("#game1").click(function () {
                                    $("#main_game2").css({"width": "49%", "display": "inline-block"});
                                    $("#choose_game").css("display", "none");
                                    $("#main_game2").load("iframe/game_1_1.php?key=" + frame_key, function () {
                                        $("#main_game2").css("display", "inline-block");
                                        // $("#main_game2>#iframe2").css("height", "375");
                                    });
                                });
                                $("#game2").click(function () {
                                    $("#main_game2").css({"width": "49%", "display": "inline-block"});
                                    $("#choose_game").css("display", "none");
                                    $("#main_game2").load("iframe/game_2_1.php?key=" + frame_key, function () {
                                        $("#main_game2").css("display", "inline-block");
                                        mainGameHeight();
                                        // $("#main_game2>#iframe2").css("height", "375");
                                    });
                                });
                            });
                        });
                    });
                });
                $("#game_2").click(function () {
                    $("#main_content").css("padding","0");
                    //                $("#main_game").load("iframe/game_1.php",function () {
                    $("#main_game").load("iframe/game_2.php?key=" + frame_key, function () {
                        showGame();
                        mainGameHeight();
                        $(window.frames['iframe1'].document).ready(function () {
                            var $iframe1 = $(this).find("#iframe1");
                            $(".new_iframe").click(function () {
                                frame_key++;
                                $(".new_iframe").hide();
                                $("#lt_top_md_money").css("width","97%");

                                $("#choose_game").css("display", "inline-block");
                                $("#main_game").css({"width": "49%", "display": "inline-block"});
                                mainGameHeight();
                                // $iframe1.get(0).contentWindow.iframeCanvas();
                                // $("#main_game>#iframe1").css("height", "375");
                                $("#game1").click(function () {
                                    $("#main_game2").css({"width": "49%", "display": "inline-block"});
                                    $("#choose_game").css("display", "none");
                                    $("#main_game2").load("iframe/game_1_1.php?key=" + frame_key, function () {
                                        $("#main_game2").css("display", "inline-block");

                                        // $("#main_game2>#iframe2").css("height", "375");
                                    });
                                });
                                $("#game2").click(function () {
                                    $("#main_game2").css({"width": "49%", "display": "inline-block"});
                                    $("#choose_game").css("display", "none");
                                    $("#main_game2").load("iframe/game_2_1.php?key=" + frame_key, function () {
                                        $("#main_game2").css("display", "inline-block");
                                        mainGameHeight();
                                        // $("#main_game2>#iframe2").css("height", "375");
                                    });
                                });
                            });
                        });
                    });
                });
            });
            $(function () {
                //按下送出button
                $('#msg_butSend').click(function () {
                    var inputMsg = $('#msg_input').val();
                    var name = $('#pname').val();
                    console.log(name + ':' + inputMsg);
                    $('#msg_input').val('');
                    //資料組合
                    var html = '<div class="user_info">';
                    html += '<img src="img/game_rt_icon.png" alt="user_icon">';
                    html += '<div>';
                    html += '<p>' + name + '</p>';
                    html += '<p class="user_talk">' + inputMsg + '</p>';
                    html += '</div></div>';
                    //吐在對話框
                    // $('#user_msg').append(html);
                    var memberId = $("#forMemberId").attr("data-sid");
                    setuser_msgHeight_toBottom();
                    whispering(memberId, inputMsg);
                });
                //Blur input press enter時
                $('#msg_input').keypress(function (e) {
                    code = (e.keyCode ? e.keyCode : e.which);
                    if (code == 13) {
                        var inputMsg = $('#msg_input').val();
                        var name = $('#pname').val();
                        console.log(name + ':' + inputMsg);
                        $('#msg_input').val('');
                        var html = '<div class="user_info">';
                        html += '<img src="img/game_rt_icon.png" alt="user_icon">';
                        html += '<div>';
                        html += '<p>' + name + '</p>';
                        html += '<p class="user_talk">' + inputMsg + '</p>';
                        html += '</div></div>';
                        // $('#user_msg').append(html);
                        var memberId = $("#forMemberId").attr("data-sid");
                        setuser_msgHeight_toBottom();
                        whispering(memberId, inputMsg);
                    }
                });
            });
            $(document).ready(function () {
                $('#groupmsg_input').keypress(function (e) {
                    code = (e.keyCode ? e.keyCode : e.which);
                    if (code == 13) {
                        var name = "<?= $viewData['member']['name'] ?>";
                        var id = "<?= $viewData['member']['id'] ?>";
                        onSubmit2(name, id);
                        $('#groupmsg_input').val('');
                    }
                });
                $("#groupmsg_butSend").click(function () {
                    var name = "<?= $viewData['member']['name'] ?>";
                    var id = "<?= $viewData['member']['id'] ?>";
                    onSubmit2(name, id);
                    $('#groupmsg_input').val('');
                });
                $('#butSend').click(function () {
                    var name = $('#pname').val();
                    var id = "<?= $viewData['member']['id'] ?>";
//                    doSend(name + ':' + inputMsg);
                    onSubmit(name, id);
                    $('#msg').val('');
                });
                $("#msg").keypress(function (e) {
                    code = (e.keyCode ? e.keyCode : e.which);
                    if (code == 13) {
                        var inputMsg = $('#msg').val();
                        var name = $('#pname').val();
                        onSubmit(name, id);
                        $('#msg').val('');
                    }
                });
                $('#butLogout').click(function () {
                    if (confirm("確定要登出？")) {
                        $('#main_game').hide();
                        $('#iframe1').attr('src', '');
                        $('#main_text').show();
                        $(location).attr("href", "login.php?m=logout");
                    }
                });
                //        setInterval(ajaxCall_JpotData, 1000);
                setInterval(ajaxCall_Marque, 5000);
            });
            if (typeof console == "undefined") {
                this.console = {log: function (msg) { }};
            }
            // 如果浏览器不支持websocket，会使用这个flash自动模拟websocket协议，此过程对开发者透明
            WEB_SOCKET_SWF_LOCATION = "/swf/WebSocketMain.swf";
            // 开启flash的websocket debug
            WEB_SOCKET_DEBUG = true;
            var ws, name, client_list = [];
            //進入網頁時自動連線ws
            $(function () {
                connect();
            });
            var id = "<?= $viewData['member']['id'] ?>";
            // 连接服务端
            function connect() {
                // 创建websocket
                ws = new WebSocket("ws://" + document.domain + ":7272");
                // 当socket连接打开时，输入用户名
//                ws.onopen = onopen;
                ws.onopen = function (evt) {
                    onOpen(evt)
                };
                ws.onmessage = function (evt) {
                    onMessage(evt)
                };
                var TryTime = 0;
                ws.onclose = function () {
                    if (TryTime >= 3) {
                        TryTime = 0;
                    }
                    ShowConnectingSt(TryTime);
                    console.log("连接关闭，定时重连");
                    showMyFriendIsEmpty();
                    connect();
                    TryTime++
                };
                ws.onerror = function () {
                    console.log("出现错误");
                };
            }
            function onOpen(evt) {
                var $room_id = $("#rt1_channels").val();
                var name = "<?= $viewData['member']['name'] ?>";
                $("#rt1_mid").html('');
                if (!$room_id) {
                    $room_id = "1";
                }
                var login_data = '{"type":"login","client_name":"' + name + '","room_id":"' + $room_id + '","member_id":"' + id + '"        }';
                ws.send(login_data);
                console.log("已連線至:" + $room_id + "聊天室");
                GetFriend();
                GetPersonalMsg();

            }

            function prepareOpen(room_id) {
                $("#rt1_channels").val(room_id);
                var name = "<?= $viewData['member']['name'] ?>";
                var login_data = '{"type":"login","client_name":"' + name + '","room_id":"' + room_id + '","member_id":"' + id + '"   }';
                ws.close();
                console.log("切換頻道至" + room_id);
                ws.send(login_data);
                $("#showMsgList").html('');
            }

            function GroupPrepareOpen(room_id, event) {
                if ($(event.target).attr("class") == "leaveGroup") {
                    ws.send('{"type":"remove_group","myid":"' + id + '","room_id":"' + room_id + '"}');
                    console.log("離開群組:" + '{"type":"remove_group","myid":"' + id + '","room_id":"' + room_id + '"}');
                } else {
                    var name = "<?= $viewData['member']['name'] ?>";
                    var login_data = '{"type":"login","client_name":"' + name + '","room_id":"' + room_id + '","member_id":"' + id + '"   }';
                    //                ws.close();
                    $("#groupChat").attr("data-sid", room_id);
                    console.log("進入群組" + room_id);
                    ws.send(login_data);
                }
            }


            // 连接建立时发送登录信息
//            function onopen(room_id)
//            {
//                // 登录
//                var name = "<?//= $viewData['member']['name'] ?>//";
//                var login_data = '{"type":"login","client_name":"' + name + '","room_id":"' + room_id + '","member_id":"' + id + '"}';
//                console.log("websocket握手成功，发送登录数据:" + login_data);
//            }



            // 服务端发来消息时
            function onMessage(e)
            {
                var data = eval("(" + e.data + ")");
                var $roomid = $("#rt1_channels").val(); //畫面中 頻道的id
                var $group_room_id = $("#groupChat").attr("data-sid"); //畫面中 群組的id
                //data['room_id'] 是群組的id
                if (data['room_id'] == null) {
                    var $server_room_id = '';
                } else {
                    var $server_room_id = String(data['room_id']);
                }
                console.log("觸發onMessage");
                console.log(data);
                //alert(data['type']);
                
                if ($server_room_id == $roomid || $group_room_id == data['group'] ||
                        data["type"] == "addfriend" || data["type"] == "getfriend" ||
                        data['type'] == "personalMsg" || data["type"] == "account_query" || 
                        data['type'] == "channel_query" || data['type'] == "whispering" || 
                        data['type'] == "history_main" || data['type'] == "get_grouplist"||
                        data['type'] == "login"
                        ) {
                        //alert($server_room_id);
                        //alert(data['type']);
                    //console.log(data['type']);
                    switch (data['type']) {
                        // 服务端ping客户端
                        case 'ping':
                            ws.send('{"type":"pong"}');
                            break;
                            // 登录 更新用户列表
                        case 'login':
                            //{"type":"login","client_id":xxx,"client_name":"xxx","client_list":"[...]","time":"xxx"}
                            //console.log(data);
                            //alert(111);
                            if (!data["group"]) {
                                //console.log(client_id);
                                if (!data['client_id'])
                                {
                                } else {
                                    showMsg(data['client_id'], data['client_name'], data['client_name'] + ' 加入了聊天室', data['time'], data['pic_status'], data['personal_avatar']);
                                }
                            } else {
                                if (data['client_id'])
                                {

                                } else
                                {
                                    showGroupMsg(data['client_id'], data['client_name'], data['client_name'] + ' 加入了群組聊天室', data['time'], data['pic_status'], data['personal_avatar'], data["group"]);
                                }

                            }
                            //flush_client_list();
                            console.log(data['client_name'] + "登录成功");
                            if (data["group_msg"]) {

                                data["group_msg"].map
                                        (
                                                (item) => {
                                            if (item.group == $group_room_id) {
                                                console.log(item);
                                                showGroupMsg("", item.clicent_name, item.message, "", item.pic_status, item.personal_avatar);
                                            }
                                        }
                                        );
                            }
                            // if (data['client_list'])
                            // {
                            //     data['client_list'].map
                            //             (
                            //                     (item) => {
                            //                 console.log(item.personal_avatar);
                            //                 if (item.personal_avatar)
                            //                 {
                            //                     flush_client_list(item.member_id, item.client_name, item.personal_avatar);
                            //                 }
                            //             }
                            //             );
                            // }

                            
                            if (data['full_people'])
                            {
                                //alert(1111);
                                data['full_people'].map
                                        (
                                                (item) => {
                                            var html = '頻道 ' + item.room_id;
                                            html += ' ( ' + item.people_count + ' /600)';
                                            $('#rt1_channels option[value=' + item.room_id + ']').text(html);
                                            // alert("full_people");
                                        }
                                        );
                            }

                            break;
                            // 发言
                        case 'say':
                            console.log("onMessage:Say");
                            if (!data["group"]) {
                                showMsg(data['from_client_id'], data['from_client_name'], data['content'], data['time'], data['pic_status'], data['personal_avatar']);
                                console.log(data['from_client_id'], data['from_client_name'], data['content'], data['time'], data['pic_status'], data['personal_avatar'])
                            } else {
                                console.log("onMessage:GroupSay");
                                showGroupMsg(data['from_client_id'], data['from_client_name'], data['content'], data['time'], data['pic_status'], data['personal_avatar']);
                            }

                            GetPersonalMsg();
                            break;
                            //加入好友
                        case 'addfriend':
//                            console.log(data);
                            break;

                        case 'whispering':
                            // console.log(data);
                            var msgList = {};

                            data["message"].map
                                    (
                                            (item) => {
                                        if (item.mh_uid == $("#user_msg").attr("data-sid") || item.mh_uid == id) {
                                            ShowPrivateMsg(item.mh_name, item.mh_message, item.personal_avatar, item.mh_stage);
                                        }
                                    }
                                    );
                            GetPersonalMsg();
                            break;

                            //取得好友列表
                        case 'getfriend':

                            $('#rt3_mid1').html('');
                            if (data["friend"].length == 0) {
                                showMyFriendIsEmpty();
                            } else {
                                data["friend"].map
                                        (
                                                (item) => {
                                            showMyFriend(item.friend_name, item.friend_id, item.friend_icon);
                                            delFriendButton(item.friend_id);
                                        }
                                        );
                            }
                            break;
                            //取得私人對話紀錄
                        case 'history_main':

                            data["history"].map
                                    (
                                            (item) => {
                                        if (item.clicent_id == "giftCenter" || item.clicent_id == "serviceCenter") {
                                            $("#msg_no_" + item.clicent_id).html(item.count);
                                            $("#msg_preview_" + item.clicent_id).html(item.message);
                                        } else {
                                            ShowPersonalMsgList(item.name, item.message, item.group, item.clicent_id, item.channel, item.pic_status, item.count);
                                        }
                                    }
                                    );
                            console.log("已經取得私人對話紀錄");
                            break;
                            //搜尋好友
                        case 'account_query':
                            data["friend_name"].map
                                    (
                                            (item) => {
                                        showMyFriend(item.friend_name, item.friend_id, item.friend_personal_avatar);
                                        // console.log(item.friend_name);
                                        if (!item.friend_name) {
                                            showMyFriendIsEmpty();
                                        }
                                    }
                                    );
                            console.log("搜尋好友列表");
                            break;
                        case 'personalMsg':
                            if (data["personalMsg_friend"]) {
                                data["personalMsg_friend"].map
                                        (
                                                (item) => {
                                            AppendPersonalMsg(item.myid, item.myname, item.personal_avatar, item.mymessage, item.friend_vip, item.friend_point, item.friend_ctime, item.mh_stage);
                                        }
                                        );
                            }
                            if (data["personalMsg_msg"]) {
                                data["personalMsg_msg"].map
                                        (
                                                (item) => {
                                            AppendPersonalMsg(item.myid, item.myname, item.personal_avatar, item.mymessage, item.friend_vip, item.friend_point, item.friend_ctime, item.mh_stage);
                                        }
                                        );
                            }
                            break;
                            //搜尋聊天室
                        case 'channel_query':
//                            console.log(data)
                            data["channel"].map
                                    (
                                            (item) => {
                                        if (item.inGroupList == 0) {
                                            showSearchChat(item.channel_name, item.room_id);
                                        } else {
                                            showSearchChatInGroupList(item.channel_name, item.room_id);
                                        }
                                    }
                                    );
                            break;
                            //離開群組
                        case 'remove_group':
                            console.log(data['friend']);
                            break;
                            //取得群組成員列表
                        case 'get_grouplist':

                            $("#rt1_players").html('');
                            data["group"].map(
                                    (item) => {
                                console.log(item.member_id, item.client_name, item.personal_avatar);
                                showGroupMemberList(item.member_id, item.client_name, item.personal_avatar);
                                flush_client_list(item.member_id, item.client_name, item.personal_avatar);

                            }
                            );
                            break;
                            // 用户退出 更新用户列表
                        case 'logout':
                            if (!data["group"]) {
                                showMsg(data['from_client_id'], data['from_client_name'], data['from_client_name'] + ' 退出了', data['time'], 0, data['personal_avatar']);
                            } else {
                                showGroupMsg(data['from_client_id'], data['from_client_name'], data['from_client_name'] + ' 退出了', data['time']);
                            }
                            delete client_list[data['from_client_id']];
                            flush_client_list();
                    }
                } else {
                }
                return e;
            }


            $(function () {
                select_client_id = 'all';
                $("#client_list").change(function () {
                    select_client_id = $("#client_list option:selected").attr("value");
                    // alert(select_client_id);
                });
            });
            function ShowConnectingSt(TryTime) {
                if (TryTime = 0) {
                    dot = ''
                } else if (TryTime = 1) {
                    dot = '.';
                } else if (TryTime = 2) {
                    dot = '..';
                } else {
                    dot = '...';
                }
                var html = '<div class="connecting"><strong>伺服器連線中' + dot + '</strong></div>';
                $("#rt1_mid").html(html);
            }

            // 提交对话
            function onSubmit(to_client_name, to_client_id) {
                var input = document.getElementById("msg").value;
                var roomid = $("#rt1_channels").val();
                ws.send('{"type":"say","myid":"' + id + '","to_client_id":"' + "all" + '","to_client_name":"' + to_client_name + '","room_id":"' + roomid + '","content":"' +
                        input + '"}');
                console.log('{"type":"say","myid":"' + id + '","to_client_id":"' + "all" + '","to_client_name":"' + to_client_name + '","room_id":"' + roomid + '","content":"' +
                        input + '"}');
            }

            function onSubmitimg(to_client_name, to_client_id, msg)
            {
                //var input = document.getElementById("msg").value;
                var roomid = $("#rt1_channels").val();
                // msg.trim;
                //alert(msg);
                ws.send('{"type":"say","myid":"' + id + '","to_client_id":"' + "all" + '","to_client_name":"' + to_client_name + '","room_id":"' + roomid + '","content":"' + msg.trim() + '","pic_status":"' + "1" + '"}');
                console.log('{"type":"say","myid":"' + id + '","to_client_id":"' + "all" + '","to_client_name":"' + to_client_name + '","room_id":"' + roomid + '","content":"' +
                        msg + '"}');
            }

            function onSubmitimgwhispering(msg)
            {
                var memberId = $("#forMemberId").attr("data-sid");
                alert(memberId);
                alert(id);
                ws.send('{"type":"whispering","myid":"' + id + '","friendid":"' + memberId + '","content":"' + msg + '","pic_status":"' + "1" + '"}');
            }

            function onSubmit2img(to_client_name, to_client_id, msg) {

                var $group_room_id = $("#groupChat").attr("data-sid");
                //alert($group_room_id);
                var input = document.getElementById("groupmsg_input").value;
                ws.send('{"type":"say","room_id":"' + $group_room_id + '","to_client_name":"' + to_client_name + '","content":"' + msg.trim() + '","member_id":"' + id + '","pic_status":"' + "1" + '"}');
                console.log("onSumit2:" + '{"type":"say","room_id":"' + $group_room_id + '","to_client_name":"' + to_client_name + '","content":"' +
                        input + '"}');
            }


            // 提交群組对话
            function onSubmit2(to_client_name, to_client_id) {
                var $group_room_id = $("#groupChat").attr("data-sid");
                var input = document.getElementById("groupmsg_input").value;
                ws.send('{"type":"say","room_id":"' + $group_room_id + '","to_client_name":"' + to_client_name + '","myid":"' + id + '","content":"' + input + '","member_id":"' + id + '"}');
                console.log('{"type":"say","room_id":"' + $group_room_id + '","to_client_name":"' + to_client_name + '","myid":"' + id + '","content":"' + input + '","member_id":"' + id + '"}');
            }
            //請求頻道玩家列表
            function askChannelMemberList() {
                var roomid = $("#rt1_channels").val();
                ws.send('{"type":"get_grouplist","myid":"' + id + '","room_id":"' + roomid + '"}');
                ws.send('{"type":"getfriend","myid":"' + id + '"}');
            }


            // 刷新用户列表框
            function flush_client_list(member_id, member_name, personal_avatar) {

                var userlist_window = $("#rt1_players");
                // userlist_window.empty();
//                console.log(client_list);

                // for (var p in client_list) {
                //     userlist_window.append('<div class="rt1_player member' + client_list[p][2] + '"><img src="<?php echo $Porimage_url; ?>' + client_list[p][1] + '" alt="Player Icon"><p>' + client_list[p][0] + '</p><button type="button" id="addfriend' + client_list[p][2] + '" onclick="addFriend(' + client_list[p][2] + ')">加好友</button></div>');

                // }
                if (!personal_avatar)
                {
                    return;
                }
                var html = '<div class="rt1_player member' + member_id + '"><img src="<?php echo $Porimage_url; ?>' + personal_avatar + '" alt="Player Icon"><p>' + member_name + '</p><button type="button" id="addfriend' + member_id + '" onclick="addFriend(' + member_id + ')">加好友</button></div>';
                userlist_window.append(html);

            }
            //刪除"加好友"按鈕、增加刪除好友
            function delFriendButton(k) {
                var delbtn = $("button#addfriend" + k);
                delbtn.attr("id", "");
                delbtn.attr("Del", "delFriend");
                delbtn.attr("onclick", "ShowPersonalMsg(" + k + ",event)");
                delbtn.text("刪除好友");
            }
            // 搜索好友
            function account_query(friendid_name) {
                $("#rt3_mid1").html('');
                if (friendid_name == '') {
                    GetFriend();
                } else {
                    ws.send('{"type":"account_query","myid":"' + id + '","friendid_name":"' + friendid_name + '"}');
                    console.log(friendid_name);
                }
            }

            // 發出私聊訊息
            function whispering(friendid, message) {
                ws.send('{"type":"whispering","myid":"' + id + '","friendid":"' + friendid + '","content":"' + message + '","mh_stage":"0"}');
                //console.log($myid + ":" + friendid);
            }


            var StickersUlr = "<?php echo $imagedate_url ?>";
            var urlp = "<?php echo $Porimage_url ?>";
            var url = "<?php echo $image_url ?>";
            //組合Show出收到的私聊訊息
            function ShowPrivateMsg(name, content, pic, pic_status) {
                //資料組合
                if (pic_status == "1") {
                    //alert('<img src="' + url +  + content + '.png">');
                    msg = '<img src="' + url + content + '" style="border-radius: 0;margin-top:8px;">';
                } else if (pic_status == "2") {
                    msg = '<img src="' + StickersUlr + content + '" style="border-radius: 0;margin-top:8px;">';
                } else if (!pic_status) {
                    msg = '<p class="user_talk" style="max-width:200px; word-wrap:break-word;">' + content + '</p>';
                }
                var html = '<div class="user_info">';
                html += '<img src="' + urlp + pic + '" alt="user_icon">';
                html += '<div>';
                html += '<p>' + name + '</p>';
                html += msg;
                html += '</div></div>';
                //吐在對話框
                $('#user_msg').append(html);
                setuser_msgHeight_toBottom();
            }


            //Show出群組訊息
            function showGroupMsg(from_client_id, from_client_name, content, time, pic_status, pic, group) {
                if ($("groupChat").attr("data-sid") == group) {
                    var url = "<?php echo $image_url ?>";
                    console.log(pic);
                    if (pic_status == "1") {
                        //alert(pic_status);
                        //alert('<img src="' + url +  + content + '.png">');
                        msg = '<img src="' + url + content + '" style="border-radius: 0;margin-top:8px;">';
                    } else if (pic_status == "2") {
                        msg = '<img src="' + StickersUlr + content + '" style="border-radius: 0;margin-top:8px;">';
                    } else if (!pic_status) {
                        msg = '<p class="user_talk" style="max-width:200px; word-wrap:break-word;">' + content + '</p>';
                    }
                    var html = '  <div class="user_info">';
                    html += '<img src="' + urlp + pic + '" alt="user_icon">';
                    html += '<div>';
                    html += '<p>' + from_client_name + '</p>';
                    html += msg;
                    html += '</div></div>';
                    $('#Groupuser_msg').append(html);
                    setGroupuser_msg_toBottom();
                }
            }
            //Show出頻道訊息
            function showMsg(from_client_id, from_client_name, content, time, pic_status, pic) {
                //alert(content);
                // alert(from_client_id, from_client_name, content, time, pic_status);
                var url = "<?php echo $image_url ?>";
                if (pic_status == "1") {
                    //如果訊息是圖片檔就走這裡
                    msg = '<img src="' + url + content + '" style="border-radius: 0;margin-top:8px;">';
                }
                ;
                if (pic_status == "2") {
                    msg = '<img src="' + StickersUlr + content + '" style="border-radius: 0;margin-top:8px;">';
                }
                ;
                if (!pic_status) {
                    msg = '<p class="rt1_cvst_talk" style="max-width:200px; word-wrap:break-word;">' + content + '</p>';
                }
                ;

                //如果訊息是字串就走這裡

                //alert(content);
                var html = '  <div class="rt1_cvst_div" data-sid="' + from_client_id + '">';
                html += '<img src="' + urlp + pic + '" alt="user_icon">';
                html += '<div>';
                html += '<p>' + from_client_name + '</p>';
                html += msg;
                html += '</div></div>';
                $('#rt1_mid').append(html);
                setRt1MidToBtm();
            }

            //Show出好友列表
            function showMyFriend(friend_name, friend_id, friend_pic) {
                if (!friend_pic) {
                    friend_pic = 'game_rt_icon3';
                }
                var html = '<div class="friend friend' + friend_id + '" id="friend_list" onclick="ShowPersonalMsg(' + friend_id + ',event)" style="border-bottom: 1px solid #fff;" data-sid="' + friend_id + '">';
                //html += '<div class="friend_div1"><img src="img/' + friend_pic + '.png" alt="Player Icon 3" class="player_icon">';
                html += '<div class="friend_div1"><img src="' + urlp + friend_pic + '" alt="Player Icon 3" class="player_icon">';
                html += '<div class="rt2_msg" id="friend_name">';
                html += '<p>' + friend_name + '</p></div>';
                html += '<button type="button" Del="delFriend" id="delfriend' + friend_id + '">刪除好友</button>';
                html += '</div></div>';
                $('#rt3_mid1').append(html);
            }

            //如果好友列表是空的Show出
            function showMyFriendIsEmpty() {
                var html = '<div style="margin-top:50px;"><p>還沒有好友嗎？</p><p>快去找朋友</p><button type="button" id="rt3_btn_goFindFriend"">立即去</button></div>';
                $('#rt3_mid1').html(html);
                // $("#showMyFriendIsEmpty").show();
            }

            // 加好友
            function addFriend(friendid) {
                delFriendButton(friendid);
                ws.send('{"type":"addfriend","myid":"' + id + '","friendid":"' + friendid + '"}');
                console.log(id + ":" + friendid);
                GetFriend();
            }
            //索取好友列表
            function GetFriend() {
                ws.send('{"type":"getfriend","myid":"' + id + '"}');
                console.log("發出請求取得用戶列表");
            }
            //取得私人對話清單
            function GetPersonalMsg() {
                $("#showMsgList").html('');
                ws.send('{"type":"history_main","myid":"' + id + '"}');
                console.log("發出請求取私人對話");
            }


            //對話計時器
            //ar dialogue_timing = 0;
            //Show出私人對話清單
            function ShowPersonalMsgList(from_client_name, content, time, from_client_id, group, pic_status, count) {
//                if (!time) {
//                    var time = "0:00";
//                }

                if (time == 0)
                {
                    var $onclickFun = 'ShowGroup(' + group + ')';
                    var $delList = 'delgroup';
                    var delNumber = group;
                    var dataType = 'group' + group;
                    var $delTalk = 'removePersonalMsgList(' + group + ')';
                }
                if (time != 0)
                {
                    var $onclickFun = 'ShowPersonalMsg(' + from_client_id + ',event)';
                    var $delList = 'delclient';
                    var delNumber = from_client_id;
                    var dataType = 'client' + from_client_id;
                    var $delTalk = 'delPersonalMsgList(' + from_client_id + ')';
                }

//                if (!from_client_id == 0) {
//                    var $onclickFun = 'ShowPersonalMsg(' + from_client_id + ')';
//                } else {
//
//                }
                if (pic_status == "1" || pic_status == "2") {
                    content = "向您發送圖片";
                }

                if (count == 0)
                {
                    var html = '<div class="' + $delList + ' rt2_msg_div" data-type="' + dataType + '"><div class="rt2_msg_div1">';
                    html += '<img src="img/game_rt_icon3.png" alt="Player Icon 3" class="player_icon">';
                    html += '<div class="rt2_msg" id="" onclick="' + $onclickFun + '">';
                    html += '<p class="rt2_msg_name">' + from_client_name + '</p>';
                    html += '<p class="rt2_msg_preview ellipsis">' + content + '</p>';
                    html += '</div></div>';
                    html += '<div class="rt2_msg_div2">';
                    html += '<p class="rt2_msg_time"></p>';
                    html += '<button type="button" data-name="' + $delList + '" data-Num="' + delNumber + '" class="rt2_msg_deleteBtn">刪除</button>';
                    html += '</div>';
                    $("#showMsgList").append(html);
                } else
                {
                    var content_html = '<div class="rt2_msg_no">' + count + '</div>';
                    var html = '<div class="' + $delList + ' rt2_msg_div" data-type="' + dataType + '"><div class="rt2_msg_div1">';
                    html += '<img src="img/game_rt_icon3.png" alt="Player Icon 3" class="player_icon">';
                    html += '<div class="rt2_msg" id="" onclick="' + $onclickFun + '">';
                    html += '<p class="rt2_msg_name">' + from_client_name + '</p>';
                    html += '<p class="rt2_msg_preview ellipsis">' + content + '</p>';
                    html += '</div></div>';
                    html += '<div class="rt2_msg_div2">';
                    html += '<p class="rt2_msg_time"></p>';
                    html += content_html;
                    html += '<button type="button" data-name="' + $delList + '" data-Num="' + delNumber + '" class="rt2_msg_deleteBtn">刪除</button>';
                    html += '</div>';
                    $("#showMsgList").append(html);
                }

            }

            function removePersonalMsgList(group) {
                // alert("Remove GroupList"+group);
                ws.send('{"type":"delete_conversation","myid":"' + id + '","room_id":"' + group + '"}');
                // $($("#showMsgList>."+rm)[0]).remove();
            }
            function delPersonalMsgList(member_id) {
                // alert("Del PersonalList"+member_id);
                ws.send('{"type":"remove_conversation","myid":"' + id + '","friend_id":"' + member_id + '"}');
                // $($("#showMsgList>."+rm)[0]).remove();
            }

            //請求私人對話紀錄+刪除好友
            function ShowPersonalMsg(member_id, event) {

                dialogue_return(0, member_id);
                if ($(event.target).attr("Del") == "delFriend") {
                    ws.send('{"type":"remove_friends","myid":"' + id + '","friend_id":"' + member_id + '"}');
                    $("div.friend" + member_id).remove();
                    askChannelMemberList();
                } else {
                    ws.send('{"type":"personalMsg","myid":"' + id + '","friendid":"' + member_id + '"}');
                    $("#user_msg").attr("data-sid", member_id);
                    console.log("請求與" + member_id + "對話");
                }
            }


            //Show出私人對話紀錄
            function AppendPersonalMsg(id, name, pic, content, lv, point, time, pic_status) {
                var StickersUlr = "<?php echo $imagedate_url ?>";
                var urlp = "<?php echo $Porimage_url ?>";
                var url = "<?php echo $image_url ?>";
                if (pic_status == "1") {
                    //alert(pic_status);
                    //alert('<img src="' + url +  + content + '.png">');
                    msg = '<img src="' + url + content + '" style="border-radius: 0;margin-top:8px;">';
                } else if (pic_status == "2") {
                    msg = '<img src="' + StickersUlr + content + '" style="border-radius: 0;margin-top:8px;">';
                } else if (!pic_status) {
                    msg = '<p class="user_talk" style="max-width:200px; word-wrap:break-word;">' + content + '</p>';
                }

                var memberId = $("#user_msg").attr("data-sid");
                var head = '<div class="member_info" id="forMemberId" style="line-height: 36px;" data-sid="' + memberId + '"><p>========================</p><p>[玩家資訊]</p>';
                head += '<p>帳號創立時間：' + time + '</p>';
                head += '<p>等級:' + lv + '</p>';
                head += '<p>點數:' + point + '</p>'
                head += '<p>========================</p></div>';
                var html = '<div class="user_info">';
                html += '<img src="' + urlp + pic + '" alt="user_icon">';
                html += '<div>';
                html += '<p>' + name + '</p>';
                html += msg;
                html += '</div></div>';
                if (lv == undefined) {

                } else {
                    $("#user_msg").append(head);
                }
                ;
                if (name) {
                    $('#user_msg').append(html);
                }
                ;
                $("#rightTab2").hide();
                $("#rightTab3").hide();
                $("#memberMsgShow").show();
                set_member_msg_Width();
                setuser_msgHeight_toBottom();
            }
            //發送搜尋聊天室字串
            function searchChat(k, l) {
                if (l == 1) {
                    $("#rt2_mid2").html('');
                    if (k == '') {
                        ws.send('{"type":"channel_query","channel_name":"","inGroupList":"1"}');
                    } else {
                        ws.send('{"type":"channel_query","channel_name":"' + k + '","inGroupList":"1"}');
                    }
                } else {
                    $("#showMsgList").html('');
                    if (k == '') {
                        GetPersonalMsg();
                    } else {
                        ws.send('{"type":"channel_query","channel_name":"' + k + '"}');
                    }
                }
            }
            //show搜尋聊天結果
            function showSearchChat(channel_name, room_id) {
                if (!time) {
                    var time = "0:00";
                }
                var spliceRoom_id = room_id.substr(5);
                var content = '';
                var $onclickFun = 'ShowGroup(' + spliceRoom_id + ')';

                var html = '<div class="rt2_msg_div" id="memberMsg"><div class="rt2_msg_div1">';
                html += '<img src="img/game_rt_icon3.png" alt="Player Icon 3" class="player_icon">';
                html += '<div class="rt2_msg" id="" onclick="' + $onclickFun + '">';
                html += '<p class="rt2_msg_name">' + channel_name + '</p>';
                html += '<p class="rt2_msg_preview ellipsis">' + content + '</p>';
                html += '</div></div>';
                html += '<div class="rt2_msg_div2">';
                html += '<p class="rt2_msg_time">' + time + '</p>';
                html += '<div class="rt2_msg_no">1</div>';
                html += '<button type="button" class="rt2_msg_deleteBtn">刪除</button>';
                html += '</div>';
                $("#showMsgList").append(html);
            }
            //在群組列表show搜尋聊天結果
            function showSearchChatInGroupList(channel_name, room_id) {
                var spliceRoom_id = room_id.substr(5);

                var html = '<div class="rt2_group_div" data-Num="' + room_id + '"><p>群組<span class="groupValue">' + spliceRoom_id + '</span><span>20人</span></p><button type="button" class="leaveGroup" id="leaveGroup1">離開群組</button></div>';
                $("#rt2_mid2").append(html);
            }
            //show出搜尋到的聊天列表的內容
            function ShowGroup(Channel) {

                dialogue_return(Channel, 0);
                $("#rightTab2").css("display", "none");
                $("#groupChat").show();
                GroupPrepareOpen('group' + Channel, event);
                set_group_msg_Width();
            }
            //請求群組成員列表
            function askForGroupList(roomid) {
                ws.send('{"type":"get_grouplist","room_id":"' + roomid + '"}');
                console.log("請求成員列表:" + '{"type":"get_grouplist","room_id":"' + roomid + '"}');
            }
            //show出群組成員
            function showGroupMemberList(id, name, pic) {
                var html = '<div class="groupMem"><div class="groupMem_div1">';
                html += '<img src="' + urlp + pic + '" alt="' + name + '" class="player_icon">';
                html += '<div class="rt2_msg">';
                html += '<p class="rt2_msg_name">' + name + '</p>';
                html += '<p class="rt2_msg_preview ellipsis"></p>';
                html += '</div></div>';
                html += '<div class="groupMem_div2">';
                html += '<p class="rt2_msg_time"></p>';
                html += '<div class="rt2_msg_no"></div>';
                html += '</div>';
                $("#Groupuser_msg").append(html);
            }
            //發送貼圖
            function postStickers(picName, WhereYouAt) {
                picName = picName + ".png";
                if (WhereYouAt == 'channel') {
                    var roomid = $("#rt1_channels").val();
                    ws.send('{"type":"say","myid":"' + id + '","to_client_id":"' + "all" + '","to_client_name":"' + name + '","room_id":"' + roomid + '","content":"' + picName + '","pic_status":"2"}');
                    console.log('{"type":"say","myid":"' + id + '","to_client_id":"' + "all" + '","to_client_name":"' + name + '","room_id":"' + roomid + '","content":"' + picName + '","pic_status":"2"}');
                } else if (WhereYouAt == 'group') {
                    var $group_room_id = $("#groupChat").attr("data-sid");
                    ws.send('{"type":"say","room_id":"' + $group_room_id + '","to_client_name":"' + name + '","myid":"' + id + '","content":"' + picName + '","member_id":"' + id + '","pic_status":"2"}');
                    console.log('{"type":"say","room_id":"' + $group_room_id + '","to_client_name":"' + name + '","myid":"' + id + '","content":"' + picName + '","member_id":"' + id + '","pic_status":"2"}');
                } else if (WhereYouAt == 'member') {
                    var friendid = $("#forMemberId").attr("data-sid");
                    ws.send('{"type":"whispering","myid":"' + id + '","friendid":"' + friendid + '","content":"' + picName + '","mh_stage":"2"}');
                }
                if ($(".stickers").hasClass("show")) {
                    $(".stickers").removeClass("show");
                }
            }
            $(document).on("click", ".channelStickers", function () {
                var where = $(this).attr("data-where");
                var picname = $(this).attr("data-name");
                postStickers(picname, where);
            });
            $(document).on("click", ".memberStickers", function () {
                var where = $(this).attr("data-where");
                var picname = $(this).attr("data-name");
                postStickers(picname, where);
            })



            $("#memID").click(function () {
                $("#rightTab2").css("display", "none");
                $("#memberMsgShow").css("display", "block");
            });
//            var wsUri = "ws://<?//= $wsChatAddr ?>//:<?//= $wsChatPort ?>//";
//
//            //建立web socket
//            var ws = BuildWebSocket();
//
//            function BuildWebSocket() {
//                ws = new WebSocket(wsUri);
//                ws.onopen = function (evt) {
//                    onOpen(evt)
//                };
//                ws.onclose = function (evt) {
//                    onClose(evt)
//                };
//                ws.onmessage = function (evt) {
//                    onMessage(evt)
//                };
//                ws.onerror = function (evt) {
//                    onError(evt)
//                };
//                return ws;
//            }
//
//            function onOpen(evt) {
//                console.log('連線已建立');
//                //ar token = QueryString('token');
//                // writeToScreen("CONNECTED");
//                //doSend('{"cmd":"login" ,"token":"' + token + '"}');
//                //$('#loading').fadeOut("slow", function() {});
//                //render(token);
//                ws.send($('#pname').val() + ':剛剛進入聊天室');
//            }
//
//
//            function onClose(evt) {
//                console.log('離線');
//                //render('closed');
//                //$('#loading').show();
//                //ws =  BuildWebSocket() ;
//                //writeToScreen("DISCONNECTED");
//                //window.location = 'login';
//                ws.send($('#pname').val() + ':剛剛離開聊天室');
//            }
//
//            function onError(evt) {
//                //writeToScreen('ERROR: ' + evt.data);
//            }
//
            function doSend(message) {
                //writeToScreen("SENT: " + message);
                ws.send(message);
            }
//
//            //接收訊息
//            function onMessage(evt) {
//                //var obj = JSON.parse(evt.data);
//                console.log(evt.data);
//                var msg = evt.data;
//                var arrMsg = msg.split(':');
//
//                var html = '  <div class="rt1_cvst_div">';
//                html += '<img src="img/game_rt_icon.png" alt="user_icon">';
//                html += '<div>';
//                html += '<p>' + arrMsg[0] + '</p>';
//                html += '<p class="rt1_cvst_talk">' + arrMsg[1] + '</p>';
//                html += '</div></div>';
//
//                $('#rt1_mid').prepend(html);
//
//            }

            //金礦彩金連線即時更新
            function ajaxCall_JpotData() {
                jQuery.ajax({
                    method: "GET",
                    url: "game.php?m=getJpotData",
                    cache: false,
                    datatype: "json",
                })

                        .done(function (msg) {
                            var jsonObj = JSON.parse(msg);
                            $.each(jsonObj, function (id, element) {
                                var result = element.accumulation.replace(/\d+?(?=(?:\d{3})+$)/img, "$&,");
                                if (result == "") {
                                    window.open(location, '_self', '');
                                } else {
                                    $("#md_money_num" + id).html(result);
                                }
                                //console.log(result);
                            });
                        });
            }

            //跑馬燈即時更新
            function ajaxCall_Marque() {
                jQuery.ajax({
                    method: "GET",
                    url: "game.php?m=getMarque",
                    cache: false,
                    datatype: "json",
                })

                        //            .done(function( msg ) {
                        //              var jsonObj = JSON.parse(msg);
                        //                $.each(jsonObj,function(id,element){
                        //                  var result = jsonObj.msg;
                        //                  var id = jsonObj.id;
                        //                  // var msg = msg.msg;
                        //                  $("#marquee"+id).html("【"+result+"】");
                        //                  // console.log(id+"</br>"+msg);
                        //                });
                        //              });
                        .done(function (msg) {
//                             console.log(msg);
                            var jsonObj = JSON.parse(msg);
                            $.each(jsonObj, function (id, element) {
                                var result = element.msg;
                                var sat = element.end_date;
                                //                        console.log(id+':'+result);
//                                console.log(element);
                                if (result == '904')
                                {
                                    $("#marquee" + id).html("");
                                }
                                if (result != '904')
                                {
                                    $("#marquee" + id).html("【" + result + "】");
                                    //$("#marquee" + id).html();
                                }


                            });
                        });
            }

        </script>
    </head>

    <body>
        <input id="pname" type="hidden" value="<?php
        if (isset($viewData['member'])) {
            echo $viewData['member']['name'];
        }
        ?>"/>

        <main>
            <div id="left">
                <!-- <div id="lt_top" class="height_5p"> -->
                <div id="lt_top">
                    <a href="index.php" id="logo"></a>
                    <div class="marquee">
                        <marquee>
                            <?php
                            for ($i = 0; $i < 10; $i++) {
                                echo " <span id='marquee" . $i . "'></span>";
                            }
                            ?>
                        </marquee>
                    </div>
                    <div id="func_btns">
                        <button type="button" class="inline_mid green_btn"><i class="fa fa-volume-up"
                                                                              style="font-size:24px"></i></button>
                        <button type="button" class="inline_mid green_btn" onclick ="enterFullScreen()" style="display:none;"><i class="fa fa-arrows-alt"
                                                                              style="font-size:24px"></i></button>

                        <button id="butLogout" type="button" class="inline_mid">登出</button>
                        <button id="btn_leave" type="button" class="inline_mid" style="display: none;">離開</button>
                    </div>
                    <img src="img/game_rt_icon.png" alt=""
                         style="width: 50px;height: 50px;border-radius: 50%;vertical-align: middle;margin-left: 10px;">
                </div>
                <div id="fullScreenArea" style="width:100%;height:99%">
                    <div id="lt_top_md_money">
                        <!--            <ul id="md_money_ul" style="text-align: right; margin-left:45px;">  <!--width:90%;-->
                        <!--            --><?php
    //               for( $i=0 ; $i<4 ; $i++ ){
    //                echo "<li>JP".($i+1)."<span class='md_money_num' id='md_money_num".$i."'></span></li>";
    //               }
    //
                        ?>
                        <!--            </ul>-->
                    </div>
                    <div class="new_iframe" style="display: none;text-align:center; "><p style="display:inline-block; margin: 1% 5% 2% 0px; line-height: 1.5em;">遊戲多開</p></div>
                    <div id="main_content">
                        <div id="main_hall" class="height_100p">
                            <div class="gameIconDiv_1">
                                <img id="game_1" src="img/BaseSymbol8.png" alt="" class="gameIconStyle_1">
                                <div class="gameIconNameStyle_1">西遊記</div>
                                <div class="gameIconTagStyle_1">攻略</div>
                            </div>
                            <div class="gameIconDiv_1">
                                <img id="game_2" src="img/win7pk.png" alt="" class="gameIconStyle_1">
                                <div class="gameIconNameStyle_1">Win7pk</div>
                                <div class="gameIconTagStyle_1">攻略</div>
                            </div>
                            <!--  <div class="gameIconDiv_1">
                                  <img src="img/game_icon2.png" alt="" class="gameIconStyle_1">
                                  <div class="gameIconNameStyle_1">Vegas</div>
                                  <div class="gameIconTagStyle_1">攻略</div>
                              </div>
                              <div class="gameIconDiv_1">
                                  <img src="img/game_icon3.png" alt="" class="gameIconStyle_1">
                                  <div class="gameIconNameStyle_1">超八</div>
                                  <div class="gameIconTagStyle_1">攻略</div>
                              </div>
                              <div class="gameIconDiv_1">
                                  <img src="img/game_icon4.png" alt="" class="gameIconStyle_1">
                                  <div class="gameIconNameStyle_1">幸運鑽石</div>
                                  <div class="gameIconTagStyle_1">攻略</div>
                              </div>
                              <div class="gameIconDiv_1">
                                  <img src="img/game_icon5.png" alt="" class="gameIconStyle_1">
                                  <div class="gameIconNameStyle_1">海洋世界</div>
                                  <div class="gameIconTagStyle_1">攻略</div>
                              </div>
                              <div class="gameIconDiv_1">
                                  <img src="img/game_icon6.png" alt="" class="gameIconStyle_1">
                                  <div class="gameIconNameStyle_1">雷神</div>
                                  <div class="gameIconTagStyle_1">攻略</div>
                              </div>
                              <div class="gameIconDiv_1">
                                  <img id="game_1" src="img/BaseSymbol8.png" alt="" class="gameIconStyle_1">
                                  <div class="gameIconNameStyle_1">西遊記</div>
                                  <div class="gameIconTagStyle_1">攻略</div>
                              </div>
                              <div class="gameIconDiv_1">
                                  <img src="img/game_icon1.png" alt="" class="gameIconStyle_1">
                                  <div class="gameIconNameStyle_1">水果吧</div>
                                  <div class="gameIconTagStyle_1">攻略</div>
                              </div>
                              <div class="gameIconDiv_1">
                                  <img src="img/game_icon2.png" alt="" class="gameIconStyle_1">
                                  <div class="gameIconNameStyle_1">Vegas</div>
                                  <div class="gameIconTagStyle_1">攻略</div>
                              </div>
                              <div class="gameIconDiv_1">
                                  <img src="img/game_icon3.png" alt="" class="gameIconStyle_1">
                                  <div class="gameIconNameStyle_1">超八</div>
                                  <div class="gameIconTagStyle_1">攻略</div>
                              </div>
                              <div class="gameIconDiv_1">
                                  <img src="img/game_icon4.png" alt="" class="gameIconStyle_1">
                                  <div class="gameIconNameStyle_1">幸運鑽石</div>
                                  <div class="gameIconTagStyle_1">攻略</div>
                              </div>
                              <div class="gameIconDiv_1">
                                  <img src="img/game_icon5.png" alt="" class="gameIconStyle_1">
                                  <div class="gameIconNameStyle_1">海洋世界</div>
                                  <div class="gameIconTagStyle_1">攻略</div>
                              </div>
                              <div class="gameIconDiv_1">
                                  <img src="img/game_icon6.png" alt="" class="gameIconStyle_1">
                                  <div class="gameIconNameStyle_1">雷神</div>
                                  <div class="gameIconTagStyle_1">攻略</div>
                              </div>-->
                        </div>
                        <div id="main_game" style="display: none;">
                        </div>
                        <div id="main_game2" style="display: none;height:50%;width:45%;float:right;">
                        </div>
                        <div id="choose_game">
                            <div id="game1" class="gameIconDiv_1">
                                <img src="img/BaseSymbol8.png" alt="" class="gameIconStyle_1">
                                <div class="gameIconNameStyle_1">西遊記</div>
                                <div class="gameIconTagStyle_1">攻略</div>
                            </div>
                            <div id="game2" class="gameIconDiv_1">
                                <img src="img/win7pk.png" alt="" class="gameIconStyle_1">
                                <div class="gameIconNameStyle_1">Win7pk</div>
                                <div class="gameIconTagStyle_1">攻略</div>
                            </div>
                        </div>
                        <!-- <div id="main_text">
                                <div class="inline_top borderBasic width_10p height_100p">
                                    <p>西遊記</p>
                                    <a href="http://60.248.141.144/web/Slot_WebGL/index.html?user=<?php //echo $viewData['member']['account'];                                                  ?>&mo=<?php //echo $viewData['member']['money'];                                                  ?>" target="_blink">點擊進入</a>
                                </div>
                                <div class="inline_top borderBasic width_80p height_100p">
                                    <div id="gameHall_A">
                                        <div class="gameIconDiv_1 fontSize_0 floatLeft">
                                            <div class="inline_bottom gameIconTagStyle_1">攻略</div>
                                            <a href="http://60.248.141.144/web/Slot_WebGL/index.html?user=<?php //echo $viewData['member']['account'];                                                  ?>&mo=<?php //echo $viewData['member']['money'];                                                  ?>" target="_blink" class="inline_bottom gameIconStyle_1"><img src="img/BaseSymbol8.png"" alt=""></a>
                                            <div class="gameIconNameStyle_1">西遊記</div>
                                        </div>
                                    </div>
                                </div>
                            </div> -->
                        <div id="main_func">
                            <a class="nav_item" target="_blank" href="intro.php?tab=0">新手教學</a>
                            <a class="nav_item" target="_blank" href="activity.php?tab=0">熱門活動</a>
                            <a class="nav_item" target="_blank" href="point.php?tab=0">儲值購點</a>
                            <a class="nav_item" target="_blank" href="point.php?tab=1">遊戲幣轉帳</a>
                            <a class="nav_item" target="_blank" href="">虛擬寶箱</a>
                            <!-- <button id="treasure_box_btn"></button>
                            <button class="chip_btn" id="chip_btn_1">儲值</button>
                            <button class="chip_btn" id="chip_btn_4">轉帳</button> -->
                        </div>
                    </div>
                </div>
            </div>
            <div id="right">
                <div id="rightTabs">
                    <ul>
                        <li><a href="#rightTab1" >即時動態</a></li>
                        <li><a href="#rightTab2" >聊天訊息</a></li>
                        <li><a href="#rightTab3" >好友列表</a></li>                  
                        <li id="rightTab4"><a href="intro.php?tab=1" target="_blank">說明</a></li>
                        <!-- <li><a href="rightTab4">說明</a></li> -->
                    </ul>
                    <!-- 即時動態 -->
                    <div id="rightTab1">
                        <div id="rt1_top" class="rt_top">
                            <div id="rt1_top1">
                                <select name="" id="rt1_channels" onchange="prepareOpen(this.value)">
                                    <option value="1"></option>
                                    <option value="2"></option>
                                    <option value="3"></option>
                                </select>
                                <button type="button" id="rt1_btn_player_list" onclick="askChannelMemberList()">玩家列表</button>
                            </div>
                            <div id="rt1_top2">
                                <h3>玩家列表</h3>
                                <button type="button" id="rt1_btn_back">回即時動態</button>
                            </div>
                        </div>
                        <div id="rt1_mid_and_btm">
                            <div id="rt1_mid1">
                                <div id="rt1_mid">

                                </div>
                                <div id="rt1_bottom">
                                    <div class="stickers">
                                        <?php
                                        // var_dump($mapData);
                                        foreach ($mapData as $key => $value) {
                                            $postStickers = explode(".png", $value['image_name']);
                                            // echo '<img src="'.$imagedate_url . $value['image_name'] . '" class="channelStickers" data-name="'. $value['image_name'] .'" height="70" width="70" onclick="postStickers('.$postStickers[0].')">';
                                            echo '<img src="' . $imagedate_url . $value['image_name'] . '" class="channelStickers" data-name="' . $postStickers[0] . '" data-where="channel" height="70" width="70">';
                                        }
                                        ?>
                                    </div>
                                    <button type="button" id="face_btn"><img src="img/smiley_face_s.png" alt="" style="width: 25px;"></button>
                                    <button type="button" id="upload_btn"><img src="img/pic_upload.png" alt=""
                                                                               style="width: 25px;"></button>
                                    <!-- <form action="" method="POST" onsubmit="return false;"> -->
                                    <!-- <input type="text" value="" id="msg" > -->
                                    <input type="text" name="" id="msg"></input>
                                    <input type="button" id="butSend" value="傳送">
                                    <!-- </form> -->
                                </div>
                            </div>
                            <div id="rt1_mid2" style="display: none;">
                                <form action="" class="searchForm">
                                    <input type="search" placeholder="搜尋">
                                </form>
                                <div id="rt1_players">

                                    <div class="rt1_player">
                                        <img src="img/game_rt_icon.png" alt="Player Icon">
                                        <p>玩家暱稱</p>
                                        <button type="button" onclick="addFriend()">加好友</button>
                                    </div>
                                    <!--                                    <div class="rt1_player">
                                                                            <img src="img/game_rt_icon.png" alt="Player Icon">
                                                                            <p>玩家暱稱</p>
                                                                            <button type="button">加好友</button>
                                                                        </div>
                                                                        <div class="rt1_player">
                                                                            <img src="img/game_rt_icon.png" alt="Player Icon">
                                                                            <p>玩家暱稱</p>
                                                                            <button type="button">加好友</button>
                                                                        </div>
                                                                        <div class="rt1_player">
                                                                            <img src="img/game_rt_icon.png" alt="Player Icon">
                                                                            <p>玩家暱稱</p>
                                                                            <button type="button">加好友</button>
                                                                        </div>-->
                                </div>
                            </div>
                            <form action="" style="display: none;" method="post" name="uploadForm" id="uploadForm" enctype="multipart/form-data">
                                <input type="file" id="upload_input" name="upfile" accept="image/jpeg,image/gif,image/png" onchange="submitform()">
                                <input type="submit" value="送出" id="upload_submit" class="btn-primary btn">
                            </form>
                        </div>
                    </div>
                    <!-- 聊天訊息 -->
                    <div id="rightTab2">
                        <div class="rt_top">
                            <div id="rt2_top1">
                                <button type="button" id="rt2_btn_music">提示音效</button>
                                <button type="button" id="rt2_btn_group_list">群組列表</button>
                            </div>
                            <div id="rt2_top2">
                                <h3>群組列表</h3>
                                <button type="button" id="rt2_btn_back">回聊天訊息</button>
                            </div>
                        </div>
                        <form action="" class="searchForm">
                            <input type="search" placeholder="搜尋" onkeyup="searchChat(this.value)">
                        </form>
                        <div id="rt2_mid1">
                            <h4>官方服務（ 2 ）</h4>
                            <div class="rt2_msg_div">
                                <div class="rt2_msg_div1">
                                    <img src="img/game_rt_icon2.png" alt="Player Icon 2" class="player_icon">
                                    <div class="rt2_msg" onclick="ShowPersonalMsg('serviceCenter', event)">
                                        <p class="rt2_msg_name">客服中心</p>
                                        <p class="rt2_msg_preview" id="msg_preview_serviceCenter">XXXX</p>
                                    </div>
                                </div>
                                <div class="rt2_msg_div2">
                                    <p class="rt2_msg_time">上午 10:35</p>
                                    <div class="rt2_msg_no" id="msg_no_serviceCenter">2</div>
                                </div>
                            </div>
                            <div class="rt2_msg_div" style="border-bottom: none;">
                                <div class="rt2_msg_div1">
                                    <img src="img/game_rt_icon2.png" alt="Player Icon 2" class="player_icon">
                                    <div class="rt2_msg" onclick="ShowPersonalMsg('giftCenter', event)">
                                        <p class="rt2_msg_name">贈獎中心</p>
                                        <p class="rt2_msg_preview" id="msg_preview_giftCenter">XXXX</p>
                                    </div>
                                </div>
                                <div class="rt2_msg_div2">
                                    <p class="rt2_msg_time">上午 10:35</p>
                                    <div class="rt2_msg_no" id="msg_no_giftCenter">2</div>
                                </div>
                            </div>
                            <h4>聊天（ 15 ）</h4>
                            <div id="showMsgList"></div>

                            <!--                            <div id="rt2_msg_list">-->
                            <!--                                <div class="rt2_msg_div">-->
                            <!--                                    <div class="rt2_msg_div1">-->
                            <!--                                        <img src="img/game_rt_icon3.png" alt="Player Icon 3" class="player_icon">-->
                            <!--                                        <div class="rt2_msg">-->
                            <!--                                            <p class="rt2_msg_name">XXX</p>-->
                            <!--                                            <p class="rt2_msg_preview">XXXXXXXXXX</p>-->
                            <!--                                        </div>-->
                            <!--                                    </div>-->
                            <!--                                    <div class="rt2_msg_div2">-->
                            <!--                                        <p class="rt2_msg_time">上午 10:35</p>-->
                            <!--                                        <div class="rt2_msg_no">1</div>-->
                            <!--                                        <button type="button" class="rt2_msg_deleteBtn">刪除</button>-->
                            <!--                                    </div>-->
                            <!--                                </div>-->
                            <!--                            </div>-->
                        </div>
                        <div id="rt2_mid2" style="display: none;">
                            <div class="rt2_group_div" onclick="GroupPrepareOpen('group1', event)">
                                <p>群組<span class="groupValue">1</span><span>20人</span></p>
                                <button type="button" class="leaveGroup" id="leaveGroup1">離開群組</button>
                            </div>
                            <div class="rt2_group_div" onclick="GroupPrepareOpen('group2', event)">
                                <p>群組<span class="groupValue">2</span><span>20人</span></p>
                                <button type="button" class="leaveGroup" id="leaveGroup2">離開群組</button>
                            </div>
                            <div class="rt2_group_div" onclick="GroupPrepareOpen('group3', event)">
                                <p>群組<span class="groupValue">3</span><span>20人</span></p>
                                <button type="button" class="leaveGroup" id="leaveGroup3">離開群組</button>
                            </div>
                        </div>
                    </div>
                    <div id="rightTab3">
                        <div class="rt_top" style="padding-top: 23px;">
                            <button type="button" style="display: none;">聊　天</button>
                        </div>
                        <form action="" class="searchForm">
                            <input type="search" placeholder="搜尋" onkeyup="account_query(this.value)">
                        </form>
                        <div id="rt3_mid1">

                            <!--                            <div class="friend" id="friend_list" style="border-bottom: 1px solid #fff;">-->
                            <!--                                <div class="friend_div1">-->
                            <!--                                    <img src="img/game_rt_icon3.png" alt="Player Icon 3" class="player_icon">-->
                            <!--                                    <div class="rt2_msg" id="memID">-->
                            <!--                                        <p class="rt2_msg_name">Snoop</p>-->
                            <!--                                    </div>-->
                            <!--                                </div>-->
                            <!--                            </div>-->





                            <div id="showMyFriendIsEmpty" style="display: none;">
                                <p>還沒有好友嗎？</p>
                                <p>快去找朋友</p>
                                <button type="button" id="rt3_btn_goFindFriend">立即去</button>
                            </div>



                        </div>
                    </div>
                    <!--            <div id="rightTab4">-->
                    <!--                <div class="rt_top">-->
                    <!--                    <button type="button">說明</button>-->
                    <!--                </div>-->
                    <!---->
                    <!--                <div id="rt4_mid1">-->
                    <!--                    <div>-->
                    <!--                        <p>這裡是說明</p>-->
                    <!---->
                    <!--                    </div>-->
                    <!--                </div>-->
                    <!--            </div>-->

                    <div id="groupChat" style="display: none">
                        <div class="MsgNav">
                            <div class="btn btn-primary" id="goBackToGroup">回上頁</div>
                            <div class="btn btn-primary" id="GroupMemberList" style="float: right;">成員列表</div>
                        </div>
                        <div id="GroupmsgContent">
                            <div id="Groupuser_msg">
                                <div class="member_info" style="line-height: 36px;">
                                    <p>========群組聊天========</p>

                                </div>
                            </div>
                            <div id="groupMsgBottom">
                                <div class="stickers">
                                    <?php
                                    // var_dump($mapData);
                                    foreach ($mapData as $key => $value) {
                                        $postStickers = explode(".png", $value['image_name']);
                                        // echo '<img src="'.$imagedate_url . $value['image_name'] . '" class="channelStickers" data-name="'. $value['image_name'] .'" height="70" width="70" onclick="postStickers('.$postStickers[0].')">';
                                        echo '<img src="' . $imagedate_url . $value['image_name'] . '" class="channelStickers" data-name="' . $postStickers[0] . '" data-where="group" height="70" width="70">';
                                    }
                                    ?>
                                </div>
                                <button type="button" id="groupmsg_face_btn"><img src="img/smiley_face_s.png" alt="" style="width: 25px;"></button>
                                <button type="button" id="groupmsg_upload_btn"><img src="img/pic_upload.png" alt=""
                                                                                    style="width: 25px;"></button>
                                <!-- <form action="" method="POST" onsubmit="return false;"> -->
                                <!-- <input type="text" value="" id="msg" > -->
                                <input type="text" name="" id="groupmsg_input"></input>
                                <input type="button" id="groupmsg_butSend" value="傳送">
                                <!-- </form> -->
                            </div>

                            <form action="" style="display: none;" method="post" id="groupmsg_submit_data" name="groupmsg_submit_data" enctype="multipart/form-data">
                                <input type="file" id="groupmsg_upload_input" name="upfile" accept="image/jpeg,image/gif,image/png" onchange="submitform1()">
                                <input type="submit" value="送出" id="groupmsg_submit" class="btn-primary btn">
                            </form>
                        </div>
                        <div id="rt1_mid2" style="display: none;">
                            <form action="" class="searchForm">
                                <input type="search" placeholder="搜尋">
                            </form>
                            <div id="rt1_players" style="height: 724px;">
                                <div class="rt1_player">
                                    <img src="img/game_rt_icon.png" alt="Player Icon">
                                    <p>玩家暱稱</p>
                                    <button type="button">加好友</button>
                                </div>
                                <div class="rt1_player">
                                    <img src="img/game_rt_icon.png" alt="Player Icon">
                                    <p>玩家暱稱</p>
                                    <button type="button">加好友</button>
                                </div>
                                <div class="rt1_player">
                                    <img src="img/game_rt_icon.png" alt="Player Icon">
                                    <p>玩家暱稱</p>
                                    <button type="button">加好友</button>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div id="memberMsgShow" style="display: none">
                        <div class="MsgNav">
                            <div class="btn btn-primary" id="go_last_page">回上頁</div>
                        </div>
                        <div id="msgContent">
                            <div id="user_msg" style="">
                                <!--                                <div class="member_info" style="line-height: 36px;">-->
                                <!--                                    <p>========================</p>-->
                                <!--                                    <p>[玩家資訊]</p>-->
                                <!--                                    <p>帳號創立時間：2000/01/01</p>-->
                                <!--                                    <p>等級:22</p>-->
                                <!--                                    <p>========================</p>-->
                                <!--                                </div>-->
                                <!--                                <div class="user_info">-->
                                <!--                                    <img src="img/game_rt_icon.png" alt="user_icon">-->
                                <!--                                    <div>-->
                                <!--                                        <p>Snoo Py</p>-->
                                <!--                                        <p class="user_talk">剛剛進入聊天室</p>-->
                                <!--                                    </div>-->
                                <!--                                </div>-->
                            </div>
                            <div id="memberMsgBottom">
                                <div class="stickers">
                                    <?php
                                    foreach ($mapData as $key => $value) {
                                        $postStickers = explode(".png", $value['image_name']);
                                        // echo '<img src="'.$imagedate_url . $value['image_name'] . '" class="channelStickers" data-name="'. $value['image_name'] .'" height="70" width="70" onclick="postStickers('.$postStickers[0].')">';
                                        echo '<img src="' . $imagedate_url . $value['image_name'] . '" class="memberStickers" data-name="' . $postStickers[0] . '" data-where="member" height="70" width="70">';
                                    }
                                    ?>
                                </div>
                                <button type="button" id="msg_face_btn"><img src="img/smiley_face_s.png" alt="" style="width: 25px;"></button>
                                <button type="button" id="msg_upload_btn"><img src="img/pic_upload.png" alt=""
                                                                               style="width: 25px;"></button>
                                <!-- <form action="" method="POST" onsubmit="return false;"> -->
                                <!-- <input type="text" value="" id="msg" > -->
                                <input type="text" name="" id="msg_input"></input>
                                <input type="button" id="msg_butSend" value="傳送">
                                <!-- </form> -->
                            </div>

                            <form action="" style="display: none;" method="post" name="membermsg_submit_data" id="membermsg_submit_data" enctype="multipart/form-data">
                                <input type="file" id="membermsg_upload_input" name="upfile" accept="image/jpeg,image/gif,image/png" onchange="submitform2()">
                                <input type="submit" value="送出" id="membermsg_submit" class="btn-primary btn">
                            </form>
                        </div>
                        <div id="rt1_mid2" style="display: none;">
                            <form action="" class="searchForm">
                                <input type="search" placeholder="搜尋">
                            </form>
                            <div id="rt1_players" style="height: 724px;">
                                <div class="rt1_player">
                                    <img src="img/game_rt_icon.png" alt="Player Icon">
                                    <p>玩家暱稱</p>
                                    <button type="button">加好友</button>
                                </div>
                                <div class="rt1_player">
                                    <img src="img/game_rt_icon.png" alt="Player Icon">
                                    <p>玩家暱稱</p>
                                    <button type="button">加好友</button>
                                </div>
                                <div class="rt1_player">
                                    <img src="img/game_rt_icon.png" alt="Player Icon">
                                    <p>玩家暱稱</p>
                                    <button type="button">加好友</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
        <!-- <script src="<?php echo $webroot; ?>/js/jquery-3.1.0.min.js"></script> -->
        <!-- <script src="<?php echo $webroot; ?>/js/jquery-ui.min.js"></script> -->

        <script src="<?php echo $webroot; ?>js/tabs/jquery-ui-1.9.2.custom.min.js"></script>
        <!-- JS by Maicca -->
        <script type="text/javascript">
                                    var name = "<?= $viewData['member']['name'] ?>";
                                    var id = "<?= $viewData['member']['id'] ?>";
                                    function saveReport() {
                                        var form = document.forms["uploadForm"];
                                        if (form["file"].files.length > 0)
                                        {
                                            alert(form["file"].xs.length);
                                            $("#upload_submit").trigger("submit");
                                        }

                                        // jquery 表单提交
                                        $("#showDataForm").ajaxSubmit(function (message) {
                                            // 对于表单提交成功后处理，message为提交页面saveReport.htm的返回内容
                                        });
                                        return false; // 必须返回false，否则表单会自己再做一次提交操作，并且页面跳转
                                    }
//                                function submitform() {
//                                    document.uploadForm.action = "php/game_uploade.php";
//                                    document.uploadForm.submit();
//                                }
                                    function submitform() {
                                        $.ajax({
                                            url: "php/game_uploade.php",
                                            data: new FormData($('#uploadForm')[0]),
                                            type: "POST",
                                            dataType: 'text',
                                            processData: false,
                                            contentType: false,
                                            success: function (msg) {
                                                //alert(msg);
                                                var membername = "<?php echo $viewData['member']['name']; ?>";
                                                //alert(membername,<?php echo $viewData['member']['id']; ?>,msg);
                                                onSubmitimg(membername,<?php echo $viewData['member']['id']; ?>, msg);
                                                document.getElementById("uploadForm").reset();
                                                alert("上傳成功");
                                            },
                                        });
                                    }
                                    function submitform1() {
                                        $.ajax({
                                            url: "php/game_uploade.php",
                                            data: new FormData($('#groupmsg_submit_data')[0]),
                                            type: "POST",
                                            dataType: 'text',
                                            processData: false,
                                            contentType: false,
                                            success: function (msg) {
                                                //alert(msg);
                                                var membername = "<?php echo $viewData['member']['name']; ?>";
                                                //alert(membername,<?php echo $viewData['member']['id']; ?>,msg);
                                                onSubmit2img(membername,<?php echo $viewData['member']['id']; ?>, msg);
                                                document.getElementById("groupmsg_submit_data").reset();
                                                alert("上傳成功");
                                            },
                                        });
                                    }
                                    function submitform2() {
                                        //alert(1231231);
                                        $.ajax({
                                            url: "php/game_uploade.php",
                                            data: new FormData($('#membermsg_submit_data')[0]),
                                            type: "POST",
                                            dataType: 'text',
                                            processData: false,
                                            contentType: false,
                                            success: function (msg) {
                                                //alert(msg);
                                                var membername = "<?php echo $viewData['member']['name']; ?>";
                                                onSubmitimgwhispering(membername,<?php echo $viewData['member']['id']; ?>, msg);
                                                document.getElementById("membermsg_submit_data").reset();
                                                alert("上傳成功");
                                            },
                                        });
                                    }
                                    /*  聊天計算器重刷  */
                                    function dialogue_return(channel, friend) {
                                        var id = <?php echo $viewData['member']['id']; ?>;
                                        ws.send('{"type":"dialogue_return","myid":"' + id + '","channel":"' + channel + '","friend":"' + friend + '","pic_status":"' + "1" + '"}');
                                        //alert(<?php echo $viewData['member']['id']; ?>,channel,friend);
//                                        //alert(111);
//                                        var id = <?php echo $viewData['member']['id']; ?>;
//                                        //alert(id);
//                                        $.ajax({
//                                            url: "php/dialogue_timing.php",
////                                            data: '{"myid": ' + id + ', "room_id:"' + channel + ', "friend_id:"' + friend + '}',
//                                            //data: '{"myid": ' + id + '}',
//                                            date:{ myid: id, room_id: channel }, 
//                                            type: "POST",
//                                            dataType: 'text',
//                                            // processData: false,
//                                            // contentType: false,
//                                            success: function (msg) {
//                                                //console.log(msg);
//                                                 alert(msg);
//                                                //print_r(msg);
//                                                // var membername = "<?php echo $viewData['member']['name']; ?>";
                                        //alert(membername,<?php echo $viewData['member']['id']; ?>,msg);
                                        // onSubmit2img(membername,<?php echo $viewData['member']['id']; ?>, msg);
//                                                // document.getElementById("groupmsg_submit_data").reset();
//                                                // alert("上傳成功");
//                                            },
//                                        });
                                    }


                                    function print_r(printthis, returnoutput) {
                                        var output = '';
                                        if ($.isArray(printthis) || typeof (printthis) == 'object') {
                                            for (var i in printthis) {
                                                output += i + ' : ' + print_r(printthis[i], true) + '\n';
                                            }
                                        } else {
                                            output += printthis;
                                        }
                                        if (returnoutput && returnoutput == true) {
                                            return output;
                                        } else {
                                            alert(output);
                                        }
                                    }
                                    /* left */
                                    function setMainHallHeight() {
                                        document.getElementById("main_hall").style.height = window.innerHeight - 171 + "px";
                                    }

                                    window.addEventListener("load", setMainHallHeight);
                                    window.addEventListener("resize", setMainHallHeight);
                                    $("#btn_leave").click(function () {
                                        $("#main_game").empty();
                                        $("#main_game2>#iframe2").remove();
                                        $("#main_game").css({"display": "none", "width": "100%"});
                                        $("#main_game2").css("display", "none");
                                        $("#main_hall").css("display", "block");
                                        $("#main_func").css("display", "block");
                                        $("#butLogout").css("display", "inline-block");
                                        $("#btn_leave").css("display", "none");
                                        $(".new_iframe").css("display", "none");
                                        $("#main_content").css("padding","10px 20px");
                                        $("#lt_top_md_money").css("width","97%");
                                    });

                                    /* #rightTab1 START */

                                    function setRt1MidDefaultData() {
                                        $("#rt1_mid").load("php/game_channel_1.php", setRt1MidToBtm);
                                    }

                                    function setRt1MidToBtm() {
                                        $("#rt1_mid").scrollTop($("#rt1_mid")[0].scrollHeight);
                                    }
                                    window.addEventListener("load", setRt1MidDefaultData);
                                    function setRt1MidHeight() {
                                        var rt1_mid_height = window.innerHeight - 147 + "px";
                                        $("#rt1_mid").css("height", rt1_mid_height);
                                    }
                                    window.addEventListener("load", setRt1MidHeight);
                                    window.addEventListener("resize", setRt1MidHeight);
                                    function setRt1PlayersHeight() {
                                        var rt1_mid_height = window.innerHeight - 148 + "px";
                                        $("#rt1_players").css("height", rt1_mid_height);
                                    }
                                    window.addEventListener("load", setRt1PlayersHeight);
                                    window.addEventListener("resize", setRt1PlayersHeight);
                                    //控制頻道下的對話框寬度
                                    function set_msg_Width() {
                                        var set_msgWidth = $("#rt1_bottom").width() - 160.41 + "px";
                                        $("#msg").css("width", set_msgWidth);
                                    }
                                    window.addEventListener("load", set_msg_Width);
                                    window.addEventListener("resize", set_msg_Width);

                                    $("#rt1_channels").change(function () {
                                        if ($(this).val() == "2") {
                                            $("#rt1_mid").load("php/game_channel_2.php", setRt1MidToBtm);
                                        } else if ($(this).val() == "3") {
                                            $("#rt1_mid").load("php/game_channel_3.php", setRt1MidToBtm);
                                        } else {
                                            $("#rt1_mid").load("php/game_channel_1.php", setRt1MidToBtm);
                                        }
                                    });
                                    $("#rt1_btn_player_list").click(function () {
                                        $("#rt1_top2").css("display", "block");
                                        $("#rt1_top1").css("display", "none");
                                        $("#rt1_mid2").css("display", "block");
                                        $("#rt1_mid1").css("display", "none");

                                    });
                                    $("#rt1_btn_back").click(function () {
                                        $("#rt1_top1").css("display", "block");
                                        $("#rt1_top2").css("display", "none");
                                        $("#rt1_mid1").css("display", "block");
                                        $("#rt1_mid2").css("display", "none");
                                    });
                                    $("#upload_btn").click(function () {
                                        $("#upload_input").trigger("click");
                                    });
                                    /* #rightTab1 END */

                                    /* #rightTab2 START */

                                    function setRt2MsgListHeight() {  //設定rt2_msgList的高度
                                        var rt2_msgList_height = window.innerHeight - 441 + "px";
                                        $("#rt2_msg_list").css("height", rt2_msgList_height);
                                    }
                                    window.addEventListener("load", setRt2MsgListHeight); //進入頁面時設定rt2_msgList的高度
                                    window.addEventListener("resize", setRt2MsgListHeight); //改變視窗大小時設定rt2_msgList的高度

                                    function setRt2Mid2Height() {
                                        var rt2_mid2_height = window.innerHeight - 148 + "px";
                                        $("#rt2_mid2").css("height", rt2_mid2_height);
                                    }
                                    window.addEventListener("load", setRt2Mid2Height);
                                    window.addEventListener("resize", setRt2Mid2Height);
                                    function setRt2Mid1Height() {
                                        var rt2_mid1_height = window.innerHeight - 148 + "px";
                                        $("#rt2_mid1").css("height", rt2_mid1_height);
                                    }
                                    window.addEventListener("load", setRt2Mid1Height);
                                    window.addEventListener("resize", setRt2Mid1Height);
                                    function setRt3Mid1Height() {
                                        var rt3_mid1_height = window.innerHeight - 119 + "px";
                                        $("#rt3_mid1").css("height", rt3_mid1_height);
                                    }
                                    window.addEventListener("load", setRt3Mid1Height);
                                    window.addEventListener("resize", setRt3Mid1Height);
                                    function setuser_msgHeight() {
                                        var user_msg_height = window.innerHeight - 148 + "px";
                                        $("#user_msg").css("height", user_msg_height);
                                    }
                                    function setuser_msgHeight_toBottom() {
                                        $("#user_msg").scrollTop($("#user_msg")[0].scrollHeight);
                                    }
                                    window.addEventListener("load", setuser_msgHeight);
                                    window.addEventListener("resize", setuser_msgHeight);
                                    //控制群組下的對話框寬度
                                    function set_group_msg_Width() {
                                        var set_group_msgWidth = $("#groupMsgBottom").width() - 160.41 + "px";
                                        $("#groupmsg_input").css("width", set_group_msgWidth);
                                    }
                                    window.addEventListener("load", set_group_msg_Width);
                                    window.addEventListener("resize", set_group_msg_Width);
                                    $("#rt2_btn_group_list").click(function () {
                                        $("#rt2_top2").css("display", "block");
                                        $("#rt2_top1").css("display", "none");
                                        $("#rt2_mid2").css("display", "block");
                                        $("#rt2_mid1").css("display", "none");
                                        $(".searchForm").find('input[type="search"]').val('');
                                        $(".searchForm").find('input[type="search"]').attr("onkeyup", "searchChat(this.value,1)");
                                    });
                                    $("#rt2_btn_back").click(function () {
                                        $("#rt2_top1").css("display", "block");
                                        $("#rt2_top2").css("display", "none");
                                        $("#groupChat").hide();
                                        GetPersonalMsg();
                                        $("#rt2_mid1").css("display", "block");
                                        $("#rt2_mid2").css("display", "none");
                                        $(".searchForm").find('input[type="search"]').attr("onkeyup", "searchChat(this.value)");
                                        $(".searchForm").find('input[type="search"]').val('');
                                    });
                                    function setGroupuser_msgHeight() {
                                        var Groupuser_height = window.innerHeight - 153 + "px";
                                        $("#Groupuser_msg").css("height", Groupuser_height);
                                        $("#Groupuser_msg").css("overflow", "auto");
                                    }
                                    window.addEventListener("load", setGroupuser_msgHeight);
                                    window.addEventListener("resize", setGroupuser_msgHeight);
                                    function setGroupuser_msg_toBottom() {
                                        $("#Groupuser_msg").scrollTop($("#Groupuser_msg")[0].scrollHeight);
                                    }
                                    $(document).on('click', '.rt2_group_div', function (event) {
                                        if ($(event.target).attr("class") == 'leaveGroup') {

                                        } else {
                                            $("#rightTab2").css("display", "none");
                                            $("#groupChat").show();
                                            set_group_msg_Width();
                                            var data_Num = $(this).attr("data-Num");
                                            GroupPrepareOpen(data_Num, event);
                                        }
                                    })
                                    $("#goBackToGroup").click(function () {
                                        $("#user_msg").attr("data-sid", "");
                                        $("#groupChat").attr("data-sid", "");
                                        $("#memberMsgShow,#groupChat").hide();
                                        $("#rightTab2,#GroupMemberList").show();
                                        $(".searchForm").find('input[type="search"]').val('');
                                        searchChat("", 1);
                                        setGroupuser_msgHeight();
                                        $(this).parent().next().find(':nth-child(2)').show();
                                        $("#Groupuser_msg").html('');
                                        GetPersonalMsg();
                                    });
                                    $("#groupmsg_upload_btn").click(function () {
                                        $("#groupmsg_upload_input").trigger("click");
                                    });


                                    $("#go_last_page").click(function () {
                                        $("#user_msg").html('');
                                    });

                                    $("#GroupMemberList").click(function () {
                                        var roomid = $("#groupChat").attr("data-sid");
                                        $('#Groupuser_msg').html('');
                                        $(this).hide();
                                        $(this).parent().next().css("height", "880px");
                                        $(this).parent().next().children().first().css("height", "880px");
                                        $(this).parent().next().find(':nth-child(2)').hide();
                                        askForGroupList(roomid);
                                    })


                                    $(document).ready(function () {

                                        /* right */
                                        $("#rightTabs").tabs();
                                        $("#go_last_page,#ui-id-1,#ui-id-2,#ui-id-3").click(function () {
                                            if ($("#rightTab1").attr("aria-hidden") == "false") {
                                                $("#groupChat").attr("data-sid", "");
                                            }
                                            if ($("#rightTab2").attr("aria-hidden") == "false") {
                                                $("#memberMsgShow").css("display", "none");
                                                $("#rightTab2").css("display", "block");
                                            }
                                            if ($("#rightTab3").attr("aria-hidden") == "false") {
                                                $("#memberMsgShow").css("display", "none");
                                                $("#rightTab3").css("display", "block");
                                                $("#groupChat").attr("data-sid", "");

                                            }
                                            $("#Groupuser_msg").html('');
                                            $("#rt3_mid1").html('');
                                            $("#user_msg").html('');
                                            GetFriend();
                                            GetPersonalMsg();
                                        });

                                        $("#rightTab4>a").unbind('click');
                                        $(document).on("click", "#rt3_btn_goFindFriend", function () {
                                            // $( "#rightTabs" ).tabs("option", "active", 1);
                                            // $("#rightTabs").tabs({
                                            //     active: 0                    // });
                                            $('#ui-id-1')[0].click();
                                            $("#rt1_btn_player_list").trigger("click");
                                        });

                                        $(document).on("click", ".rt2_msg_deleteBtn", function () {
                                            var rt2_msg_div = $(this).closest(".rt2_msg_div");
                                            var data_name = $(this).attr("data-name");
                                            var data_Num = $(this).attr("data-Num");
                                            if (data_name == "delgroup") {
                                                removePersonalMsgList(data_Num);
                                            } else {
                                                delPersonalMsgList(data_Num);
                                            }
                                            rt2_msg_div.remove();
                                        });


                                        //鎖住搜尋框的Enter
                                        // function LockSearchEnterKey(){
                                        $(".searchForm").find("input[type='search']").keypress(function (e) {
                                            code = (e.keyCode ? e.keyCode : e.which);
                                            if (code == 13) {
                                                return false;
                                            }
                                        });
                                        // }

                                        /* #rightTab2 END */

                                        /* #rightTab3 START */

                                        $("#ui-id-3").click(function () {
                                            $("#rightTab2").css("display", "none");
                                        });
                                        // $("#rt3_btn_goFindFriend").click(function () {
                                        // });
                                        $("#msg_upload_btn").click(function () {
                                            $("#membermsg_upload_input").trigger("click");
                                        });
                                    })





                                    //控制群組下的對話框寬度
                                    function set_group_msg_Width() {
                                        var set_group_msgWidth = $("#groupMsgBottom").width() - 160.41 + "px";
                                        $("#groupmsg_input").css("width", set_group_msgWidth);
                                    }
                                    window.addEventListener("load", set_group_msg_Width);
                                    window.addEventListener("resize", set_group_msg_Width);

                                    //控制私聊下的對話框寬度
                                    function set_member_msg_Width() {
                                        var set_member_msgWidth = $("#memberMsgBottom").width() - 160.41 + "px";
                                        $("#msg_input").css("width", set_member_msgWidth);
                                    }
                                    window.addEventListener("load", set_member_msg_Width);
                                    window.addEventListener("resize", set_member_msg_Width);

                                    /* #rightTab3 END */

                                    // rightTab 共用

                                    $("#face_btn,#msg_face_btn,#groupmsg_face_btn").click(function () {
                                        var $this = $(this);
                                        $this.prev(".stickers").toggleClass("show");
                                    });
        </script>
        <script type="text/javascript">
            window.onload = function () {
                $("body").css("opacity", "1");
            };
        </script>
    </body>

</html>
