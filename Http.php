<?php
/**
 * Author   : wgkoro
 * Update   : 2014/3/2
 *
 * HTTP request helper class.
 */
class Http{
    public static function get($param_name, $default=null, $cast_type="string"){
        if(! isset($_GET[$param_name])){
            return $default;
        }

        $data   = $_GET[$param_name];
        return Http::getValidatedData($data, $default, $cast_type);
    }

    public static function post($param_name, $default=null, $cast_type="string"){
        if(! isset($_POST[$param_name])){
            return $default;
        }

        $data   = $_POST[$param_name];
        return Http::getValidatedData($data, $default, $cast_type);
    }

    public static function request($param_name, $default=null, $cast_type="string"){
        if(! isset($_REQUEST[$param_name])){
            return $default;
        }

        $data   = $_REQUEST[$param_name];
        return Http::getValidatedData($data, $default, $cast_type);
    }

    public static function cookie($param_name, $default=null, $cast_type="string"){
        if(! isset($_COOKIE[$param_name])){
            return $default;
        }

        $data   = $_COOKIE[$param_name];
        return Http::getValidatedData($data, $default, $cast_type);
    }

    // return request method. (ex."GET", "POST", "PUT"...)
    public static function method(){
        if(! isset($_SERVER["REQUEST_METHOD"])){
            return null;
        }

        return $_SERVER["REQUEST_METHOD"];
    }

    public static function getValidatedData($data, $default, $cast_type){
        $casted = Http::cast($data, $cast_type);
        if($casted === null && $cast_type != "unset"){
            return $default;
        }

        return $casted;
    }

    public static function cast($str, $type="string"){
        $val    = null;
        try{
            switch($type){
            case "int":
                if(! Http::isNum($str)){ return null; }
                $val    = (int) $str;
                break;
            case "integer":
                if(! Http::isNum($str)){ return null; }
                $val    = (int) $str;
                break;
            case "bool":
                $val    = (bool) $str;
                break;
            case "boolean":
                $val    = (bool) $str;
                break;
            case "array":
                $val    = (array) $str;
                break;
            case "object":
                $val    = (object) $str;
                break;
            case "unset":
                $val    = null;
                break;
            default:
                if($type == "str"){
                    $type = "string";
                }

                $val    = (string) $str;
            }
        }catch(Exception $e){}

        return $val;
    }

    public static function isNum($string){
        if(preg_match("/^[0-9]+$/", $string)){
            return true;
        }

        return false;
    }
}
