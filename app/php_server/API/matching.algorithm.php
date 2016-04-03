<?php

/**
 * Created by Taban Cosmos.
 * User: Taban
 * Date: 9/24/15
 * Time: 12:50 PM
 */

require("../Auto-Load.php");

class MatchingAlgorithmDev
{


    /** To accomplish this algorithm, what is needed.
     *
     *  DATA STRUCTURES TO USE.
     *  QUEUE, STACKS PRIORITY QUEUE
     *
     *
     *
     *  Matching algorithm.
     *
     *  To make users take few factors into account.
     *  When a user uses facebook to login,
     *  Based on their facebook relationship, try to alert the user that
     *  his or her friend is looking for a roommate or room
     *
     *  User location GPS approximation.
     *
     *  Take users preferences and compare it to the many
     *  data available to see if there are things that are similar
     *  to users who are in the same area.
     *
     *  When a user does choose a location, based ont the location that they prefer,
     *  Help the user get matched to find a roommate or room
     *
     *  Take into consideration the amount of lease they want to
     *  commit
     *
     *  Lease term.
     *  Urgency. How quick a user wants someone to become
     *  roommate or get an apartment or room
     *
     * */


    private $aboutTheUser = null;
    private $smoking = null;
    private $drinking = null;
    private $partying = null;
    private $clean = null;
    private $hygiene = null;
    private $description = null;
    private $userA = null;
    private $userB = null;
    private $databaseInstance = null;
    private $database;
    private $connection;

    /* 
    Getting data from users in the database and comparing it 
    to other users within the database
    */

    /** Constructor
     *
     * Access database tables get the values for the user
     * perform sting manipulation be doing any comparison with
     * other existing users in the database.
     *
     */


    public function _constructor()
    {
        /**
         * SQL query to access the database table and saving the results into the an array for
         * string processing.
         *
         */
        $this->database = LocalDatabase::getInstance();
        /** Assign database object to database */
        $this->connection =& $this->database->getConnection();
        /** Save database connection */

    }

    public function returnData()
    {

        if ($this->connection)
            return 0;
        return 1;
    }

    /* Strip widespace from a long text fro va*/

    private function matchingAlgorithm()
    {
        global $connection;
        $location = null;
        $preference = null;
    }

    //Test purpose

    private function strip_wideSpace($data)
    {

        if (empty($data)) {

        }

    }

}


$matchingAl = new MatchingAlgorithmDev();
$return =& $matchingAl;


echo $return->returnData();













