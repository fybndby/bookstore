<?php
//访问限制
if(!defined('WWWROOT')){
    die('request not allowed!');
}
    //
    $datas = '';
    //读取数据
    $sql = "SELECT id,title,photourl,gourl FROM ykj_swiper";

    $msql ->execute($sql);

    while($res = $msql ->fetchquery()){
        $datas .= '<tr>
        <th>'.$res['id'].'</th>
        <th>'.$res['title'].'</th>
        <th>'.$res['photourl'].'</th>
        <th>'.$res['gourl'].'</th>
        <th><a href="main.php?go=swiper_view&id='.$res['id'].'">浏览</a>|<a href="main.php?go=swiper_edit&id='.$res['id'].'">修改</a>|<a href="main.php?go=swiper_del&id='.$res['id'].'">删除</a></th>
      </tr> ';
    }
 //载入模板
 include 'pages/templates/swiper.html';
?>