// JavaScript Document

  
//輸入判斷式

function checklen(fmobj,fmobjmsg,lenmin,lenmax)
{ 
if(document.getElementById(fmobj))
{
 	if ((document.getElementById(fmobj).value.length < lenmin)) 
 	{ 
    	alert(fmobjmsg+"需超過"+lenmin+"個字"); 
    	document.getElementById(fmobj).focus(); 
   	 	return false; 
 	} 
	
 	if ((document.getElementById(fmobj).value.length > lenmax)) 
 	{ 
    	alert(fmobjmsg+"不能超過過"+lenmax+"個字"); 
    	document.getElementById(fmobj).focus(); 
   	 	return false; 
 	} 
}
 
 return true; 
}



function checklens(fmobj,fmobjmsg,lens)
{ 
 
 	if ((document.getElementById(fmobj).value.length != lens)) 
 	{ 
    	alert(fmobjmsg+"需為"+lens+"個字"); 
    	document.getElementById(fmobj).focus(); 
   	 	return false; 
 	} 

 return true; 
}


function checknum(fmobj,fmobjmsg)
{ 
    if(document.getElementById(fmobj))
    {
        re = /^([0-9]*[.0-9])$/;
         if (!re.test(document.getElementById(fmobj).value))
         { 
            alert(fmobjmsg +"只允許輸入數字"); 
            document.getElementById(fmobj).focus(); 
            return false; 
         }
     } 
     return true; 
} 

//檢查是否為數字(包括小數點)
function checknumpoint(fmobj,fmobjmsg)
{ 
    if(document.getElementById(fmobj))
    {
        if (isNaN(document.getElementById(fmobj).value) == true) 
        { 
           alert(fmobjmsg +"只允許輸入數字"); 
           document.getElementById(fmobj).focus(); 
           return false; 
        }
    } 
    return true; 
} 


function checkmobile(fmobj)
{ 
    if(document.getElementById(fmobj))
    {
        re = /^09\d{8}$/; 
        if (!re.test(document.getElementById(fmobj).value)) 
        { 
           alert("手機格式有問題 範例:0987654321"); 
           document.getElementById(fmobj).focus(); 
           return false; 
        } 
    }
    return true; 
} 


function checkemail(fmobj)
{ 
 if(document.getElementById(fmobj).value!="")
 {
 
 re = /^[^\s]+@[^\s]+\.[^\s]{2,3}$/; 
 if (!re.test(document.getElementById(fmobj).value)) 
 { 
    alert("email格式有問題"); 
    document.getElementById(fmobj).focus(); 
    return false; 
 } 
 }
 return true; 
} 


function checkempty(fmobj,fmobjmsg)
{ 
 //alert(fmobj);
 if ((document.getElementById(fmobj).value=="")) 
 { 
    alert(fmobjmsg + "為必輸入欄位"); 
    document.getElementById(fmobj).focus(); 
    return false; 
 } 
 return true; 
} 

function checkempty2(fmobj,fmobjmsg,fmobjshow)
{ 
 //alert(fmobj);
 if ((document.getElementById(fmobj).value==fmobjshow)) 
 { 
    alert(fmobjmsg + "為必輸入欄位"); 
    document.getElementById(fmobj).focus(); 
    return false; 
 } 
 return true; 
} 

