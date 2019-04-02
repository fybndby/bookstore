<?php
 //引入公用文件、
 require_once('../include/common.in.php');

 //畅销书top3
 $sql = "SELECT pid,bookname,price,sum(counts) as total FROM ykj_order as o LEFT JOIN ykj_book as b ON (o.pid=b.id) WHERE catagory='book' GROUP BY pid ORDER BY total DESC LIMIT 0,3";

 $msql ->execute($sql);

 while($res = $msql ->fetchquery()){

    //获取图书封面
    $pid = $res['pid'];
    $sql = "SELECT coverurl FROM ykj_cover WHERE bookid=$pid LIMIT 1";
    $msql ->execute($sql,'book');
    $res_cover = $msql ->fetchquery('book');

    $res['coverurl'] = $res_cover['coverurl'];

    //处理标题部分(如果超过21个字符截取)
    $title = $res['bookname'];
    $titleLen = strlen($title);
    if($titleLen>43){
       $res['bookname'] = mb_substr($title,0,21,'utf-8').'...';  //mb_substr 截取
    }
    $res['titlelength'] = strlen($title);
    //处理价格
    $price = explode('.',$res['price']);

    $res['price_int'] = $price[0];
    $res['price_dec'] = $price[1];

     $tempArr[] = $res;
 }

 echo json_encode($tempArr);

?>