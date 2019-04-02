


<?php
    //访问限制
    if(!defined('WWWROOT')){
        die('request not allowed!');
    }
    //获取ID
    $id = intval($id);

    //删除语句（主表）
    $sql ="DELETE FROM ykj_book WHERE id=$id";

    $msql ->execute($sql);

    $as = $msql ->affectedRows();

    //如果主表数据删除成功了
    if($as>0){

        $sql ="SELECT coverurl FROM ykj_cover WHERE bookid=$id";

        //执行
        $msql ->execute($sql);
        while($res = $msql ->fetchquery()){
            //文件路径
            $path = $res['coverurl'];
            //删除封面（文件）
            if(file_exists($path)){
                unlink($path);
            }
        }
        

        //删除封面（数据）
        $sql = "DELETE FROM ykj_cover WHERE bookid=$id";
        $msql ->execute($sql);
        $as = $msql ->affectedRows();
        //跳转到列表页面
        jump('main.php?go=booklist');
    }

?>
     