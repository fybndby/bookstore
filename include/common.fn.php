<?php
    //检查登录权限
function checkAuthor()
{
    //获取session  //如果session不符合规则
    if (!$_SESSION['admin'] && !preg_match('^/[A-Z]{6}/', $_SESSION['admin'])) {
        //跳转函数
        jump('login.html');
        //阻止代码继续执行
        die();
    }
}

function jump($go, $time = '1000')
{
    echo '<script>';
    echo 'setTimeout(function(){location.href="' . $go . '";},' . $time . ')';
    echo '</script>';
}

//文件上传
function uploadFile($arrFile, $dir = 'upload')
{
     //判断路径是否存在，不存在则创建

     if(!file_exists($dir)){
         mkdir($dir);
     }
    //确保提交了数据
    if (is_array($arrFile['name'])) {

        //上传上来的旧的文件名
        $arrFn = $arrFile['name'];
        //邻时文件
        $arrTemp = $arrFile['tmp_name'];

         //定义邻时数组
         $tempDestArr = array();

         //遍历邻时文件
         foreach ($arrTemp as $key => $item) {  //处理一次上传多个文件
             //邻时文件名
             $tempFile = $item;
 
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
             }

             //只返回成功上传的文件 
             return $tempDestArr;
         
     }
        
    }else{  //处理单个文件

        //邻时文件
        $tempFile = $arrFile['tmp_name'];

        //新的文件名
        $newFileName = time() . mt_rand(1, 100);
 
        //旧的文件名
        $oldName = $arrFile['name'];

        //扩展名
        $pathInfo = pathinfo($oldName);
        $extension = $pathInfo['extension'];

        //服务器文件路径
        $destFile = $dir.'/' . $newFileName . '.' . $extension;

        //执行上传
        if (move_uploaded_file($tempFile, $destFile)) {  //1.邻时文件名2.远程路径名
            return $destFile;
        } else {
            return '上传失败';
        }
    }
   
        

       
}
 