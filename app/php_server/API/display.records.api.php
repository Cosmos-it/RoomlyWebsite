<?php
/**********************
 * Created by PhpStorm.
 * User: Taban
 * Date: 9/21/15
 * Time: 9:03 PM
 ****************************/
/**************************
 *  IMPORT FILES
 *********************************/
require_once("../Auto-Load.php");
require_once("../classes/Preference.php");
/*****************************************************
 * This API inserts data into the database
 *
 *
 * Things to do:
 *  1: Catching errors
 *      Checking for all inputs before they are submitted to the
 *      database
 *      Sending the result back to frontend so that
 *      a friendly message can be display to the users.
 *
 *****************************************************************/
/** Database connection **/
$databaseInstance = LocalDatabaseConnection::getInstance();
$connection = $databaseInstance->getConnection();
$db = Database::getInstance();
$connection = $db->getConnection();
$sql = 'SELECT * FROM admin';
$result = mysqli_query($connection, $sql);
if (!$result) {
    die("Database query failed");
}
//New data converted into array
$array_data = array();
while ($row = mysqli_fetch_assoc($result)) {
    $array_data[] = $row;
}
//encode the data into array.
$json = json_encode($array_data);
echo $json;
//Close database after successful connection
if (isset($connection)) {
    mysqli_close($connection);
}




