<?php
require_once('autoload.php');
$validation=new Validation;
$AddData  =new AddData;
$id=isset($_GET['inpt']) ? $_GET['inpt'] : null;
$vl=isset($_GET['value']) ? $_GET['value'] : null;
$type=isset($_GET['type']) ? $_GET['type'] : null;

if($type=='input'){

  if($id=='signUn'){
    $result=$validation->inpt_validate($vl,'aword',20,4,'users','userName');
    if($result=='invalid'){
      $message=$validation->vld_message($result," ادخل احرف عربيه او انجليزيه من اربعه الي عشرون حرف بدون مسافات",'ar fld');
      echo $message;
    }else{
      $message=$validation->vld_message($result,null,'ar fld');
      echo $message;
    }
  }elseif ($id=='signPs') {
    $_SESSION['pas']='';
    $password = $vl;
    $result=$validation->inpt_validate($password,'string',20,8,'users','password');
    $password = hash("sha512", $vl);
    if($result=='invalid'){
      $message=$validation->vld_message($result,"ادخل من 8 الي 20 رموز وارقام وحروف بالانجليزيه",'ar fld');
      echo $message;
    }else{
      $message=$validation->vld_message($result,null,'ar fld');
      echo $message;
    }
    $_SESSION['pas']=$vl;
  }elseif ($id=='signCp') {
    if($vl==$_SESSION['pas']){
      $password = $vl;
      $result=$validation->inpt_validate($password,'string',20,8,'users','password');
      $password = hash("sha512", $vl);
      if($result=='invalid'){
        $message=$validation->vld_message($result,"ادخل من 8 الي 20 رموز وارقام وحروف بالانجليزيه",'ar fld');
        echo $message;
      }else{
        $message=$validation->vld_message($result,null,'ar fld');
        echo $message;
      }
    }else{
      $message=$validation->vld_message(null,' .. كلمه السر غير متطابقه ','ar fld');
      echo $message;
    }

  }elseif ($id=='signEm') {
    $result=$validation->inpt_validate($vl,'email',100,10,'users','email');
    if($result=='invalid'){
      $message=$validation->vld_message($result," .. ادخل ايميل صالح",'ar fld');
      echo $message;
    }else{
      $message=$validation->vld_message($result,null,'ar fld');
      echo $message;
    }
  }elseif ($id=='signFn') {
    $result=$validation->inpt_validate($vl,'aletter_s',40,4);
    if($result=='invalid'){
      $message=$validation->vld_message($result,"ادخل احرف عربيه او انجليزيه من اربعه الي اربعون حرف",'ar fld');
      echo $message;
    }else{
      $message=$validation->vld_message($result,null,'ar fld');
      echo $message;
    } 
  }
  
}elseif(isset($_POST['signUn'])){
  $signUn=isset($_POST['signUn']) ? $_POST['signUn'] : null;
  $signPs=isset($_POST['signPs']) ? $_POST['signPs'] : null;
  $signCp=isset($_POST['signCp']) ? $_POST['signCp'] : null;
  $signEm=isset($_POST['signEm']) ? $_POST['signEm'] : null;
  $signFn=isset($_POST['signFn']) ? $_POST['signFn'] : null;

  $complete=0;
  $result=$validation->inpt_validate($signUn,'aword',20,4,'users','userName');
  if($result=='success'){$complete+=1;}
  $password1 =$signPs;
  $result=$validation->inpt_validate($password1,'string',20,8,'users','password');
  $password1 = hash("sha512", $signPs);
  if($result=='success'){$complete+=1;}
  $password2 = $signCp;
  $result=$validation->inpt_validate($password2,'string',20,8,'users','password');
  $password2 = hash("sha512", $signCp);
  if($result=='success'){$complete+=1;}
  $result=$validation->inpt_validate($signEm,'email',100,10,'users','email');
  if($result=='success'){$complete+=1;}
  $result=$validation->inpt_validate($signFn,'aletter_s',40,4);
  if($result=='success'){$complete+=1;}
  if($signPs===$signCp){$complete+=1;}
     $data=array();
    if($complete===6){
      $data['signUn']=$signUn;
      $data['signPs']=$password1;
      $data['signEm']=$signEm;
      $data['signFn']=$signFn;
      $signIN=$AddData->createUser($data);
      if($signIN==true){
        $message=$validation->vld_message(null," ... مبروك تم تسجيل عضويتك",'ar sucs');
        echo $message;
      }else{
        $message=$validation->vld_message(null," ... حدث خطأ برجاء المحاوله في وقت لاحق",'ar fld');
        echo $message;   
      }
    }else{
      $message=$validation->vld_message(null," ... بيانات غير صالحه او مكرره اعد ادخال البيانات",'ar fld');
      echo $message;   
    }
}
?>