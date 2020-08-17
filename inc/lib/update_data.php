<?php
class update_data{
    private $db;
    private $tbl_nm;
    private $db_row;
    private $val;
    private $data=array();
    private $login;
    public function __construct(){
        $this -> db = new Database();
    }
    
   //update product
  public function updateUser($data){
       $userName=$_SESSION['logn']['userUname'];
       $this->db->query("UPDATE users SET fullName = :fullName, userName = :userName, email = :email WHERE userName=:userNm");
       // Bind Data
       $this->db->bind(':fullName', $data['updateFn']);
       $this->db->bind(':userName',$data['updateUn']);
       $this->db->bind(':email',  $data['updateEm']);
       $this->db->bind(':userNm',  $userName);
       //Execute
       if($this->db->execute()){
           $_SESSION['logn']['userUname']=$data['updateUn'];               
           $_SESSION['logn']['userFname']=$data['updateFn'];               
           $_SESSION['logn']['userEmail']=$data['updateEm'];  
           return true;
       }else{
           return false;
       }
  }  
  public function updatePassword($data){
    $userPassword= $_SESSION['logn']['userPassword'];
    $userName    = $_SESSION['logn']['userUname'];
    $this->db->query("SELECT * FROM users WHERE userName=:userNm AND `password`=:psw");
    $this->db->bind(':userNm', $userName);
    $this->db->bind(':psw', $userPassword);
    $this->db->execute();
    $result= $this->db->result();
    //return $userPassword;
    $oldPassword=$result[0]->password;

    if($oldPassword==$data['oldPassword']){

        $this->db->query("UPDATE users SET `password` = :pasw WHERE userName=:userNm");
        $this->db->bind(':pasw', $data['newPassword']);
        $this->db->bind(':userNm', $userName);
        if($this->db->execute()){
            $_SESSION['logn']['userPassword']=$data['newPassword'] ;
            return true;
        }else{
            return false;
        }
    }

}  
}
?>