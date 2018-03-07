<?php

if (isset($_POST['logOut'])) {
    session_start();
    session_unset();
    session_destroy();
    header('Location: index.php');
}else{
    header('Location: profile.php');
}
