<?php
class RegisterModel extends Model{
    public function insertInfo($realName,$stPwd,$stNum,$stPro,$class,$age,$birthday,$email,$idCard,$tel){
        $sql="insert into users values('','".$realName."','".md5($stPwd)."','".$stNum."','".$stPro."','".$class."','".$age."','".$birthday."','".$email."','".$idCard."','".$tel."')";
        return $this->db->MySQLquery($sql);
    }
}
