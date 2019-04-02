





<?php
    //访问限制
    if(!defined('WWWROOT')){
        die('request not allowed!');
    }
    //接收ID
    $id = intval($id);

    //删除封面文件
    $sql ="SELECT coverurl FROM ykj_movie WHERE id=$id LIMIT 1";
    $msql ->execute($sql);
    $res = $msql ->fetchquery();
    $url = $res['coverurl'];
    if(file_exists($url)){
        @unlink($url);
    }

    $sql = "DELETE FROM ykj_movie WHERE id=$id";
    $msql ->execute($sql);
    $as = $msql ->affectedRows();
    if($as>0){
        $result = '删除成功！';

        //跳转
        jump('main.php?go=movielist');
    }else{
        $result = '删除失败！';
    }





    //载入模板
    include 'pages/templates/movie_del.html';
?>
     