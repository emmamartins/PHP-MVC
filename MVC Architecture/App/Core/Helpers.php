<?php
/**
 * Created by IntelliJ IDEA.
 * User: BetaCodings
 * Date: 10/06/2019
 * Time: 3:17 AM
 */

if (!function_exists('format')) {
    function format($msg, $vars)
    {
        $vars = (array)$vars;

        $msg = preg_replace_callback('#\{\}#', function ($r) {
            static $i = 0;
            return '{' . ($i++) . '}';
        }, $msg);

        return str_replace(
            array_map(function ($k) {
                return '{' . $k . '}';
            }, array_keys($vars)),

            array_values($vars),

            $msg
        );
    }
}

if (!function_exists('url')) {
    function url($path = '')
    {

        if (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off' || $_SERVER['SERVER_PORT'] == 443) {
            $http = "https://";
        } else {
            $http = "http://";
        }


        return $http . $_SERVER['HTTP_HOST'] . $path;
    }
}

if (!function_exists('public_path')) {
    function public_path($path = '')
    {
        return url(DS . ASSETS_PATH . $path);
    }
}

if (!function_exists('file_path')) {
    function filepath($filePath = '', $defaultfile = '')
    {

        if (file_exists(PUBLIC_PATH . DS . $filePath)) {

            return url(DS . $filePath);

        } else {

            return url($defaultfile);
        }

    }
}
if (!function_exists('countQuery')) {
    function countQuery($table, $qu = NULL)
    {
        $db = App::$getDB;

        $query = $db->query("SELECT * FROM $table $qu");

        //print_r("SELECT * FROM $table $qu");
        return $db->countRows($query);
    }
}

if (!function_exists('query')) {
    function query($sql)
    {
        $db = App::$getDB;
        return $db->query($sql);
    }
}

if (!function_exists('fetch')) {
    function fetch($query)
    {
        $db = App::$getDB;
        return $db->fetch($query);
    }
}


if (!function_exists('includeFile')) {
    function includeFile($path, $data = array())
    {
        $dir = '../';//'__DIR__.'/''
        $path = explode('.', $path);
        $fileExists = '';
        for ($i = 0; $i < count($path); $i++) {
            $fileExists .= $path[$i] . '/';
        }
        $fileExists = substr($dir . 'views/' . $fileExists, -0, -1) . '.html';
        if (file_exists($fileExists)) {
            require_once $fileExists;
        } else {
            die("The file {$fileExists} does not exists.");
        }
    }

}


if (!function_exists('emailSender')) {
    function emailSender($From, $To, $Subject, $Message)
    {

        $from = $From;
        $to = $To;
        $header = "From:$from\r\n";
        $header .= "MIME-Version: 1.0\r\n";
        $header .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
        $subject = $Subject;

        $retval = mail($to, $subject, $Message, $header);
        if ($retval == true) {
            return true;
        } else {
            return false;
        }
    }
}


?>