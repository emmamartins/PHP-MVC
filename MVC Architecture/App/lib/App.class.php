<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

Class App
{

    protected static $routers;
    protected static $getrouters;
    protected static $getpath;
    protected static $getview;

    public static $getDB;

    public static function getRouters()
    {

        return self::$routers;
    }

    public static function getPath()
    {
        return self::$getpath;
    }

    public static function runs($uri)
    {

        self::$routers = new Router($uri);


        $dbDriver = Configs::get('dbConnect')["Driver"];

        if ($dbDriver == "MYSQL") {
            self::$getDB = new MYSQL(Configs::get('dbConnect'));

        }
        if ($dbDriver == "SQLite") {
            self::$getDB = new SQLite(Configs::get('dbConnect'));

        }
        
        if ($dbDriver == "PostgreSQL") {
            self::$getDB = new PostgreSQL(Configs::get('dbConnect'));

        }

        if ($dbDriver == "Oracle") {
            self::$getDB = new Oracle(Configs::get('dbConnect'));

        }


        Lang::loadLang(self::$routers->getLanguages());

        self::$getrouters = Configs::get('route');


        $newUri = self::$routers->getControllers() . '/' . self::$routers->getActions();


        if (isset(self::$getrouters[$newUri])) {
            $routesUri = explode('@', self::$getrouters[$newUri]);
        } else {
            $routesUri = array();
        }

        if (isset($routesUri[0])) {

            $controllersClass = ucfirst(self::$routers->getControllers()) . 'Controller';

            $controllersMethods = self::$routers->getMethodPrefix() . $routesUri[1];

        } else {

            $controllersClass = ucfirst(self::$routers->getControllers()) . 'Controller';

            $controllersMethods = self::$routers->getMethodPrefix() . self::$routers->getActions();
        }

        try {

            $m = (self::$routers->getControllers());
            $ind = new IndexController();
            if (class_exists($controllersClass, true)) {


                $controllersObject = new $controllersClass();


                if (method_exists($controllersObject, $controllersMethods)) {

                    $controllersObject->$controllersMethods();


                    return false;

                }else{

                    die("This Method Not found :- ".$controllersMethods);
                }
            }elseif (method_exists($ind, $m)) {


                    return $ind->$m();


            }else {
                throw new Exception("Unable to load class: $controllersClass", E_USER_WARNING);

            }


        }catch (Exception $e){
            $con = new Controllers;
            $con->views('504', $e->getMessage());

    }


    }

    public static function startSession()
    {

        session_start();

    }


}

