<?php

    //引用公用配置文件
    require_once('include/common.in.php');
    //引入公用函数文件
    require_once('include/common.fn.php');
    //检查权限
    checkAuthor();
    //加载不同的业务模块（增删改查） 的代码
    //子页面不可以访问，只能通过入口文件main.php 来执行



    //默认页面
    $go = $go?$go:'welcome';
    //接收哪个子页面的请求‘
    // echo $go;  //go是模板传过来的参数!!!!!!!!!!!!
    $allowpages[] = 'welcome';
    
    $allowpages[] = 'booklist';      //图书
    $allowpages[] = 'bookadd';
    $allowpages[] = 'book_add_do';
    $allowpages[] = 'book_view';
    $allowpages[] = 'book_edit';
    $allowpages[] = 'book_edit_do';
    $allowpages[] = 'book_del';

    $allowpages[] = 'movielist';   //电影
    $allowpages[] = 'movieadd';
    $allowpages[] = 'movie_add_do';
    $allowpages[] = 'movie_del';

 
    $allowpages[] = 'musiclist';   //音乐
    $allowpages[] = 'musicadd';
    $allowpages[] = 'music_add_do';
    $allowpages[] = 'music_view';
    $allowpages[] = 'music_edit';
    $allowpages[] = 'music_edit_do';
    $allowpages[] = 'music_del';

    $allowpages[] = 'classparent';  //一级分类
    $allowpages[] = 'classparentadd';
    $allowpages[] = 'classparentaddo';
    $allowpages[] = 'classparentedit';
    $allowpages[] = 'classparent_edit_do';
    $allowpages[] = 'classparent_del';



    $allowpages[] = 'classchild';  //二级分类
    $allowpages[] = 'classchild_add';
    $allowpages[] = 'classchild_add_do';
    $allowpages[] = 'classchild_edit';
    $allowpages[] = 'classchild_edit_do';
    $allowpages[] = 'classchild_del';

    
    $allowpages[] = 'ajax_class_select';

    $allowpages[] = 'exit';
    $allowpages[] = 'swiper';
    $allowpages[] = 'swiperadd';
    $allowpages[] = 'swiper_add_do';
    $allowpages[] = 'swiper_del';
    $allowpages[] = 'swiper_edit';
    $allowpages[] = 'swiper_edit_do';
    $allowpages[] = 'swiper_view';
    
    

    
    


    // $allowpages[] = 'musiclist';

    if(!in_array($go,$allowpages)){  //
        die('requesr fail!!');
    }

    //根据$go 跳转到不同的子页面
    require_once('pages/'.$go.'.php');

    //欢迎页面->首页面
    // require_once('pages/welcome.php');

    //载入图书管理页面
?>