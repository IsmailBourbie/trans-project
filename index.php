<?php
    session_start();
    if(isset($_SESSION['logined'])){
        header('Location: profile.php');
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Translation</title>
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans">
        <link rel="stylesheet" href="css/normalize.css">
        <link rel="stylesheet" href="css/font-awesome.min.css">
        <link rel="stylesheet" href="css/main.css">
        <link rel="stylesheet" href="css/identify.css">
        <style>
            @import url('https://fonts.googleapis.com/css?family=Open+Sans');
        </style>
    </head>
    <body>
        <header>
            <div class="headerContainer">
                <div class="logo float-left">
                    <h1>Translation</h1>
                </div>
                <div class="identify float-right ">
                    <button id="login">Login</button>
                    <button id="register">Register</button>
                </div>
            </div>
            <div class="clearfix"></div>
        </header>
        <div class="con">
            
            <div class="container">
                <div class="header">
                    <div class="chooseContainer">
                        <div class="chooseTitle">
                            <i class="fa fa-list" aria-hidden="true">&nbsp;</i>
                            <h3 class="reset-margin" style="display: inline">Choose Language</h3>
                        </div>
                        <div class="chooseList">
                            <ul class="rest-list">
                                <li id="eng_fr">Anglais - Français</li>
                                <li id="fr_eng">Français - Anglais</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="translatContainer">
                <button id="translate" class="visible">Translate</button>
                <div class="inputContainer text-center">
                    <textarea id="input" rows="4" disabled></textarea>
                    <textarea id="output" rows="4" readonly></textarea>
                </div>
                
            </div>
            </div>
            
            <!-- Sign In Start -->
            <div class="modal text-center" >
                <div class="modalContainer">
                    <div class="header">
                        <h2 class="reset-margin float-left">Login</h2>
                        <span class="float-right closeIdentify">X</span>
                    </div>
                    <div class="signInContainer">
                        <form action="signin.php" method="post">
                            <input id="userNameLog" class="inputs" type="email" placeholder="Email"  name="username" required autocomplete="off">
                            <input id="userPassLog" class="inputs" type="password" placeholder="Password" name="userpass" required>
                            <input id="submitLogin" type="submit" name="login" value="Login">
                        </form>
                    </div>
                    <hr style="width: 60%">
                    <div class="notHaveAccount">
                        <p>You doin't have a Account?</p>
                        <button id="goToRegister">Register</button>
                    </div>
                </div>
            </div>
            <!-- Sign In End -->
            
            <!-- Sign Up Start -->
            <div class="modalRegister text-center">
                <div class="modalContainer">
                    <div class="header">
                        <h2 class="reset-margin float-left">Register</h2>
                        <span class="float-right closeIdentify">X</span>
                    </div>
                    <div class="signInContainer">
                        <form>
                            <input id="userNameRegister" class="inputs" type="text" placeholder="User Name">
                            <input id="emailRegister" class="inputs" type="Email" placeholder="Email">
                            <input id="passwordRegister" class="inputs" type="password" placeholder="Password">
                            <input id="passwordAgainRegister" class="inputs" type="password" placeholder="Password Again">
                            <input id="submitRegister" type="button" value="Register">
                        </form>
                    </div>
                    <hr style="width: 60%">
                    <div class="notHaveAccount">
                        <p>You already have a Account?</p>
                        <button id="goToLogin">Login</button>
                    </div>
                </div>
            </div>
            <!-- Sign Un End -->
            
        </div>
        <footer>
            <div class="copyright float-left"><h3>Easy Code Club &copy; 2017</h3></div>
            <div class="aboutUs">
                <a href="#" class="rest-adress float-right"><i class="fa fa-instagram fa-2x" aria-hidden="true"></i></a>
                <a href="#" class="rest-adress float-right"><i class="fa fa-youtube-play fa-2x" aria-hidden="true"></i></a>
                <a href="#" class="rest-adress float-right"><i class="fa fa-facebook-official fa-2x" aria-hidden="true"></i></a>
            </div>
            <div class="clearfix"></div>
        </footer>
  
        <script src="js/jquery-3.2.1.min.js"></script>
        <script src="js/identifyPlugins.js"></script>
        <script src="js/plugin.js"></script>
    </body>
</html>