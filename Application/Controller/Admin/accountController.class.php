<?php

/*
 * Student控制器类
 * 控制器类名必须使用Controller结尾(控制器名+Controller)
 * 方法名必须使用Action结尾
 */
class accountController extends Controller{
    public function accountAction(){
        $st=new studentModel();
        $rs=$st->getList();
        require __VIEW__."ShowStudList.html";
    }
}
