<?php

class Users_model extends CORE_Model{

    protected  $table="user_accounts"; //table name
    protected  $pk_id="user_id"; //primary key id


    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }

    function create_default_user(){

        //return;
        $sql="INSERT IGNORE INTO user_accounts
                  (user_id,user_name,user_pword,user_lname,user_fname,user_mname,user_address,user_mobile,user_group_id)
              VALUES
                  (1,'admin',SHA1('admin'),'Paguio','Harold','','Matatalaib, Tarlac City, Tarlac','0916-603-8435',1)
        ";
        $this->db->query($sql);

    }

    function authenticate_user($uname,$pword){
        $this->db->select('brgy.*,ua.user_id,ua.is_active,ua.user_name,ua.user_group_id,ua.photo_path,ua.user_fname,ua.user_lname,ua.user_address,ua.user_mobile,ua.date_created,CONCAT_WS(" ",ua.user_fname,ua.user_mname,ua.user_lname) as user_fullname,ua.photo_path');
        $this->db->from('user_accounts as ua');
        $this->db->join('brgy', 'brgy.brgy_id = ua.user_id','LEFT');
        $this->db->where('ua.user_name', $uname);
        $this->db->where('ua.user_pword', sha1($pword));
        return $this->db->get();

    }

    function checkifuserexist($user_name) {
      $check_user=$this->db->query("SELECT COUNT(user_id) as countcheck FROM user_accounts WHERE user_name='".$user_name."' ");
                                        $verify_count = $check_user->result();
                                        return $verify_count[0]->countcheck;
    }





}




?>
