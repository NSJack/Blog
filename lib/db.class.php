<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class db{
    
    public $host;
    public $user;
    public $passwd;   
    public $dbname;
            
            
    public $dblink;
    
    //构造函数，用来传入数据库的各种参数
    function __construct($host,$user,$passwd,$dbname) {
        $this->host = $host;
        $this->user = $user;
        $this->passwd = $passwd;
        $this->dbname = $dbname;
        $this->connect();
        $this->query("aet names UTF8");
    }
    
    //连接数据库，并创建一个类属性：$this->dblink;
    function connect(){
        $mysqli = new mysqli($this->host,$this->user,$this->passwd,$this->dbname);
        if($mysqli->connect_errno<>0){
            echo "数据库连接失败，错误信息：".$mysqli->connect_error;
            exit;
        }
        $this->dblink = $mysqli;
    }
    
    //执行一次SQL查询
    function query($sql,$resultmode = MYSQLI_STORE_RESULT){
        return $this->dblink->query($sql,$resultmode);
    }
    
    //如果你认为有必要，可以调用这个方法，手动关闭数据库
    //否则，等网页加载完毕，会自动关闭数据库连接
    function close(){
        return $this->dblink->close();
    }
    //获取一条数据
    function get($sql){
        $res = $this->query($sql);
        $row = $res->fetch_array();
        return $row;
    }
    //获取多条数据
    function gets($sql){
        $res = $this->query($sql);
        $rows = array();
        while ($row = $res->fetch_array()){
            $rows[] = $row;
        }
        return $rows;
    }
    
    
}
