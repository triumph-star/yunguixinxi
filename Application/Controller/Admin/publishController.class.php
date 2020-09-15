<?php

/*
 * Student控制器类
 * 控制器类名必须使用Controller结尾(控制器名+Controller)
 * 方法名必须使用Action结尾
 */
class publishController extends Controller{
    public function publishAction(){
        require __VIEW__."article_edit.html";
    }
    
}
