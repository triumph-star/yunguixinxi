<?php

/*
 * Student控制器类
 * 控制器类名必须使用Controller结尾(控制器名+Controller)
 * 方法名必须使用Action结尾
 */
class StudentController extends Controller{
    public function getListAction(){       
        $userName=$_SESSION["userName"];
        require __VIEW__."layout.html";
    }
    public function addAction(){
        $st=new studentModel();
        $rs=$st->insertInfo();
        //require 'studentInfo.html';
    }
    public function delAction(){
        $id=$_POST["id"];
        $st=new studentModel();
        echo $st->deleteInfo($id);//将删除受影响行数返回到前台
    }
}
