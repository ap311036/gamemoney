/* #md_member_tab2 START */
$("#md_mb_profile").tabs();
$('#mbAdd').twzipcode({
    'countyName': 'mbCounty', // 預設值為 county
    'districtName': 'mbDistrict', // 預設值為 district
    'zipcodeName': 'mbZipcode' // 預設值為 zipcode
});
$('#mbReceiptAdd').twzipcode({
    'countyName': 'rcCounty',
    'districtName': 'rcDistrict',
    'zipcodeName': 'rcZipcode'
});
$("#mbGameType").change(function() {
    var mbGameType_value = document.getElementById("mbGameType").value;
    if (mbGameType_value == "gt1") {
        $("#mbGameName .gt1").css("display", "initial");
        $("#mbGameName .gt2").css("display", "none");
        $("#mbGameName .gt3").css("display", "none");
    }
    switch (mbGameType_value) {
        case "gt1":
            $("#mbGameName .gt1").css("display", "initial");
            $("#mbGameName .gt2").css("display", "none");
            $("#mbGameName .gt3").css("display", "none");
            break;
        case "gt2":
            $("#mbGameName .gt1").css("display", "none");
            $("#mbGameName .gt2").css("display", "initial");
            $("#mbGameName .gt3").css("display", "none");
            break;
        case "gt3":
            $("#mbGameName .gt1").css("display", "none");
            $("#mbGameName .gt2").css("display", "none");
            $("#mbGameName .gt3").css("display", "initial");
            break;
        default:
            $("#mbGameName .gt1").css("display", "initial");
            $("#mbGameName .gt2").css("display", "initial");
            $("#mbGameName .gt3").css("display", "initial");
            break;
    }
});
$("#mbGameTypeV").change(function() {
    var mbGameTypeV_value = document.getElementById("mbGameTypeV").value;
    if (mbGameTypeV_value == "gt1") {
        $("#mbGameNameV .gt1").css("display", "initial");
        $("#mbGameNameV .gt2").css("display", "none");
        $("#mbGameNameV .gt3").css("display", "none");
    }
    switch (mbGameTypeV_value) {
        case "gt1":
            $("#mbGameNameV .gt1").css("display", "initial");
            $("#mbGameNameV .gt2").css("display", "none");
            $("#mbGameNameV .gt3").css("display", "none");
            break;
        case "gt2":
            $("#mbGameNameV .gt1").css("display", "none");
            $("#mbGameNameV .gt2").css("display", "initial");
            $("#mbGameNameV .gt3").css("display", "none");
            break;
        case "gt3":
            $("#mbGameNameV .gt1").css("display", "none");
            $("#mbGameNameV .gt2").css("display", "none");
            $("#mbGameNameV .gt3").css("display", "initial");
            break;
        default:
            $("#mbGameNameV .gt1").css("display", "initial");
            $("#mbGameNameV .gt2").css("display", "initial");
            $("#mbGameNameV .gt3").css("display", "initial");
            break;
    }
});
$("#md_btn_2_6_1").click(function() {
    $("#md_content_2_6_1").css("display", "initial");
    $("#md_content_2_6_2").css("display", "none");
});
$("#md_btn_2_6_2").click(function() {
    $("#md_content_2_6_1").css("display", "none");
    $("#md_content_2_6_2").css("display", "initial");
});
/* #md_member_tab2 END */
/* #md_member_tab3 START */

$("#md_slider").slider({
    value: 0,
    min: -1000,
    max: 1000,
    slide: function(event, ui) {
        $("#md_card_credit").html("$" + ui.value);
    }
});
$("#md_card_credit").html("$" + $("#md_slider").slider("value"));
$("#md_card_credit_max").html("$" + $("#md_slider").slider("option", "max"));

$("#md_card_type_get").html($("#md_card_type_now").html());

/* #md_member_tab3 END */

/* #md_member_tab4 START */

