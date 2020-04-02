<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

Class Controllers {

    protected $data;
    protected $model;
    protected $params;
    protected $path;

    public function getData() {

        return $this->data;
    }

    public function getModel() {

        return $this->model;
    }

    public function getParams() {

        return $this->params;
    }

    public function __construct($data = array()) {
        $this->data = $data;
        $this->params = App::getRouters()->getParams();
    }

    protected static function getDefaultViewPath() {

        $router = App::getRouters();

        if (!$router) {
            return false;
        }


        $controllerDirectory = $router->getControllers();


        $templateName = $router->getMethodPrefix() . $router->getActions() . '.html';

        return VIEWS_PATH . DS . $controllerDirectory . DS . $templateName;
    }

    public function views($pathf, $data = []) {


       // print_r($pathf);

        if ($pathf == "") {

            $pathf = self::getDefaultViewPath();

        }


        $pathf = VIEWS_PATH . DS . $pathf . '.html';



        if (!file_exists($pathf)) {

            $this->views('404', '');

            die();
            // throw new Exception('Template file is not found in path' . $pathf);
        }

        $this->data = $data;
        $this->path = $pathf;
        print $this->rendering();
        return false;

    }

    public function rendering() {

        $data = $this->data;
        ob_start();
        include($this->path);
        $loadContent = ob_get_clean();
        return $loadContent;
    }

    public function request($type = null)
    {

        $dataType = array(
                    'get' => $_GET,
                    'post' => $_POST,
                    'file' => $_FILES,
                    'put' => $_REQUEST
        );



        if(isset($dataType[$type])){

            return (object) $dataType[$type];
        }else{

            return false;
        }


    }

    
    public function datetime($format){
        
        $date = array(
            'd' => date('Y-m-d'),
            'dt' => date('Y-m-d H:i:s'),
            'dta' => date('Y-m-d H:i:s A'),
            '24ta' => date('H:i:s A'),
            '12ta' => date('h:i:s A'),
            't' => time(),
            
        );
        
        return isset($date[$format])? $date[$format] : date($format);
    }




}
