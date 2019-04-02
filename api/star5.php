<?php

 //引入公用文件、
 require_once('../include/common.in.php');

 //定义一个数字 存放最终的所有 数据
 $allDatasArr = array();


 //////////////////////////////////////////////////////////////////////////
 //图书5星第一名
 $sql = "SELECT pid,bookname,price,coverurl FROM ykj_comment as c LEFT JOIN ykj_book as b ON (c.pid=b.id) LEFT JOIN ykj_cover as x ON (c.pid=x.bookid) WHERE stars=5 AND catagory='book' ORDER BY c.id DESC LIMIT 1";

 $msql ->execute($sql);

 $res= $msql ->fetchquery();

 //符合条件的PID
 $book_pid = $res['pid'];

 //根据id统计评论数
 
 $sql ="SELECT count(*) as total FROM ykj_comment WHERE pid=$book_pid";

 $msql ->execute($sql);
 $res_book_count = $msql ->fetchquery();

 $res['counts'] = $res_book_count['total'];   //评论数量
 
 $allDatasArr['book'] = $res;   //给总数组
 /*************************************************************************** */

 //音乐5星第一名

 $sql = "SELECT pid,musicname,price,coverurl FROM ykj_comment as c LEFT JOIN ykj_music as b ON (c.pid=b.id)  WHERE stars=5 AND catagory='music' ORDER BY c.id DESC LIMIT 1";

 $msql ->execute($sql);

 $res= $msql ->fetchquery();

 //符合条件的PID
 $music_pid = $res['pid'];

 //根据id统计评论数
 
 $sql ="SELECT count(*) as total FROM ykj_comment WHERE pid=$music_pid";

 $msql ->execute($sql);
 $res_music_count = $msql ->fetchquery();

 $res['counts'] = $res_music_count['total'];   //评论数量



 $allDatasArr['music'] = $res;  //给总数组
 /*************************************************************************** */
//电影5星第一名

$sql = "SELECT pid,moviename,price,coverurl FROM ykj_comment as c LEFT JOIN ykj_movie as b ON (c.pid=b.id)  WHERE stars=5 AND catagory='movie' ORDER BY c.id DESC LIMIT 1";

$msql ->execute($sql);

$res= $msql ->fetchquery();

//符合条件的PID
$movie_pid = $res['pid'];

//根据id统计评论数

$sql ="SELECT count(*) as total FROM ykj_comment WHERE pid=$movie_pid";

$msql ->execute($sql);
$res_movie_count = $msql ->fetchquery();

$res['counts'] = $res_movie_count['total'];   //评论数量



 $allDatasArr['movie'] = $res;   //给总数组
 /*************************************************************************** */





 echo json_encode($allDatasArr);   //返回最终结果


?>