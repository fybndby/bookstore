

<?php

    //访问限制
    if(!defined('WWWROOT')){
        die('request not allowed!');
    }

    //接收id
    $id = intval($id);


    //先读取一级分类
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

    //从数据库中查询该  ID的数据
    $sql = "SELECT cc.cname as cname,cid,cp.cname as pname FROM ykj_class_child as cc LEFT JOIN ykj_class_parent as cp ON(cc.cid=cp.id) WHERE cc.id=$id LIMIT 1";

    //执行语句
    $msql ->execute($sql);

    //获取数据
    $res = $msql ->fetchquery();
    


    // 载入模板
    include 'pages/templates/classchild_edit.html';
?>
     