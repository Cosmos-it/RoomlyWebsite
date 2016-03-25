<?php
/**
 * Created by PhpStorm.
 * User: Taban
 * Date: 12/20/15
 * Time: 1:22 AM
 */

/*********** IMPORT FILES  *************/
require_once("../Auto-Load.php");
//Database Connection
$databaseInstance = LocalDatabase::getInstance();
$connection = $databaseInstance->getConnection();

//Data posted
$data = json_decode(file_get_contents("php://input"));

try {

    $token = $data->token;
    $logout = "LOGGED OUT";
    $query = "UPDATE User SET TOKEN='$logout' WHERE TOKEN='$token'";
    $result = mysqli_query($connection, $query);
    confirm_query($result);

    if (!$result) {
        die("Query failed " . mysqli_error($connection));
    } else {
        // echo a message to say the UPDATE succeeded
        echo $result . " records UPDATED successfully";
    }


} catch (Exception $e) {
    echo $result . $e->getMessage();
}

$connection = null;