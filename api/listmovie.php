
<?php
    //引入公用文件、
    require_once('../include/common.in.php');

    //接收参数
    // $ccid = intval($ccid);
    $sql = "SELECT id,class_style,class_country,moviename,derector,writer,roles,price,movieurl,coverurl FROM ykj_movie ORDER BY id DESC";

    $msql ->execute($sql);

    $arrTemp =array();
    
    //获取数据
    while($res = $msql ->fetchquery()){
        
        //c.处理价格
        $price = explode('.',$res['price']); //explode方法分割
        $res['price_int'] = $price[0]; //整数部分
        $res['price_dec'] = $price[1];  //小数部分
        // echo $res['price_dec'];   //截取
        //d.处理评论星星数
        $res['stars'] = 5;

        //e.评论数量
        $res['counts'] =0;

        //把每一条记录存入邻时数组
        $arrTemp[]=$res;
    }
    //读取分类语句
    $sql = "SELECT cid,cname FROM ykj_class_child WHERE cid=$class_parent_movie OR cid=$class_parent_country";
    $msql ->execute($sql);

    while($res = $msql ->fetchquery()){
        if($res['cid'] == $class_parent_movie){     //分类
            $tempArrCatagory[] = $res;
        }else{ //国家
            $tempArrCountry[] = $res;
        }
    }

    $datas['class_catagory'] = $tempArrCatagory; //分类
    $datas['class_country'] =$tempArrCountry;   //国家
    $datas['list_datas'] = $arrTemp;    //列表
    //返回数据
    echo json_encode($datas);

?>