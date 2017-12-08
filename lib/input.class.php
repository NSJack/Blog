<?php

//负责处理输入
class input{
    function post($key,$filter=true){
        if( isset($_POST[$key])){
            $value = $_POST[$key];
        }
        else{
            $value = NULL;
        }
        if($filter){
            $value = strip_tags($value);
        }
        
        return $value;
    }
    
    function get($key){
        if(isset($_GET[$key])){
            $value = $_GET[$key];
        }
        else{
            $value = NULL;
        }
        $execValue = strip_tags($value);
        return $execValue;
    }
    
    function session($key){
        if(isset($_SESSION[$key])){
            $value = $_SESSION[$key];
        }
        else{
            $value = NULL;
        }
        $execValue = strip_tags($value);
        return $execValue;
    }
    
    function cookie($key){
        if(isset($_COOKIE[$key])){
            $value = $_COOKIE[$key];
        }
        else{
            $value = NULL;
        }
        $execValue = strip_tags($value);
        return $execValue;
    }
}
