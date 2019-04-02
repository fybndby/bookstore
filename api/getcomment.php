<?php
    //引入公用文件、
    require_once('../include/common.in.php');

    //获取分类和产品ID

    $catagory = $catagory;

    $pid = $pid;
    $sql ="SELECT stars,notes,c.dt,uname,header FROM ykj_comment as c LEFT JOIN ykj_user as u ON(c.openid=u.openid) WHERE catagory='".$catagory."' AND pid=$pid";

    $msql ->execute($sql);

    while($res = $msql ->fetchquery()){

        
        $tempArr[]= $res;
    }

    echo json_encode($tempArr);



?>