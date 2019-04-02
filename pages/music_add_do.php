



<?php
    //访问限制
    if(!defined('WWWROOT')){
        die('request not allowed!');
    }

    //接收表单数据

    //二级分类ID
    $cclass = $cclass;

    //歌曲名称
    $musicname = trim($musicname);

    //歌手
    $singer = trim($singer);

    //作曲
    $compose = trim($composer);

    //填词
    $writer = trim($writer);

    //价格
    $price = trim($price);

    //封面
    $poster = $_FILES['poster'];

    //音乐
    $music = $_FILES['music'];

    //歌词
    $descript = trim($descript);

    //上架日期
    $dt = strtotime($dt);  //strtotime日期转换成时间戳

     //////////////////////////////////////////////////////////////////////
     //上传文件
     //上传封面
     $destPosterUrl = uploadFile($poster);
     //上传音乐
     $destMusicUrl = uploadFile($music,'upload/music');
     //////////////////////////////////////////////////////////////////////
    if(!$musicname){
        $result = '请填写歌曲名称';
    }else{
        //入库操作

        //语句
        $sql = "INSERT INTO ykj_music (cid,ccid,musicname,singer,compose,writer,price,musicurl,coverurl,words,dt) VALUES ($class_parent_music,$cclass,'".$musicname."','".$singer."','".$compose."','".$writer."',$price,'".$destMusicUrl."','".$destPosterUrl."','".$descript."',$dt)";

        //执行语句
        $msql ->execute($sql);

        //获取执行结果
        $as = $msql ->affectedRows();

        if($as>0){
            $result ='入库成功！';
        }else{
            $result ='入库失败！';
            $msql ->error();
        }
    }
    
    

    //载入模板
    include 'pages/templates/music_add_do.html';
?>