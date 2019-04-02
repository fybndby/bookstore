



<?php
    //访问限制
    if(!defined('WWWROOT')){
        die('request not allowed!');
    }
    //给模板提供数据


    $datas = '';
    //1.读取数据的语句
    $sql = "SELECT cc.id as ccid,cc.cname as cname,cp.cname as pname,cp.id as cpid FROM ykj_class_child as cc LEFT JOIN ykj_class_parent as cp ON(cc.cid=cp.id) ORDER BY cc.id DESC";

    //2.执行语句
    $msql ->execute($sql);

    //3.获取查询结果
    while($res = $msql ->fetchquery()){
        $datas .= '<tr>
        <td>'.$res['ccid'].'</td>
        <td>'.$res['pname'].$res['cpid'].'</td>
        <td>'.$res['cname'].'</td>
        <td><a href="main.php?go=classchild_edit&id='.$res['ccid'].'">修改</a>|<a href="javascript:;" onclick="ask('.$res['ccid'].')">删除</a></td>
      </tr>';
    };
    print_r($res);

    //载入模板
    include 'pages/templates/classchild.html';
?>
     