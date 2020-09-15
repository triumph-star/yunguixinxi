<?php
class UsersModel extends Model {
    public function validate($username,$pwd){
        $sql="select count(*) from users where usrNum='".addslashes($username)."' and usrPwd='".md5($pwd)."'";
        return $this->db->fetchCell($sql,'assoc');
    }
}
