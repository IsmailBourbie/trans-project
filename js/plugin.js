/*global $, jQuery, console, alert*/
$(document).ready(function () {
    'use strict';
    /* Declaration Start */
    var chooseTitle = $(".chooseTitle"),
        chooseList = $('.chooseList'),
        chooseEng = $('#eng_fr'),
        chooseFr = $('#fr_eng'),
        input = $("#input"),
        output = $("#output"),
        translate = $('#translate'),
        valOfListe = 2;
    /* Declaration End */
    
    /* choose Language Start */
    chooseTitle.click(function () {
        chooseList.slideToggle();
    });
    
    chooseEng.click(function () {
        chooseTitle.children().last().text(chooseEng.text());
        chooseList.slideToggle();
        input.prop('disabled', false);
        input.focus();
        valOfListe = 0;
    });
    
    chooseFr.click(function () {
        chooseTitle.children().last().text(chooseFr.text());
        chooseList.slideToggle();
        input.prop('disabled', false);
        input.focus();
        valOfListe = 1;
    });
    /* choose Language End */
    
    input.on("input", function () {
        if (input.val().length > 0) {
            translate.animate({opacity: "1"});
        } else {
            translate.animate({opacity: "0"});
        }
    });
    
    /* Using Ajax Start */
    
    translate.click(function () {
        $.ajax({
            url: "server/get_the_traduction.php",
            type: "get",
            data: {
                word: input.val(),
                sense: valOfListe
            },
            dataType: "json",
            success: function (data) {
                if (data.message === "success") {
                    output.html(data.synonyms[0].word);
                } else {
                    output.html(data.message);
                }
            },
            error: function () {
                alert("Error try later please");
            }
        });
    });
    
    /* Using Ajax End */
    
});