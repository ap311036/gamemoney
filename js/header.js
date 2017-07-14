function changePlayImg() {
    $("header #hd_play").css("background-image", "url('img/Night_Play_2.png')");
    setTimeout(function() {
        $("header #hd_play").css("background-image", "url('img/Night_Play_1.png')");
    }, 500);
}

setInterval("changePlayImg()", 1000);

function changeFBImg() {
    $("#fb_fan_page").css("background-image", "url('img/Night_FB_2.png')");
    setTimeout(function() {
        $("#fb_fan_page").css("background-image", "url('img/Night_FB_1.png')");
    }, 500);
}

setInterval("changeFBImg()", 1000);



$('#fb_login_div').click(function(){

    fbloginuse();
    FB.login(function(response){
        if (response.status === 'connected') {
            location.href=('login.php?m=fbLogin');
        } else {
            // The person is not logged into this app or we are unable to tell.

        }
    });
// //
//     // var log = 1;
//     //
//     // alert("log"+":"+log);
//     //
//     //    $.get('login.php?m=fbloginTest', {log:log}, function(){
//     //
//     //
//     //
//     //        alert('正在執行內部登入');
//     //    }, 'json');
//
//
//
//        // location.href=('index.php')
});
// $('#fb_login_div').click(function () {
//     alert("有");
// });