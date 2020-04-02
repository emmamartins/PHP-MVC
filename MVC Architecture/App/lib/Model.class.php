<?php
/**
 * Created by IntelliJ IDEA.
 * User: user
 * Date: 22/05/2019
 * Time: 4:09 PM
 */




class Model{

    protected $db;

    /**
     * Model constructor.
     */
    public function __construct()
    {

        $this->db = App::$getDB;
    }


}
?>