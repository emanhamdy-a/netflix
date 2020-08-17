<?php
 class delete_data{
    private $db;
    private $gt_dta;

    public function __construct(){
        $this->db = new Database();
    }
    public function unlink_img($imge){
        unlink($imge);
    }
        //function delete
    public function delete_prdct($id){
        //Insert Query
        $this->gt_dta=new get_data();
        $image=$this->gt_dta->get_any_tabel('prdct','id',$id);
        $image=$image[0]->img;
        $this->db->query("DELETE  FROM prdct WHERE id= $id");
        //Execute
        if($this->db->execute()){
            $this->unlink_img($image);
            return $image;
        } else {
            return 'false';
        }
    }
 }

?>