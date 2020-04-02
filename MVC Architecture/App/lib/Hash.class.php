<?php
/**
 * Created by IntelliJ IDEA.
 * User: user
 * Date: 22/05/2019
 * Time: 5:04 PM
 */

class Hash {
    public static function make($str, $algo=PASSWORD_BCRYPT, $opts=null, $prehash = null) {
        // $str .=self::mix_hash(self::prefix_hash($prehash).'_').$str;
        $opts = [
            'cost' => 12,
        ];
        return password_hash($str, $algo, $opts);
    }
    public static function check($str, $hash ) {
        return password_verify($str, $hash);
    }
    public static function needsRehash($str, $algo=PASSWORD_DEFAULT) {
        $opts = [
            'cost' => 12,
        ];
        return password_needs_rehash($str, $algo, $opts);
    }

    public static function random($length=32 ) {
        return substr( md5( mt_rand() ), 0, $length );
    }
    public static function mix_hash($str)
    {
        return sha1(md5($str));
    }
    public static function prefix_hash($pre){
        return $pre;
    }

}