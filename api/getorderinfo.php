<?php
 //引入公用文件、
 require_once('../include/common.in.php');

 //接收openid
 $openid = $openid;
 if($openid){
     $sql = "SELECT pid,catagory,dt FROM ykj_order WHERE openid='".$openid."'";

     $msql->execute($sql);

     while($res = $msql ->fetchquery()){
         //初始化
        //  $arrBook =array();
        //  $arrMusic = array();
        //  $arrMovie = array();

        //分类
        $class = $res['catagory'];

        //产品id
        $pid = $res['pid'];

        //根据不同的分类，去不同的表中查找该pid对应的数据（名称封面价格）；
        if($class =='book'){
            $sql = "SELECT bookname,price,coverurl FROM ykj_book as b LEFT JOIN ykj_cover as c ON (b.id=c.bookid) WHERE b.id=$pid LIMIT 1";
            $msql ->execute($sql,'book');
            $res_book = $msql ->fetchquery('book');
            //产品名称
            $pname = $res_book['bookname'];
            //产品价格
            $pprice = $res_book['price'];
            //封面
            $pcover = $res_book['coverurl'];
            //分类
            $res_book['catagory'] = $class;
            //pname////////////////////////////////////
            $res_book['pname'] = $pname;
            //产品ID
            $res_book['pid'] = $pid;
            //上架日期
            $res_book['dt'] = date('Y-m-d',$res['dt']);

            //图书评论
            $sql = "SELECT stars,notes,dt FROM ykj_comment WHERE catagory='book' AND pid=$pid AND openid='".$openid."' ORDER BY id DESC LIMIT 1";
            $msql ->execute($sql,'comment1');
            $res_comment = $msql ->fetchquery('comment1');
            $res_comment['date'] = date('Y-m-d',$res_comment['dt']);
            //评论
            $res_book['comment'] = $res_comment;

            //存入总数组
            $tempArr[] = $res_book;
        }

        if($class =='music'){
            $sql = "SELECT musicname,price,coverurl FROM ykj_music  WHERE id=$pid LIMIT 1";
            $msql ->execute($sql,'music');
            $res_music = $msql ->fetchquery('music');
           
            //分类
            $res_music['catagory'] = $class;
            //pname///////////////////
            $res_music['pname'] = $res_music['musicname'];
            //产品ID
            $res_music['pid'] = $pid;
            //上架日期
            $res_music['dt'] = date('Y-m-d',$res['dt']);

            //音乐评论
            $sql = "SELECT stars,notes,dt FROM ykj_comment WHERE catagory='music' AND pid=$pid AND openid='".$openid."' ORDER BY id DESC LIMIT 1";
            $msql ->execute($sql,'comment2');
            $res_comment = $msql ->fetchquery('comment2');
            $res_comment['date'] = date('Y-m-d',$res_comment['dt']);
            //评论
            $res_music['comment'] = $res_comment;

            //存入总数组
            $tempArr[] = $res_music;
        }


        if($class =='movie'){
            $sql = "SELECT moviename,price,coverurl FROM ykj_movie  WHERE id=$pid LIMIT 1";
            $msql ->execute($sql,'movie');
            $res_movie = $msql ->fetchquery('movie');
           
            //分类
            $res_movie['catagory'] = $class;
            //产品ID
            $res_movie['pid'] = $pid;
            //pname///////////////////
            $res_movie['pname'] = $res_movie['moviename'];
            //上架日期
            $res_movie['dt'] = date('Y-m-d',$res['dt']);

            //电影评论
            $sql = "SELECT stars,notes,dt FROM ykj_comment WHERE catagory='movie' AND pid=$pid AND openid='".$openid."' ORDER BY id DESC LIMIT 1";
            $msql ->execute($sql,'comment3');
            $res_comment = $msql ->fetchquery('comment3');
            $res_comment['date'] = date('Y-m-d',$res_comment['dt']);
            //评论
            $res_movie['comment'] = $res_comment;

            //存入总数组
            $tempArr[] = $res_movie;
        }
         
     }

     echo json_encode($tempArr);
 }


?>