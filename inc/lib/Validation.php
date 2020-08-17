<?php
class Validation{
    private $db;
    private $patern;
    private $mxlnth;
    private $mnlnth;
    private $tbl_nm;
    private $db_row;
    private $inpt_vl;
    private $inptvl;
    private $clmn_nm;

    public $ptrn= [
        'aword'    =>'/^[A-Za-z\p{Arabic}]+$/u',
        'word'    =>'/^[A-Za-z]+$/',
        'awordnm'  =>'/^[A-Za-z0-9\p{Arabic} ]+$/u',
        'wordnm'  =>'/^[A-Za-z0-9\ ]+$/u',
        'aletter_s' =>'/^[A-Za-z\p{Arabic} ]+$/u',
        'letter_s' =>'/^[A-Za-z ]+$/',
        'numbers' =>'/^[0-9]+$/',
        'astring'  =>'/^[A-Za-z\p{Arabic}0-9.\/@!:\'()"?<>{}|+-_*&^%$#\/\`~=.,;\[\] ]+$/u',
        'string'  =>'/^[A-Za-z0-9.\/@!:\'()"?<>{}|+-_*&^%$#\/\`~=.,;\[\] ]+$/',
        'asql'     =>'/^[A-Za-z\p{Arabic}0-9.\/@!:\'()"?<>{}|+-_*&^%$#\/\`~=.,;\[\] ]+$u/',
        'sql'     =>'/^[A-Za-z0-9.\/@!:\'()"?<>{}|+-_*&^%$#\/\`~=.,;\[\] ]+$/',
        'afil_nm'=>'/^[A-Za-z\p{Arabic}0-9.@!\'(){}+-_*&^%$#`~=.,[]; ]+$/u',
        'fil_nm'=>'/^[A-Za-z0-9.@!\'(){}+-_*&^%$#`~=.,[]; ]+$/',
        'apath'   =>'/^[A-Za-z\p{Arabic}0-9.\/@!:\'(){}+-_*&^%$#\/\`~=.,;\[\] ]+$/u',
        'path'    =>'/^[A-Za-z0-9.\/@!:\'(){}+-_*&^%$#\/\`~=.,;\[\] ]+$/',
        'imgpath' =>'/^[A-Za-z0-9.]+$/',
        'phone'   =>'/^[0-9]{11}+$/',
        'date'    =>'/^[0-3][0-9]\/[0-1][0-9]\/[0-9]{4}$/',
        'email'   =>'/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,5}$/ix',
        'password'=>'/^\S*(?=\S*[a-z])(?=\S*[A-Z])(?=\S*[\d])\S*$/',
    ];
    public function __construct(){
       $this->db      = new DataBase();
    }
    public function vld_message($type=null,$txt=null,$class=null) {
        $this->tybe = $type; 
        $this->txt  = $txt; 
        $this->class  = $class; 
        if($this->txt == null && $this->tybe=='success'){
           return "<span id='' class='{$class} sucs'><i class='fa fa-check'><i></span>";
        }elseif($this->txt == null && $this->tybe=='required') {
           return "<span id='' class='{$class}'> .. هذا الحقل مطلوب</span>";
        }elseif($this->txt == null && $this->tybe=='used') {
           return "<span id='' class='{$class}'> .. مستخدم اخر له نفس البيانات</span>";
        }elseif($this->txt == null && $this->tybe=='invalid'){
           return "<span id='' class='{$class}'>Invalid Input Renter It ...</span>";
        }elseif($this->txt != null && ($this->tybe =='success' or $this->tybe =='danger')){
           return "<span id='' class='alert-{$this->tybe} col-12 p-1 pl-2 pr-2 m-0'style='border-radius:4px;'>{$this->txt}</span>";
        }elseif($class!=null && $txt !=null){
            return "<span id='' class='{$class}'>{$this->txt}</span>";
        }else{}  
    }
    public function count_exist($inpt_vl,$tbl_nm,$db_row) {
     $this->inpt_vl = $inpt_vl; 
     $this->tbl_nm = $tbl_nm; 
     $this->db_row = $db_row; 
     $this->db->query("SELECT * FROM $this->tbl_nm WHERE $this->db_row = :val");
     $this->db->bind(":val", $this->inpt_vl);
     $row = $this->db->result();
     return count($row);
      /*if($this->db->execute()){
          return 1;
       } else {
          return 0;
       }*/
    }
    public function UserHasThis($inpt_vl,$tbl_nm,$db_row) {
      $UserLoggedIn=$_SESSION['logn']['userUname'];  
      $this->inpt_vl = $inpt_vl; 
      $this->tbl_nm = $tbl_nm; 
      $this->db_row = $db_row; 
      $this->db->query("SELECT * FROM $this->tbl_nm WHERE $this->db_row = :val");
      $this->db->bind(":val", $this->inpt_vl);
      $row = $this->db->result();
      if($row){
         if($UserLoggedIn===$row[0]->userName){
            return 'success';
         }else{
            return 'used';
         }
      }else{
         return 'invalid';
      }
     }
    public function inpt_validate($inpt_vl,$patern,$mxlnth,$mnlnth,$tbl_nm='no',$db_row='no'){
       $this->patern  = $this ->ptrn[$patern];
       $this->mxlnth  = $mxlnth;
       $this->mnlnth  = $mnlnth;
       $this->tbl_nm  = $tbl_nm;
       $this->db_row  = $db_row;
       $this->inpt_vl = $inpt_vl;
       if($db_row='password'){
          $this->inptvl=hash("sha512",$this->inpt_vl);
       }
       if($this->tbl_nm != 'no'){
  
             $this->db->query("SELECT * FROM $this->tbl_nm WHERE $this->db_row = :val");
             $this->db->bind(":val", $this->inptvl);
             $row  = $this->db->result();
             $count= count($row);
  
          if($this->inpt_vl !='' && $count == 0  && preg_match($this->patern, $this->inpt_vl)==1 && strlen($this->inpt_vl) <= $this->mxlnth && strlen($this->inpt_vl) >= $this->mnlnth ){  
             return 'success';
          }elseif($this->inpt_vl ==''){
             return 'required';
          }elseif($count != 0){
             return 'used';
          }else{
             return 'invalid';
          }
  
       }else{
  
          if($this->inpt_vl !='' && preg_match($this->patern, $this->inpt_vl)==1 && strlen($this->inpt_vl) <= $this->mxlnth && strlen($this->inpt_vl) >= $this->mnlnth ){  
             return 'success';
          }elseif($this->inpt_vl ==''){
             return 'required';
          }else{
             return 'invalid';
          }
       }
    }
    public function UpDt_validate($inpt_vl,$patern,$mxlnth,$mnlnth,$tbl_nm='no',$db_row='no'){
      $this->patern  = $this ->ptrn[$patern];
      $this->mxlnth  = $mxlnth;
      $this->mnlnth  = $mnlnth;
      $this->tbl_nm  = $tbl_nm;
      $this->db_row  = $db_row;
      $this->inpt_vl = $inpt_vl;
      if($db_row='password'){
         $this->inptvl=hash("sha512",$this->inpt_vl);
      }
      if($this->tbl_nm != 'no'){
            $UserLoggedIn=$_SESSION['logn']['userUname'];  
            $this->db->query("SELECT * FROM $this->tbl_nm WHERE $this->db_row = :val");
            $this->db->bind(":val", $this->inpt_vl);
            $row  = $this->db->result();
            if($row){
               $userNm=$row[0]->userName;
               $count= count($row);
               if($userNm==$UserLoggedIn){$count-=1;}
            }else{
               $count= count($row);
            }
         if($this->inpt_vl !='' && $count === 0  && preg_match($this->patern, $this->inpt_vl)==1 && strlen($this->inpt_vl) <= $this->mxlnth && strlen($this->inpt_vl) >= $this->mnlnth ){  
            return 'success';
         }elseif($this->inpt_vl ==''){
            return 'required';
         }elseif($count != 0){
            return 'used';
         }else{
            return 'invalid';
         }
      }else{
         if($this->inpt_vl !='' && preg_match($this->patern, $this->inpt_vl)==1 && strlen($this->inpt_vl) <= $this->mxlnth && strlen($this->inpt_vl) >= $this->mnlnth ){  
            return 'success';
         }elseif($this->inpt_vl ==''){
            return 'required';
         }else{
            return 'invalid';
         }
      }
    }
}
?>