<?php
/*****************************************************************
 * Created by Taban Cosmos.
 * User: Taban
 * Date: 9/21/15
 * Time: 9:03 PM
 *****************************************************/

/*****************************************************
 * This API inserts data into the database
 * Things to do: In progress
 *  1: Catching errors
 *      Checking for all inputs before they are submitted to the
 *      database
 *      Sending the result back to frontend so that
 *      a friendly message can be display to the users.
 ******************************************************/

/****** IMPORT FILES ******/
require_once("../Auto-Load.php");
require_once("../classes/Preference.php");


/** Database connection **/
$database = LocalDatabase::getInstance();
$connection =& $database->getConnection();

//Pass in database connection
//insertPreferenceData($database);
returnData($connection, $database);


/** set a user's preferences here *
 * @param $database
 * @throws Exception
 */
function insertPreferenceData($database)
{

    global $connection;
    /* Preference selection */
    $OCCASIONAL = 1;
    $FREQUENTLY = 2;
    $NONE = 3;
    $pref = new userPreference();
    $result = null;

    $pref->setAbout("I would like to have a roommate as soon asap because my
    lease is almost over. This new roommate will assume the
        the lease and that means you have will have the same rate I have now. ");
    $pref->setSmokeStatus($NONE);
    $pref->setDrinkingStatus($OCCASIONAL);
    $pref->setHygieneStatus($FREQUENTLY);
    $pref->setPartyStatus($NONE);


    //User preference setting
    $about = $pref->getAbout();
    $smoking = $pref->getSmokeStatus();
    $hygiene = $pref->getHygieneStatus();
    $partying = $pref->getPartyStatus();
    $drinking = $pref->getDrinkingStatus();
    $id = 8; //This ID needs to

    try {
        //Insert data into the database
        $query = "INSERT INTO userPreference (";
        $query .= " about, smoking, partying, hygiene, drinking, user_id";
        $query .= " ) VALUES ( '{$about}', '{$smoking}', '{$partying}', '{$hygiene}', '{$drinking}', '{$id}')";

        //execute query
        $result = mysqli_query($connection, $query);
        confirm_query($result, $connection);

        echo "Success";

    } catch (PDOException $e) {
        echo $result . "<br>" . $e->getMessage();
    }
    /*Database connection closed*/
    $connection = null;
}


/* Displays data */
function returnData()
{
    global $connection;
    /** Query */
    $query = "SELECT * FROM userPreference";
    try {
        $result = mysqli_query($connection, $query);
        confirm_query($result, $connection);
        //New data converted into array
        $array_data = array();
        while ($row = mysqli_fetch_assoc($result)) {
            $array_data[] = $row;
        }
        /**
         * encode the data into array.
         * The data is returned as a json encoded
         * data.
         * Accessible by the front end code that will
         * eventually get the specific data as a
         **/
        $json = json_encode($array_data);

        echo $json;
    } catch (PDOException $e) {
        echo $query . "<br>" . $e->getMessage();
    }
    $connection = null;//Close database connection
}