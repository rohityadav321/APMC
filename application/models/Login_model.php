<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login_model extends CI_Model
{
     function __construct()
     {
          // Call the Model constructor
          parent::__construct();

     }

     function get_user($usr, $pwd)
        {
          $usr = $this->db->escape_str($usr) ;
          $pwd = $this->db->escape_str($pwd) ;

          $multipleWhere = ['username' => $usr, 'password' => $pwd];
          $this->db->where($multipleWhere);
          $dbResult = $this->db->get('apmc_users');

          // echo $dbResult->num_rows();
          // die ;

          // return $query->num_rows();

          return $dbResult->num_rows();

     }

     function get_LastLoginDetails($usr, $pwd)
     {
          // $sql = "SELECT * FROM hisusers WHERE username='$usr' and password='$pwd' ";
          $sql = "SELECT * FROM hisusers WHERE username= ? and password= ? ";
          $qry = $this->db->query($sql, array($usr, $pwd));
          // $query = $this->db->query($sql);
          $result = $qry->result();
//          $result = $ndb->query($sql);
          return $result;
     }

}?>
