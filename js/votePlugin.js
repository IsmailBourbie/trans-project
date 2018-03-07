/*jslint eqeq: true*/
/*global $, jQuery, console, alert*/
$(document).ready(function () {
    'use strict';
    var voteTrue = $('#voteTrue'),
        voteFalse = $('#voteFalse'),
        confirmationBox = $('.confirmContiner'),
        eng_word = $('input#engWord'),
        fr_word = $('input#frWord'),
        iduser = parseInt($('footer span').text(), 10),
        VoteContiner = $('.VoteContiner'),
        thanksContainer = $('.thanksContainer'),
        sendVote = $('button#confirmVote'),
        idTemp,
        answer;

    /* Toggle class active start */
    voteTrue.on('click', function () {
        voteTrue.addClass('o-active');
        voteFalse.removeClass('x-active');
        confirmationBox.show();
        answer = 1;
        
    });
    voteFalse.on('click', function () {
        voteFalse.addClass('x-active');
        voteTrue.removeClass('o-active');
        confirmationBox.show();
        answer = 0;
    });
    /* Toggle class active end */
    
    /* get word from data base start */
    function getWords() {
        $.ajax({
            url: "server/get_no_voted_words.php",
            type: "get",
            data: {
                id_user: iduser
            },
            success: function (data) {
                if (data.message === 0) {
                    VoteContiner.animate({
                        left: "1300px"
                    }, function () {
                        VoteContiner.hide();
                    });
                    thanksContainer.show(function () {
                        thanksContainer.animate({
                            left: "0px"
                        });
                    });
                } else {
                    var engData = data.words[0].eng,
                        frData = data.words[0].fr;
                    
                    idTemp = data.words[0].id_temp;
                    eng_word.val(engData.charAt(0).toUpperCase() + engData.slice(1));
                    fr_word.val(frData.charAt(0).toUpperCase() + frData.slice(1));
                }
            }
        });
    }
    getWords();
    /* get word from data base end */
    
    /* send vote to data base start */
    sendVote.click(function () {
        confirmationBox.hide();
        $.ajax({
            url: "server/add_a_vote.php",
            type: "get",
            data: {
                id_user: iduser,
                id_temp: idTemp,
                decision: answer
            },
            success: function (data) {
                getWords();
                voteFalse.removeClass('x-active');
                voteTrue.removeClass('o-active');
            }
        });
        
    });
    /* send vote to data base end */
});