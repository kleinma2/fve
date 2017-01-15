<?php 
class Get {
    public function __construct() {
       $this->db = (new MongoDB\Client())->selectDatabase('fve');
    }
    
    function structure($id=null){
        $structure=$this->db->selectCollection('structure');
        if($id==null){
            return $structure->find()->toArray();
        }else{
            return $structure->find(array('_id'=>new MongoDB\BSON\ObjectId($id)))->toArray();
        }
    }

    function equipment($id=null,$structure_id=null){
        $structure=$this->db->selectCollection('structure');
        if($id!=null){
            return $structure->find(array('_id'=>$id))->toArray();
        }else{
            return $structure->find(array('structure_id'=>new MongoDB\BSON\ObjectId($structure_id)))->toArray();
        }
    }
}
