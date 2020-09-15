<?php
class adminModel extends Model {
    public function validate($userName,$pwd){
        $sql="select count(*) from admin where name='".addslashes($userName)."' and password='".md5($pwd)."'";
        return $this->db->fetchCell($sql,'assoc');
    }
}
 