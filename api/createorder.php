
<?php

 //引入公用文件、
 require_once('../include/common.in.php');

 //接收小程序的订单数据
 $openid = $openid;
//  echo '1';
//  echo $openid;
 $datas = json_decode(stripslashes($datas),true);

 //定义入库状态
 $result = 666;
 //数据提取及入库
 foreach($datas as $key =>$item){
    
    $catagory = $key;//分类名称
   
    if(count($item)){
        foreach($item as $item2){    //遍历内容

            //产品id
            $pid = $item2['pid'];
            //产品数量
            $count = $item2['count'];

            //下单日期
            $dt = time();
            //执行入库
    
            $sql = "INSERT INTO ykj_order (openid,catagory,pid,counts,dt) VALUES ('".$openid."','".$catagory."',$pid,$count,$dt)";
            
            $msql ->execute($sql);
    
            $as = $msql ->affectedRows();
    
            if($as<0){
                $result = 'fail';
            }
    
           
        }
    }
    // $msql ->error();
 }

   echo $result;





?>