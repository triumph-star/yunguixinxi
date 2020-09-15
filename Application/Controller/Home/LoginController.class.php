<?php
class LoginController extends Controller{
    public function loginAction(){
        // echo "验证码值:".$_SESSION['captcha']."<br>"."验证码长度:".strlen($_SESSION['captcha']);
        if(isset($_POST["confirm"])){
            $userName = isset($_POST['username'])?$_POST['username']:"";
            $userPwd = isset($_POST["password"])?$_POST['password']:"";
            $userCaptcha = isset($_POST['captcha'])?$_POST['captcha']:"";
            if($_SESSION['captcha']!=$userCaptcha){
                echo "<script>alert('验证码错误！')</script>"; 
            }else if(!($userName&&$userPwd)){
                echo "<script>alert('用户名或密码不存在！')</script>"; 
            }else{
                $user=new UsersModel();
                $usr=$user->validate($userName, $userPwd);
                $adm=new AdminModel();
                $admin=$adm->validate($userName, $userPwd);
                if($usr>0){
                    $_SESSION["userName"]=$userName;
                    header("location:index.php?c=student&a=student&p=home");
                }else{
                    echo "<script>alert('学号或密码错误！')</script>";
                }
                if($admin>0){
                    $_SESSION["userName"]=$userName;
                    header("location:index.php?c=student&a=getlist&p=admin");
                }else{
                    echo "<script>alert('对不起,你不是管理员')</script>"; 
                }
                
            }
        }
        require __VIEW__."login.html";
    }
    // 退出登录
    public function logoutAction(){
        if(isset($_SESSION["userName"])){
            unset($_SESSION["userName"]);
            echo "<script>alert('退出成功！')</script>"; 
            header("Refresh:1;url=index.php");
        }
        
    }
    // 生成验证码字符
    public function captchaAction(){
       
        function captcha_create(){
            $rd=null;
            $arr1=range("A","Z");
            $arr2=range("a","z");
            $arr3=range(0,9);
            $arr=array_merge($arr1,$arr2,$arr3);
            $array=array_rand($arr,4);
            foreach($array as $key){
            $rd=$arr[$key]." ".$rd;
        }
            return $rd; //返回验证码文本
        }
       
        // 显示验证码
        function captcha_show($rd)
        {
            $image = imagecreate(100, 30);
            $bgcolor = imagecolorallocate($image, 255, 255, 255);
            imagefill($image, 0, 0, $bgcolor);
            $fontcolor = imagecolorallocate($image, rand(0, 120), rand(0, 120), rand(0, 120));
            $x = 10 +  rand(5, 10);
            $y = rand(5, 10);
            imagestring($image, 100, $x, $y, $rd, $fontcolor);
        
            //增加干扰点
        
            for ($i = 0; $i < 100; $i++) {
                $pointcolor = imagecolorallocate($image, rand(0, 255), rand(0, 255), rand(0, 255));
                imagesetpixel($image, rand(1, 99), rand(1, 29), $pointcolor);
            }
        
            //增加干扰线
        
            for ($i = 0; $i < 5; $i++) {
                $linecolor = imagecolorallocate($image, rand(1, 99), rand(1, 29), rand(1, 99));
                imageline($image, rand(1, 99), rand(1, 29), rand(1, 99), rand(1, 29), $linecolor);
            }
        
            header('content-type:image/png');
            imagepng($image);
            imagedestroy($image);
        } 
        
        function trimall($str){
            $before=array(" ","　","\t","\n","\r");
            $after=array("","","","","");
            return str_replace($before,$after,$str);    
        }
        $captchaCode=captcha_create();
        captcha_show($captchaCode);

        $_SESSION['captcha']=trimall($captchaCode);
    }

}
