



<?php
    //访问限制
    if(!defined('WWWROOT')){
        die('request not allowed!');
    }

    //1.获取ID    intval函数转成整型
    $id = intval($id);
    // echo $id;

    //2.根据ID 查询数据库语句
    $sql = "SELECT cname FROM ykj_class_parent WHERE id=$id LIMIT 1";

    //3.执行语句
    $msql ->execute($sql);

    //4.获取数据
    $res = $msql ->fetchquery();

    //5.给模板提供数据
    $value = $res['cname'];

    // print_r($res);
    // echo $value;




    //载入模板
    include 'pages/templates/classparentedit.html';
?>