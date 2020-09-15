<?php
    header("content-type:text/html;charset=utf-8");
    class MySQLDB {
        private $host;//主机
        private $port;//端口
        private $user;//数据库用户名
        private $pwd;//数据库密码
        private $dbname;//数据库名
        private $charset;//字符集
        private $link;//数据库连接对象
        private static $instance;//MySQLDB类的静态实例对象


        //参数初始化
        private function initParam($config){
            $this->host=isset($config['host'])?$config['host']:"localhost";            
            $this->port=isset($config['port'])?$config['port']:"3306";
            $this->user=isset($config['user'])?$config['user']:"root";
            $this->pwd=isset($config['pwd'])?$config['pwd']:"123456";
            $this->dbname=isset($config['dbname'])?$config['dbname']:"yungui";
            $this->charset=isset($config['charset'])?$config['charset']:"utf8";
        }

                //连接数据库
        private function connect(){
            $this->link=@mysqli_connect("{$this->host}:{$this->port}", $this->user, $this->pwd) or die("数据库连接失败。");
        }
        
        //选择数据库
        private function selectDB(){
            $this->link->select_db($this->dbname);
        }
        
        /*
         * 封装执行MySQL语句中的query方法
         * $sql是需要执行的SQL语句
         * $result执行SQL语句的结果
         * 执行select语句时，如果执行成功则返回mysqli_result类型的结果集，如果执行失败则返回false;
         * 执行update、insert或delete时,如果执行成功则返回受影响行数，如果执行失败返回-1
         */        
        public function MySQLquery($sql){
            $result=$this->link->query($sql);
            $str= substr(strtolower($sql), 0, 6) ;
            if($str=='update'||$str=="insert"||$str=="delete"){
                $result=  mysqli_affected_rows($this->link);
            }
            if($result===FALSE||$result===-1){ 
                // echo "SQL语句执行失败。<br>";
                // echo "错误编号：".mysqli_errno($this->link)."<br>";
                // echo "错误信息：".mysqli_error($this->link)."<br>";
                 echo "<script>alert('用户已注册!')</script>";
                // echo "错误的SQL语句：".$sql."<br>";
            }
           return $result; 
        }

        /*
         * 单例模式：Web下某一用户程序有且仅有一个实例
         * 满足条件：三私一公
         * 一个私有的类构造函数，一个私有的魔术克隆方法，一个私有的静态实例对象属性，一个公共的创建静态实例方法
         * 
         */
        //私有的构造函数
        private function __construct($config) {
            $this->initParam($config);
            $this->connect();
            $this->selectDB();
            $this->MySQLquery("set names {$this->charset}");
            //echo "这是构造函数";
        }
        //阻止克隆clone，创建一个私有的克隆魔术方法
        private function __clone() { }
        
        //公有的静态方法，用来获取或创建MySQLDB类的实例
        public static function getInstance($config){
            if(!self::$instance instanceof self){
                self::$instance=new self($config);
            }
            return self::$instance; 
        }
        
        /*
         * 从数据库中读取数据
         * row|assoc|array|object
         * 返回一个二维数组,数组类型由$fetch_type决定
         */
        public function fetchAll($sql,$fetch_type='array'){
            $rs=$this->MySQLquery($sql);
            $fetch_types=array("row","assoc","array","object");
            if(!in_array($fetch_type, $fetch_types)){
                $fetch_type='array';
            }
            $fetch_fun="mysqli_fetch_".$fetch_type;
            $array=array();
            while($row=$fetch_fun($rs)){
                $array[]=$row;
            }
            return $array;
        }
        
        /*
         * 从数据库中读取第一行记录，一维数组
         */
        public function fetchRow($sql,$fetch_type='array'){
            $rs=  $this->fetchAll($sql, $fetch_type);

            return empty($rs)?null:$rs[0];
        }
        
        /*
         * 从数据库中读取第一行第一列数据
         */
        public function fetchCell($sql){
            $rs=$this->fetchRow($sql, "row");
            return empty($rs)?null:$rs[0];
        }
    }
    
//------------------------------------------------------------------------------    
    


   
