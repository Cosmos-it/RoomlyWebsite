<?php
/**
 * Created by Taban Cosmos.
 * User: Taban
 * Date: 12/14/15
 * Time: 9:42 PM
 */
/**
 *==========================================================
 * This API inserts data into the database
 * Things to do:
 *  1: Catching errors
 *      Checking for all inputs before they are submitted to the
 *      database
 *      Sending the result back to frontend so that
 *      a friendly message can be display to the users.
 *=========================================================*/

/**==========IMPORT FILES=======================*/
require_once("../Auto-Load.php");

/**=======  Database Connection =================*/
$databaseInstance = LocalDatabase::getInstance();
$connection = $databaseInstance->getConnection();

/**===============Data posted======*/
$data = json_decode(file_get_contents("php://input"));
$password = $data->password;
$email = $data->email;

/**===================================================================
 * This function takes 4 variables, error message, database connection
 * user password and email
 *
 * @parameters
 * @param $password
 * @param $email
 *
 */

function authenticate($password, $email)
{
    global $connection;
    $password = $password;
    $email = $email;
    $message = "Error";
    $result = null;

    try {
        if (empty($password) && empty($email)) {
            print $message;

        }

        $query = "SELECT Email  FROM User" . " WHERE Email ='{$email}' AND Password ='{$password}'";
        $result = mysqli_query($connection, $query);
        confirm_query($result);

        if (count($result) == 1) {
            $_SESSION['uid'] = uniqid('uid_');
            echo json_encode($_SESSION['uid']);

        } else {
            echo json_encode($message);

        }
    } catch (Exception $e) {
        echo $result . "<br>" . $e->getMessage();
    }
}

authenticate($password, $email);
$connection = null;//Database connection closed


