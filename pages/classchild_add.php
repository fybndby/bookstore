

<?php
    //访问限制
    if(!defined('WWWROOT')){
        die('request not allowed!');
    }

    //给模板提供数据

    //定义变量
    $datas = '';
    //1.查询一级分类语句
    $sql = "SELECT id,cname FROM ykj_class_parent";

    //2执行语句
    $msql ->execute($sql);

    //3.获取数据

    while($res = $msql ->fetchquery()){
        $datas .= '<option value="'.$res['id'].'">'.$res['cname'].'</option>';
    }
    //载入模板
    include 'pages/templates/classchild_add.html';
?>
     