function checkcheck(fmobj,fmobjmsg)
{ 
	var obj = document.getElementsByName(fmobj);
	var checkVal = '';
	
	for(var i=0;i<obj.length;i++) 
	{ 
		if(obj[i].checked) 
		{ 
			checkVal=obj[i].value; 
			break; 
		} 
	} 

 if (checkVal == '') 
 { 
    alert(fmobjmsg + "需確認"); 
    fmobj = fmobj.replace(/([\(\)\[\]\{\}\^\$\+\-\*\?\.\"\'\|\/\\])/g, '');
    document.getElementById(fmobj).focus(); 
    return false; 
 } 
 return true; 
}


function checkname(fmobj)
{ 
    if(!checklen(fmobj,"姓名",2,20)) return false;
    return true; 
}
 
function checktel(fmobj,fmobjmsg)
{ 

if(document.getElementById(fmobj).value!="")
{
//re = /(^([0][1-9]{2,3}[-])?\d{3,8}(-\d{1,6})?$)|(^\([0][1-9]{2,3}\)\d{3,8}(\(\d{1,6}\))?$)|(^\d{3,8}$)/; 
//re = /^(([0\+]\d{2,3}-)?(0\d{2,3})-)?(\d{7,13})(-(\d{3,}))?$/;
//re=/^[+]{0,1}(d){1,3}[ ]?([-]?((d)|[ ]){1,12})+$/;
//re=/^(\((0([2-9]){1,4})\))?(\s)?(([2-9]){1}[0-9]{5,7}){1}(\s)?(\#(\s)?[0-9]{1,8})?$/;
 
//  re=/^(\((0([2-9]){1,4})\))?(\s)?(([2-9]){1}[0-9]{5,7}){1}(\s)?(\#(\s)?[0-9]{1,8})?$/;
	re=	/^[0-9]{2,3}\-[0-9]{8}(\#[0-9]+)?$/;
 if (!re.test(document.getElementById(fmobj).value)) 
 { 
    alert(fmobjmsg+"號碼格式有問題 範例 02-23456789#1234"); 
    document.getElementById(fmobj).focus(); 
    return false; 
 } 
   
}
 return true; 
} 

function checkid(fmobj)
{ 
{
	if(!checklen(fmobj,"帳號",3,30)) return false;
	re = /^\w{1,30}$/; 
 	if (!re.test(document.getElementById(fmobj).value)) 
 	{ 
    	alert("帳號格式有問題,只能由英文數字及底線"); 
    	document.getElementById(fmobj).focus(); 
    	return false; 
 	}
}
 return true; 
} 



function checkpass(fmobj,dvalue)
{ 
 	var str = document.getElementById(fmobj).value;
        if (str == dvalue)
            return true;
        
 	var subStr = "";
  var ns = 0;
  var ni = 0;
 	for (i=0,n=str.length;i<n;i++)
	{
      	subStr = str.charCodeAt(i);
      	if ((subStr > 256))
		{
         	alert("密碼格式不符合,不能使用中文字"); 
    		document.getElementById(fmobj).focus();
			return false;
      	}
     
     if(subStr>=48 && subStr<=57)
       ni = 1;
     else
       ns = 1;
      	
  	}
  	
 
 if(ns == 0 || ni == 0)
 {
    alert("密碼要有 數字 及 英文或符號 之組合"); 
    document.getElementById(fmobj).focus();
		return false;
 }
 
 	if(!checklen(fmobj,"密碼",8,30)) return false;
 
 
 return true; 
}

function checknum0(fmobj,fmobjmsg)
{ 

 	if (document.getElementById(fmobj).value == 0) 
 	{ 
    	alert(fmobjmsg+"不能為0"); 
    	document.getElementById(fmobj).focus(); 
    	return false; 
 	}

 	return true; 
} 


function checkIDD(fmobj)
{
	
  idStr = document.getElementById(fmobj).value;


  var letters = new Array('A', 'B', 'C', 'D',
      'E', 'F', 'G', 'H', 'J', 'K', 'L', 'M',
      'N', 'P', 'Q', 'R', 'S', 'T', 'U', 'V',
      'X', 'Y', 'W', 'Z', 'I', 'O');

  var multiply = new Array(1, 9, 8, 7, 6, 5,
                           4, 3, 2, 1);
  var nums = new Array(2);
  var firstChar;
  var firstNum;
  var lastNum;
  var total = 0;

  var regExpID=/^[a-z](1|2)\d{8}$/i;

  if (idStr.search(regExpID)==-1) 
  {
    	alert("身份証字號有問題"); 
    	document.getElementById(fmobj).focus();
   		return false;
  }
  else 
  {

	firstChar = idStr.charAt(0).toUpperCase();
	lastNum = idStr.charAt(9);
  }

  for (var i=0; i<26; i++) {
	if (firstChar == letters[i]) {
	  firstNum = i + 10;
	  nums[0] = Math.floor(firstNum / 10);
	  nums[1] = firstNum - (nums[0] * 10);
	  break;
	}
  }

  for(var i=0; i<multiply.length; i++){
    if (i<2) {
      total += nums[i] * multiply[i];
    } else {
      total += parseInt(idStr.charAt(i-1)) *
               multiply[i];
    }
  }

  if ((10 - (total % 10))!= lastNum) 
  {
	      	alert("身份証字號有問題"); 
    		document.getElementById(fmobj).focus();
			return false;
  }
  return true;
}


function checkdate(fmobj)
{ 
    if(document.getElementById(fmobj))
    {
        dateString = document.getElementById(fmobj).value;
        re = /^(\d{4})([\/]|[-])(\d{1,2})\2(\d{1,2})$/; 
        if (!re.test(dateString)) 
        { 
           alert("日期格式有問題!範例格式2011-12-12,您可選擇清除重填"); 
           document.getElementById(fmobj).focus(); 
           return false; 
        }
        
        // Parse the date parts to integers
        var parts = dateString.split("-");
        var year = parseInt(parts[0], 10);
        var month = parseInt(parts[1], 10);
        var day = parseInt(parts[2], 10);

        // Check the ranges of month and year
        if(year < 1000 || year > 3000 || month < 1 || month > 12)
        { 
           alert("年月超出範圍!範例格式2011-12-12,您可選擇清除重填"); 
           document.getElementById(fmobj).focus(); 
           return false; 
        }

        var monthLength = [ 31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31 ];

        // Adjust for leap years
        if (year % 400 == 0 || (year % 100 != 0 && year % 4 == 0))
            monthLength[1] = 29;

        // Check the range of the day
        if (day <= 0 || day > monthLength[month - 1])
        { 
           alert("日期超出範圍!範例格式2011-12-12,您可選擇清除重填"); 
           document.getElementById(fmobj).focus(); 
           return false; 
        }
    }
    return true; 
}

//valid checkbox value in array use elements name
function is_arr_val_empty(name,i,str) 
{ 
	var chks = $('input[name="'+name+'['+i+']"]');  //here comp_stat[] is the name of the textbox          
	if (chks.val() == '') 
	{ 
		alert(str + "為必輸入欄位");    
		chks.focus(); 
		return false;
	} 
	else
	{
		return true;
	}

}   

//跳出視窗
function dialog_set(url,title,w,h)
{
	$(document).ready(function() {
	if(h == 0)
	{
		h_max = return_max_height();					
	}
	else
	{
		h_max = h;	
	}
	$(".ui-dialog-titlebar").show();						   
	$('body').append('<div id="category_edit_dialog" style="display:none;"></div>');
	$("#category_edit_dialog").dialog({
		modal: true,
		hide: 'drop',
		draggable: true,
		autoOpen: true,
		title: title,
		width: w,
		height: h_max,
		position: {my: "center", at: "center", of: window }
	});
	$('.ui-widget-overlay').click(function() { dialog_close(); });
//        $('#category_edit_dialog').html('<a href="#" onclick="window.open("'+url+'", "Yahoo", config="height=500,width=500");">開新視窗</a>');
	$('#category_edit_dialog').html('<src="' + url + '" frameborder="0" height="98%" width="100%" id="dialogFrame" scrolling="auto"></iframe>');
	});
}


//跳出視窗 偵測版
function dialog_auto(url,title)
{
	$(document).ready(function() {
    
	$(".ui-dialog-titlebar").show();						   
	$('body').append('<div id="category_edit_dialog" style="display:none;"></div>');
	$('#category_edit_dialog').html('<iframe src="' + url + '" frameborder="0" id="dialogFrame" scrolling="auto"></iframe>');
	$('#dialogFrame').load(function() {
 	$('#dialogFrame').attr('height',((this.contentWindow.document.body.offsetHeight) + 10) + 'px');
	$('#dialogFrame').attr('width',((this.contentWindow.document.body.offsetWidth)+ 15) + 'px');
	});
	
	
	$("#category_edit_dialog").dialog({
		modal: true,
		hide: 'slide',
		draggable: true,
		autoOpen: true,
		title: title,
		width: 'auto',
		height: 'auto',
		position:['center',50] 
		//position: {my: "top", at: "center", of: window }
	});
	
	$('.ui-widget-overlay').click(function() { dialog_close(); });	
	
	});
}





//關閉視窗
function close_dialog()
{
	window.parent.dialog_close();
}
//popup location
function href_dialog(url)
{
	window.parent.location.href=url;
}

/**
 * 視窗遮罩訊息
 *
 * @message = 訊息內容
 * @title	= 訊息標題
 * @mask	= 是否開啟全視窗遮罩
 */
function dialog_msg(message,title,mask,esc)
{
	if(esc == '')
	{
		esc = false;
	}
	else
	{
		esc = true;
	}

	$(document).ready(function() {		
		$('body').append('<div id="dialog-msg"></div>');
		
        $("#dialog-msg").dialog({
		   title        : title,	
		   modal		: mask,				
		   resizable    : false,						
		   closeOnEscape: esc,
		   open: function(event, ui) 
		   { 
				if(esc == false)
				{
					$(".ui-dialog-titlebar-close").hide(); 
				}
		   }
		});
		if(title != '')
		{
			$(".ui-dialog-titlebar").show();
		}
		else
		{
			$(".ui-dialog-titlebar").hide();
		}
		$('.ui-widget-overlay').click(function() { dialog_close(); });
		$('#dialog-msg').html('<div style="text-align:left; font-size:15px;line-height:20px;">'+message+'</div>');
	});
		
}

/**
 * 關閉視窗遮罩訊息
 */
function close_msg_dialog()
{
	$("#dialog-msg").dialog("close");
}


function dialog_close()
{
	$("#category_edit_dialog").dialog("close");
}


function return_max_height()
{
	var maxHeight = screen.availHeight;
	return maxHeight-250;
}

//from to 日曆
function get_datepicker(from,to)
{
	$(function() {
		var dates = $( "#"+from+", #"+to ).datepicker({
			defaultDate: "+0w",
			changeMonth: true,
			numberOfMonths: 1,
			onSelect: function( selectedDate ) {
				var option = this.id == from ? "minDate" : "maxDate",
					instance = $( this ).data( "datepicker" ),
					date = $.datepicker.parseDate(
						instance.settings.dateFormat ||
						$.datepicker._defaults.dateFormat,
						selectedDate, instance.settings );
				dates.not( this ).datepicker( "option", option, date );
				dates.datepicker( "option", "dateFormat", "yy-mm-dd");
			}
		});
	});
}

//from 日曆
function get_datepicker_uni(from)
{
	$(function() {
		var dates = $( "#"+from).datepicker({
			defaultDate: "+0w",
			changeMonth: true,
			numberOfMonths: 1,
			onSelect: function( selectedDate ) {
				var option = this.id == from ? "minDate" : "maxDate",
					instance = $( this ).data( "datepicker" ),
					date = $.datepicker.parseDate(
						instance.settings.dateFormat ||
						$.datepicker._defaults.dateFormat,
						selectedDate, instance.settings );
				dates.not( this ).datepicker( "option", option, date );
				dates.datepicker( "option", "dateFormat", "yy-mm-dd");
			}
		});
	});
}


/* Chinese initialisation for the jQuery UI date picker plugin. */
/* Written by Ressol (ressol@gmail.com). */
jQuery(function($){
	$.datepicker.regional['zh-TW'] = {
		closeText: '關閉',
		prevText: '&#x3c;上月',
		nextText: '下月&#x3e;',
		currentText: '今天',
		monthNames: ['一月','二月','三月','四月','五月','六月',
		'七月','八月','九月','十月','十一月','十二月'],
		monthNamesShort: ['一','二','三','四','五','六',
		'七','八','九','十','十一','十二'],
		dayNames: ['星期日','星期一','星期二','星期三','星期四','星期五','星期六'],
		dayNamesShort: ['周日','周一','周二','周三','周四','周五','周六'],
		dayNamesMin: ['日','一','二','三','四','五','六'],
		weekHeader: '周',
		dateFormat: 'yy/mm/dd',
		firstDay: 1,
		isRTL: false,
		showMonthAfterYear: true,
		yearSuffix: '年'};
	$.datepicker.setDefaults($.datepicker.regional['zh-TW']);
});


//判斷是不是數字(可判斷浮點數)
function is_number(obj)
{
	var number = document.getElementById(obj).value;
		
	rep=new String(number);
	
	pattern=/^[\.0-9]+$/;
	
	if(rep.length>0 && rep.match(pattern) && parseFloat(number)>=0 && rep.length<=40) 
	{
		return true;
	} else {
		return false;
	}
}

//2012-05-02 stanley
//ajax function for autocomplete
//btn_id ->input id
//url -> sql query page
function get_ajax_autocomplete(btn_id,url)
{
	$('#'+btn_id).typeahead({
		source: function (typeahead, query){
		$.ajax({
			url: url,
			type: "POST",
			data: "query="+query,
			dataType: "JSON",
			async: true,
			success:
				function (data){
					if(data)
					{
						typeahead.process(data);
					}
				}
			});
		}
	})
}

//2012-05-02 stanley
//ajax function for response
//btn_id ->input id
//url -> sql query page
function get_ajax_response(btn_id,url)
{
	var response = $.ajax({
						type: "POST",
						url: url,
						data: "query="+$('#'+btn_id).val(),
						async: false
						}).responseText;
	return jQuery.parseJSON(response);					
}

//2012-05-03 annie
//input check and add message by ajax
//id -> input id
//ajaxurl -> get_ajax_response url
//passmsg -> 成功訊息
//wrongmsg -> 錯誤訊息
function ajax_add_msg(id,ajaxurl,passmsg,wrongmsg)
{
	var chk_input = get_ajax_response(id,ajaxurl);
	var input = $('#'+id).val();
	
	if(chk_input != null)
	{
		if($('#ajax_'+id).length > 0)
		{
			$('#'+id).unwrap();
		}
		$('#'+id).wrap('<div id="ajax_'+id+'" class="control-group error" style="margin-bottom:0px;"></div>');
		$('#ajax_'+id+'_msg').remove();
		$('#ajax_'+id).append('<span class="help-inline" id="ajax_'+id+'_msg">'+wrongmsg+'</span>');
	}
	else if(chk_input == null && input != "")
	{
		if($('#ajax_'+id).length > 0)
		{
			$('#'+id).unwrap();
		}
		$('#'+id).wrap('<div id="ajax_'+id+'" class="control-group success" style="margin-bottom:0px;"></div>');
		$('#ajax_'+id+'_msg').remove();
		$('#ajax_'+id).append('<span class="help-inline" id="ajax_'+id+'_msg">'+passmsg+'</span>');
	}
	else if(input == "")
	{
		if($('#ajax_'+id).length > 0)
		{
			$('#'+id).unwrap();
		}
		$('#ajax_'+id+'_msg').remove();
	};
}