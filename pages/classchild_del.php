




<?php
    //访问限制
    if(!defined('WWWROOT')){
        die('request not allowed!');
    }
    //接收id
    $id = intval($id);
    //语句
    $sql = "DELETE FROM ykj_class_child WHERE id=$id";

    //执行语句
    $msql ->execute($sql);

    //返回执行结果

    $res = $msql ->affectedRows();
    $msql->error();
    if($res>0){
        $result = '删除成功！';
    }else{
        $result = '删除失败！';
    };



    //载入模板
    include 'pages/templates/classchild_del.html';
?>
     