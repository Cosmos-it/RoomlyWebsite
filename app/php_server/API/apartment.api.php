<?php
/**********************
 * Created by Taban Cosmos.
 * User: Taban
 * Date: 9/21/15
 * Time: 9:03 PM
 ****************************/


/**************************
 *  IMPORT FILES
 *********************************/
require_once("../Auto-Load.php");
require_once("../classes/Apartment.php");


/*****************************************************
 * This API inserts data into the database
 * Things to do:
 *  1: Catching errors
 *      Checking for all inputs before they are submitted to the
 *      database
 *      Sending the result back to frontend so that
 *      a friendly message can be display to the users.
 *
 *****************************************************************/

/** Database connections **/

/* Database accessible from the Heroku cloud */

//$herokuDB = Database::getInstance();
//$herokuDB_Connection = $herokuDB->getConnection();

/* Local database connection for test purposes */
//Instantiate database
$database = LocalDatabase::getInstance();
$connection =& $database->getConnection();


/* Data received from the user interface 
* appartmentName
* location
* leaseTerm
* price
*/


$data = json_decode(file_get_contents("php://input"));


/**
 * @param $connection
 * @param $database
 * @internal param $databaseInstance
 * @internal param $data
 */
function insertApartmentInfo($connection, $database)
{

    //Create an object
    $apart = new Apartment();

    /* Set values */

    $apart->setAptName("The Groove");
    $apart->setLocation("Ellensburg");
    $apart->setLeaseTerm(3);
    $apart->setPrice(850.00);

    /* Get the results */
    $apartmentName = $apart->getAptName();
    $location = $apart->getLocation();
    $leaseTerm = $apart->getLeaseTerm();
    $price = $apart->getPrice();
    $user_id = 4;

    /* SQL QUERY */
    $query = "INSERT INTO apartmentDetails (";
    $query .= " apartmentName, location, price, leaseTerm, user_id";
    $query .= ") VALUES ('{$apartmentName}', '{$location}', '{$price}', '{$leaseTerm}', '{$user_id}')";
    $result = mysqli_query($connection, $query);
    confirm_query($result, $connection);

    echo "Success";

    /*Database connection closed*/

}


try {
    insertApartmentInfo($connection, $database);

} catch (Exception $e) {
    echo $e;
}