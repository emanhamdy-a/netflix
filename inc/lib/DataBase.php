<?php
class DataBase{
  private $con;
  private $host=DB_HOST;
  private $db_nm=DB_NAME;
  private $user=DB_USER;
  private $pass=DB_PASS;
  private $error;
  private $stmt;

  public function __construct(){
    $options=array(
        PDO::ATTR_PERSISTENT=>true,
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    );
    try {
        $this->con=new PDO('mysql:host=' . $this->host . ';dbname=' . $this->db_nm,$this->user,$this->pass,$options);
    } catch (PDOException $e) {
        $this->error=$e->getMessage();
    }
    //print_r($this->con);
    //echo $this->error;
  }
  public function query($statment){
     $this->stmt=$this->con->prepare($statment);//stmt من غير كول او ريترن استخدمها في الفنكشن التانيه
  }
  public function bind($baram,$value,$type=null){
      if(is_null($type)){
          switch (true) {
              case is_int($value):
                  $type=PDO::PARAM_INT;
                  break;
              case is_bool($value):
                  $type=PDO::PARAM_BOOL;
                  break;
              case is_null($value):
                  $type=PDO::PARAM_NULL;
                  break;
              default:
                  $type=PDO::PARAM_STR;
                  break;
          }
      }
      $this->stmt->bindvalue($baram,$value,$type);
  }
  public function execute(){
        //echo"000000000000"; //ال ايكو ظهرت من غير كول وال ستمت استخدمتها من ما اكون عامله لها ريترن من الفنكشن اللي قبلها او عامله كول يها
        $this->stmt->execute();
        return $this->stmt->rowCount();
  }

  public function result(){
      $this->execute();
     return $this->stmt->fetchAll(PDO::FETCH_OBJ);//هنا بقي منقدرتش استخدم نتيجه ال اكسكيوت من غير كول ومقرتش اخد النتيجه من غير ريترن
  }
  public function one_result(){
    $this->execute();
   return $this->stmt->fetch(PDO::FETCH_OBJ);
  }
  public function result_style($style){
      $this->execute();
     return $this->stmt->fetchAll($style);
  }
}
//$t=new DataBase;
//$sql=$t->query("SELECT * FROM categories");
//$sq=$t->result_style(PDO::FETCH_ASSOC);
//print_r($sq[0]['name']);
?>