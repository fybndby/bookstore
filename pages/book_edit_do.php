<?php
    //访问限制
if (!defined('WWWROOT')) {
    die('request not allowed!');
}
//接收表单数据

//获取id
$id = intval($id);
// //1.一级分类id
// $class_pid = intval($pclass);
//2.二级分类id
$class_cid = intval($cclass);
//3.书名
$bookname = trim($bookname);
//4.作者
$author = trim($author);
//5.出版社  
$publicer = trim($publicer);
//6.价格
$price = trim($price);
//7.封面
$poster = $_FILES['poster'];
//8.图书介绍
$descript = trim(stripslashes($descript)); //stripslashes把之前

//9.上架日期
$dt = strtotime($dt);  //strtotime日期转换成时间戳

//初始化变量
$result_upload = $result_book = $result_poster = '';
////////////////////////////////////////////////////////////////////////////////////////////

//1.数据验证
if (strlen($bookname) < 2 || !$author || !$publicer || !$price) {
    die('填写不规范');
}

//处理封面上传
if ($poster['name'][0]) { //是否选择了文件
    //上传上来的文件名
    $arrFn = $poster['name'];
    //邻时文件
    $arrTemp = $poster['tmp_name'];
    // print_r($poster);
    //定义邻时数组
    $tempDestArr = array();

    //遍历邻时文件
    foreach ($arrTemp as $key => $item) {
        //邻时文件名
        $tempFile = $item;
        print_r($item);
        //新的文件名
        $newFileName = time() . mt_rand(1, 100);

        //旧的文件名
        $oldName = $arrFn[$key];

        //扩展名
        $pathInfo = pathinfo($oldName);
        $extension = $pathInfo['extension'];

        //服务器文件路径
        $destFile = 'upload/' . $newFileName . '.' . $extension;
        //执行上传
        if (move_uploaded_file($tempFile, $destFile)) {  //1.邻时文件名2.远程路径名
            $tempDestArr[] = $destFile;
            $result_upload = '封面上传成功!<br>';
        } else {
            $result_upload = '封面上传失败!<br>';
        }
    }
}
//2.数据入库


////////////////////////////////////////////////////////////////////////////////////////////
//入库操作

//1.图书入库
//语句
// $sql = "INSERT INTO ykj_book (cid,ccid,bookname,author,publicer,price,descript,dt) VALUES ($class_pid,$class_cid,'" . $bookname . "','" . $author . "','" . $publicer . "','" . $price . "','" . $descript . "',$dt)";
$sql = "UPDATE ykj_book SET ccid=$class_cid,bookname='".$bookname."',author='".$author."',publicer='".$publicer."',price='".$price."',descript='".$descript."',dt=$dt WHERE id=$id";
//执行语句
$msql->execute($sql);

//获取执行结果
$as = $msql ->affectedRows();

// echo $as;

//图书入库结果
if ($as > 0) {
    $result_book = '图书数据修改成功！<br/>';
} else {
    $result_book = '图书数据修改失败！<br/>';
}

//2.封面入库
 if(count($tempDestArr)>0){     //意味着上传了新的封面
    foreach ($tempDestArr as $url) {
        //语句
        $sql = "INSERT INTO ykj_cover (bookid,coverurl)  VALUES($id,'" . $url . "')";
        //执行语句
        $msql->execute($sql);
        //获取封面入库执行结果
        $as = $msql->affectedRows();
        if ($as > 0) {
            $result_poster = '封面入库成功！<br/>';
        } else {
            $result_poster = '封面入库失败！<br/>';
        }
    }
 }
include 'pages/templates/book_edit_do.html';
