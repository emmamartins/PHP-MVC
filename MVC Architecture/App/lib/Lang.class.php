<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Lang {

    protected static $data;

    public static function loadLang($langCode) {

        $langPath = ROOT . DS . 'lang' . DS . strtolower($langCode) . '.php';

        if (file_exists($langPath)) {
            self::$data = include($langPath);
        } else {

            throw new Exception("Lang file not found" . $langPath);
        }
    }

    public static function get($key, $defindValue = '') {

        return isset(self::$data[strtolower($key)]) ? self::$data[strtolower($key)] : $defindValue;
    }

}
