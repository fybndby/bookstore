<?php
require_once('../include/common.in.php');


$sql = "SELECT photourl,gourl FROM ykj_swiper";

$msql ->execute($sql);

$tempArr =array();
while($res =$msql ->fetchquery()){
    $tempArr[] = $res;
}
//  //初始化
// $arrBookId = array();
// $arrNew = array();
// // bookID 相同的不重复出现
// if(count($tempArr)>0){
//     foreach($tempArr as $key=>$res){

//         //获取名称
//         $bookid = $res['bookid'];

//         //把图书名存入数组
//         if(!in_array($bookid,$arrBookId)){
//             $arrBookId[] = $bookid;
//             $arrNew[] = $res;
//         }
//     }
// }

echo json_encode($tempArr);


?>