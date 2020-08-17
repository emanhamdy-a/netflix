<?php
class Login{
    private $db;
    private $logn;
    private $pasw;
    private $phon;
    private $userId;
    private $userUname;
    private $usr_typ;
    private $user_kind;
    private $userPassword;
    private $user_adrs;
    private $storenm;
    
    public function __construct(){
        $this->db= new DataBase();
    }
    public function LogIn($data){
            $this->db->query("SELECT * FROM users WHERE `password`=:pasword AND `userName` = :userName");
            $this->db->bind(':pasword',$data['logInPs']);
            $this->db->bind(':userName',$data['logInUn']);
            // Assign Result Set
            $result = $this->db->result();
            //return $data['logInUn'];
            if(count($result) > 0){
              $_SESSION['logn']['login-result']='yeas';               
              $_SESSION['logn']['userId']=$result[0]->id;               
              $_SESSION['logn']['userUname']=$result[0]->userName;               
              $_SESSION['logn']['userFname']=$result[0]->fullName;               
              $_SESSION['logn']['userPassword']=$result[0]->password;  
              $_SESSION['logn']['userEmail']=$result[0]->email;  
                return true;
            }else{
                return false;
            }
   
    } 

    public function check_login(){
        if(isset($_SESSION['logn']['login-result']) && $_SESSION['logn']['login-result'] !=''){
            return true;
        }else{
            return false;
        }
    }

    public function usr_nm(){
        if($this->check_login()!=false){
            $logn=isset($_SESSION['logn']['userUname']) ? $_SESSION['logn']['userUname'] : 'empty';
            return $logn;
        }
    }

    public function usr_id(){
        if($this->check_login()!=false){
            $logn=isset($_SESSION['logn']['userId']) ? $_SESSION['logn']['userId'] : 'empty';
            return $logn;
        }else{
            return 'empty';
        }
    }  

    public function usr_email(){
        if($this->check_login()!=false){
            $logn=isset($_SESSION['logn']['userEmail']) ? $_SESSION['logn']['userEmail'] : 'empty';
            return $logn;
        }else{
            return 'empty';
        }
    }
    public function usr_pasw(){
        if($this->check_login()!=false){
            $logn=isset($_SESSION['logn']['userPassword']) ? $_SESSION['logn']['userPassword'] : 'empty';
            return $logn;
        }else{
            return 'empty';
        }
    }

    function signLogoutProfile(){
     if($this->check_login()){
      echo"
      
      <a class='m-0 pr-2' style='color:white;' href='logout.php'> 
      <i style='font-size:16px;' class='fa fa-sign-out'></i> <a>
      <a class='m-0 pr-2' style='color:white;' href='profile.php'> 
      <i style='font-size:16px;' class='fa fa-user-circle'></i> <a>
      <a class='m-0' style='color:white;' href='serach.php'> 
      <i style='font-size:16px;' class='fa fa-search'></i> </a>
      ";
     }else{
      echo" 
      <i style='font-size:16px;' class='fa fa-sign-in sctnIcn'></i>
      <a class='search-switch search-open'> Login /<a>
      <a class='signup-switch signup-open'> Sign up<a>
        ";
     }
    }
 ///////////////////////////////echo--regester/end///////////////
 
 ///////////////////////////////echo--myaccount///////////////
   function echo_myaccount(){
       if($this->check_login() == true){
         return "My Profile";
       }else{
         return "";
       }
   }   
   function echo_favorit() {
      if($this->check_login() == true && $this->usr_typ() == 'byer' ){
        return " <a href='favorites.php' class='fav-nav'>Favourites</a>";
      }
      else{
        return "";
      }
   }
///////////////////////////////////////////////////////////
   function echo_favorit_icon(){
     if($this->check_login() == true && $this->usr_typ() == 'byer' ) {
        return "
            <a href='favorites.php' >
            <i style=''class='icon_heart_alt'></i>
            <span id='fvrt_nm'>0</span>
            </a>
            ";
      }elseif($this->check_login() == true && $this->usr_typ() != 'byer' ){
        return "";
      }elseif($this->check_login() == false){
        return "<a href='favorites.php' data-toggle='modal' data-target='#login_modal'>
              <i style=''class='icon_heart_alt'></i>
              <span id='fvrt_nm'>0</span>
              </a>";
      }
   } 
   function echo_logout_or_logn(){
    if($this->check_login() == true){
      return "<a href='logout/log_out.php'>log out</a>";
    }
    else{
      return "<a href='log in.php'>log In</a>";
      //echo "<a style='cursor:pointer;'data-toggle='modal' data-target='#login_modal'>Log In</a>";
    }
  }
}
?>