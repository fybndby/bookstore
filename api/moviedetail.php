



<?php
    //引入公用文件、
    require_once('../include/common.in.php');

   $id = intval($id);

   $sql = "SELECT id,moviename,class_country,class_style,derector,writer,roles,price,coverurl,descript,longs,movieurl FROM ykj_movie WHERE id=$id";

   $msql ->execute($sql);

   $res = $msql ->fetchquery();
   $price = explode('.',$res['price']); //explode分割
   $res['price_int'] = $price[0]; //整数部分
   $res['price_dec'] = $price[1];  //小数部分
    //b.2 截取长度
   $res['descript'] = mb_substr($res['descript'],0,200,'utf8').'...';



   //返回数据
   echo json_encode($res);
?>



