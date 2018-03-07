<?php

require './database_connection.php';

//Creating a database_connection object, we will use it in the queries
$connection = new database_connection();

//creating and array in which we gonna store some information and output it in json
$response = array();

if (isset($_GET['en_word']) && isset($_GET['fr_word']) && isset($_GET['id_user'])) {
    
    $en_word = $_GET['en_word'];
    $id_user = $_GET['id_user'];
    $fr_word = $_GET['fr_word'];
    
    $response['status'] = 'Okay';
    
    $select_french_word = "SELECT * FROM french_words WHERE french_word = '$fr_word'";
    $select_english_word = "SELECT * FROM english_words WHERE english_word = '$en_word'";
    
    $result_fr = mysqli_query($connection->connection, $select_french_word);
    $result_en = mysqli_query($connection->connection, $select_english_word);
    
    $select_temp_word = "SELECT * FROM temp_words WHERE english_word='$en_word' AND french_word ='$fr_word'";
    
    $result_temp = mysqli_query($connection->connection, $select_temp_word);

    if (($result_en->num_rows == 0 || $result_fr->num_rows == 0) && $result_temp->num_rows == 0) {
        
        $insert_into_temp = "INSERT INTO temp_words(_id_temp, english_word, french_word) VALUES(NULL,'$en_word','$fr_word') ";
        mysqli_query($connection->connection, $insert_into_temp);
        
        $generated_id = mysqli_insert_id($connection->connection);
        $insert_into_voted = "INSERT INTO voted(_id_user, _id_temp, type) VALUES ('$id_user','$generated_id',true)";
        
        mysqli_query($connection->connection, $insert_into_voted);

        $response['id_temp'] = $generated_id;
        $response['message'] = 'word added successfully';

        header('Content-type:application/json');
        echo json_encode($response);
        
    } else {
        
        $response['message'] = 'The word already exist';
        header('Content-type:application/json');
        echo json_encode($response);
        
    }
    
} else {
    
    $response['status'] = 'Error';
    $response['message'] = 'Missing Parametrs';
    header('Content-type: application/json');
    echo json_encode($response);
    
}
