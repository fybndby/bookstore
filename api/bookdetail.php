
<?php
 //引入公用文件、
 require_once('../include/common.in.php');

 //接收小程序传过来的id
 $id = intval($id);
 
 //查询语句
 $sql = "SELECT ccid,bookname,author,publicer,price,descript,cname FROM ykj_book as b LEFT JOIN ykj_class_child as cc ON (b.ccid=cc.id) WHERE b.id=$id LIMIT 1";
//  echo $sql;

 $msql ->execute($sql);

 //获取数据、
 $res = $msql ->fetchquery();


 //c.处理价格
 $price = explode('.',$res['price']); //explode方法分割
 $res['price_int'] = $price[0]; //整数部分
 $res['price_dec'] = $price[1];  //小数部分
 //初始化数组
 $tempArr =array();

 //b.2 截取长度
 $res['descript'] = mb_substr($res['descript'],0,200,'utf8').'...';
 //封面处理
 $sql = "SELECT coverurl FROM ykj_cover WHERE bookid=$id";
 $msql ->execute($sql);
 while($rex =$msql ->fetchquery()){
    $tempArr[] = $rex;
 }
 $res['cover'] = $tempArr;
 //转换成json数据并且输出
//  print_r($res);
 echo json_encode($res);



?>