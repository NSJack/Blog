<?php
include ('../start.php');
define("NOT_LOGIN",1);  //该页面不需要登录
include(ADM_PATH.'/start.adm.php');

//$_SESSION['auid']=0;

//session_start();
/*
if($_GET['do'] == 'checkuser'){
    echo "进入登录校验流程";
}
*/
if($input->get('do') == 'checkuser'){
    ///echo "进入登录校验流程";
  
    $auname = $input->post('username');
    $passwd = md5($input->post('passwd'));
    //var_dump($auname, $passwd);
  
    $sql = "select * from adminuser where auname='{$auname}' and passwd='{$passwd}' limit 1";
    //var_dump($sql);
    $row = $db->get($sql);
    if(!$row){
        exit("账号或密码错误");
    }
    else{
        $_SESSION['auid']=$row['auid'];
        header("location:index.php");
    }
    //var_dump($auname, ($passwd));
    
    exit;
}
//退出登录
if($input->get('do') == 'out'){
    $_SESSION['auid']=0;
    header("location:".ADM_URL_PATH."/login.php");
}
 
?>

<!DOCTYPE html>
<html lang="zh-CN">
<head>
	<?php    include(ADM_PATH.'/inc/header.inc.php');?>
</head>
<body>
    
    <div class="container " style="margin-top: 200px">
        <div class="col-md-3" ></div>
        <div class="col-md-6">
            
            <div class="panel panel-primary" >
                <div class="panel-heading">管理员登录</div>
                <div class="panel-body">
                    <form class="form-horizontal" action="<?php echo URL_PATH;?>/admin/login.php?do=checkuser" method="post">
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">用户：</label>
                                <div class="col-sm-10">
                                    <input type="text" name="username" class="form-control" id="username" placeholder="请输入用户名">
                                </div>
                        </div>
                        <div class="form-group">
                            <label for="inputPassword3" class="col-sm-2 control-label">密码：</label>
                                <div class="col-sm-10">
                                    <input type="password" name="passwd" class="form-control" id="passwd" placeholder="请输入密码">
                                </div>
                        </div>

                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                                <button type="submit" class="btn btn-default">登录</button>
                            </div>
                        </div>
                    </form> 
                </div>
                <div class="panel-footer text-right text-muted" >版权所有，盗版必究</div>
            </div>
            
            
            
        </div>
        <div class="col-md-3" ></div>
    </div>
        
</body>
</html>