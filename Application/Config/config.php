<?php
//配置文件，设置基本参数
return array(
    "database" =>array(
            'host'=>'Localhost',//主机
            'port'=>'3306',//端口
            'user'=>'root',//用户名
            'pwd'=>'123456',//密码
            'dbname'=>'yungui',//数据库名
            'charset'=>'utf8'//字符集
        ),
    "app"=>array(
        "default_controller"=>"index",
        "default_action"    =>"index",
        "default_platform"  =>"Home"
    )
);