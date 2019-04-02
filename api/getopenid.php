<?php
    //引入公用文件、
    require_once('../include/common.in.php');

    //获取code
    $code = $code;

    //获取openid
    $res = file_get_contents('https://api.weixin.qq.com/sns/jscode2session?appid=wxbe4d7f817b498601&secret=5067059178dc3eabffd873f11cca46d0&js_code='.$code.'&grant_type=authorization_code');

    //输出json
    echo $res;




?>