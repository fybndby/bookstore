<?php
 //引入公用文件、
 require_once('../include/common.in.php');


 $openid = $openid;
 $catagory = $catagory;
 $pid = $pid;
 $dt = time();

 //订单入库
 $sql = "INSERT INTO ykj_order(openid,pid,catagory,counts,dt) VALUES('".$openid."',$pid,'".$catagory."',1,$dt) ";

 $msql ->execute($sql);

 $as = $msql ->affectedRows();

 if($as > 0){
     echo 'success';
 }else{
    echo 'fail';
 }


?>