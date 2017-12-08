<?php

include ('../start.php');
include(ADM_PATH.'/start.adm.php');

$db->query('set names utf8');
$config = $db->gets("select * from settings order by sid asc");

if( $input -> get('do') == 'save' ){
    $v = $input ->post('v',FALSE);
    foreach ( $v as $key => $val ){
        $sql = "update settings set v='{$val}' where k='{$key}'";
        $db->query($sql);
    }
    header("location:".ADM_URL_PATH."/settings.php");
    exit;
}
    
?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <?php    include(ADM_PATH.'/inc/header.inc.php');?>
    <link rel="stylesheet" type="text/css" href="<?php echo URL_PATH;?>/public/simditor/styles/simditor.css" />  
    
    <script type="text/javascript" src="<?php echo URL_PATH;?>/public/simditor/scripts/module.js"></script>
    <script type="text/javascript" src="<?php echo URL_PATH;?>/public/simditor/scripts/hotkeys.js"></script>
    <script type="text/javascript" src="<?php echo URL_PATH;?>/public/simditor/scripts/uploader.js"></script>
    <script type="text/javascript" src="<?php echo URL_PATH;?>/public/simditor/scripts/simditor.js"></script>
</head>
<body>   
    <?php include(ADM_PATH.'/inc/nav.inc.php');?>

    <div class="container " >
        <div class="page-header">
            <h1>基本设置 
                <small class="">
                    设置网站的功能开关。
                </small>
            </h1>
        </div>
        
            <div class="container ">
            <div class="col-md-12" >
                    <form class="form-horizontal" action="<?php echo ADM_URL_PATH;?>/settings.php?do=save" method="post" >
                        <?php foreach ($config as $item):?>
                        <div class="form-group">
                            <label for="title" class="col-sm-2 control-label"><?php echo $item['kname'];?></label>
                                <div class="col-sm-10">
                                    <input type="text" name="v[<?php echo $item['k'];?>]" class="form-control"  placeholder="请输入配置" value="<?php echo $item['v'];?>">
                                    <p><span style="margin: 5px"class="glyphicon glyphicon-question-sign"> </span><?php echo $item['intro'];?>(<?php echo $item['k'];?>)</p>
                                </div>
                        </div>                  
                        <?php endforeach;?>
                        <div class="form-group">                          
                            <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-10">
                                    <button type="submit" class="btn btn-default">提交</button>
                                </div>
                            </div>
                        </div> 
                </form>       
        </div>  
    </div>
</body>
</html>
