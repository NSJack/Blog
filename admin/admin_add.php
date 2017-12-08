<?php
//echo ("后台管理首页");

include ('../start.php');
include(ADM_PATH.'/start.adm.php');

$auid = (int) $input->get('auid');

$item = array(
    'auid' => 0,
    'auname' => '',
    'passwd' => '',
);

if($auid>0){
    $item = $db->get("select * from adminuser where auid = '{$auid}'");
    //$item = $db->get("select * from adminuser where $auname = '{$auname}'");
    if(!$item){
        exit("没有找到对应用户");
    }
}

var_dump($item['auname']) ;
    
//读取adminuser的数据
if ($input->get('do') == 'save') {
    $auid = (int) $input->post('auid');
    $auname = trim($input->post('auname'));
    $passwd = trim($input->post('passwd'));
    
    if (empty($auname)) {
        exit("用户名不能为空");
    }
    
    //仅仅在添加账号的时候，验证账号重复     
    if($auid<1){
         if (empty($passwd)) {
            exit("密码不能为空");
        }
        $usercheck = $db->get("select * from adminuser where auname='{$auname}'");
        if (is_array($usercheck)) {
            exit("用户名已存在");
        }
    }
    //根据添加、修改的不同需要执行不同的sql
    if($auid<1){        
        $passwd = md5($passwd);
        $sql = "insert into adminuser (auname,passwd) values ('{$auname}','{$passwd}')";
        }else{
        //如果密码字段为空，则不修改密码
            if(empty($passwd)){
                $sql = "update adminuser set auname='{$auname}' where auid='{$auid}'";
            }else{              
                $passwd = md5($passwd);
                $sql = "update adminuser set auname='{$auname}',passwd='{$passwd}' where auid='{$auid}'";
            }
    }

    $db->query($sql);
    header("location:".ADM_URL_PATH."/admin.php");

    exit;
}
?>

<!DOCTYPE html>
<html lang="zh-CN">
<head>
	<?php    include(ADM_PATH.'/inc/header.inc.php');?>
</head>
<body>
    
    <?php include(ADM_PATH.'/inc/nav.inc.php');?>

    <div class="container " >
        <div class="page-header">
            <h1>管理员管理 
                <small class="pull-right">
                    <a href="<?php echo ADM_URL_PATH ?>/admin.php" class="btn btn-primary btn-sm"><span class="glyphicon glyphicon-chevron-left"></span> 返回</a>
                </small>
            </h1>
        </div>
        
            <div class="container ">
            <div class="col-md-6 col-md-offset-3" >
                    <form class="form-horizontal" action="<?php echo ADM_URL_PATH;?>/admin_add.php?do=save" method="post" >
                        <input type="hidden" name="auid" value="<?php echo $auid;?>">
                        <div class="form-group">
                            <label for="auname" class="col-sm-2 control-label">用户：</label>
                                <div class="col-sm-10">
                                    <input type="text" name="auname" class="form-control" id="auname" placeholder="请输入用户名" value="<?php echo $item['auname']; ?>">
                                </div>
                        </div>
                        <div class="form-group">
                            <label for="password" class="col-sm-2 control-label">密码：</label>
                                <div class="col-sm-10">
                                    <input type="password" name="passwd" class="form-control" id="passwd" placeholder="请输入密码">
                                </div>
                        </div>

                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                                <button type="submit" class="btn btn-default">提交</button>
                            </div>
                        </div>
                    </form> 
            </div> 
        </div>  
    </div>
</body>
</html>
