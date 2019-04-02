

<?php
    //访问限制 
    if(!defined('WWWROOT')){
        die('request not allowed!');
    }

    //一级分类名称入库

    //1.入库语句
    $sql = "INSERT INTO ykj_class_parent (cname) VALUE ('".$title."')";

    //2.执行语句
    $msql ->execute($sql);

    //查看执行结果
    $res = $msql ->affectedRows();

    //给模板提供数据
    if($res>0){
        $result = '创建成功！';
    }else{
        $result = '创建失败！';
    }
    
    // $content = 'Welcome page!';

    //载入模板
    include 'pages/templates/classparentaddo.html';
?>
     