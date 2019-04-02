

<?php
//访问限制
if(!defined('WWWROOT')){
    die('request not allowed!');
}
    //接收表单数据
    $title =trim($title);
    $photo = $_FILES['poster'];
    $url = trim($url);
    //上传图片
    $destFile = uploadFile($photo);

    //入库
    $sql = "INSERT INTO ykj_swiper (title,photourl,gourl) VALUES ('".$title."','".$destFile."','".$url."')";

    $msql ->execute($sql);

    $as = $msql ->affectedRows();

    $result = '';
    
    if($as>0 && strpos($destFile,'load')){  //数据入库成功并且图片上传成功
        $result = '文件上传成功！'.'<br/>'.'数据入库成功！';
        jump('main.php?go=swiper');
    }else{
        $result = '数据库入库失败';
    }
    
    include 'pages/templates/swiper_add_do.html';

?>