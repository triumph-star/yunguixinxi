<?php

/*
 * Student控制器类
 * 控制器类名必须使用Controller结尾(控制器名+Controller)
 * 方法名必须使用Action结尾
 */
class publishController extends Controller{
    public function publishShowAction(){
        echo @$_FILES['cover']['name']."<br>";
       echo @$_FILES['cover']['tmp_name']."<br>";
       if(isset($_FILES['cover']) && $_FILES['cover']['error']==0){
           $mine = $_FILES['cover']['type'];
           $fileType = [
               'image/png' => '.png',
               'image/jpeg' => '.jpg'
           ];
           $newFilename = uniqid(rand()).$fileType[$mine];
           if(move_uploaded_file($_FILES['cover']['tmp_name'],'Public/images/'.$newFilename)){
            echo "<script>alert('文件上传成功！')</script>"; 
            $_SESSION['test']='../../../Public/images/'.$newFilename;
            echo $_SESSION['test']."<br>";
           }
       }
       require __VIEW__."news.html";
    }
    
}
