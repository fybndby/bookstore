<?php
 //引入公用文件、
require_once('../include/common.in.php');

//引入公用函数
require_once('../include/common.fn.php');

//接收小程序表单数据

$openid =$openid;
// 姓名
$uname = trim($uname);

//电话
$tel = trim($tel);
//地址
$address = trim($address);
//邮编
$post = trim($post);
//头像
$photo = $_FILES['file'];

//日期
$dt = time();

//上传头像
$remoteUrl = uploadFile($photo,'../upload');
$remoteUrl = substr($remoteUrl,3);

//查询表中是否已经存在该用户，如果有则修改，否则创建

$sql = "SELECT id FROM ykj_user WHERE openid='".$openid."' LIMIT 1";
$msql ->execute($sql);
$res = $msql ->fetchquery();
if(!$res['id']){
    $sql = "INSERT INTO ykj_user (openid,uname,tel,address,post,header,dt) VALUES ('".$openid."','".$uname."','".$tel."','".$address."','".$post."','".$remoteUrl."',$dt)";
}else{
    //修改
    if($photo){ //重新选择头像

        $sql = "UPDATE ykj_user SET  uname='".$uname."',tel='".$tel."',address='".$address."',post='".$post."',header='".$remoteUrl."' WHERE openid='".$openid."'";

    }else{ //没有重置头像

        $sql = "UPDATE ykj_user SET  uname='".$uname."',tel='".$tel."',address='".$address."',post='".$post."' WHERE openid='".$openid."'";

    }

}

$msql ->execute($sql);

$msql->error();
//获取执行结果
$as = $msql ->affectedRows();
if($as>0){
    $result = 'success';
}else{
    $result = 'fail';
}
echo $result;

?>