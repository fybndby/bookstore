


<?php
    //访问限制
    if(!defined('WWWROOT')){
        die('request not allowed!');
    }
    //获取ID
    $id = intval($id);

    //根据该ID获取数据
    $sql = "SELECT b.id,b.cid,ccid,bookname,author,publicer,price,dt,c.cname as cname,descript,fp FROM ykj_book as b LEFT JOIN ykj_class_child as c ON (b.ccid=c.id) WHERE b.id=$id ORDER BY b.id DESC LIMIT 1";

    //执行语句
    $msql ->execute($sql);

    //获取数据
    $res = $msql ->fetchquery();

    //二级分类名
    $className = $res['cname'];

    //二级分类ID
    $class_cid = $res['ccid'];

    //获取全部的二级分类
        //初始化
        $data='';
        //根据id从数据库中读取该一级分类
        //语句
        $sql ="SELECT id,cname FROM ykj_class_child WHERE cid=$class_parent_book";
        $msql ->execute($sql);
        while($rex = $msql ->fetchquery()){
            $data .= '<option value="'.$rex['id'].'">'.$rex['cname'].'</option>';
        }


    //书名
    $bookname = $res['bookname'];

    //作者
    $author = $res['author'];

    //出版社
    $publicer = $res['publicer'];

    //是否包邮
    $fp = $res['fp'];

    //价格
    $price = $res['price'];

    //描述
    $descript = $res['descript'];

    //日期
    $dt = date('Y-m-d',$res['dt']);
    
    //载入模板
    include 'pages/templates/book_edit.html';
?>
     