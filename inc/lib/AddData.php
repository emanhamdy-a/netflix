<?php
 class AddData{
     private $db;
     private $dataa=array();
     private $login;

     public function __construct(){
         $this -> db = new DataBase();
     }
     //upload image
    public function move_image($nam,$path){
        if(isset($nam) && isset($path)){
            $imageName = $nam;
            $imageTmpName = $path;
            $imageName =explode('.',$imageName) ;
            $imageName ='.' . $imageName[1];
            $date = date_create();
            $path= rand(1, date_timestamp_get($date));      
            $path=$path . rand(1, date_timestamp_get($date));      
            $mypath = "img/userimg/$path$imageName";
            $move=move_uploaded_file($imageTmpName,$mypath);
            if($move==1){
                $image = "img/userimg/$path$imageName";
                return $image;
            }else{
                return false;
            }            
        }

    }       
    //add product
    public function add_product($data){
      //get image path
      $image=$this->move_image($data['ad_imagenm'],$data['ad_imageTmpName']);
      //Insert prepare
      if($image != false){
        $this->db->prepare("INSERT INTO prdct (prdctnm, dscrptn, pric, stock, cat_id, sub_cat, `img`, userid,adrs,phonnu,storenm,color,size)
        VALUES (:prdctnm, :dscrptn, :pric, :stock, :cat_id, :sub_cat, :img, :userid,:adrs,:phonnu,:storenm,:color,:size)");  
        //$this->$login->usr_email();
        $this->login=new LogIn;
        // Bind Data
        $this->db->bind(':prdctnm', $data['ad_prdctnm']);
        $this->db->bind(':dscrptn',$data['ad_dscrptn']);
        $this->db->bind(':pric',  $data['ad_pric']);
        $this->db->bind(':stock', $data['ad_stok']);
        $this->db->bind(':cat_id',$data['ad_sortct']);
        $this->db->bind(':sub_cat',$data['ad_sortsb']);
        $this->db->bind(':color', $data['ad_color']);
        $this->db->bind(':size', $data['ad_size']);
        $this->db->bind(':img', $image);
        $this->db->bind(':userid', $this->login->usr_id());
        $this->db->bind(':adrs',   $this->login->usr_adrs());
        $this->db->bind(':phonnu', $this->login->usr_phon());
        $this->db->bind(':storenm',$this->login->stor_nm());
        //Execute
        if($this->db->execute()){
            return 'true';
        }else{
            return 'false';
        }          
      }else{
          return 'image faild';
      }
    }  
      
    //create user 
    public function createUser($data){
        //Insert prepare
        $this->db->query("INSERT INTO users (fullName,  userName, `email`, `password`)
        VALUES (:fullName, :userName,:email ,:pasword)");
        // Bind Data
        $this->db->bind(':fullName', $data['signFn']);
        $this->db->bind(':userName', $data['signUn']);
        $this->db->bind(':email', $data['signEm']);
        $this->db->bind(':pasword', $data['signPs']);
        //Execute
        $rowCount=$this->db->execute();
        if($rowCount){
          //return $rowCount;
          $dataa['logInUn']=$data['signUn'];
          $dataa['logInPs']=$data['signPs'];
           $this->login=new LogIn;
          $this->login->LogIN($dataa);
          return true;
        } else {
          return false;
        }
    }


}
?>