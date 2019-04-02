

<?php
    //引入公用文件、
    require_once('../include/common.in.php');

   $id = intval($id);

   $sql = "SELECT m.id,musicname,singer,compose,writer,price,musicurl,coverurl,words,cname FROM ykj_music as m LEFT JOIN ykj_class_child as cc ON (m.ccid=cc.id) WHERE m.id=$id LIMIT 1";

   $msql ->execute($sql);

   $res = $msql ->fetchquery();

    //处理价格
    $price = explode('.',$res['price']); //explode分割
    $res['price_int'] = $price[0]; //整数部分
    $res['price_dec'] = $price[1];  //小数部分

   //返回数据
   echo json_encode($res);
?>














