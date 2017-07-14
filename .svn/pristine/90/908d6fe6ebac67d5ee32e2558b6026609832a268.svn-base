/* aside #lt START */
$("#lt_slider").slider({
    value: 0,
    min: -1000,
    max: 1000,
    slide: function(event, ui) {
        $("#lt_card_credit").html("$" + ui.value);
    },
    disabled: true
});
$("#lt_card_credit").html("$" + $("#lt_slider").slider("value"));
$("#lt_card_credit_max").html("$" + $("#lt_slider").slider("option", "max"));
/* aside #lt END */
