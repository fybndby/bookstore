<?php
 //引入公用文件、
require_once('../include/common.in.php');

//接收表单数据并验证处理
// $catagory =$catagory;

//评论时间
$dt = time();


if ($action == 'add') {   //入库语句
    //入库
    $sql = "INSERT INTO ykj_comment(catagory,pid,openid,stars,notes,dt) VALUES ('" . $catagory . "',$pid,'" . $openid . "',$starnum,'" . $content . "',$dt)";

}

if($action == 'edit'){   //修改语句

    $sql = "UPDATE ykj_comment SET stars=$starnum,notes='".$content."' WHERE openid='".$openid."' AND catagory='".$catagory."' AND pid=$pid";

}

    $msql->execute($sql);

    $as = $msql ->affectedRows();

    if($as>0){
        echo 'success';
    }else{
        echo 'fail';
    }

?>