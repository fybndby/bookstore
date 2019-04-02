

<?php
    //访问限制
    if(!defined('WWWROOT')){
        die('request not allowed!');
    }
    //给模板提供数据


    $datas = '';
    //1.读取数据的语句
    $sql = "SELECT id,cname FROM ykj_class_parent ORDER BY id DESC";

    //2.执行语句
    $msql ->execute($sql);

    //3.获取查询结果
    while($res = $msql ->fetchquery()){
        $datas .= '<tr>
        <td>'.$res['id'].'</td>
        <td>'.$res['cname'].'</td>
        <td><a href="main.php?go=classparentedit&id='.$res['id'].'">修改</a>|<a href="javascript:;" onclick="ask('.$res['id'].')">删除</a></td>
      </tr>';
    }

    //载入模板
    include 'pages/templates/classparent.html';
?>
     