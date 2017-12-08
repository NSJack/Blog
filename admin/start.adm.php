<?php
session_start();
$session_auid = (int) $input->session('auid');
$user  = $db->get("select * from adminuser where auid='{$session_auid}'");

//登录验证
if(($session_auid<1 || !is_array($user)) && defined('NOT_LOGIN')==FALSE ){
    header("location:".ADM_URL_PATH."/login.php");
    exit;
}

//var_dump($auid);