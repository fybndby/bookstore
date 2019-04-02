
<?php
 //引入公用文件、
 require_once('../include/common.in.php');

    $sql = "SELECT id,cname FROM ykj_class_child WHERE cid=$class_parent_music";
    $msql ->execute($sql);
    //获取数据
    while($res = $msql->fetchquery()){
        $arrTemp[]=$res;
    }
    //返回数据
    echo json_encode($arrTemp);
  
?>