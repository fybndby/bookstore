<?php
    //接收ajax 参数
    $id = intval($id);

    //初始化
    $data='';
    //根据id从数据库中读取该一级分类
    //语句
    $sql ="SELECT id,cname FROM ykj_class_child WHERE cid=$id";
    $msql ->execute($sql);
    while($res = $msql ->fetchquery()){
        print_r($res);
        $data .= '<option value="'.$res['id'].'">'.$res['cname'].'</option>';
    }
    echo $data;
    $msql ->error();


?>