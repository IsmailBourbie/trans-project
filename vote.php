<?php
    session_start();
    if(isset($_SESSION['logined'])){
        $user = strtoupper($_SESSION['username']);
        $iduser = strtoupper($_SESSION['iduser']);
    }else{
        header('Location: index.php');
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Translation: Profile</title>
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans">
        <link rel="stylesheet" href="css/normalize.css">
        <link rel="stylesheet" href="css/font-awesome.min.css">
        <link rel="stylesheet" href="css/main.css">
        <link rel="stylesheet" href="css/profile.css">
        <link rel="stylesheet" href="css/vote.css">
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
                <div class="userProfile float-right ">
                    <h2 class="reset-margin"><?php echo $user ?></h2>
                    <span id="showOptions"><i class="fa fa-sort-desc fa-2x" aria-hidden="true"></i></span>
                    <div class="profileOptions" >
                        <ul class="rest-list float-left">
                            <form action="logout.php" method="post">
                                <li><input type="button" value="Option1" ></li>
                                <li><input type="button" value="Option2" ></li>
                                <li><input type="submit" value="Log Out" name="logOut" ></li>
                            </form>    
                        </ul>
                    </div>
                </div>
            </div>
            <div class="clearfix"></div>
        </header>
        <div class="con">
            <div class="container">
                <div class="VoteContiner text-center">
                <div class="helpInfo">
                    <p class="reset-margin">Do you think this is true ?</p>
                </div>
                <div class="inputContiner">
                    <div class="wordContier">
                        <input id="engWord" type="text" disabled><span>=</span>
                        <input  id="frWord" type="text" disabled>
                    </div>
                    <div class="reponseContiner">
                        <i id="voteTrue" class="fa fa-circle-thin" aria-hidden="true"></i>
                        <i id="voteFalse" class="fa" aria-hidden="true">╳</i>
                    </div>
                </div>
                <div class="confirmContiner float-right">
                    <button id="confirmVote">Confirm</button>
                    <button id="ignoreVote">Ignore</button>
                </div>
            </div>
                <div class="thanksContainer" >
                    <p>Thank you very much for your help!<br/>There is no a suggest for now.<br/>Please check this page after some time for more help.</p>
                </div>
            </div>            
        </div>
        <footer>
            <span class="id_user hidden" style="font-size: 2px; position: absolute;"><?php echo $iduser ?></span>
            <div class="copyright float-left"><h3>Easy Code Club &copy; 2017</h3></div>
            <div class="aboutUs">
                <a href="#" class="rest-adress float-right"><i class="fa fa-instagram fa-2x" aria-hidden="true"></i></a>
                <a href="#" class="rest-adress float-right"><i class="fa fa-youtube-play fa-2x" aria-hidden="true"></i></a>
                <a href="#" class="rest-adress float-right"><i class="fa fa-facebook-official fa-2x" aria-hidden="true"></i></a>
            </div>
            <div class="clearfix"></div>
        </footer>
  
        <script src="js/jquery-3.2.1.min.js"></script>
        <script src="js/profilePlugin.js"></script>
        <script src="js/plugin.js"></script>
        <script src="js/votePlugin.js"></script>
    </body>
</html>