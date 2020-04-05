<?php

/**
 * Created by IntelliJ IDEA.
 * User: user
 * Date: 22/05/2019
 * Time: 1:07 PM
 */
Class Database
{

    public $connect = null;
    protected $host;
    protected $database;
    protected $username;
    protected $password;
    protected $port;
    protected $prefix;

    public function __construct($settings = array())
    {


        $this->host = $settings['host'];
        $this->database = $settings['database'];
        $this->username = $settings['username'];
        $this->password = $settings['password'];
        $this->port = $settings['port'];
        $this->prefix = $settings['prefix'];


        if (is_null($this->connect)) {
            $this->getConnection()->connectDB();
        }
    }

    /**
     * Check Database
     */
    public function connectDB()
    {

        if (oci_connect($this->connect, $this->database)):
            return true;
        else:
            return false;
        endif;
    }

    /**
     * Get Connection / Create Connections
     */
    public function getConnection()
    {

        try {
            $this->connect = " $this->host, $this->port, $this->username, $this->password"
            if (!oci_connect()) {
                die("Unable to create connection!");
            }

            return $this;
        } catch (Exception $e) {

            die("Unable to create connection!");
        }
    }

    public function query($sql)
    {


        $result = mysqli_query($this->connect, $sql);


        return $result;
    }

    public function DB($sql)
    {


        $result = mysqli_query($this->connect, $sql);
        if ($result) {
            $data = array();
            while ($row = mysqli_fetch_assoc($result)) {
                $data[] = $row;
            }
            return $data;
        } else {

            return false;
        }
    }

    public function countRows($result)
    {

        return $result->num_rows;
    }

    public function fetch($result)
    {

        if ($result) {
            $data = array();
            while ($row = mysqli_fetch_assoc($result)) {
                $data[] = $row;
            }
            return $data;
        } else {

            return false;
        }
    }

    public function escapeString($string)
    {

        return mysqli_real_escape_string($this->connect, $string);
    }


}
