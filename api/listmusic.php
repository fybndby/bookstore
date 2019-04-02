
<?php
    //引入公用文件、
    require_once('../include/common.in.php');

    //接收参数
    $ccid = intval($ccid);

    if($ccid){
        $sql = "SELECT id,musicname,singer,compose,writer,price,coverurl FROM ykj_music WHERE ccid=$ccid ORDER BY id DESC LIMIT 0,20";
    }else{
        $sql = "SELECT id,musicname,singer,compose,writer,price,coverurl FROM ykj_music ORDER BY id DESC LIMIT 0,20";
    }

    $msql ->execute($sql);

    $arrTemp =array();
    //获取数据
    while($res = $msql ->fetchquery()){
    
        //c.处理价格
        $price = explode('.',$res['price']); //explode方法分割
        $res['price_int'] = $price[0]; //整数部分
        $res['price_dec'] = $price[1];  //小数部分

        //d.处理评论星星数
        $res['stars'] = 5;

        //e.评论数量
        $res['counts'] =0;

        //把每一条记录存入邻时数组
        $arrTemp[]=$res;
    }
    //返回数据
    echo json_encode($arrTemp);
?>