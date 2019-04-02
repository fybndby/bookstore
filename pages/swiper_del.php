

<?php
//访问限制
if(!defined('WWWROOT')){
    die('request not allowed!');
}

//接收id
$id = intval($id);

//删除数据之前删除文件
$sql = "SELECT photourl FROM ykj_swiper id=$id LIMIT 1";
$msql ->execute($sql);
$res = $msql ->fetchquery();
$photoUrl = $res['photourl'];

if(file_exists($photoUrl)){
    @unlink($photoUrl);
}
$sql = "DELETE FROM ykj_swiper WHERE id=$id";

$msql ->execute($sql);

$as = $msql ->affectedRows();
$result = '';
if($as>0){
    $result = '删除成功';
    jump('main.php?go=swiper');
}else{
    $result = '删除失败';
}

 //载入模板
 include 'pages/templates/swiper_del.html';
?>