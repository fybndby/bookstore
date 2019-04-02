<?php
 //引入公用文件、
 require_once('../include/common.in.php');

 //初始化WHERE
 $where = '';
// 结收参数
$cls = trim($cls);
$country = trim($country);

//根据以上两个条件查询
    if($cls !='all_class'){ //如果选择全部分类 ，则where 条件不变
        $where .="AND class_style LIKE '%".$cls."%'";
    }

    if($country !='all_country'){ //如果选择全部分类 ，则where 条件不变
        $where .="AND class_country='".$country."'";
    }
    


    $sql = "SELECT id,class_style,class_country,moviename,derector,writer,roles,price,movieurl,coverurl FROM ykj_movie WHERE 1 $where ORDER BY id DESC";

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
        $arrTemp[]=$res;
    }



        //读取分类语句
        $sql = "SELECT cid,cname FROM ykj_class_child WHERE cid=$class_parent_movie OR cid=$class_parent_country";

        $msql ->execute($sql);
    
        while($res = $msql ->fetchquery()){
            if($res['cid'] == $class_parent_movie){     //电影分类
                
                if($res['cname'] == $cls){  //给当前点击的加样式
                    $res['myclass'] = 'active-class';
                }else{
                    $res['myclass'] = '';
                }
                $tempArrCatagory[] = $res;
            }else{ //国家
               
                if($res['cname'] == $country){
                    $res['mycountry'] = 'active-country';
                }else{
                    $res['mycountry'] = '';
                }
                $tempArrCountry[] = $res;
            }
        }
        
        $datas['class_catagory'] = $tempArrCatagory; //分类
        $datas['class_country'] =$tempArrCountry;   //国家
        $datas['list_datas'] = $arrTemp;  //数据
        echo json_encode($datas);
    // echo  '当前要查找的条件是:分类'.$cls.';地区为：'.$country.'的数据';





?>