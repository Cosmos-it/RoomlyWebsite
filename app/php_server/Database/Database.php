<?php

/**
 * Created by PhpStorm.
 * User: Taban
 * Date: 8/21/15
 * Time: 5:44 PM
 */
class Database
{

    /* Database field definition */
    private $url = null;
    private static $_instance; //The single instance
    private $_connection;
    private $DB_USER;
    private $DB_PASS;
    private $DB_PATH;
    private $DB_SERVER;

    /* Initiate the database connection */
    private function __construct()
    {

        $this->url = parse_url(getenv("CLEARDB_DATABASE_URL"));
        $this->DB_SERVER = $this->url['host'];
        $this->DB_USER = $this->url['user'];
        $this->DB_PASS = $this->url['pass'];
        $this->DB_PATH = substr($this->url['path'], 1);

        $this->_connection = new mysqli($this->DB_SERVER,
            $this->DB_USER,
            $this->DB_PASS, $this->DB_PATH);
        /* Test if connection succeeded */
        if (mysqli_connect_errno()) {
            die("Database connection failed: " .
                mysqli_connect_error() .
                " (" . mysqli_connect_errno() . ")"
            );
        }
    }

    /**********************************
     * Get an instance of the database
     *
     * @return Database
     *
     ***********************************/
    public static function getInstance()
    {

        if (!self::$_instance) { // If no instance then make one
            self::$_instance = new self();
        }

        return self::$_instance;
    }

    /****************************************
     * Magic method clone is empty to prevent duplication of connection
     *******************************************************************/
    private function __clone()
    {

    }

    /* Return a connection */
    public function getConnection()
    {

        return $this->_connection;
    }

    /* Closes data connection after usage */
    public function closeDBConnection()
    {

        $connection = $this->_connection;
        if (isset($connection)) {
            mysqli_close($connection);
        }
    }


}