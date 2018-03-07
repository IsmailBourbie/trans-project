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
                <div class="header">
                    <div class="voteContainer float-right" ><button id="voteButton">Vote</button></div>
                    <div class="clearfix" ></div>
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
                        <div class="suggestWord" href="#"><i class="fa fa-pencil" aria-hidden="true"></i>&nbsp; Suggest a word</div>
                    </div>
                    <div class="sendSuggestContiner float-right">
                        <div class="thnxContiner">
                            <p class="reset-margin">Thanx for your Suggest.<br/><span>PS: will add your Suggest whene we checke it.</span></p>
                        </div>
                        <div class="sendSuggest">
                            <button id="buttonSend" disabled>Send</button>
                            <button id="buttonCancel">Cancel</button>
                        </div>
                    </div>
                    <div class="clearfix"></div>
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
    </body>
</html>