<?php
 //引入公用文件、
require_once('../include/common.in.php');

//接收tap参数
$tap = $tap;

//结收options参数
$searchKeywords=trim($searchKeywords);
$comlumn=trim($comlumn);

//根据不同的tap，查询不同的数据

//初始化
$ccid = '';
$tempArr = array();

//把tap转换成二级分类ID
switch ($tap) {
    case 'science':
        $ccid = 27;
        break;
    case 'child':
        $ccid = 26;
        break;
    case 'people':
        $ccid = 25;
        break;
    case 'younth':
        $ccid = 24;
        break;
    case 'health':
        $ccid = 23;
        break;
    default:
        $ccid = 27;
        break;
}

//根据ccid（二级分类id查询该分类下的数据）

//2.1查询语句
if($searchKeywords && $comlumn){

    $sql = "SELECT b.id,bookname,author,publicer,dt,descript,price,coverurl FROM ykj_book as b LEFT JOIN ykj_cover as c ON (b.id=c.bookid) WHERE $comlumn LIKE '%".$searchKeywords."%' ORDER BY b.id DESC LIMIT 0,20";

}else if($tap == 'free99'){

    $sql = "SELECT b.id,bookname,author,publicer,dt,descript,price,coverurl FROM ykj_book as b LEFT JOIN ykj_cover as c ON (b.id=c.bookid) WHERE fp=1 ORDER BY b.id DESC LIMIT 0,20";

}else if($tap=='bookmoretop'){

    //畅销书top3
    $sql = "SELECT b.id,bookname,price,sum(counts) as total,author,publicer,o.dt,descript,coverurl FROM ykj_order as o LEFT JOIN ykj_book as b ON (o.pid=b.id) LEFT JOIN ykj_cover as c ON (b.id=c.bookid) WHERE catagory='book' GROUP BY pid ORDER BY total DESC LIMIT 0,20";

} else{

    $sql = "SELECT b.id,bookname,author,publicer,dt,descript,price,coverurl FROM ykj_book as b LEFT JOIN ykj_cover as c ON (b.id=c.bookid) WHERE ccid=$ccid ORDER BY b.id DESC LIMIT 0,20";

}


//2.2执行语句
$msql ->execute($sql);

//2.3获取数据
while($res = $msql ->fetchquery()){

    //a.处理日期
    $res['date'] = date('Y-m-d',$res['dt']); //格式化时间戳
    //b.处理简介

    //b.1 去掉html标签
    $res['descript'] = strip_tags($res['descript']);  // strip_tags去掉html标签的方法
    //b.2 截取长度
    $res['descript'] = mb_substr($res['descript'],0,35,'utf8').'...';

    //c.处理价格
    $price = explode('.',$res['price']); //explode方法分割
    $res['price_int'] = $price[0]; //整数部分
    $res['price_dec'] = $price[1];  //小数部分

    //d.处理评论星星数
    $res['stars'] = 5;

    //e.评论数量
    $res['comment_count'] =0;

    $tempArr[] =$res;
}


//初始化
$arrBookName = array();
$arrNew = array();

//2.4二维数组去重
if(count($tempArr)>0){
    foreach($tempArr as $key=>$res){

        //获取名称
        $bookname = $res['bookname'];

        //把图书名存入数组
        if(!in_array($bookname,$arrBookName)){
            $arrBookName[] = $bookname;
            $arrNew[] = $res;
        }
    }
}
// print_r($arrNew);

//2.5把数据转化成json格式并返回个小程序

echo json_encode($arrNew);

?>