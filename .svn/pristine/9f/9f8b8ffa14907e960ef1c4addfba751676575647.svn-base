    var wsUri = "ws://52.198.76.181:8002";
    // 'ws://www.christophe.tw:9111/websocket/server2.php';
    var token = '';

    //判斷現在選取的 product_code
    var selectedProduct = '';
    var price_no = '';
    var nowSelectedPrice = 0;
    var lastestProduct = {};

    var lastestFivePrice = {};

    var price_amount_timer;
    var now_selected_show_list = '';

    //判斷是不是要出現倉按鈕
    var storing = new Array();

    //當頁面載入完成
    $(document).ready(function() {

        var isAdmin = QueryString("admin");
        if (isAdmin != "") {
            $("#header").hide();
            $("#left_cont").hide();
            $(".right_top").css("height", "200px");
            $("#divTime").hide();

            $("#li_head_option_result5").hide();
            $("#li_head_option_result6").hide();
            $("option5").hide();
            $("option6").hide();
        }


        $("#bt1").click(function() {
            $("#amount").val(1);
        });
        $("#bt2").click(function() {
            $("#amount").val(2);
        });
        $("#bt3").click(function() {
            $("#amount").val(3);
        });
        $("#bt4").click(function() {
            $("#amount").val(4);
        });
        $("#bt5").click(function() {
            $("#amount").val(5);
        });

        //建立web socket
        var ws = BuildWebSocket();

        $('.productItem').each(function() {
            $(this).css('border-top', 'solid 1px #E7E7E7');
            $(this).css('border-bottom', 'solid 1px #B7BABC');
            $(this).css('border-left', 'solid 1px #B7BABC');
            $(this).css('border-right', 'solid 1px #B7BABC');
        });
        //一進頁面，從DB中初始化產品項目           
        $('.productItem').each(function() {

            //每個商品 點擊選取事件
            $(this).click(function() {

                //所有商品，取消選取的CSS
                $('.productItem').each(function() {
                    $(this).css('border-top', 'solid 1px #E7E7E7');
                    $(this).css('border-bottom', 'solid 1px #B7BABC');
                    $(this).css('border-left', 'solid 1px #B7BABC');
                    $(this).css('border-right', 'solid 1px #B7BABC');
                });

                //設定此筆被選取
                $(this).css('border', 'solid 1px blue');
                $('#info1').html('');
                $('#info3').html('');
                selectedProduct = $(this).attr('id');
                price_no = $(this).find('.price_no').val();

                //在各地方，顯示商品名稱
                var infoName = $(this).find('.name').html();
                $('#info1_name').html(infoName);
                $('#info2_name').html(infoName);
                $('#info3_name').html(infoName);
                $('#info4_name').html(infoName);
                $('#info5_name').html(infoName);
                $('#info6_name').html(infoName);
                //$(this).css('background-color','white');


                //設定最後交易日
                var last_day = $(this).attr('last_day');
                $('#last_day').html(last_day);

                //設定目前被選取的商品 代碼
                $("#now_product_code").val(selectedProduct);
                //取得現在商品 最後一筆報價
                var obj = lastestProduct[selectedProduct];
                //alert(JSON.stringify(obj));
                //商品月份，先清空，避免暫存
                $('#product_month').html('');
                if (obj != null) {
                    var deny_new = "<span style='color:green;'>" + obj['deny_new_order_min'] + "</span> ~ <span style='color:red;'>" + obj['deny_new_order_max'] + "</span>";
                    $('#deny_new_range').html(deny_new);
                    var offset = "<span style='color:green;'>" + obj['system_offset_min'] + "</span> ~ <span style='color:red;'>" + obj['system_offset_max'] + "</span>";
                    $('#offset_range').html(offset);
                    //最上頭，設定商品月份
                    var month = obj['price_code'];
                    month = month.substr(month.length - 2, 2);
                    if (month == 'EA')
                        month = ''
                    $('#product_month').html(Number(month));
                }
                $('#userMenu').show();
                $('#emptyMenu').hide();

                //假如現在選取的是 '量價表' ,選取產品時，要去server要資料
                if (now_selected_show_list == "price_amount") {
                    ajaxLoad_price_amount();
                }

                //新增一筆分價揭示
                newPrice(obj);
                //加最後一筆到五檔揭示
                var fivePrice = lastestFivePrice[price_no];
                updateFivePrice(fivePrice);

                //從server讀取是否收盤全平
                load_closeOffset(selectedProduct);


            });
        });

        //商品統計列表，顯示全部
        $('#chkShowAllProduct').click(function() {
            if ($(this).prop('checked')) {

            }
        });


        //手動送出命令
        $('#butCmd').click(function() {
            var command = $('#txtCmd').val();
            doSend(command);
        });


        //買多
        $('#butBuy_up').click(function() {
            sendCmd('up');
        });

        //買空
        $('#butBuy_down').click(function() {
            sendCmd('down');
        });


        //在挑選市價單或限價單時，要產生的控制項
        $('.type').each(function() {
            $(this).click(function() {
                var radID = $(this).attr('id');
                //alert(radID);
                if (radID == 'rad_limitPrice') {
                    var obj = lastestProduct[selectedProduct];

                    $('#li_limitPrice').show();
                    $('#txtLimitPrice').val(obj['new_price']);
                } else {
                    $('#li_limitPrice').hide();
                    $('#li_limitPrice').val('');
                }
            });
        });

        //限價單按鈕
        $('#butLimitPrice').click(function() {
            var obj = lastestProduct[selectedProduct];
            $('#txtLimitPrice').val(obj['new_price']);
        });

        //限價單+
        $('#plus').click(function() {
            var price = $('#txtLimitPrice').val();
            price = Number(price) + 1;
            $('#txtLimitPrice').val(price);
        });
        //限價單-
        $('#mins').click(function() {
            var price = $('#txtLimitPrice').val();
            price = Number(price) - 1;
            $('#txtLimitPrice').val(price);
        });

        //往上
        $('#but_left_up').click(function() {
            //price_amount_list

            var objDiv = document.getElementById("price_amount_left_bottom_body");
            objDiv.scrollTop = objDiv.scrollTop - 10;
            //console.log(objDiv.scrollTop);
        });
        //往下
        $('#but_left_down').click(function() {
            //price_amount_list
            var objDiv = document.getElementById("price_amount_left_bottom_body");
            objDiv.scrollTop = objDiv.scrollTop + 10;
            //console.log(objDiv.scrollTop);
        });

        //置中
        /* $('#but_left_mid').click(function() {
             //price_amount_list
             var objDiv = document.getElementById("price_amount_left_bottom_body");
             objDiv.scrollTop = objDiv.scrollHeight / 2;
             //console.log(objDiv.scrollTop);
         });*/

        //電雷單
        $('#fast_order').click(function() {
            $('#div_menu_speed').hide();
            //$('#div_menu_amount').hide();
            $('#div_order_type').hide();
            $('#butStoreAll').prop("disabled", true);
        });
        //一般單
        $('#normal_order').click(function() {
            $('#div_menu_speed').show();
            //$('#div_menu_amount').show();
            $('#div_order_type').show();
            $('#butStoreAll').prop("disabled", false);
        });


    });
    // <!-- document.ready 結尾 -->

    //使用者下單
    function sendCmd(up_down) {
        var serArray = $("form").serializeArray();
        var cmd = {};
        for (var i = 0; i < serArray.length; i++) {
            cmd[serArray[i].name] = serArray[i].value;
        }

        var strStatus = $('#' + cmd.now_product_code).find('.status').html();

        /*if (strStatus == '參考用' || strStatus == '未開盤') {
            alertify.error("未開盤");
            return false;
        }*/

        //選雷電單時，自動改成市價單
        if ($('#fast_order').prop('checked')) {
            cmd.type = 2;
        }

        if (cmd.amount == '') {
            alertify.error("請輸入欲購買口數");
            return false;
        }
        if (isNaN(cmd.amount)) {
            alertify.error("口數必需為數字");
            return false;
        }

        if (cmd.type == 3 && $('#chkClose').prop('checked') == true) {
            alertify.error("收盤全平，不允許下收盤單");
            return false;
        }

        var obj = lastestProduct[selectedProduct];

        var price_code = $('#' + cmd.now_product_code).attr('price_code');

        var serv_cmd = {};
        if (cmd.type == 3) {
            serv_cmd.cmd = 'closeOrder';
        } else {
            serv_cmd.cmd = 'preOrder';
        }

        serv_cmd.token = QueryString('token');
        serv_cmd.data = {
            "product_code": cmd.now_product_code,
            "price_code": price_code,
            "up_down": up_down,
            "amount": cmd.amount,
            "delay": cmd.delay,
            "type": cmd.type,
            "now_price": obj.buy_1_price,
            "limitPrice": cmd.limitPrice,
            "up_limit": cmd.stop_up,
            "down_limit": cmd.stop_down
        };
        //alert(JSON.stringify(serv_cmd));
        doSend(JSON.stringify(serv_cmd));
        //alertify.success("已送出交易");
        $('#amount').val('');
    }


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

    function load_closeOffset(product_code) {
        //alert(product_code);
        var obj = ajaxSave({ 'product_code': product_code }, 'operation/load_closeOffset');
        obj.success(function(res) {
            //alert(res.isCloseOffset);

            if (res.isCloseOffset == '1') {
                $('#chkClose').prop('checked', true);
            } else {
                $('#chkClose').prop('checked', false);
            }
            //alertify.success('訂單處理中');

        });

    }


    function onOpen(evt) {
        var token = QueryString('token');
        // writeToScreen("CONNECTED"); 
        doSend('{"cmd":"login" ,"token":"' + token + '"}');
        $('#loading').fadeOut("slow", function() {});
        //render(token);
    }

    function onClose(evt) {
        //render('closed');
        //$('#loading').show();
        //ws =  BuildWebSocket() ;
        //writeToScreen("DISCONNECTED"); 
        window.location = 'login';
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
        var obj = JSON.parse(evt.data);

        if (typeof obj.type == null) {
            render(JSON.stringify(obj));
        }

        //render(JSON.stringify(obj));
        switch (obj.type) {
            case 0: //接收商品價格
                //render(JSON.stringify(obj.data));
                updateProduct(obj.data);

                lastestProduct[obj.data.product_code] = obj.data;
                //render(obj.data.product_code + " = " + lastestProduct[obj.data.product_code].buy_1_price + "<br><br>");

                //在收到價格，更新 分價揭示 ，
                if (obj.data.product_code == selectedProduct) {
                    newPrice(obj.data);
                    nowSelectedPrice = obj.data.new_price;
                }
                break;

            case 1: //接收五檔報價
                //render(JSON.stringify(obj));
                lastestFivePrice[obj.price_no] = obj.data;

                if (obj.price_no == price_no) {
                    updateFivePrice(obj.data);
                }

                break;
            case 3: //從user_order.php更新回來訂單資料

                //更新 買賣下單列表
                //var data = obj.data;
                //console.log(JSON.stringify(obj.list2));
                orderList1(obj.list1, obj.user_product);
                orderList2(obj.list2, obj.user_product);
                orderList3(obj.list3);
                orderList4(obj.list2, obj.list3);

                $('#serverTime').html(obj.serverTime);

                updateProductStatus(obj.product_status);

                //系統提示使用者訊息
                if (obj.msg != null) {
                    if (obj.msg.length > 0) {
                        for (var k = 0; k < obj.msg.length; k++) {
                            if (obj.msg[k].type == 1) {
                                alertify.success(JSON.stringify(obj.msg[k].msg));
                            } else {
                                alertify.error(JSON.stringify(obj.msg[k].msg));
                            }
                        }
                    }
                }
                //未平倉列表
                // $('#nowOrderList').html('');
                //$('#nowOrderList').html(strOrder1);

                //已平倉列表
                // $('#storeOrderList').html('');
                //$('#storeOrderList').html(strOrder1);

                break;

            case 4: //錯誤訊息
                if (obj.code != 0) {
                    showLoginFailMessage(obj.code);
                    return;
                }

                if (obj.data == null) {
                    showLoginFailMessage(404);
                    return;
                }

                $(".show_name").text = obj.data.show_name;
                $(".service_name").text = obj.data.service_name;
                $(".service_tel").text = obj.data.service_tel;
                $(".default_money").text = obj.data.default_money;
                $(".user_money").text = obj.data.user_money;
                break;

            default:
        }

    }

    //買賣下單列表 －－處理欄位資料
    function orderList1(data, user_product) {
        if (data == null) {
            return false;
        }
        var img = '<img src="' + webroot + '/assets/img/loading.gif" width="10" >';
        var del_icon = '<img src="' + webroot + '/assets/img/delete.png" width="15" title="刪除" />';
        var edit_icon = '<img src="' + webroot + '/assets/img/edit2.png" width="15" title="修改" />';

        //console.log(user_product[0].product_code);

        var list = []; //處理後的資料

        for (var i = 0; i < data.length; i++) {

            //跳過已平倉
            //if (data[i].type == 'sto_orders') {
            //    continue;
            //}
            //未成交單據
            if ($('#chk_list1_unoffset').prop('checked')) {
                //console.log(data[i].type);
                //console.log(data[i].status);

                if (data[i].type == 'sto_orders')
                    continue;
            }

            //抓出此張訂單商品，對應使用者商品設定，停利損需》＝ ？點
            var loss = '';
            var profit = '';
            for (j = 0; j < user_product.length; j++) {
                //console.log(data[i].product_code + "==" + user_product[j].product_code);
                if (data[i].product_code == user_product[j].product_code) {
                    loss = user_product[j].stop_loss;
                    profit = user_product[j].stop_profit;
                }
            }

            //列表置底
            if ($('#chk_list1_bottom').prop('checked')) {
                var objDiv = document.getElementById("list1_right_middle_body_bottom");
                objDiv.scrollTop = objDiv.scrollHeight;
            }
            var color = '';
            if (data[i].up_down == 'up')
                color = 'style="color:red"';
            if (data[i].up_down == 'down')
                color = 'style="color:green;"';
            var row = {};
            var type = data[i].type;
            var status = data[i].status;

            //列表上每筆資料的編號
            row.key = 'list1_' + data[i].type + '_' + data[i].order_id;

            row.co1 = '';
            if (data[i].type == 'orders' && data[i].status == 0) {
                row.co1 = '<input id="but_' + data[i].order_id + '" type="button" value="平倉" onclick="storeProduct(' + data[i].order_id + ')" />';
            } else if (data[i].type == 'pre_orders') {
                if (data[i].order_type == 4) {
                    row.co1 = '<button type="button" onclick="deletePreorder(' + data[i].pre_id + ');">' + del_icon + '</button>';
                    row.co1 += '&nbsp;<button type="button" onclick="open_modify_limit(' + data[i].pre_id + ',' + data[i].amount + ',\'' + data[i].product_code + '\');">' + edit_icon + '</button>';
                }

            } else if (data[i].type == 'close_order') {
                row.co1 = '<button type="button"  onclick="deleteCloseorder(' + data[i].pre_id + ');" >' + del_icon + '</button>';
            } else {
                row.co1 = '';
            }

            row.co2 = data[i].order_id;
            row.co3 = '<span ' + color + '>' + data[i].name + '</span>';
            row.co4 = '';

            if (data[i].up_down == 'up') {
                row.co5 = '<span ' + color + '>多</span>';
            } else {
                row.co5 = '<span ' + color + '>空</span>';
            }


            switch (data[i].order_type) {
                case '1':
                    row.co6 = '<span ' + color + '>批分價</span>';
                    break;

                case '2':
                    row.co6 = '<span ' + color + '>市價</span>';
                    break;

                case '3':
                    row.co6 = '<span ' + color + '>收盤價</span>';
                    break;

                case '4':
                    row.co6 = '<span ' + color + '>' + data[i].now_price + '</span>';
                    break;
            }

            //if(type=='close_order')
            //{

            //}

            var sAmount = '<span ' + color + '>' + data[i].amount + '</span>';

            if (data[i].amount != data[i].remaining_amount) {
                sAmount += '<span ' + color + '> (' + data[i].remaining_amount + ')</span>';
            }
            row.co7 = sAmount;

            row.co8 = '<span ' + color + '>' + data[i].price + '</span>';
            row.co9 = '<span ' + color + '>' + removeDate(data[i].action_time) + '</span>';
            row.co10 = '<span ' + color + '>' + removeDate(data[i].finish_time) + '</span>';
            row.co11 = '<span ' + color + '>一般</span>';

            //獲利點數
            var point = 0;
            if (type == 'orders') {
                var obj = lastestProduct[data[i].code];
                var sellPrice = obj.sell_1_price;

                if (data[i].up_down == 'up') {
                    point = sellPrice - data[i].price;
                } else {
                    point = data[i].price - sellPrice;
                }
            }



            var loss_enable = 'disabled';
            //if (loss > 0) {
            //    loss_enable = '';
            //}
            var profit_enable = 'disabled';
            //if (profit > 0) {
            //    profit_enable = '';
            // }
            if (loss == 0) {
                loss = '無';
            }
            if (profit == 0) {
                profit = '無';
            }

            if (type == 'orders') {
                if (data[i].status == 0) {
                    if (loss > 0) {
                        loss_enable = '';
                    }

                    if (profit > 0) {
                        profit_enable = '';
                    }


                } else {
                    loss_enable = 'disabled';
                    profit_enable = 'disabled';

                }
            } else {
                loss_enable = 'disabled';
                profit_enable = 'disabled';
            }
            row.co12 = '<button ' + loss_enable + ' style="width:50px;" onclick="resetLimit(\'' + data[i].pre_id + '\' , \'down\')"  type="button">' + loss + '</button>';
            row.co13 = '<button ' + profit_enable + ' style="width:50px;" onclick="resetLimit(\'' + data[i].pre_id + '\' , \'up\')"  type="button">' + profit + '</button>';


            switch (type) {
                case 'pre_orders':
                    row.co14 = img + '未成交';
                    break;
                case 'close_order':
                    row.co14 = img + '收盤單';
                    break;
                case 'orders':
                    if (data[i].status == 2) {
                        row.co14 = img + '平倉中';
                    } else {
                        row.co14 = '已成交';
                    }

                    break;
                case 'sto_orders':
                    row.co14 = '已平倉';
                    if (data[i].isStore == 1)
                        row.co14 += '(平倉單)';
                    break;
            }


            list.push(row);


        }
        updateList1(list);
    }

    function removeDate(datetime) {
        if (datetime == null)
            return '';
        var arrTime = datetime.split(' ');
        if (arrTime.length == 2)
            return arrTime[1];
        else
            return '';
    }

    function updateProductStatus(list) {
        //console.log(list.length);
        for (var i = 0; i < list.length; i++) {
            //跳過加權期
            //console.log(list[i].code);
            if (list[i].code != 'TS') {
                $('#' + list[i].code).find('.status').html(list[i].status);
            }
        }
    }

    //將處理完的資料，組成HTML
    function updateList1(list) {
        //一直刷新table 頁面
        var html = '';

        for (var i = 0; i < list.length; i++) {
            var obj = $('#' + list[i]['key']).length;
            var rowID = list[i]['key'];

            html += '<tr id="' + rowID + '">';
            for (var index in list[i]) {
                if (index == 'key')
                    continue;
                html += '<td class="' + index + '">' + list[i][index] + '</td>';
            }
            html += '</tr>';
        }
        $('#orderList').html(html);
    }

    //手動設定停損停利
    function resetLimit(pre_id, up_down) {
        //alert(pre_id + ',' + up_down);

        //清空控制項，恢復預設值
        $('#selected_order_id').val(pre_id);
        $('#loss_point').val(0);
        $('#profit_point').val(0);

        //讀取此筆訂單，停損停利
        var obj = ajaxSave({
            'pre_id': pre_id
        }, 'operation/loadLimit');
        obj.success(function(res) {
            //alert(JSON.stringify(res));
            $('#loss_point').val(res['down_limit']);
            $('#profit_point').val(res['up_limit']);
        });

        //開啟視窗
        $.colorbox({
            inline: true,
            href: "#divLimit",
            width: '50%',
            height: '50%'
        });

    }

    function saveLimit() {
        var id = $('#selected_order_id').val();

        var model = {
                'pre_id': id,
                'loss': $('#loss_point').val(),
                'profit': $('#profit_point').val()
            }
            //alert(JSON.stringify(model));
        var obj = ajaxSave(model, 'operation/saveLimit');
        obj.success(function(res) {
            //alert(JSON.stringify(res.msg));
            if (res.msg == 'success') {
                alertify.success('儲存成功');
                window.parent.close();
            } else {
                alertify.error('儲存失敗');
                // window.parent.closer();
            }
        });

        $('#selected_order_id').val('');
        $('#loss_point').val(0);
        $('#profit_point').val(0);

    }

    //計算損益
    function getProfit(row_id) {

        //正式單
        /*
        if (orderData[i].type == "orders") {
            var lastProduct = lastestProduct[orderData[i].code];
            if (lastProduct != null) {
                var profit = lastProduct.sell_1_price - orderData[i].pre_price;

                if (orderData[i].price != 0) {
                    profit = orderData[i].price - orderData[i].pre_price;
                }
                if (orderData[i].up_down == 'down') {
                    profit = profit * -1;
                }


                if (profit > 0) {
                    strOrder1 += '<td >&nbsp;</td>';
                    strOrder1 += '<td >' + profit + '</td>';
                } else if (profit == 0) {
                    strOrder1 += '<td >&nbsp;</td>';
                    strOrder1 += '<td >&nbsp;</td>';
                } else {
                    strOrder1 += '<td >' + profit + '</td>';
                    strOrder1 += '<td >&nbsp;</td>';
                }

            }
            //掛單
        } else {
            strOrder1 += '<td >&nbsp;</td>';
            strOrder1 += '<td >&nbsp;</td>';
        }*/

    }

    //未平倉
    function orderList2(data, user_product) {
        if (data == null) {
            return false;
        }

        //初始化倉位數量
        var unoffset_count = {};
        $('.productItem').each(function() {
            var code = $(this).attr('id');
            unoffset_count[code] = { 'count': 0, 'color': 'black' };
        });




        var img = '<img src="' + webroot + '/assets/img/loading.gif" width="10" >';
        var list = []; //處理後的資料

        for (var i = 0; i < data.length; i++) {
            //列表上每筆資料的編號
            var row = {};
            row.key = 'list2_' + data[i].order_id;

            //若有狀態為完成的，把它從列表上移除
            //console.log(data[i]);
            if (data[i].status == 1) {
                $('#' + row.key).remove();
                //console.log($('#' + row.key));
                continue;
            }


            //抓出此張訂單商品，對應使用者商品設定，停利損需》＝ ？點
            var loss = '';
            var profit = '';
            for (j = 0; j < user_product.length; j++) {
                //console.log(data[i].product_code + "==" + user_product[j].product_code);
                if (data[i].product_code == user_product[j].product_code) {
                    loss = user_product[j].stop_loss;
                    profit = user_product[j].stop_profit;
                }
            }

            //記錄未平倉數，更新至報價單
            if (unoffset_count[data[i].code] != null) {
                unoffset_count[data[i].code].count += Number(data[i].remaining_amount);
            } else {
                unoffset_count[data[i].code].count = Number(data[i].remaining_amount);
            }

            var color = '';
            if (data[i].up_down == 'up') {
                color = 'style="color:red"';
                unoffset_count[data[i].code].color = 'red';
            }
            if (data[i].up_down == 'down') {
                color = 'style="color:green;"';
                unoffset_count[data[i].code].color = 'green';
            }
            var type = data[i].type;
            var status = data[i].status;
            row.co1 = data[i].order_id;

            if (data[i].status == 2) {
                row.co2 = '';
            } else {
                row.co2 = '<input type="button" onclick="storeOrder(' + data[i].order_id + ');" value="平倉" />';
            }
            row.co3 = '<span ' + color + '>' + data[i].name + '</span>';
            if (data[i].up_down == 'up') {
                row.co4 = '<span ' + color + '>多</span>';
            } else {
                row.co4 = '<span ' + color + '>空</span>';
            }

            switch (data[i].type) {
                case '1':
                    row.co5 = '<span ' + color + '>批分單</span>';
                    break;
                case '2':
                    row.co5 = '<span ' + color + '>市價單</span>';
                    break;
                case '3':
                    row.co5 = '<span ' + color + '>收盤單</span>';
                    break;
                case '4':
                    row.co5 = '<span ' + color + '>限價單</span>';
                    break;
            }


            row.co6 = '<span ' + color + '>' + data[i].price + '</span>';
            row.co7 = '<span ' + color + '>' + data[i].amount + '</span>';


            var buyCharge = 0;
            var product_price = 0;
            switch (data[i].charge_type) {
                case '0': //代理
                    buyCharge = data[i].buy_charge;
                    product_price = data[i].price_agent;
                    break;
                case '1': //大
                    buyCharge = data[i].buy_charge_large;
                    product_price = data[i].price_large;
                    break;
                case '2': //中
                    buyCharge = data[i].buy_charge_med;
                    product_price = data[i].price_med;
                    break;
                case '3': //小
                    buyCharge = data[i].buy_charge_small;
                    product_price = data[i].price_small;
                    break;
                case '4': //迷你
                    buyCharge = data[i].buy_charge_mini;
                    product_price = data[i].price_mini;
                    break;
            }
            buyCharge = buyCharge * data[i].amount;
            row.co8 = '<span ' + color + '>' + buyCharge + '</span>';

            //獲利點數
            var point = 0;

            var obj = lastestProduct[data[i].code];
            var sellPrice = obj.sell_1_price;

            if (data[i].up_down == 'up') {
                point = sellPrice - data[i].price;
            } else {
                point = data[i].price - sellPrice;
            }

            var loss_enable = '';
            if (loss == 0) {
                loss_enable = 'disabled';
                loss = '無';
            }
            var profit_enable = '';
            if (profit == 0) {
                profit_enable = 'disabled';
                profit = '無';
            }
            row.co9 = '<button ' + loss_enable + ' style="width:50px;" onclick="resetLimit(\'' + data[i].pre_id + '\' , \'down\')"  type="button">' + loss + '</button>';
            row.co10 = '<button ' + profit_enable + ' style="width:50px;" onclick="resetLimit(\'' + data[i].pre_id + '\' , \'up\')"  type="button">' + profit + '</button>';

            row.co11 = '';


            var win_loss = data[i].amount * product_price * point - (buyCharge);
            if (win_loss > 0) {
                row.co12 = '<span style="color:blue;">' + win_loss + '</span>';
            } else if (win_loss < 0) {
                row.co12 = '<span style="color:red;">' + win_loss + '</span>';
            } else {
                row.co12 = win_loss;
            }

            //row.co12 = data[i].productPrice * point;

            if (point > 0) {
                row.co13 = '<span style="color:red">▲' + point + '</span>';
            } else if (point < 0) {
                var removeNe = point * -1;
                row.co13 = '<span style="color:green">▼' + removeNe + '</span>';
            } else {
                row.co13 = point;
            }
            //row.co13 = point;

            row.co14 = '0';
            if (data[i].status == 0) {
                row.co15 = '';
            } else if (data[i].status == 2) {
                row.co15 = img + '平倉中';
            }
            list.push(row);
        }
        updateList2(list);

        //更新報價上的倉位
        //alert(JSON.stringify(unoffset_count));
        //console.log(JSON.stringify(unoffset_count));        

        var up_count = 0;
        var down_count = 0;
        //設定報價單上的倉數
        for (var index in unoffset_count) {
            $('#' + index).find('.store').html('<sapn style="color:' + unoffset_count[index].color + ';">' + unoffset_count[index].count + '</span>');

            if (unoffset_count[index].color == 'red') {
                up_count += unoffset_count[index].count;
            }
            if (unoffset_count[index].color == 'green') {
                down_count += unoffset_count[index].count;
            }
        }

        //未平倉頁纖上顯示的多，空，數量
        $('#title_unoffset_up_count').html(up_count);
        $('#title_unoffset_down_count').html(down_count);


    }

    function updateList2(list) {
        var html = '';

        for (var i = 0; i < list.length; i++) {
            var rowID = list[i]['key'];

            //console.log($('#' + rowID).attr('id'));
            //alert(obj);
            //用編好的ID去找，有找到此筆資料

            if ($('#' + rowID).attr('id') != null) {
                for (var index in list[i]) {
                    if (index == 'key')
                        continue;
                    $('#' + rowID).find('.' + index).html(list[i][index]);
                }

            } else {
                html = '<tr id="' + rowID + '">';
                for (var index in list[i]) {
                    if (index == 'key') {
                        html += '<td class="' + index + '"><input class="chkList2" id="chk_' + list[i][index] + '" type="checkbox" /></td>';
                    } else {
                        html += '<td class="' + index + '">' + list[i][index] + '</td>';
                    }
                }

                html += '</tr>';
                $('#nowOrderList').append(html);
                //}
            }

        }
    }

    //己平倉
    function orderList3(data) {
        //alert(list);
        var img = '<img src="' + webroot + '/assets/img/loading.gif" width="10" >';
        var list = []; //處理後的資料

        //console.log(data);

        for (var i = 0; i < data.length; i++) {
            //列表上每筆資料的編號
            var row = {};
            row.key = 'list3_' + data[i].rel_id;

            var color = '';
            if (data[i].up_down == 'up')
                color = 'style="color:red"';
            if (data[i].up_down == 'down')
                color = 'style="color:green;"';

            row.co1 = data[i].name;

            row.co2 = data[i].newID;
            row.co3 = data[i].stoID;

            switch (data[i].type1) {
                case '1':
                    row.co4 = '批分單';
                    break;
                case '2':
                    row.co4 = '市價單';
                    break;
                case '3':
                    row.co4 = '收盤單';
                    break;
                case '4':
                    row.co4 = '限價單';
                    break;
            }
            switch (data[i].type2) {
                case '1':
                    row.co5 = '批分單';
                    break;
                case '2':
                    row.co5 = '市價單';
                    break;
                case '3':
                    row.co5 = '收盤單';
                    break;
                case '4':
                    row.co5 = '限價單';
                    break;
            }

            row.co6 = data[i].amount;
            if (data[i].up_down == 'up')
                row.co7 = '多';
            else
                row.co7 = '空';


            row.co8 = data[i].price;
            row.co9 = data[i].stoPrice;
            row.co10 = removeDate(data[i].buyTime);
            row.co11 = removeDate(data[i].sellTime);

            //獲利點數
            var point = 0;
            if (data[i].up_down == 'up') {
                point = data[i].stoPrice - data[i].price;
            } else {
                point = data[i].price - data[i].stoPrice;
            }

            if (point > 0) {
                row.co12 = '<span style="color:red">▲' + point + '</span>';
            } else if (point < 0) {
                var removeNe = point * -1;
                row.co12 = '<span style="color:green">▼' + removeNe + '</span>';
            } else {
                row.co12 = point;
            }


            row.co13 = '';

            var buyCharge = 0;
            var product_price = 0;
            switch (data[i].charge_type) {
                case '0': //代理
                    buyCharge = data[i].buy_charge;
                    product_price = data[i].price_agent;

                    break;
                case '1': //大
                    buyCharge = data[i].buy_charge_large;
                    product_price = data[i].price_large;
                    break;
                case '2': //中
                    buyCharge = data[i].buy_charge_med;
                    product_price = data[i].price_med;
                    break;
                case '3': //小
                    buyCharge = data[i].buy_charge_small;
                    product_price = data[i].price_small;
                    break;
                case '4': //迷你
                    buyCharge = data[i].buy_charge_mini;
                    product_price = data[i].mini;
                    break;
            }
            buyCharge = buyCharge * data[i].amount;

            var sellCharge = 0;
            switch (data[i].charge_type) {
                case '0': //代理
                    sellCharge = data[i].sell_charge;
                    break;
                case '1': //大
                    sellCharge = data[i].sell_charge_large;
                    break;
                case '2': //中
                    sellCharge = data[i].sell_charge_med;
                    break;
                case '3': //小
                    sellCharge = data[i].sell_charge_small;
                    break;
                case '4': //迷你
                    sellCharge = data[i].sell_charge_mini;
                    break;
            }
            sellCharge = sellCharge * data[i].sto_amount;

            row.co14 = buyCharge + sellCharge;

            var win_loss = data[i].amount * product_price * point - (buyCharge + sellCharge);
            //console.log(product_price + "*" + point + "-" + "(" + buyCharge + "+" + sellCharge + ")");
            if (win_loss > 0) {
                row.co15 = '<span style="color:blue;">' + win_loss + '</span>';
            } else if (win_loss < 0) {
                row.co15 = '<span style="color:red;">' + win_loss + '</span>';
            } else {
                row.co15 = win_loss;
            }
            list.push(row);
        }
        updateList3(list);
        //未平倉列表
        //$('#storeOrderList').html(strOrder3);
    }


    function updateList3(list) {
        var html = '';

        for (var i = 0; i < list.length; i++) {
            var obj = $('#' + list[i]['key']).length;
            var rowID = list[i]['key'];

            //用編好的ID去找，有找到此筆資料


            html += '<tr id="' + rowID + '">';
            for (var index in list[i]) {
                if (index == 'key') {
                    //html += '<td class="' + index + '"><input class="list2" id="chk_' + list[i][index] + '" type="checkbox" /></td>';
                } else {
                    html += '<td class="' + index + '">' + list[i][index] + '</td>';
                }
            }
            //continue;


            html += '</tr>';

        }
        $('#storeOrderList').html(html);
    }

    //商品統計
    function orderList4(list2, list3) {

        var arrProduct = [];
        //未平倉
        for (var i = 0; i < list2.length; i++) {
            //排除已處理完的訂單(上面列表保留，是為了要將己處理完畢的訂單從TABLE上移除)
            if (list2[i].status == 1)
                continue;
            //手續費
            var buyCharge = 0;
            var product_price = 0;
            switch (list2[i].charge_type) {
                case '0': //代理
                    buyCharge = list2[i].buy_charge;
                    product_price = list2[i].price_agent;
                    break;
                case '1': //大
                    buyCharge = list2[i].buy_charge_large;
                    product_price = list2[i].price_large;
                    break;
                case '2': //中
                    buyCharge = list2[i].buy_charge_med;
                    product_price = list2[i].price_med;
                    break;
                case '3': //小
                    buyCharge = list2[i].buy_charge_small;
                    product_price = list2[i].price_small;
                    break;
                case '4': //迷你
                    buyCharge = list2[i].buy_charge_mini;
                    product_price = list2[i].price_mini;
                    break;
            }
            buyCharge = buyCharge * list2[i].amount;

            var sellCharge = 0;
            switch (list2[i].charge_type) {
                case '0': //代理
                    sellCharge = list2[i].sell_charge;
                    break;
                case '1': //大
                    sellCharge = list2[i].sell_charge_large;
                    break;
                case '2': //中
                    sellCharge = list2[i].sell_charge_med;
                    break;
                case '3': //小
                    sellCharge = list2[i].sell_charge_small;
                    break;
                case '4': //迷你
                    sellCharge = list2[i].sell_charge_mini;
                    break;
            }
            sellCharge = sellCharge * list2[i].amount;

            //獲利點數
            var point = 0;
            var obj = lastestProduct[list2[i].code];
            var sellPrice = obj.sell_1_price;

            if (list2[i].up_down == 'up') {
                point = sellPrice - list2[i].price;
            } else {
                point = list2[i].price - sellPrice;
            }

            //損益
            var win_loss = list2[i].amount * product_price * point - (buyCharge + sellCharge);
            //console.log(product_price + "*" + point + "-" + "(" + buyCharge + "+" + sellCharge + ") = " + win_loss);

            var isEqual = false;
            for (var k = 0; k < arrProduct.length; k++) {
                if (list2[i].code == arrProduct[k].code) {

                    if (list2[i].up_down == 'up') {
                        arrProduct[k].upAmount += Number(list2[i].amount);
                        //arrProduct[k].downAmount = 0;
                    } else {
                        //newItem.upAmount = 0;
                        arrProduct[k].downAmount += Number(list2[i].amount);
                    }
                    arrProduct[k].remaining_amount += Number(list2[i].remaining_amount);
                    arrProduct[k].total += Number(list2[i].amount);
                    arrProduct[k].charge += Number(buyCharge);
                    arrProduct[k].win_loss += win_loss;
                    arrProduct[k].preStore += 0;

                    isEqual = true;
                    break;
                }
            }
            //建立新的一筆資料
            if (isEqual == false) {
                var newItem = {};
                newItem.name = list2[i].name;
                newItem.code = list2[i].code;


                if (list2[i].up_down == 'up') {
                    newItem.upAmount = Number(list2[i].amount);
                    newItem.downAmount = 0;
                } else {
                    newItem.upAmount = 0;
                    newItem.downAmount = Number(list2[i].amount);
                }
                newItem.remaining_amount = Number(list2[i].remaining_amount);
                newItem.total = Number(list2[i].amount) + Number(list2[i].remaining_amount);
                newItem.charge = Number(buyCharge);
                newItem.win_loss = win_loss;
                newItem.preStore = 0;
                arrProduct.push(newItem);
            }
        }

        //已平倉
        for (var i = 0; i < list3.length; i++) {

            var buyCharge = 0;
            var product_price = 0;
            switch (list3[i].charge_type) {
                case '0': //代理
                    buyCharge = list3[i].buy_charge;
                    product_price = list3[i].price_agent;
                    break;
                case '1': //大
                    buyCharge = list3[i].buy_charge_large;
                    product_price = list3[i].price_large;
                    break;
                case '2': //中
                    buyCharge = list3[i].buy_charge_med;
                    product_price = list3[i].price_med;
                    break;
                case '3': //小
                    buyCharge = list3[i].buy_charge_small;
                    product_price = list3[i].price_small;
                    break;
                case '4': //迷你
                    buyCharge = list3[i].buy_charge_mini;
                    product_price = list3[i].price_mini;
                    break;
            }
            buyCharge = buyCharge * list3[i].amount;

            var sellCharge = 0;
            switch (list3[i].charge_type) {
                case '0': //代理
                    sellCharge = list3[i].sell_charge;
                    break;
                case '1': //大
                    sellCharge = list3[i].sell_charge_large;
                    break;
                case '2': //中
                    sellCharge = list3[i].sell_charge_med;
                    break;
                case '3': //小
                    sellCharge = list3[i].sell_charge_small;
                    break;
                case '4': //迷你
                    sellCharge = list3[i].sell_charge_mini;
                    break;
            }
            sellCharge = sellCharge * list3[i].sto_amount;

            //獲利點數
            var point = 0;
            var sPrice = 0;
            if (list3[i].stoPrice != '') {
                sPrice = list3[i].stoPrice;
            }
            if (list3[i].up_down == 'up') {

                point = sPrice - list3[i].price;
            } else {
                point = list3[i].price - sPrice;
            }
            //console.log(point);
            //損益
            var win_loss = list3[i].amount * product_price * point - (buyCharge + sellCharge);
            //console.log(product_price + "*" + point + "-" + "(" + buyCharge + "+" + sellCharge + ") = " + win_loss);

            //比對陣列的值
            var isEqual = false;
            for (var k = 0; k < arrProduct.length; k++) {
                if (list3[i].code == arrProduct[k].code) {

                    if (list3[i].up_down == 'up') {
                        arrProduct[k].upAmount += Number(list3[i].amount);
                        arrProduct[k].downAmount += Number(list3[i].sto_amount);
                    } else {
                        arrProduct[k].upAmount += Number(list3[i].sto_amount);
                        arrProduct[k].downAmount += Number(list3[i].amount);
                    }
                    //arrProduct[k].remaining_amount += Number(list3[i].sto_amount);
                    arrProduct[k].total += Number(list3[i].amount) + Number(list3[i].sto_amount);
                    arrProduct[k].charge += Number(buyCharge + sellCharge);
                    arrProduct[k].win_loss += win_loss;
                    arrProduct[k].preStore += 0;

                    isEqual = true;
                    break;
                }
            }

            //建立新的一筆資料
            if (isEqual == false) {
                var newItem = {};
                newItem.name = list3[i].name;
                newItem.code = list3[i].code;


                if (list3[i].up_down == 'up') {
                    newItem.upAmount = Number(list3[i].amount);
                    newItem.downAmount = Number(list3[i].sto_amount);
                } else {
                    newItem.upAmount = Number(list3[i].sto_amount);
                    newItem.downAmount = Number(list3[i].amount);
                }
                newItem.remaining_amount = 0;
                newItem.total = Number(list3[i].amount) + Number(list3[i].sto_amount);
                newItem.charge = Number(buyCharge + sellCharge);
                newItem.win_loss = win_loss;
                newItem.preStore = 0;
                arrProduct.push(newItem);
            }
        }

        //串出商品統計的 html
        var totalProfit = 0;
        var html = '';
        for (var m = 0; m < arrProduct.length; m++) {
            html += '<tr>';

            for (var index in arrProduct[m]) {
                if (index == 'code')
                    continue;
                if (index == 'win_loss') {
                    if (arrProduct[m][index] > 0) {
                        html += '<td style="color:blue;">' + arrProduct[m][index] + '</td>';
                    } else if (arrProduct[m][index] < 0) {
                        html += '<td style="color:red;">' + arrProduct[m][index] + '</td>';
                    } else {
                        html += '<td>' + arrProduct[m][index] + '</td>';
                    }
                    totalProfit += Number(arrProduct[m][index]);
                    //console.log(index);
                    //alert(totalProfit);
                } else {
                    html += '<td>' + arrProduct[m][index] + '</td>';
                }
            }
            html += '</tr>';
        }
        $('#list_static').html(html);



        //處理者用者損益
        var userMoney = Number($('#user_money').val());

        //console.log(totalProfit);

        if (totalProfit != null) {
            userMoney += totalProfit;
        }

        //帳戶餘額
        $('#li_user_money').html(userMoney);
        $('#li_user_money2').html(userMoney);


        var strProfit = totalProfit;
        if (totalProfit > 0) {
            strProfit = '<span style="color:red;">' + strProfit + '</span>';
        }
        if (totalProfit < 0) {
            strProfit = '<span style="color:green;">' + strProfit + '</span>';
        }
        //今日損益
        $("#user_profit").html(strProfit);
        $("#user_profit2").html(strProfit);


    }

    function showLoginFailMessage(code) {
        var errMsg;

        switch (code) {
            case 401:
                errMsg = "此帳號目前暫停使用!!";
                break;

            case 403:
                errMsg = "此帳號已被凍結!!";
                break;

            default:
                errMsg = "登入失敗.錯誤代碼:" + code;
                break;
        }
        alertify.error(errMsg);
    }

    function trimDate(strDateTime) {
        var arrDate = strDateTime.split(' ');
        if (arrDate[1] == null)
            return "&nbsp;";
        if (arrDate[1] == "00:00:00")
            return "&nbsp;";

        return arrDate[1];
    }

    function render(str) {
        $('body').append('<p>' + str + '</p>');
    }

    //指定特定商品平倉
    function storeProduct(id) {
        //var arrID = id.split('_');
        //$("#" + id).hide();

        var serv_cmd = {};
        serv_cmd.cmd = 'storeOrder';
        serv_cmd.token = QueryString('token');
        serv_cmd.data = {
            "orderID": id
        };
        //{"cmd":"preOrder","token":" DD5F125C-12E9-07A1-3232-01282A23FB71","data":{"product_code":"TN","up_down":"up","amount":1,"up_limit":199,"down_limit":50}}
        //storing.push(arrID[1]);
        doSend(JSON.stringify(serv_cmd));
        alertify.success('送出訂單平倉');
    }

    //刪除收盤單
    function deleteCloseorder(id) {

        var model = { 'id': id }
        var obj = ajaxSave(model, 'operation/deleteCloseorder');
        obj.success(function(res) {
            if (res.msg == 'success') {
                alertify.success('刪除收盤單成功');
            } else {
                alertify.error('刪除收盤單失敗');
            }
        });
    }

    //刪除掛單
    function deletePreorder(id) {

        var model = { 'id': id }
        var obj = ajaxSave(model, 'operation/deletePreorder');
        //alert(JSON.stringify(model));
        obj.success(function(res) {
            if (res.msg == 'success') {
                alertify.success('刪除掛單成功');
            } else {
                alertify.error('刪除掛單失敗');
            }
        });
    }

    //修改限價單
    function updateLimitOrder(id) {
        alertify.success('修改限價單');
    }



    //五檔報價       
    function updateFivePrice(obj) {
        //render(JSON.stringify(obj));
        var html = '';
        if (obj != null) {
            var totalBuy = Number(obj['buy_2_amount']) + Number(obj['buy_3_amount']) + Number(obj['buy_4_amount']) + Number(obj['buy_5_amount']);
            var totalSell = Number(obj['sell_2_amount']) + Number(obj['sell_3_amount']) + Number(obj['sell_4_amount']) + Number(obj['sell_5_amount']);

            for (var i = 5; i >= 1; i--) {
                var percentage = Number(obj['sell_' + i + '_amount']) / totalSell;
                var width = 50 * percentage;
                width = Math.round(width);
                html += '<ul class="list2">';
                html += '                   <li class="item2 one">';
                html += '                  </li>';
                html += '                   <li class="item2 two"></li>';
                html += '                   <li class="item2 three">' + obj['sell_' + i + '_price'] + '</li>';
                html += '                   <li class="item2 four">' + obj['sell_' + i + '_amount'] + '</li>';
                html += '                   <li class="item2 five">xx';
                html += '                       <div style="width:' + width + 'px;">xx</div>';
                html += '                   </li>';
                html += '               </ul>';
            }

            html += '<ul class="list2">';
            html += '                   <li class="item2 one">';
            html += '                  </li>';
            html += '                   <li class="item2 two"></li>';
            html += '                   <li class="item2 three">' + nowSelectedPrice + '</li>';
            html += '                   <li class="item2 four"></li>';
            html += '                   <li class="item2 five">xx';
            html += '                   </li>';
            html += '               </ul>';

            for (var i = 1; i < 6; i++) {
                var percentage2 = Number(obj['buy_' + i + '_amount']) / totalBuy; //sdfsdfsfsdfsd
                var width2 = 50 * percentage2;
                width2 = Math.round(width2);
                html += '<ul class="list2" >';
                html += '                   <li class="item2 one" >';
                html += '                      <div style="width:' + width2 + 'px;margin-top:-17px;"></div>';
                html += '                  </li>';
                html += '                   <li class="item2 two" >' + obj['buy_' + i + '_amount'] + '</li>';
                html += '                   <li class="item2 three">' + obj['buy_' + i + '_price'] + '</li>';
                html += '                   <li class="item2 four"></li>';
                //html += '                   <li class="item2 five">xx';
                //html += '                       <div>xx</div>';
                //html += '                   </li>';
                html += '               </ul>';
            }
        }
        $('#info1').html(html);
        $('#fivePrice_totalBuy').html(totalBuy);
        $('#fivePrice_totalSell').html(totalSell);

        var barWidth = Math.round(70 * (totalBuy / (totalBuy + totalSell))); //sdf
        var bar2Width = 70 - barWidth;
        //console.log(barWidth + "," + bar2Width);
        $("#fivePrice_totalBuyBar").css('width', barWidth + 'px');
        $("#fivePrice_totalSellBar").css('width', bar2Width + 'px');
    }

    //分價揭示
    function newPrice(obj) {
        if (obj == null)
            return;
        var arrTime = obj.create_date.split(' ');
        var upDown = '';
        if (obj.up_down_sign == '+')
            upDown = '<i class="fa fa-caret-up" aria-hidden="true"></i>';
        if (obj.up_down_sign == '-')
            upDown = '<i class="fa fa-caret-down" aria-hidden="true"></i>';

        var color = '';
        if (obj.up_down_sign == '+') {
            color = 'red';
        } else if (obj.up_down_sign == '-') {
            color = 'green';
        } else {
            color = 'black';
        }

        var strHtml = '<ul class="list2">'; //123asd
        strHtml += '<li class="item2 one">' + arrTime[1] + '</li>';
        strHtml += '<li class="item2 two">' + obj.now_amount + '</li>';
        strHtml += '<li class="item2 three" style="width:60px;color:' + color + '">' + upDown + ' ' + obj.up_down_count + '</li>';
        strHtml += '<li class="item2 four" style="color:' + color + ';padding-left:20px;">' + obj.new_price + '</li>';
        strHtml += '</ul>';
        //alert(strHtml);
        $('#info3').append(strHtml);


        if ($('#chk_bottom').prop('checked')) {
            var div = document.getElementById('info3');
            //alert(div.scrollTop + ","+ div.scrollHeight);
            div.scrollTop = div.scrollHeight;
            //div.scrollTop = 99999999999;
            //alert(div.scrollTop);

        }
    }

    //主要商品價格
    function updateProduct(obj) {
        var upDown = '';
        if (obj.up_down_sign == '+')
            upDown = '▲';
        if (obj.up_down_sign == '-')
            upDown = '▼';

        var color = '';
        if (obj.up_down_sign == '+') {
            color = 'red';
        } else if (obj.up_down_sign == '-') {
            color = 'green';
        } else {
            color = 'black';
        }

        var str = '<ul class="figure" id="' + obj.product_code + '" >';
        str += '        <li class="figure_result product name" >' + obj.name + '</li>';
        str += '        <li class="figure_result store" data-bind="text: store">0</li>';
        str += '        <li class="figure_result k" data-bind="text: k">x</li>';
        str += '        <li class="figure_result sit" data-bind="text: sit">x</li>';
        str += '        <li class="figure_result amount" data-bind="text: amount" style="color:' + color + ';">' + obj.new_price + '</li>';
        str += '        <li class="figure_result buy" data-bind="text: buy" style="color:' + color + ';">' + obj.buy_1_price + '</li>';
        str += '        <li class="figure_result sell" data-bind="text: sell" style="color:' + color + ';">' + obj.sell_1_price + '</li>';
        str += '        <li class="figure_result updown" data-bind="text: updown" style="color:' + color + ';">' + upDown + obj.up_down_count + '</li>';
        str += '        <li class="figure_result percentage" data-bind="text: percentage" style="color:' + color + ';">' + obj.up_down_rate + '</li>';
        str += '        <li class="figure_result total" data-bind="text: total" style="color:' + color + ';">' + obj.total_amount + '</li>';
        str += '        <li class="figure_result open" data-bind="text: open" style="color:' + color + ';">' + obj.open_price + '</li>';
        str += '        <li class="figure_result max" data-bind="text: max" style="color:' + color + ';">' + obj.high_price + '</li>';
        str += '        <li class="figure_result min" data-bind="text: min" style="color:' + color + ';">' + obj.low_price + '</li>';
        str += '        <li class="figure_result y_close" data-bind="text: y_close" style="color:' + color + ';">' + obj.last_close_price + '</li>';
        str += '        <li class="figure_result y_total" data-bind="text: y_total" style="color:' + color + ';">' + obj.last_new_price + '</li>';
        str += '        <li class="figure_result status" data-bind="text: status">' + obj.status_name + '</li>';
        str += '       <input type="hidden" class="price_no" value="' + obj.price_no + '"></input>';
        str += '    </ul>';

        var bool = false;
        $('.figure').each(function() {
            var orginColor = '#E7E7E7';

            $(this).find('.amount').css('background-color', orginColor);
            $(this).find('.buy').css('background-color', orginColor);
            $(this).find('.sell').css('background-color', orginColor);
            $(this).find('.buy').css('background-color', orginColor);
            $(this).find('.updown').css('background-color', orginColor);
            $(this).find('.percentage').css('background-color', orginColor);
            $(this).find('.total').css('background-color', orginColor);
            $(this).find('.open').css('background-color', orginColor);
            $(this).find('.max').css('background-color', orginColor);
            $(this).find('.min').css('background-color', orginColor);
            $(this).find('.y_close').css('background-color', orginColor);
            $(this).find('.y_total').css('background-color', orginColor);
            $(this).find('.status').css('background-color', orginColor);

            if (obj.product_code == $(this).attr('id')) {
                $(this).find('.amount').css('color', color);
                $(this).find('.buy').css('color', color);
                $(this).find('.sell').css('color', color);
                $(this).find('.buy').css('color', color);
                $(this).find('.updown').css('color', color);
                $(this).find('.percentage').css('color', color);
                $(this).find('.total').css('color', color);
                $(this).find('.open').css('color', color);
                $(this).find('.max').css('color', color);
                $(this).find('.min').css('color', color);
                $(this).find('.y_total').css('color', color);
                $(this).find('.y_close').css('color', color);

                //為了對應五價揭的資料
                $(this).find('.price_no').val(obj.price_no);
                //var properties = ['name','','','','']

                if ($(this).find('.amount').html() != obj.new_price) {
                    //var amount = $(this).find('.amount');
                    $(this).find('.amount').html(obj.new_price);
                    //$(this).find('.amount').css('border','solid 1px blue'); 
                    //$(this).find('.amount').animate({ borderColor: "#000"}, 'fast');
                }

                if ($(this).find('.buy').html() != obj.buy_1_price) {
                    $(this).find('.buy').html(obj.buy_1_price);
                    $(this).find('.buy').css('background-color', 'yellow');
                }

                if ($(this).find('.sell').html() != obj.sell_1_price) {
                    $(this).find('.sell').html(obj.sell_1_price);
                    $(this).find('.sell').css('background-color', 'yellow');
                }

                if ($(this).find('.updown').html() != obj.up_down_count) {
                    $(this).find('.updown').html(upDown + ' ' + obj.up_down_count);
                    $(this).find('.updown').css('background-color', 'yellow');
                }

                if ($(this).find('.percentage').html() != obj.up_down_rate) {
                    $(this).find('.percentage').html(obj.up_down_rate);
                    $(this).find('.percentage').css('background-color', 'yellow');
                }


                if ($(this).find('.total').html() != obj.total_amount) {
                    $(this).find('.total').html(obj.total_amount);
                    $(this).find('.total').css('background-color', 'yellow');
                }

                if ($(this).find('.open').html() != obj.open_price) {
                    $(this).find('.open').html(obj.open_price);
                    $(this).find('.open').css('background-color', 'yellow');
                }

                if ($(this).find('.max').html() != obj.high_price) {
                    $(this).find('.max').html(obj.high_price);
                    $(this).find('.max').css('background-color', 'yellow');
                }

                if ($(this).find('.min').html() != obj.low_price) {
                    $(this).find('.min').html(obj.low_price);
                    $(this).find('.min').css('background-color', 'yellow');
                }

                if ($(this).find('.y_close').html() != obj.last_close_price) {
                    $(this).find('.y_close').html(obj.last_close_price);
                    $(this).find('.y_close').css('background-color', 'yellow');
                }

                if ($(this).find('.y_total').html() != obj.last_new_price) {
                    $(this).find('.y_total').html(obj.last_new_price);
                    $(this).find('.y_total').css('background-color', 'yellow');
                }

                if ($(this).find('.status').html() != obj.status_name) {
                    $(this).find('.status').html(obj.status_name);
                    $(this).find('.status').css('background-color', 'yellow');
                }
                bool = true;
            }
        });
        //if (!bool) {
        //    $('#stock').append(str);
        //}
    }

    //商品統計
    function productStatic(orderData) {
        if (orderData == null)
            return false;
        var arrAll = [];
        /* var obj = {
            name: '',
            code: '',
            upTotal: 0,
            downTotal: 0,
            notStore: 0,
            totalAmount: 0,
            fee: 0,
            profit: 0,
            restStore: 0
        };
*/
        //掃己平倉的商品，做商品統計
        for (var i = 0; i < orderData.length; i++) {
            if (orderData[i].listType != 'list3') {
                continue;
            }

            isNew = true;
            for (var j = 0; j < arrAll.length; j++) {
                if (arrAll[j].code == orderData[i].code) {

                    if (orderData[i].up_down == "up") {
                        arrAll[j].upTotal = Number(arrAll[j].upTotal) + Number(orderData[i].amount);
                    }
                    if (orderData[i].up_down == "down") {
                        arrAll[j].downTotal = Number(arrAll[j].downTotal) + Number(orderData[i].amount);
                    }

                    arrAll[j].totalAmount = Number(arrAll[j].totalAmount) + Number(orderData[i].amount);

                    arrAll[j].fee += Number(orderData[i].amount) * $('#' + orderData[i].code).attr('charge');
                    isNew = false;
                }
            }

            if (isNew) {
                var obj = {
                    name: orderData[i].name,
                    code: orderData[i].code,
                    upTotal: 0,
                    downTotal: 0,
                    notStore: 0,
                    totalAmount: orderData[i].amount,
                    fee: orderData[i].amount * $('#' + orderData[i].code).attr('charge'),
                    profit: 0,
                    restStore: 0
                };
                if (orderData[i].up_down == "up") {
                    obj.upTotal += orderData[i].amount;

                }
                if (orderData[i].up_down == "down") {

                    obj.downTotal += orderData[i].amount;
                }
                arrAll.push(obj);
            }
        }


        var html = '';
        for (var k = 0; k < arrAll.length; k++) {

            html += ' <tr > ';
            html += '<td >' + arrAll[k].name + '</td>';
            html += '<td>' + arrAll[k].upTotal + '</td>';
            html += '<td>' + arrAll[k].downTotal + '</td>';
            html += '<td>' + arrAll[k].notStore + '</td>';
            html += '<td>' + arrAll[k].totalAmount + '</td>';
            html += '<td>' + arrAll[k].fee + '</td>';
            html += '<td>' + arrAll[k].profit + '</td>';
            html += '<td>' + arrAll[k].restStore + '</td>';
            html += '</tr>';
        }

        $('#list_static').html(html);

    }

    function commafy(num) {
        var str = num.toString().split('.');
        if (str[0].length >= 5) {
            str[0] = str[0].replace(/(\d)(?=(\d{3})+$)/g, '$1,');
        }
        if (str[1] && str[1].length >= 5) {
            str[1] = str[1].replace(/(\d{3})/g, '$1 ');
        }
        return str.join('.');
    }

    function formatFloat(num, pos) {
        var size = Math.pow(10, pos);
        return Math.round(num * size) / size;
    }