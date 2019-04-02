


<?php
    //访问限制
    if(!defined('WWWROOT')){
        die('request not allowed!');
    }
    //获取ID
    $id = intval($id);

    //根据该ID获取数据
    $sql = "SELECT id,title,photourl,gourl FROM ykj_swiper  WHERE id=$id ORDER BY id DESC LIMIT 1";

    //执行语句
    $msql ->execute($sql);

    //获取数据
    $res = $msql ->fetchquery();

    $title = $res['title'];

    $photourl = $res['photourl'];

    $gourl = $res['gourl'];

    //载入模板
    include 'pages/templates/swiper_view.html';
?>
     