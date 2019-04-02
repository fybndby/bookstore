<?php
    //引入公用文件、
    require_once('../include/common.in.php');

    $sql = "SELECT b.id,bookname,price,coverurl,fp FROM ykj_book as b LEFT JOIN ykj_cover as c ON (b.id=c.bookid)  GROUP BY b.id ORDER BY b.fp DESC,b.id DESC LIMIT 0,3";

    $msql ->execute($sql);

    while($res = $msql ->fetchquery()){

    //处理标题部分(如果超过21个字符截取)
    $title = $res['bookname'];
    $titleLen = strlen($title);
    if($titleLen>43){
       $res['bookname'] = mb_substr($title,0,15,'utf-8').'...';  //mb_substr 截取
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