


<?php
    //访问限制
    if(!defined('WWWROOT')){
        die('request not allowed!');
    }

    //接收ID
    $id = intval($id);

    //删除文件
    $sql = "SELECT musicurl,coverurl FROM ykj_music WHERE id=$id LIMIT 1";
    $msql ->execute($sql);
    $res = $msql ->fetchquery();

    //封面地址
    $coverurl = $res['coverurl'];
    //音频地址
    $musiceurl = $res['musiceurl'];

    //判断文件是否存在，如果存在就删除
    if(file_exists($coverurl)){
        @unlink($coverurl);
    }
    if(file_exists($musiceurl)){
        @unlink($musiceurl);
    }
    //删除数据
    $sql = "DELETE FROM ykj_music WHERE id=$id";

    //执行
    $msql ->execute($sql);
    $as = $msql ->affectedRows();
    if($as>0){
        $result = '删除成功！';
        //跳转
        jump('main.php?go=musiclist');
    }else{
        $result = '删除失败！';
    }

    //载入模板
    include 'pages/templates/music_del.html';
?>
     