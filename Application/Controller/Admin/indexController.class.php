<?php

/*
 * Student控制器类
 * 控制器类名必须使用Controller结尾(控制器名+Controller)
 * 方法名必须使用Action结尾
 */
class indexController extends Controller{
    public function indexAction(){
        //获取服务器基本信息
        $data = [
             'host' => $_SERVER['HTTP_HOST'],
             'userIp' => $_SERVER['REMOTE_ADDR'],
             'serverName' => $_SERVER['SERVER_NAME'],
             'port' => $_SERVER['SERVER_PORT'],
             'addr' => $_SERVER['SERVER_ADDR'],
             'http' => date('Y-m-d H:i:s', $_SERVER['REQUEST_TIME']),
             'time' => date('Y-m-d H:i:s', time()),
        ];
        //载入页面
        require __VIEW__."index.html";
    }
    
}
