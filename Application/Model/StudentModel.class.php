<?php
/*
 * 一个表就对应一个模型，模型类以Model结尾的.class.php文件
 */
class StudentModel extends Model {
    public function getList(){
    return $this->db->fetchAll("select * from users",'assoc');
    }
    public function insertInfo(){
        
        echo 'insert';
    }
    public function updateInfo(){
        echo 'update';
    }
    public function deleteInfo($id){
        echo $id;
        $sql="delete from users where usrId='".$id."'"; 
        return $this->db->MySQLquery($sql);//删除成功
    }
    
}