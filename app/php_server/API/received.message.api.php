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
$database = LocalDatabase::getInstance();
$connection =& $database->getConnection();


function receiveMessage($connection) {

}
