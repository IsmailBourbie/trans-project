<?php

require './database_connection.php';

//Creating a database_connection object, we will use it in the queries

$connection = new database_connection();

//the response array
$response = array();

if (isset($_GET['email']) && isset($_GET['username']) && isset($_GET['password'])) {

    $email = $_GET['email'];
    $password = $_GET['password'];
    $username = $_GET['username'];

    $response['status'] = 'Okay';
    
    $select_query = "SELECT * FROM users WHERE email ='$email'";
    $result_email = mysqli_query($connection->connection, $select_query);
    $select_query2 = "SELECT * FROM `users` WHERE username='$username'";
    $result_username = mysqli_query($connection->connection, $select_query2);
    if($result_email->num_rows>0 && $result_username->num_rows >0 ){
        $response['message'] = 'success';
    
    $response['message'] = 4;
    
    //and we output the damn json file
    header('Content-type: application/json');
    echo json_encode($response);
    }else if($result_username->num_rows>0){
        $response['message'] = 'success';
   
    $response['message'] = 3;
    
    //and we output the damn json file
    header('Content-type: application/json');
    echo json_encode($response);
    }else if($result_email->num_rows>0){
        $response['message'] = 'success';
   
    $response['message'] = 2;
    
    //and we output the damn json file
    header('Content-type: application/json');
    echo json_encode($response);
    }else{

    $insert_query = "INSERT INTO users(_id_user, email, password, username) "
            . "VALUES (NULL,'$email','$password','$username')";

    mysqli_query($connection->connection, $insert_query);
    
    $id_inserted = mysqli_insert_id($connection->connection);
    
    //putting the result in the response variable
    //in this case w set the message to succes
    $response['message'] = 'success';
    $response['id_user'] = $id_inserted;
    $response['message'] = 1;
    
    //and we output the damn json file
    header('Content-type: application/json');
    echo json_encode($response);
    }

  
    
} else {
    //if we had missing parametrs we output then
    $response['status'] = 'Error';
    $response['message'] = 0;
    header('Content-type: application/json');
    echo json_encode($response);
}
