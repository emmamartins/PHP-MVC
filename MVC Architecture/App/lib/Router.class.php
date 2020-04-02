<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

Class Router
{

    protected $uri;
    protected $controllers;
    protected $actions;
    protected $params;
    protected $routes;
    protected $methodprefix;
    protected $languages;

    public function getUri()
    {

        return $this->uri;
    }

    public function getControllers()
    {

        return $this->controllers;
    }

    public function getActions()
    {

        return $this->actions;
    }

    public function getParams()
    {

        return $this->params;
    }

    public function getLanguages()
    {

        return $this->languages;
    }

    public function getMethodPrefix()
    {

        return $this->methodprefix;
    }

    public function getRoutes()
    {

        return $this->routes;
    }

    public function __construct($uri)
    {
        $this->uri = urldecode(trim($uri, '/'));

        $routes = Configs::get('route');
        //print_r($this->routes);
        $this->routes = Configs::get('default_routes');
        $this->methodprefix = isset($routes[$this->routes]) ? $routes[$this->routes] : '';
        $this->languages = Configs::get('default_languages');
        $this->controllers = Configs::get('default_controllers');
        $this->actions = Configs::get('default_actions');
        $uri_paths = explode("?", $this->uri);

        $path_array = $uri_paths[0];
        $pathparts_array = explode('/', $path_array);
        $pathparts_paramarray = $_SERVER["QUERY_STRING"];


        if(isset($pathparts_paramarray) && !empty($pathparts_paramarray)) {
            $pairs = explode('&', $pathparts_paramarray);
            $pathparts_paramarray = array();

            # loop through each pair
            foreach ($pairs as $i) {
                list($name, $value) = explode('=', $i, 2);
                # if name already exists
                if (isset($pathparts_paramarray[$name])) {
                    # stick multiple values into an array
                    if (is_array($pathparts_paramarray[$name])) {
                        $pathparts_paramarray[$name][] = $value;
                    } else {
                        $pathparts_paramarray[$name] = array($pathparts_paramarray[$name], $value);
                    }
                } # otherwise, simply stick it in a scalar
                else {
                    $pathparts_paramarray[$name] = $value;
                }
            }

        }else{

            $pathparts_paramarray = "";
        }

        $path_parts = $pathparts_array;


        if (count($path_parts)) {

            if (in_array(current($path_parts), array_keys($routes))) {
                $this->routes = current($path_parts);
                $this->methodprefix = isset($routes[$this->routes]) ? $routes[$this->routes] : '';
                array_shift($path_parts);
            }
            if (in_array(current($path_parts), Configs::get('languages'))) {

                $this->languages = current($path_parts);
                array_shift($path_parts);
            }
            if (current($path_parts)) {
                $this->controllers = current($path_parts);
                array_shift($path_parts);
            }
            if (current($path_parts)) {
                $this->actions = current($path_parts);
                array_shift($path_parts);
            }

            $this->params = (empty($pathparts_paramarray))? $path_parts : $pathparts_paramarray;

        }
    }


    public static function redirect($location)
    {

        header('Location:' . $location);
    }
}
