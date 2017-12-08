<?php

include ('../start.php');
include(ADM_PATH.'/start.adm.php');
include(APP_PATH . '/lib/upload.class.php');

//上传文件
$u = new upload();
$result = $u->up('file1');

//拼接编辑器需要的JSON数组
$arr = [];
if ($result['error'] == 0) {
    $arr['success'] = true;
    $arr['file_path'] = $result['full_filename'];  
}else{
    $arr['msg'] = "错误代码：" .$result['error'];
}
echo json_encode($arr);
/*
 * {
  "success": true/false,
  "msg": "error message", # optional
  "file_path": "[real file path]"
}
 */

