<?php
class Employee{
    private $name;
    private $salary;
   /**/
    public function __construct($name,$salary){
        //$this->age=$age;
        //$this->tax=$tax;
        $this->name=$name;
        $this->salary=$salary;
    } 
    public function __get($prop){
        return $this->$prop;
    }
    public function clc(){
        return $this->salary . ($this->name);
    }
}
 $conection=null;
 try {
     $conection=new PDO('mysql://hostname=localhost;dbname=akhbari2','root','',
     array(
         //PDO::MYSQL_ATRR_INIT_COMMAND=>'SET NAMES UTF',//ERRMODE_SILENT
         PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
     ));
 } catch (PDOException $e) {
     echo $e->getMessage();
 }
 //var_dump($conection->exec("SELECT * FROM categories"));
 //var_dump($conection->query("SELECT * FROM categories"));
 if (isset($_GET['submit'])) {
    $name=filter_input(INPUT_GET,'text',FILTER_SANITIZE_STRING);
    $salary=filter_input(INPUT_GET,'sal',FILTER_SANITIZE_NUMBER_FLOAT,FILTER_FLAG_ALLOW_FRACTION);
    //$salary=filter_input(INPUT_GET,'sal',FILTER_SANITIZE_NUMBER_INT);
    /* $emply=new Employee;
    $->name=$name;
    $emply->salary=$salary;*/
    //$emply=new Employee($name,$salary);
    $sql="INSERT INTO category SET `name`=:name,`salary`=:salary";
    $stmt=$conection->prepare($sql);
    
    //echo $sql;='$name'$salary
    /*
    if ($conection->exec($sql)) {
        $msg='done';
    }else{
        $msg='error';
    }*/
    if ($stmt->execute (array(':name' => $name,
              ':salary'=>$salary
             ))
             ==true){
        $msg='done';
    }else{
        $msg='error';
    }
 }
 $sql="SELECT * FROM category";
 $stmt=$conection->query($sql);
 $result=$stmt->fetchAll(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE,'Employee',array('name','salary'));
 $result=(is_array($result) && !empty($result) ? $result : false);
 $rslt=array_shift($result);
 var_dump($rslt);
   // $result=$stmt->fetchAll(PDO::FETCH_OBJ);
   // $result=$stmt->fetchAll(PDO::FETCH_ASSOC);
   // $result=$stmt->fetchAll(PDO::FETCH_BOTH);
   // $result=$stmt->fetchAll(PDO::FETCH_ARRAY);
   //var_dump($result);
if (isset($_GET['actn']) && $_GET['actn']=='edt' && isset($_GET['id'])) {
    $id=filter_input(INPUT_GET,'id',FILTER_SANITIZE_NUMBER_INT);
    if($id > 0){
        //$emply=new Employee;($name,$salary);
        $sql="SELECT * FROM category WHERE id=:id";
        $result=$conection->prepare($sql);
        $found=$result->execute (array(':id' => $id,
                                         ':id'=>$id
                                        )
                                   );
     if($found){
        $result=$result->fetchAll(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE,'Employee',array('name','salary'));
       
        var_dump($result);
     }
    }
}
if (isset($_GET['actn']) && $_GET['actn']=='dlt' && isset($_GET['id'])) {
    $id=filter_input(INPUT_GET,'id',FILTER_SANITIZE_NUMBER_INT);
    if($id > 0){
        //$emply=new Employee;($name,$salary);
        $sql="DELETE FROM category WHERE id=:id";
        $result=$conection->prepare($sql);
        $found=$result->execute (array(':id' => $id,
        ':id'=>$id
        )
    );
    $sql="SELECT * FROM category";
    $stmt=$conection->query($sql);
    $result=$stmt->fetchAll(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE,'Employee',array('name','salary'));
    $result=(is_array($result) && !empty($result) ? $result : false);
    $rslt=array_shift($result);
    echo '$found';
    var_dump($rslt);
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset='UTF-8'>
    <meta name='description' content='Amin Template'>
    <meta name='keywords' content='Amin, unica, creative, html'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <!--<meta name='viewport' content='width=device-width, initial-scale=1.0, shrink-to-fit=no'>-->
    <meta http-equiv='X-UA-Compatible' content='ie=edge'>
    <title>PDO</title>
    <style>
     .tr{
        border:1px solid black;
        margin:2px;
        padding:2px;
     }
     .td{
        border:1px solid black;
        margin:2px;
        padding:2px;
     }
    </style>
    <!-- Css Styles -->
</head>
<body>   
    <table class='tbl'>
        <thead>
        <tr class='tr'id='title'>
            <th class='td' id='d'>id</th>
            <th class='td' id='d'>name</th>
            <th class='td' id='d'>salary</th>
        </tr>
        </thead>
        <tbody>
            <?php
             //if (isset($_GET['submit'])) {
             if(false !== $result){
                foreach ($result as $emply) {
                ?>
                 <tr>
                  <td class='td'><?=$emply->id;   ?></td>
                  <td class='td'><?=$emply->name; ?></td>
                  <td class='td'><?=$emply->clc();//$emply->name . $emply->salary;=?></td>                      
                  <td class='td'><a href="database.php?actn=edt&id=<?=$emply->id;?>">edt</a></td>                      
                  <td class='td'><a href="database.php?actn=dlt&id=<?=$emply->id;?>"onclick='if(!confirm("Do You Want To Delet This Empoyee..?")){return false;}'>dlt</a></td>                      
                 </tr>   
                <?php 
                }
             }
           // }
            ?>
        </tbody>
    </table>
    <form class='border' method="get" action=''>
        <h1><?= isset($msg) ? $msg : '';?></h1>
        name : <input class='m-5' name='text' type="text"  value='<?=$emply->name;?>'autocomplete='on' required><br><br>
        salary: <input class='m-5' name='sal' type="number"value='<?=$emply->salary;?>' step='0.01' max='2'min='1' value=""required>
        <input name='submit' type="submit" value="send">
    </form>
</body>
</html>