<?php

include ('../start.php');
include(ADM_PATH.'/start.adm.php');

$bid = (int) $input->get('bid');

$item = array(
    'bid'     =>  0,
    'title'   =>  '',
    'author'  =>  $user['auname'],
    'content' =>  '',
);

if( $bid > 0 ){
    $item = $db->get("select * from blog where bid = '{$bid}'");
    if(!$item){
        exit("没有找到对应日志");
    }
}
if ($input->get('do') == 'save') {
    $bid        =  (int)$input->post('bid');
    $title      =  trim($input->post('title'));
    $author     =  trim($input->post('author'));
    $content    =  trim($input->post('content',false));
    $nowTime    =  time();
    if (empty($title) || empty($author) || empty($content)) {
        exit("请完整填写表单！");
    }
    if( $bid > 0 ){
        $sqlstr = "update blog set title='%s',author='%s',content='%s',uptime='%d' WHERE bid='%d'";
        $sql = sprintf($sqlstr,$title,$author,$content,$nowTime,$bid);
    }else{
        $sqlstr = "insert into blog (`title`,`author`,`content`,`intime`,`uptime`) values ('%s','%s','%s','%d','%d')";
        $sql = sprintf($sqlstr,$title,$author,$content,$nowTime,$nowTime);
    }
    
    //$sql="insert into blog (`title`,`author`,`content`,`intime`) values ('{$title}','{$author}','{$content}','{$intime}')";
    
    
    $db->query($sql);
    header("location:".ADM_URL_PATH."/blog.php");

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
            <h1>日志管理 
                <small class="pull-right">
                    <a href="<?php echo ADM_URL_PATH ?>/blog.php" class="btn btn-primary btn-sm"><span class="glyphicon glyphicon-chevron-left"></span> 返回</a>
                </small>
            </h1>
        </div>
        
            <div class="container ">
            <div class="col-md-12" >
                    <form class="form-horizontal" action="<?php echo ADM_URL_PATH;?>/blog_add.php?do=save" method="post" >
                        <input type="hidden" name="bid" value="<?php echo $bid;?>">
                        <div class="form-group">
                            <label for="title" class="col-sm-2 control-label">标题：</label>
                                <div class="col-sm-10">
                                    <input type="text" name="title" class="form-control" id="title" placeholder="请输入标题" value="<?php echo $item['title']; ?>">
                                </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="author" class="col-sm-2 control-label">作者：</label>
                                <div class="col-sm-4">
                                    <input type="text" name="author" class="form-control" id="author" placeholder="请输入作者" value="<?php echo $item['author']; ?>">
                                </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="content" class="col-sm-2 control-label">正文：</label>
                            <div class="col-sm-10">
                                <textarea name="content" id="content" ><?php echo htmlspecialchars($item['content']); ?></textarea>
                                <script>
                                    var editor = new Simditor({
                                      textarea: $('#content'),
                                      placeholder:'请输入正文....',
                                      upload:{
                                          url:'<?php echo ADM_URL_PATH."/upload.php";?>',
                                          fileKey:'file1'                                         
                                      },
                                      toolbar : [
                                            'title',
                                            'bold',
                                            'italic',
                                            'underline',
                                            'strikethrough',
                                            'fontScale',
                                            'color',
                                            'ol' ,           
                                            'ul'  ,           
                                            'blockquote',
                                            'code'    ,      
                                            'table',
                                            'link',
                                            'image',
                                            'hr'  ,   
                                            'indent',
                                            'outdent',
                                            'alignment'
                                             ]
                                      //optional options
                                    });
                                </script>
                            
                            </div>

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
