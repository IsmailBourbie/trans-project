<?php

require './server/database_connection.php';

//Creating a database_connection object, we will use it in the queries

session_start();
if (isset($_POST['login'])) {
    $connection = new database_connection();
    $username = $_POST['username'];
    $userpass = $_POST['userpass'];

    $sql = "SELECT * FROM `users` WHERE email='$username' AND password='$userpass' ";

    $resultat = mysqli_query($connection->connection, $sql);

    $user = null;

    if ($resultat->num_rows > 0) {
        $data = mysqli_fetch_array($resultat);
        $_SESSION['logined'] = true;
        $_SESSION['username'] = $data['username'];
        $_SESSION['iduser'] = $data['_id_user'];
        header('Location: profile.php');
    } else {
        header('Location: index.php');
        unset($_SESSION['logined']);
        unset($_SESSION['username']);
        unset($_SESSION['iduser']);
    }
}else{
    header("HTTP/1.0 404 Not Found");
}
