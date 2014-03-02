<?php
class Env{
    public static function server($param_name, $default=null, $cast_type="string"){
        if(! isset($_SERVER[$param_name])){
            return $default;
        }

        $data   = $_SERVER[$param_name];
        return Env::getValidatedData($data, $default, $cast_type);
    }

    public static function session($param_name, $default=null, $cast_type="string"){
        if(! isset($_SESSION[$param_name])){
            return $default;
        }

        $data   = $_SESSION[$param_name];
        return Env::getValidatedData($data, $default, $cast_type);
    }

    public static function getValidatedData($data, $default, $cast_type){
        $casted = Env::cast($data, $cast_type);
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
                if(! Env::isNum($str)){ return null; }
                $val    = (int) $str;
                break;
            case "integer":
                if(! Env::isNum($str)){ return null; }
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
