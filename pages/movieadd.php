




<?php
    //访问限制
    if(!defined('WWWROOT')){
        die('request not allowed!');
    }
    //初始化
    $class = $country ='';
    //类型（2级分类）
    $sql = "SELECT id,cname FROM ykj_class_child WHERE cid=$class_parent_movie";
    $msql ->execute($sql);
    while($res = $msql ->fetchquery()){
        $class .= '<option value="'.$res['cname'].'">'.$res['cname'].'</option>';
    }

    //地区
    $sql = "SELECT id,cname FROM ykj_class_child WHERE cid=$class_parent_country";
    $msql ->execute($sql);
    while($res = $msql ->fetchquery()){
        $country .= '<option value="'.$res['cname'].'">'.$res['cname'].'</option>';
    }
    //载入模板
    include 'pages/templates/movieadd.html';
?>
     