

<?php
//访问限制
if(!defined('WWWROOT')){
    die('request not allowed!');
}
//接收ID
$id = intval($id);

$sql = "SELECT id,title,photourl,gourl FROM ykj_swiper WHERE id=$id";

$msql ->execute($sql);

$res = $msql ->fetchquery();

$title = $res['title'];
$photourl = $res['title'];
$gourl = $res['gourl'];

 include 'pages/templates/swiper_edit.html';
?>