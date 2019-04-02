

<?php
    //访问限制
    if(!defined('WWWROOT')){
        die('request not allowed!');
    }

    //1.获取ID    intval函数转成整型
    $id = intval($id);

    //2.删除一级分类的语句
    $sql = "DELETE FROM ykj_class_parent WHERE id=$id LIMIT 1";

    //3.执行删除
    $msql ->execute($sql);

    //4.执行结果
    $res = $msql->affectedRows();

    if($res>0){
        $result = '删除一级分类成功！';
        //删除二级分类
        $sql = "DELETE FROM ykj_class_child WHERE cid=$id ";

        //执行删除二级分类
        $msql ->execute($sql);

        //获取执行二级分类删除结果
        $res2 = $msql->affectedRows();

        if($res2>0){
            $result2 = '删除二级分类成功！';
        }else{
            $result2 = '删除二级分类失败！';
        }
    }else{
        $result = '删除一级分类失败！';
    }

    //载入模板
    include 'pages/templates/classparent_del.html';
?>