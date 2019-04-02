

<?php
 //引入公用文件、
 require_once('../include/common.in.php');

 //查询销量最高的6手歌曲

 $sql = "SELECT pid,sum(counts) as total,musicname,coverurl,price FROM ykj_order as o LEFT JOIN ykj_music as m ON(o.pid=m.id) WHERE catagory='music' GROUP BY pid ORDER BY total DESC LIMIT 0,6";

 $msql ->execute($sql);

 while($res = $msql ->fetchquery()){

    //处理星星数量   
    $pid = $res['pid'];
    $sql = "SELECT AVG(stars) as avgstars FROM ykj_comment WHERE catagory='music' AND pid=$pid"; //星星平均数量
    $msql ->execute($sql,'music');

    $res_star =$msql ->fetchquery('music');

    //如果没有评论，默认5星
    $res_star['avgstars'] = $res_star['avgstars'] ? $res_star['avgstars']:5;

    $res['stars'] = ceil($res_star['avgstars']);
    $tempArr[] = $res;
 }
 

 echo json_encode($tempArr);




?>