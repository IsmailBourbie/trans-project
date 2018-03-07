<?php
require './database_connection.php';

//Creating a database_connection object, we will use it in the queries

$connection = new database_connection();

//the response array
$response = array();

$response['status'] = 'Okay';

$select_query = "SELECT * FROM users ";

//getting the result
$result = mysqli_query($connection->connection, $select_query);

//check if the result is bigger than 0
if ($result->num_rows > 0) {
    $response['message'] = 'There si users';
    $response['users'] = array();
    while ($row = mysqli_fetch_array($result)) {
        $user = array();
        $user['id_user'] = $row['_id_user'];
        $user['email'] = $row['email'];
        $user['password'] = $row['password'];
        $user['username'] = $row['username'];

        array_push($response['users'], $user);
    }
    header('Content-type:application/json');
    echo json_encode($response);
    
} else {
    $response['message'] = 'There is no users';
    header('Content-type:application/json');
    echo json_encode($response);
}
