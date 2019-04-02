<?php

 //引入公用文件、
 require_once('../include/common.in.php');

 //初始化
 $res = array();
 $openid = trim($openid);
 
 //语句
 $sql = "SELECT uname,tel,address,header FROM ykj_user WHERE openid='".$openid."'";

 $msql ->execute($sql);

 $res = $msql ->fetchquery();

 //返回执行结果
 echo json_encode($res);  //{uname:'',tel:'',address:''}


?>