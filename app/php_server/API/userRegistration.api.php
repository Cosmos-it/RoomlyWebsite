<?php
/****************************************************
 * This API inserts data into the database
 * Created by PhpStorm.
 * User: Taban
 * Date: 9/9/15
 * Time: 12:38 PM
 ****************************/

/*********** IMPORT FILES  *************/
require_once("../Auto-Load.php");
include("../classes/Registration.php");

//Database Connection
$database = LocalDatabase::getInstance();
$connection =& $database->getConnection();

$data = json_decode(file_get_contents("php://input"));

$query;

try {
    //Registration object
    $createUser = new Registration();

    $firstName = $data->firstName;
    $lastName = $data->lastName;
    $email = $data->email;
    $password = $data->password;
    $roomStatus = $data->roomOwner;
    //user profile image

    /**
     * This is when the user chooses either a room owner or not
     * 1 = room owner
     * 0 = not a room owner.
     */
    $checkedStatus = 0;

    if ($roomStatus == true) {
        $checkedStatus = 1;
    } else {
        $checkedStatus = 0;
    }

    //Set values
    $createUser->setFirstName("Latio");
    $createUser->setLastName("Cosmos");
    $createUser->setEmail("cosmosl@gmail.com");
    $createUser->setPassword("testpasswd");
    $createUser->setRoomStatus(1);

    /** Post the data to database **/
    $userName = $createUser->getUsername();
    $roomOwner = $createUser->getRoomStatus();
    $firstName = $createUser->getFirstName();
    $lastName = $createUser->getLastName();
    $email = $createUser->getEmail();
    $password = $createUser->getPassword();

    //Get values and post them into query.
    $query = "INSERT INTO users (";
    $query .= " username, firstname, lastname, password, roomstats, email";
    $query .= " ) VALUES ( '{$userName}', '{$firstName}', '{$lastName}', ";
    $query .= "'{$password}', '{$roomOwner}', '{$email}')";

    $result = mysqli_query($connection, $query);
    confirm_query($result, $connection);

    echo $result . json_encode($userName);//return user name.

} catch (PDOException $e) {
    echo $query . $e->getMessage();
}

$connection = null; //Closed connection








