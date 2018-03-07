<?php

require './database_connection.php';

//Creating a database_connection object, we will use it in the queries

$connection = new database_connection();

//the response array
$response = array();


//see if the url hase the email parametrs and the password paramter
if (isset($_GET['id_user']) ) {

    $id_user = $_GET['id_user'];
    $response['status'] = 'Okay';

    $select_query = "SELECT DISTINCT voted._id_temp,english_word,french_word FROM"
                . " temp_words ,voted WHERE "
                . "temp_words._id_temp = voted._id_temp "
                . "AND voted._id_user !='$id_user' AND voted._id_temp NOT IN "
                . "(SELECT voted._id_temp FROM voted WHERE voted._id_user ='$id_user')";
    

    //getting the result
    $result = mysqli_query($connection->connection, $select_query);

    //check if the result is bigger than 0, so we have a user
    if ($result->num_rows > 0) {

        $response['words'] = array();

        while ($data = mysqli_fetch_array($result)) {

            $words = array();

            $words['eng'] = $data['english_word'];
            $words['fr'] = $data['french_word'];
            $words['id_temp'] = $data['_id_temp'];
            
            array_push($response['words'],$words);
        }

        //in this case w set the message to succes
        $response['message'] = 1;

        //and we output the damn json file
        header('Content-type: application/json');
        echo json_encode($response);
    } else {
        //if we had no result so the user either is not in the database or password or email 
        //are not correct
        $response['message'] = 0;
        header('Content-type: application/json');
        echo json_encode($response);
    }
} else {
    //if we had missing parametrs we output then
    $response['status'] = 'Error';
    $response['message'] = -1;
    header('Content-type: application/json');
    echo json_encode($response);
}



