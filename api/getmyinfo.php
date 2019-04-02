<?php
 //引入公用文件、
 require_once('../include/common.in.php');

 //接收openid
//  echo $openid;

 //语句
 $sql = "SELECT uname,tel,address,post,header FROM ykj_user WHERE openid='".$openid."' LIMIT 1";

 $msql ->execute($sql);
 $res = $msql ->fetchquery();
 echo json_encode($res);




?>