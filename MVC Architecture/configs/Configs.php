<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */




Configs::set('dbConnect', array(

    'host' => "localhost",
    'database' => "",
    'username' => "",
    'password' => "",
    'port' => "",
    'prefix' => "",
    'Driver' => "" //MYSQL

));


Configs::set('swiftmailer', array(

    'smtp' => "smtp.gmail.com",
    'username' => "",
    'password' => "",
    'port' => 465,

));


Configs::set('site_name', "SMS");

Configs::set('site_prefix', "sm_");

Configs::set('languages', array('en', 'fr', 'ig'));

Configs::set('route', array(
    'uri' => '',
    'uri' => 'indexController@method',

));

Configs::set('default_languages', "en");
Configs::set('default_routes', "index");
Configs::set('default_controllers', "index");
Configs::set('default_actions', "index");

