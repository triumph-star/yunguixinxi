<?php
class Framework{
    /*
     * 定义路径常量
     */
    private static function initConst(){
        define('DS',DIRECTORY_SEPARATOR);//目录分隔符
        define("ROOT_PATH", getcwd().DS);//网站根目录
        define("APP_PATH",ROOT_PATH."Application".DS);//Application目录
        define("FRAMEWORK_PATH", ROOT_PATH."Framework".DS);
        define("PUBLIC_PATH", ROOT_PATH."Public".DS);
        define("CONTROLLER_PATH", APP_PATH."Controller".DS);
        define("MODEL_PATH", APP_PATH."Model".DS);
        define("VIEW_PATH", APP_PATH."View".DS);
        define("CONFIG_PATH", APP_PATH."Config".DS);
        define("CORE_PATH", FRAMEWORK_PATH."Core".DS);
        define("LIB_PATH", FRAMEWORK_PATH."Lib".DS);
    }
    
    //读取配置文件
    private static function initConfig(){
        $GLOBALS['config']=require APP_PATH."config".DS."config.php";
    }
    
    /*
     * 路由
     */
    private static function initRoute(){
        //接收地址传递的参数（控制器和方法）
        $c=isset($_REQUEST["c"])?$_REQUEST["c"]:$GLOBALS["config"]["app"]["default_controller"];
        $a=isset($_REQUEST["a"])?$_REQUEST["a"]:$GLOBALS["config"]["app"]["default_action"];
        $p=isset($_REQUEST['p'])?$_REQUEST["p"]:$GLOBALS["config"]["app"]["default_platform"];
        define("PLATFORM_NAME", $p);
        define("CONTROLLER_NAME",$c);
        define("ACTION_NAME",$a);
        define("__URL__",CONTROLLER_PATH.PLATFORM_NAME.DS);//当前控制器目录
        define("__VIEW__",VIEW_PATH.PLATFORM_NAME.DS);//当前视图目录
    }
    
    //自定义自动加载类
        private static function autoload($className){
            $class_map=array(
                "Controller"    =>  CORE_PATH."Controller.class.php",
                "Model"         =>  CORE_PATH."Model.class.php",
                "MySQLDB"       =>  CORE_PATH."MySQLDB.class.php"
            );
            if(isset($class_map[$className])){
                require $class_map[$className];
            }
            elseif(substr($className, -5)=="Model"){
                require MODEL_PATH.$className.".class.php";
            }
            elseif (substr($className, -10)=="Controller") {
                require __URL__.$className.".class.php";
        }
    }
    
    //注册自定义自动加载类
    private static function initRegisterAutoLoad(){
        spl_autoload_register("self::autoload");
    }
    
    //请求分发
    private static function initDispatch(){
        //实例化一个控制器
        $controllerName=CONTROLLER_NAME."Controller";
        $controller=new $controllerName();
        //执行控制器中方法
        $actionName=ACTION_NAME."Action";
        $controller->$actionName();
    }
    
    public static function run(){
        self::initConst();
        self::initConfig();
        self::initRoute();
        self::initRegisterAutoLoad();
        self::initDispatch();
    }
}
