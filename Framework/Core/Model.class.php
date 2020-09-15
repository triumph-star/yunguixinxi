<?php
/*
 *基础模型类，用来封装所有模型类的公共属性和方法
 */
class Model {
    protected $db;//包连接数据库的单例对象
    public function initDB(){
        $config=$GLOBALS['config']['database'];
         $this->db=MySQLDB::getInstance($config);
    }
    function __construct() {
       $this->initDB();
    }
}
