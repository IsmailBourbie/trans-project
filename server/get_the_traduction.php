<?php

require './database_connection.php';

//Creating a database_connection object, we will use it in the queries

$connection = new database_connection();

//creating and array in which we gonna store some information and output it in json
$response = array();

if (isset($_GET['word']) && isset($_GET['sense'])) {

    $word = $_GET['word'];
    $sense = $_GET['sense'];
    $response['status'] = 'Okay';
    $response['source'] = $word;

    $select_query = NULL;
    if ($sense == 1) {
        $select_query = "SELECT english_word as result FROM "
                . "french_words AS fr,"
                . "synonyms,"
                . "english_words AS eng "
                . "WHERE french_word = '$word' AND"
                . " synonyms._id_french = fr._id_french AND"
                . " synonyms._id_english = eng._id_english";
    } else if ($sense == 0) {
        $select_query = "SELECT french_word as result FROM "
                . "french_words AS fr,"
                . "synonyms,"
                . "english_words AS eng "
                . "WHERE english_word = '$word' AND"
                . " synonyms._id_french = fr._id_french AND"
                . " synonyms._id_english = eng._id_english;";
    }


    $result = mysqli_query($connection->connection, $select_query);

    //check if the result is bigger than 0, so we have some words
    if ($result->num_rows > 0) {
        $response['synonyms'] = array();

        while ($data = mysqli_fetch_array($result)) {

            $words = array();

            $words['word'] = $data['result'];
            array_push($response['synonyms'],$words);
        }

        //putting the result in the response variable
        //in this case w set the message to succes
        $response['message'] = 'success';

        //and we output the damn json file
        header('Content-type: application/json');
        echo json_encode($response);
    } else {
        //if we had no result we output it
        $response['message'] = 'there is no word match';
        header('Content-type: application/json');
        echo json_encode($response);
    }
} else {
    //if we had missing parametrs we output then
    $response['status'] = 'Error';
    $response['message'] = 'Missing Parametrs';
    header('Content-type: application/json');
    echo json_encode($response);
}


