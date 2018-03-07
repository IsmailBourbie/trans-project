<?php

require './database_connection.php';

//Creating a database_connection object, we will use it in the queries

$connection = new database_connection();

//creating and array in which we gonna store some information and output it in json
$response = array();

if (isset($_GET['id_user']) && isset($_GET['decision']) && isset($_GET['id_temp'])) {

    $response['status'] = 'Okay';

    $id_user = $_GET['id_user'];
    $id_temp = $_GET['id_temp'];
    $decision = $_GET['decision'];

    $select_word_from_id = "SELECT english_word, french_word FROM temp_words WHERE _id_temp = '$id_temp'";

    $result_of_select_word_from_id = mysqli_query($connection->connection, $select_word_from_id);

    $data_of_select_word_from_id = mysqli_fetch_array($result_of_select_word_from_id);

    $english_word = $data_of_select_word_from_id['english_word'];
    $french_word = $data_of_select_word_from_id['french_word'];

    $insert_query = "INSERT INTO voted(_id_user,_id_temp,type) VALUES('$id_user','$id_temp','$decision')";

    mysqli_query($connection->connection, $insert_query);

    if ($decision == 1) {
        $count_query = "SELECT (SELECT COUNT(_id_temp) "
                . "FROM voted WHERE type = true AND _id_temp = '$id_temp') "
                . " - (SELECT COUNT(_id_temp) FROM"
                . " voted WHERE type = false AND _id_temp = '$id_temp') as result;";

        $result = mysqli_query($connection->connection, $count_query);
        $data = mysqli_fetch_array($result);
        if ($data['result'] >= 4) {

            $select_french_word = "SELECT * FROM french_words WHERE french_word='$french_word'";
            $select_english_word = "SELECT * FROM english_words WHERE english_word='$english_word'";

            $result_for_exist_french = mysqli_query($connection->connection, $select_french_word);
            $result_for_exist_english = mysqli_query($connection->connection, $select_english_word);

            if ($result_for_exist_english->num_rows == 0 && $result_for_exist_french->num_rows == 0) {
                $insert_in_eng_query = "INSERT INTO english_words"
                        . "(_id_english, english_word) VALUES (NULL,'$english_word');";
                $result_en = mysqli_query($connection->connection, $insert_in_eng_query);
                $id_eng = mysqli_insert_id($connection->connection);

                $insert_in_fr_query = "INSERT INTO french_words"
                        . "(_id_french, french_word) VALUES (NULL,'$french_word');";
                $result_fr = mysqli_query($connection->connection, $insert_in_fr_query);
                $id_fr = mysqli_insert_id($connection->connection);

                $insert_into_synonyms = "INSERT INTO synonyms(_id_french, _id_english) VALUES ('$id_fr','$id_eng');";
                mysqli_query($connection->connection, $insert_into_synonyms);

                $delete_from_voted = "DELETE FROM voted WHERE _id_temp = '$id_temp';";
                $delete_from_temp = "DELETE FROM temp_words WHERE _id_temp='$id_temp'";

                mysqli_query($connection->connection, $delete_from_voted);
                mysqli_query($connection->connection, $delete_from_temp);
            } else {
                if ($result_for_exist_english->num_rows == 0) {

                    $data_french = mysqli_fetch_array($result_for_exist_french);
                    $id_of_french_word = $data_french['_id_french'];
                    $insert_in_eng_query = "INSERT INTO english_words"
                            . "(_id_english, english_word) VALUES (NULL,'$english_word');";
                    $result_en = mysqli_query($connection->connection, $insert_in_eng_query);
                    $id_eng = mysqli_insert_id($connection->connection);

                    $insert_into_synonyms = "INSERT INTO synonyms(_id_french, _id_english) VALUES ('$id_of_french_word','$id_eng');";
                    mysqli_query($connection->connection, $insert_into_synonyms);

                    $delete_from_voted = "DELETE FROM voted WHERE _id_temp = '$id_temp';";
                    $delete_from_temp = "DELETE FROM temp_words WHERE _id_temp='$id_temp'";

                    mysqli_query($connection->connection, $delete_from_voted);
                    mysqli_query($connection->connection, $delete_from_temp);
                } else if ($result_for_exist_french->num_rows == 0) {
                    $data_english = mysqli_fetch_array($result_for_exist_english);
                    $id_of_english_word = $data_english['_id_english'];

                    $insert_in_fr_query = "INSERT INTO french_words"
                            . "(_id_french, french_word) VALUES (NULL,'$french_word');";
                    $result_fr = mysqli_query($connection->connection, $insert_in_fr_query);
                    $id_fr = mysqli_insert_id($connection->connection);

                    $insert_into_synonyms = "INSERT INTO synonyms(_id_french, _id_english) VALUES ('$id_fr','$id_of_english_word');";
                    mysqli_query($connection->connection, $insert_into_synonyms);

                    $delete_from_voted = "DELETE FROM voted WHERE _id_temp = '$id_temp';";
                    $delete_from_temp = "DELETE FROM temp_words WHERE _id_temp='$id_temp'";

                    mysqli_query($connection->connection, $delete_from_voted);
                    mysqli_query($connection->connection, $delete_from_temp);
                }
            }
        }
    } else {
        $count_query = "SELECT (SELECT COUNT(_id_temp) "
                . "FROM voted WHERE type = true AND _id_temp = '$id_temp') "
                . " - (SELECT COUNT(_id_temp) FROM"
                . " voted WHERE type = false AND _id_temp = '$id_temp') as result;";

        $result = mysqli_query($connection->connection, $count_query);
        $data = mysqli_fetch_array($result);
        echo $data['result'];
    }
} else {
    $response['status'] = 'Error';
    $response['message'] = 'missing parametrs';
    header("Content-type:application/json");
    echo json_encode($response);
}