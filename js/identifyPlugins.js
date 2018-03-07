/*global $, jQuery, console, alert*/
$(document).ready(function () {
    'use strict';
    /* Declaration Start */
    var login = $("#login"),
        register = $("#register"),
        goToRegister = $('#goToRegister'),
        goToLogin = $('#goToLogin'),
        boxLogin = $('.modal'),
        boxRegister = $('.modalRegister'),
        submitRegister = $('#submitRegister');
    /* Declaration End */

    /* SignIn Start */
    login.click(function () {
        boxLogin.slideToggle();
    });

    goToRegister.click(function () {
        boxLogin.slideToggle(function () {
            boxRegister.slideToggle();
        });
    });

    $('.closeIdentify').click(function () {
        boxLogin.slideUp();
        boxRegister.slideUp();
    }); // close box Login/register 
    /* SignIn End */

    /* SignUp Start */
    register.click(function () {
        boxRegister.slideToggle();
    });

    goToLogin.click(function () {
        boxRegister.slideToggle(function () {
            boxLogin.slideToggle();
        });
    });
    /* SignUp End */

    /* Register using AJAX Start */

    submitRegister.click(function () {
        var userName = $('#userNameRegister').val(),
            emailR = $('#emailRegister').val(),
            password = $('#passwordRegister').val(),
            passwordAgain = $('#passwordAgainRegister').val();
        if (password !== passwordAgain) {
            alert("error in ur password");
        } else {
            $.ajax({
                url: 'server/add_a_user.php',
                type: 'get',
                data: {
                    email: emailR,
                    password: passwordAgain,
                    username: userName
                },
                success: function (data) {
                    if (data.message === 1) {
                        var userLog = $('#userNameLog'),
                            passLog = $('#userPassLog');
                        userLog.val(emailR);
                        passLog.val(password);
                        $('#submitLogin').trigger('click');
                    } else if (data.message === 2) {
                        alert("Email existe");

                    } else if (data.message === 3) {
                        alert("User Name existe ");
                    } else {
                        alert("Email and User name existe");
                    }

                }
            });
        }

    });

    /* Register using AJAX End */

});
