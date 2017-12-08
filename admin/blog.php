<?php
//echo ("后台管理首页");

include ('../start.php');
include(ADM_PATH.'/start.adm.php');
include(APP_PATH.'/lib/page.class.php');

switch ($input->get('do')){
    case "delete":
        $bid=(int) $input->get('bid');
        if($bid<1){
            exit("没有正确传递auid的参数");
        }
        $db->query("delete from blog where bid='{$bid}'");
        header("location:".ADM_URL_PATH."/blog.php");
        break;
}
//当前页数
$p              = (int)$input->get('p');
if ($p<1) {
    $p = 1;
}
//每页显示数(从系统配置中读取)
$blogs_num      = C('adm_blog_pages');

$offset         = $blogs_num * ($p-1);
//数据总数
$blogs_count    = $db->get("select count(*) as total from blog")[0];

$page = new page($blogs_count,$blogs_num,$p,ADM_URL_PATH.'/blog.php');

//读取blogs的数据
$sql = "select * from blog order by bid desc limit {$offset},{$blogs_num}";

$blogs = $db->gets($sql);
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
            <h1>日志管理 
                <small class="pull-right">
                    <a href="<?php echo ADM_URL_PATH ?>/blog_add.php" class="btn btn-primary btn-sm"><span class="glyphicon glyphicon-plus"></span> 添加</a>
                </small>
            </h1>
        </div>
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>bid</th>
                        <th>标题</th>
                        <th>作者</th>
                        <th>时间</th>
                        <th>管理功能</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($blogs as $blog):?>
                    <tr>
                        <td><?php echo $blog['bid']; ?></td>
                        <td><?php echo $blog['title']; ?></td>
                        <td><?php echo $blog['author']; ?></td>
                        <td><?php echo date("Y-m-d H-i-s",$blog['intime']); ?></td>                       
                        <td>
                             <a href="<?php echo ADM_URL_PATH;?>/blog_add.php?bid=<?php echo $blog['bid'];?>" 
                               class="btn btn-primary btn-xs">编辑</a>
                               
                           
                            <a href="<?php echo ADM_URL_PATH;?>/blog.php?do=delete&bid=<?php echo $blog['bid'];?>" 
                               class="btn btn-danger btn-xs">
                                删除
                            </a>                       
                        </td>
                    </tr>
                    <?php endforeach;?>
                </tbody>
            </table>
            
            <nav aria-label="Page navigation" class="pull-right">
                <ul class="pagination">
                  <?php echo $page->showPage();?>       
                </ul>
            </nav>
        </div>
    </div>
</body>
</html>