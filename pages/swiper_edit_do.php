<?php
 //访问限制
if (!defined('WWWROOT')) {
    die('request not allowed!');
}
//接收ID
$id = intval($id);

//接收表单修改的数据
$title = trim($title);
$photourl = $_FILES['poster'];
$gourl = trim($url);
//上传图片
$destFile = uploadFile($photourl);

//语句
$sql = "UPDATE ykj_swiper SET id=$id,title='" . $title . "',gourl='" . $gourl . "' WHERE id=$id";
$msql->execute($sql);
$as = $msql->affectedRows();
$result = '';

if ($as > 0) {  //数据入库成功并且图片上传成功
    $result = '数据修改成功！';
    jump('main.php?go=swiper');
} else {
    $result = '数据修改失败';
}

//图片入库
$sql = "UPDATE ykj_cover SET coverurl='" . $destFile . "' WHERE bookid=$id";
$msql->execute($sql);

$as = $msql->affectedRows();
if ($as > 0) {
    $result_poster = '图片修改成功！<br/>';
} else {
    $result_poster = '图片修改失败！<br/>';
}



include 'pages/templates/swiper_edit_do.html';
 