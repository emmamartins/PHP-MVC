<?php

/**
 * Created by IntelliJ IDEA.
 * User: user
 * Date: 22/05/2019
 * Time: 4:17 PM
 */
class Session
{

    protected static $flashMessage;

    protected static $sessions;

    public static function setFlash($message=array())
    {

        self::$flashMessage = $message;

    }

    public static function hasFlash($key)
    {

        return !is_null(self::$flashMessage[$key]);
    }

    public static function getFlash($key)
    {

        return self::$flashMessage[$key];

    }

    public static function setSession($key, $val)
    {

        return self::$sessions = $_SESSION[$key] = $val;

    }

    public static function getSession($key, $def = null)
    {

        return self::hasSession($key) ? $_SESSION[$key] : $def;
    }

    public static function hasSession($key)
    {

        return isset($_SESSION[$key]);
    }


    public static function deleteSession($key)
    {

        if (self::hasSession($key)) {
            unset($_SESSION[$key]);
        }

    }


    public static function destroySession()
    {

        session_destroy();

    }


}