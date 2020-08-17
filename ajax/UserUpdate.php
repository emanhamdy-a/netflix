<?php
require_once('autoload.php');
$validation=new Validation;
$updateData   =new update_data;
$id=isset($_GET['inpt']) ? $_GET['inpt'] : null;
$vl=isset($_GET['value']) ? $_GET['value'] : null;
$type=isset($_GET['type']) ? $_GET['type'] : null;

if($type=='input'){

  if($id=='usernm'){
    $result=$validation->UpDt_validate($vl,'aword',20,4,'users','userName');
    if($result=='invalid'){
      $message=$validation->vld_message($result," ادخل احرف عربيه او انجليزيه من اربعه الي عشرون حرف بدون مسافات",'ar fld');
      echo $message;
    }else{
      $message=$validation->vld_message($result,null,'ar fld');
      echo $message;
    }
  }elseif ($id=='email') {
    $result=$validation->UpDt_validate($vl,'email',100,10,'users','email');
    if($result=='invalid'){
      $message=$validation->vld_message($result," .. ادخل ايميل صالح",'ar fld');
      echo $message;
    }else{
      $message=$validation->vld_message($result,null,'ar fld');
      echo $message;
    }
  }elseif ($id=='fullnm') {
    $result=$validation->UpDt_validate($vl,'aletter_s',40,4);
    if($result=='invalid'){
      $message=$validation->vld_message($result,"ادخل احرف عربيه او انجليزيه من اربعه الي اربعون حرف",'ar fld');
      echo $message;
    }else{
      $message=$validation->vld_message($result,null,'ar fld');
      echo $message;
    } 
  }
  
}elseif(isset($_POST['userName'])){
  $updateUn=isset($_POST['userName']) ? $_POST['userName'] : null;
  $updateFn=isset($_POST['fullName']) ? $_POST['fullName'] : null;
  $updateEm=isset($_POST['email']) ? $_POST['email'] : null;

  $complete=0;
  $result=$validation->UpDt_validate($updateUn,'aword',20,4,'users','userName');
  if($result=='success'){$complete+=1;}
  $result=$validation->UpDt_validate($updateEm,'email',100,10,'users','email');
  if($result=='success'){$complete+=1;}
  $result=$validation->UpDt_validate($updateFn,'aletter_s',40,4);
  if($result=='success'){$complete+=1;}
    $SupdateUn=$_SESSION['logn']['userUname'];               
    $SupdateFn=$_SESSION['logn']['userFname'];               
    $SupdateEm=$_SESSION['logn']['userEmail'];
    if($SupdateUn===$updateUn && $SupdateFn===$updateFn && $SupdateEm===$updateEm){
      if($updateUn != '' && $updateFn!='' && $updateEm!=''){
        $message=$validation->vld_message(null," ... بياناتك لم تتغير لقد ادخلت نفس البيانات القديمه",'ar fld');
        echo $message;        
      }else{
        $message=$validation->vld_message(null," ... الرجاء ملئ كل الحقول",'ar fld');
        echo $message;  
      }
  }else{
    $data=array();
    if($complete===3){
        $data['updateUn']=$updateUn;
        $data['updateEm']=$updateEm;
        $data['updateFn']=$updateFn;
        $updateIN=$updateData->updateUser($data);
        if($updateIN==true){
          $message=$validation->vld_message(null," ...  تم تحديث بياناتك",'ar sucs');
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
}elseif($type=='UdPsw'){

  if($id=='oldPassword'){
    $password = hash("sha512", $vl);
    $result=$validation->UserHasThis($password,'users','password');
    if($result=='invalid'){
      $message=$validation->vld_message($result," .. كلمه سر غير صحيحه",'ar fld');
      echo $message;
    }else{
      $message=$validation->vld_message($result,null,'ar fld');
      echo $message;
    }
  }elseif ($id=='newPassword') {
    $_SESSION['pass']='';
    $password = $vl;
    $result=$validation->UpDt_validate($password,'string',20,8,'users','password');
    if($result=='invalid'){
      $message=$validation->vld_message($result,"ادخل من 8 الي 20 رموز وارقام وحروف بالانجليزيه",'ar fld');
      echo $message;
    }else{
      $message=$validation->vld_message($result,null,'ar fld');
      echo $message;
    }
    $_SESSION['pass']=$vl;
  }elseif ($id=='newPassword2') {
    if($vl==$_SESSION['pass']){
      $password = $vl;
      $result=$validation->UpDt_validate($password,'string',20,8,'users','password');
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

  }
  
}elseif(isset($_POST['oldPassword'])){
  $oldPassword =isset($_POST['oldPassword']) ? $_POST['oldPassword'] : null;
  $newPassword1 =isset($_POST['newPassword']) ? $_POST['newPassword'] : null;
  $newPassword2=isset($_POST['newPassword2']) ? $_POST['newPassword2'] : null;

  $complete=0;
  $oldPassword = hash("sha512",$_POST['oldPassword']);
  $result=$validation->UserHasThis($oldPassword,'users','password');
  if($result=='success'){$complete+=1;}

  $result=$validation->UpDt_validate($newPassword1,'string',20,8,'users','password');
  if($result=='success'){$complete+=1;}
  $newPassword1 = hash("sha512", $_POST['newPassword']);
  $result=$validation->UpDt_validate($newPassword2,'string',20,8,'users','password');
  $newPassword2 = hash("sha512", $_POST['newPassword2']);
  if($result=='success'){$complete+=1;}


  
  if($newPassword1===$newPassword2){$complete+=1;}
  
  if($oldPassword != $newPassword1){
    if($complete===4){
        $data=array();
        $data['oldPassword']=$oldPassword;
        $data['newPassword']=$newPassword1;
        $UpDatPsw=$updateData->updatePassword($data);
        if($UpDatPsw==true){
          $message=$validation->vld_message(null," ... تم تحديث كلمه السر الخاصه بك",'ar sucs');
          echo $message;
        }else{
          $message=$validation->vld_message(null," ... حدث خطأ برجاء المحاوله في وقت لاحق",'ar fld');
          echo $UpDatPsw;   
        }
    }else{
        $message=$validation->vld_message(null," ... بيانات غير صالحه او مكرره اعد ادخال البيانات",'ar fld');
        echo $message;   
    }
  }else{
    if($_POST['newPassword1']!= '' && $_POST['newPassword2'] !='' && $_POST['oldPassword']!=''){
      $message=$validation->vld_message(null," ... كلمه السر الخاصه بك لم تتغير لقد ادخلت كلمه السر القديمه",'ar fld');
      echo $message;        
    }else{
      $message=$validation->vld_message(null," ... الرجاء ملئ كل الحقول",'ar fld');
      echo $message;  
    }
  }
}
?>