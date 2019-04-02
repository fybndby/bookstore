


<?php
    //访问限制
    if(!defined('WWWROOT')){
        die('request not allowed!');
    }
    //获取ID
    $id = intval($id);
    //根据该ID获取数据
    $sql = "SELECT m.id,m.cid,ccid,musicname,singer,compose,writer,price,c.cname as cname,coverurl,words,dt FROM ykj_music as m LEFT JOIN ykj_class_child as c ON (m.ccid=c.id) WHERE m.id=$id ORDER BY m.id DESC LIMIT 1";

    //执行语句
    $msql ->execute($sql);

    //获取数据
    $res = $msql ->fetchquery();

    //二级分类名
    $className = $res['cname'];
    //书名
    $musicname = $res['musicname'];

    //作者
    $singer = $res['singer'];

    //出版社
    $compose = $res['compose'];

    //作词
    $writer = $res['writer'];

    //价格
    $price = $res['price'];

    //封面
    $coverurl = $res['coverurl'];

    //描述
    $words = $res['words'];

    //日期
    $dt = date('Y-m-d',$res['dt']);

    
    //载入模板
    include 'pages/templates/music_view.html';
?>
     