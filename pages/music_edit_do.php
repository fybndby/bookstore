<?php
        //访问限制
        if (!defined('WWWROOT')) {
            die('request not allowed!');
        }


        $id = intval($id);
        $class_cid = intval($cclass);
        $musicname = trim($musicname);
        $singer = trim($singer);
        $compose = trim($compose);
        $writer = trim($writer);
        $price = trim($price);
        $poster = $_FILES['poster'];
        $music = $_FILES['music'];
        $words = trim(stripslashes($words));  // stripslashes()该函数可用于清理从数据库中或者从 HTML 表单中取回的数据。
        $dt = strtotime($dt);  //strtotime日期转换成时间戳

        //数据验证
        if (strlen($musicname) < 2 || !$singer || !$compose ||!$writer || !$price) {
            die('填写不规范');
        }


        $resFile =''; //初始化是否文件上传成功
        // 处理封面文件
        if($poster['name']){
            $arrTemp = $poster['name'];                          //上传时文件名
            $tempFile = $poster['tmp_name'];                     //上传时本地路径
            // echo $arrTemp.'<br/>'.$tempFile.'<br/>';          // pathinfo 函数以数组的形式返回文件路径的信息。  输出！
            $pathInfo = pathinfo($arrTemp);                     //Array ( [dirname] => . [basename] => 11111.jpg [extension] => jpg [filename] => 11111 )
            $extension = $pathInfo['extension'];                //后缀名
            // print_r($pathInfo);
            $newFileName = time() . mt_rand(1, 100);
            $destFile = 'upload/' . $newFileName . '.' . $extension;  //服务器文件路径
            // echo $destFile;
            if(move_uploaded_file($tempFile,$destFile)){
                $resFile = true;
                $result_file = '文件上传成功'.'<br/>';
            }else{
                $resFile = false;
                $result_file = '文件上传失败'.'<br/  >';
            }
        }

        //数据入库
        $sql = "UPDATE ykj_music SET ccid=$class_cid,musicname='".$musicname."',singer='".$singer."',compose='".$compose."',writer='".$writer."',price='".$price."',words='".$words."',dt=$dt WHERE id=$id";
        $msql ->execute($sql);
        
        //获取执行结果
        $as = $msql ->affectedRows();

        // echo $as;

        //图书入库结果
        if ($as > 0) {
            $result_book = '音乐数据修改成功！<br/>';
        } else {
            $result_book = '音乐数据修改失败！<br/>';
        }

        //封面入库
        if($resFile){  //验证是否有封面数据
            $sql = "INSERT INTO ykj_cover (bookid,coverurl)  VALUES($id,'" . $destFile . "')";
            $msql ->execute($sql);

            $as = $msql->affectedRows();
            if ($as > 0) {
                $result_poster = '封面入库成功！<br/>';
            } else {
                $result_poster = '封面入库失败！<br/>';
            }
        }








        include 'pages/templates/music_edit_do.html';
?>