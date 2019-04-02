
<?php
 //引入公用文件、
 require_once('../include/common.in.php');

 //获取分类和产品ID
 $catagory = $catagory;
 $pid = $pid;

 //查询数据库
 switch($catagory){

     case 'book':
     $sql ="SELECT bookname as pname FROM ykj_book WHERE id=$pid LIMIT 1";
     break;

     case 'music':
     $sql ="SELECT musicname as pname FROM ykj_music WHERE id=$pid LIMIT 1";
     break;

     case 'movie':
     $sql ="SELECT moviename as pname FROM ykj_movie WHERE id=$pid LIMIT 1";
     break;

 }
 
    $msql ->execute($sql);

    $res = $msql ->fetchquery();

    echo json_encode($res);


?>