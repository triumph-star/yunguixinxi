<?php
class RegisterController extends Controller{
    public function registerAction(){
        if(isset($_POST["register"])){
            $realName=isset($_POST['realname'])?$_POST['realname']:"";
            $stPwd=isset($_POST["passwd"])?$_POST['passwd']:"";
            $stNum=isset($_POST["stnum"])?$_POST['stnum']:"";
            $stPro=isset($_POST["pro"])?$_POST['pro']:"";
            $class=isset($_POST["class"])?$_POST['class']:"";
            $age=isset($_POST["age"])?$_POST['age']:"";
            $birthday=isset($_POST["birthday"])?$_POST['birthday']:"";
            $email=isset($_POST["email"])?$_POST['email']:"";
            $idCard=isset($_POST["idcard"])?$_POST['idcard']:"";
            $tel=isset($_POST["tel"])?$_POST['tel']:"";
            $insert=new registerModel();
            @$ir=$insert->insertInfo($realName,$stPwd,$stNum,$stPro,$class,$age,$birthday,$email,$idCard,$tel);
            if(!($ir===FALSE||$ir===-1)){
                echo "<script>alert('注册成功!')</script>"; 
                header("Refresh:0;url=?c=login&a=login&p=home");
            }
        }
        require __VIEW__."register.html";
    }
}
