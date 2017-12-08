<?php
include ('start.php');
include (APP_PATH.'/lib/page.class.php');


//当前页数
$p              = (int)$input->get('p');
if ($p<1) {
    $p = 1;
}
//每页显示数(从系统配置中读取)
$blogs_num      = C('blog_pages');

$offset         = $blogs_num * ($p-1);
//数据总数
$blogs_count    = $db->get("select count(*) as total from blog")[0];

$page = new page($blogs_count,$blogs_num,$p,URL_PATH.'index.php');

//读取blogs的数据
$sql = "select * from blog order by bid desc limit {$offset},{$blogs_num}";

$blogs = $db->gets($sql);

?>

<html>
    <head>
        <?php include('inc/header.inc.php');?>
    </head>
    <body>
        <div class="container">
            <div class="jumbotron">
               <h1><?php echo C('web_name');?></h1>
               <p><?php echo C('web_intro');?></p>
            </div>
            <div class="col-md-9" >
                
                <ol class="breadcrumb">
                    <li><a href="<?php URL_PATH;?>">首页</a></li>
                    <li><a href="#"></a></li>
                </ol>
                <?php foreach( $blogs as $blog ):?> 
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <a href="<?php URL_PATH;?>/blog.php?bid=<?php echo $blog['bid']; ?>"><?php  echo $blog['title'];?></a>
                        </div>
                        <div class="panel-body">
                            <?php  echo mb_substr(strip_tags($blog['content']), 0,50);?>...
                        </div>
                    </div>
                <?php  endforeach;?>
                <nav aria-label="Page navigation" class="pull-right">
                    <ul class="pagination">
                        <?php echo $page->showPage();?>       
                    </ul>
                </nav>
            </div>
            <div class="col-md-3">
                <?php include ('inc/sidebar.inc.php');?>
            </div>
            <div class="col-md-12 text-right">       
                <?php include ('inc/footer.inc.php');?>
            </div>
        </div>
    </body>
</html> 
