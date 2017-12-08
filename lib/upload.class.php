<?php


class upload{
    //生成路径
    function getFullName($filename){
        return $filepath =  '/public/files/'.$filename;
    }
    function  up($form_name){
        $file1 = $_FILES[$form_name];
        //处理返回信息
        $result = array();
        $result['error'] = 0;
        
        
        //处理错误
        if ( $file1['error'] > 0 ) {
            $result['error'] = $file1['error'];
            return $result;
        }
        //获取文件后缀(并转为小写)
        $ext = strtolower(pathinfo($file1['name'],PATHINFO_EXTENSION));
        //拼接生成文件名
        $filename = microtime(true).".".$ext;
        
        //文件名
        $result['filename'] = $filename;
        //网站路径
        $result['full_filename'] = $this->getFullName($filename);
        //硬盘路径
        $result['disk_filename'] = APP_PATH .$result['full_filename'];
        
        //将文件移动到指定目录
        $is = move_uploaded_file($file1['tmp_name'],$result['disk_filename']);
        if( !$is ){
            return $result['error'] = -1;
        }
        return $result;
    }
}
