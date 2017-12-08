<?php
//时间+8小时
date_default_timezone_set( 'Asia/Shanghai' );
//前台的网址路径
define("URL_PATH", 'http://blog.com');
//前台的硬盘路径
define("APP_PATH", dirname(__FILE__));
//后台的硬盘路径前缀
define("ADM_PATH", APP_PATH.'/admin');
//后台的网址路径前缀
define("ADM_URL_PATH", 'http://blog.com/admin');
//加载配置文件
include (APP_PATH.'/config.php');
//加载数据库类
include(APP_PATH.'/lib/db.class.php');
$db = new db('127.0.0.1', 'php','123456' ,'blog' );
//var_dump($db);
//加载输入类
include (APP_PATH.'/lib/input.class.php');
$input = new input();
//加载函数库
include (APP_PATH.'/lib/founctions.php');
//var_dump(APP_PATH.'/lib/db.class.php');
$db->query('set names utf8');