$(".md_mb_card_1").hover(function() {
    $(".md_mb_card_1").addClass("md_mb_card_hover");
    $(".md_mb_card_1").last().addClass("md_mb_card_hover_last");
}, function() {
    $(".md_mb_card_1").removeClass("md_mb_card_hover");
    $(".md_mb_card_1").last().removeClass("md_mb_card_hover_last");
});

$(".md_mb_card_2").hover(function() {
    $(".md_mb_card_2").addClass("md_mb_card_hover");
    $(".md_mb_card_2").last().addClass("md_mb_card_hover_last");
}, function() {
    $(".md_mb_card_2").removeClass("md_mb_card_hover");
    $(".md_mb_card_2").last().removeClass("md_mb_card_hover_last");
});

$(".md_mb_card_3").hover(function() {
    $(".md_mb_card_3").addClass("md_mb_card_hover");
    $(".md_mb_card_3").last().addClass("md_mb_card_hover_last");
}, function() {
    $(".md_mb_card_3").removeClass("md_mb_card_hover");
    $(".md_mb_card_3").last().removeClass("md_mb_card_hover_last");
});

$(".md_mb_card_4").hover(function() {
    $(".md_mb_card_4").addClass("md_mb_card_hover");
    $(".md_mb_card_4").last().addClass("md_mb_card_hover_last");
}, function() {
    $(".md_mb_card_4").removeClass("md_mb_card_hover");
    $(".md_mb_card_4").last().removeClass("md_mb_card_hover_last");
});

$(".md_mb_card_5").hover(function() {
    $(".md_mb_card_5").addClass("md_mb_card_hover");
    $(".md_mb_card_5").last().addClass("md_mb_card_hover_last");
}, function() {
    $(".md_mb_card_5").removeClass("md_mb_card_hover");
    $(".md_mb_card_5").last().removeClass("md_mb_card_hover_last");
});

$(".md_mb_card_1").click(function() {
    $(".md_mb_card_select").removeClass("md_mb_card_select");
    $(".md_mb_card_select_last").removeClass("md_mb_card_select_last");
    $(".md_mb_card_1").addClass("md_mb_card_select");
    $(".md_mb_card_1").last().addClass("md_mb_card_select_last");
    $("#md_mb_card_content span").html($(".md_mb_card_1").first().html());
});

$(".md_mb_card_2").click(function() {
    $(".md_mb_card_select").removeClass("md_mb_card_select");
    $(".md_mb_card_select_last").removeClass("md_mb_card_select_last");
    $(".md_mb_card_2").addClass("md_mb_card_select");
    $(".md_mb_card_2").last().addClass("md_mb_card_select_last");
    $("#md_mb_card_content span").html($(".md_mb_card_2").first().html());
});

$(".md_mb_card_3").click(function() {
    $(".md_mb_card_select").removeClass("md_mb_card_select");
    $(".md_mb_card_select_last").removeClass("md_mb_card_select_last");
    $(".md_mb_card_3").addClass("md_mb_card_select");
    $(".md_mb_card_3").last().addClass("md_mb_card_select_last");
    $("#md_mb_card_content span").html($(".md_mb_card_3").first().html());
});

$(".md_mb_card_4").click(function() {
    $(".md_mb_card_select").removeClass("md_mb_card_select");
    $(".md_mb_card_select_last").removeClass("md_mb_card_select_last");
    $(".md_mb_card_4").addClass("md_mb_card_select");
    $(".md_mb_card_4").last().addClass("md_mb_card_select_last");
    $("#md_mb_card_content span").html($(".md_mb_card_4").first().html());
});

$(".md_mb_card_5").click(function() {
    $(".md_mb_card_select").removeClass("md_mb_card_select");
    $(".md_mb_card_select_last").removeClass("md_mb_card_select_last");
    $(".md_mb_card_5").addClass("md_mb_card_select");
    $(".md_mb_card_5").last().addClass("md_mb_card_select_last");
    $("#md_mb_card_content span").html($(".md_mb_card_5").first().html());
});

/* #md_member_tab4 END */
$("#md_member").css("opacity", "1");
