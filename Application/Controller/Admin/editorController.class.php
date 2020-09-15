<?php

/*
 * Student控制器类
 * 控制器类名必须使用Controller结尾(控制器名+Controller)
 * 方法名必须使用Action结尾
 */
class editorController extends Controller{
    public function editorAction(){
        //获取服务器基本信息
        //载入页面
        require __VIEW__."article.html";
    }
    
}
