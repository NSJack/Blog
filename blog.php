<?php
include ('start.php');
include (APP_PATH.'/lib/page.class.php');



    $bid        =  (int)$input->get('bid');
    

    
if($bid<1){
    exit("没有正确传递bid的参数");
}
            
$blog = $db->get("select * from blog where bid='{$bid}'");
if( !$blog ){
    exit("不存在的数据");
}



/*$bid = (int) $input->get('bid');
if($bid<1){
    exit("没有正确传递auid的参数");
}
$blog = $db->query("select * from blog where bid='{$bid}'");
if( !$blog ){
    exit("不存在的数据");
}
*/
?>

<html>
    <head>
        <?php include('inc/header.inc.php');?>
    </head>
    <body>
        <div class="container">
            <?php echo include('inc/nav.inc.php');?>
            <div class="col-md-9" >
                <ol class="breadcrumb">
                    <li><a href="<?php URL_PATH;?>">首页</a></li>
                    <li><a href="#"></a><?php echo $blog['title'];?></li>
                </ol>
                <div class="page-header">
                    <h1><?php echo $blog['title'];?> 
                        <small class="pull-right" style="font-size: 16px">
                            作者： <?php echo $blog['author'];?> <?php echo date("Y-m-d",$blog['intime']);?>
                        </small>
                    </h1>
                </div>
                <div class="well well-lg" style="line-height: 2em">
                    <?php echo $blog['content'];?>
                </div>
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
