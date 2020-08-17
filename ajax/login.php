<?php
require_once('autoload.php');
$validation=new Validation;
$logIn  =new LogIn;
$id=isset($_GET['inpt']) ? $_GET['inpt'] : null;
$vl=isset($_GET['value']) ? $_GET['value'] : null;
$type=isset($_GET['type']) ? $_GET['type'] : null;

if($type=='input'){

  if($id=='logInUn'){
    $result=$validation->count_exist($vl,'users','userName') ;
    if($vl!=''){
      if($result==0){
        $message=$validation->vld_message(null," ..اسم المستخدم هذا غير موجود ",'ar fld');
        echo $message;
      }else{
        $message=$validation->vld_message("success",null,null);
        echo $message;
      }
    }  else{
      $message=$validation->vld_message("required",null,'ar fld');
      echo $message;
    }
  }elseif ($id=='logInPs') {
    $password = hash("sha512", $vl);
    $result=$validation->count_exist($password,'users','password') ;
    if($vl!=''){
      if($result==0){
        $message=$validation->vld_message(null," ..كلمه السر هذه غير موجوده ",'ar fld');
        echo $message;
      }else{
        $message=$validation->vld_message("success",null,null);
        echo $message;
      }
    }  else{
      $message=$validation->vld_message("required",null,'ar fld');
      echo $message;
    }
  }
  
}elseif(isset($_POST['logInUn'])){
  $logInUn=isset($_POST['logInUn']) ? $_POST['logInUn'] : null;
  $logInPs=isset($_POST['logInPs']) ? $_POST['logInPs'] : null;

  $complete=0;
  $result=$validation->count_exist($logInUn,'users','userName') ;
  if($result!=0){$complete+=1;}
  $password = hash("sha512", $logInPs);
  $result=$validation->count_exist($password,'users','password') ;
  if($result!=0){$complete+=1;}

    $data=array();
    if($complete===2){
      $password = hash("sha512", $logInPs);
      $data['logInUn']=$logInUn;
      $data['logInPs']=$password;
      $logInIN=$logIn->LogIn($data);
      if($logInIN){
        $message=$validation->vld_message(null," ... تم تسجيل دخولك",'ar sucs');
        echo $message;
      }else{
        $message=$validation->vld_message(null," ... اسم المستخدم او كلمه السر تخص مستخدم اخر",'ar fld');
        echo $message;   
      }
    }else{
      $message=$validation->vld_message(null," .. خطأ في ادخال البيانات اعد المحاوله",'ar fld');
      echo $message;   
    }
}
?>