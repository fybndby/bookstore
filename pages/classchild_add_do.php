

<?php
    header("Content-type:text/html;charset=utf8");


    //访问限制
    if(!defined('WWWROOT')){
        die('request not allowed!');
    }

    //接收表单数据
    $cid = intval($cid);
    $title = trim($title);

    //验证合法性

    //入库语句
    $sql = "INSERT INTO ykj_class_child(cid,cname) VALUES ($cid,'".$title."')";

    //执行语句

    $msql ->execute($sql);

    //验证数据是否入库
    $res = $msql ->affectedRows();

    if($res>0){
        echo '数据入库成功';
        echo '<a href="main.php?go=classchild_add">继续新增</a>';
        echo '<a href="main.php?go=classchild">返回列表页</a>';
    }else{
        echo '数据入库失败';
    }



    //载入模板
    // include 'pages/templates/classchild_add.html';
?>
     