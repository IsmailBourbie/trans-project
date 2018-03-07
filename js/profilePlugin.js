/*global $, jQuery, console, alert*/
$(document).ready(function () {
    'use strict';
    /* Declaration Start */
    var showOption = $('.userProfile > span'),
        profileOptions = $('.profileOptions'),
        suggestWord = $('.suggestWord'),
        messageAfterSend = $('.sendSuggestContiner'),
        output = $('#output'),
        input = $('#input'),
        sendSuggest = $('#buttonSend'),
        cancelSuggest = $('#buttonCancel'),
        chooseTitle = $(".chooseTitle"),
        id_user = parseInt($('.id_user').text(), 10),
        eng_word,
        fr_word,
        sense = null;
    /* Declaration End */
    
    showOption.click(function () {
        profileOptions.slideToggle();
    });
    
    function witchSense() {
        if (chooseTitle.children().last().text().charAt(0) === 'A') {
            sense = 0;
            eng_word = input.val().trim();
            fr_word = output.val().trim();
        } else if (chooseTitle.children().last().text().charAt(0) === 'F') {
            sense = 1;
            eng_word = output.val().trim();
            fr_word = input.val().trim();
        }
    }

    /* Suggest Word Start */
    input.on("input", function () {
        if (input.val().length > 0) {
            suggestWord.show();
        } else {
            suggestWord.hide();
            messageAfterSend.hide();
        }
    });
    output.on("input", function () {
        if (output.val().length > 0) {
            sendSuggest.prop('disabled', false);
        } else {
            sendSuggest.prop('disabled', true);
        }
    });
    suggestWord.click(function () {
        messageAfterSend.show();
        output.prop('readonly', false);
        output.focus();
    });
    
    $('#buttonCancel').click(function () {
        $('.sendSuggestContiner').hide();
        output.val("");
        output.prop('readonly', true);
    });
    /* Suggest Word End */
    
    /* Send suggest using Ajax Start */
    
    sendSuggest.click(function () {
        witchSense();
        $.ajax({
            url: "server/add_temp_word.php",
            type: "get",
            data: {
                "id_user": id_user,
                "en_word": eng_word,
                "fr_word": fr_word
            },
            datatype: 'html',
            success: function (data) {
                $('#buttonCancel').trigger('click');
                setTimeout(function () {alert("DONE"); }, 700);
            }

        });
    });
    /* Send suggest using Ajax End */
    
});