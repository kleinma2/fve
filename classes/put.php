<?php 
class Put {
    public function __construct() {
       $this->db = (new MongoDB\Client())->selectDatabase('fve');
    }
    
    function structure($data){
        $structure=$this->db->selectCollection('structure');
        if(isset($data['_id'])){
            $id=new MongoDB\BSON\ObjectId($data['_id']);
            unset($data['_id']);
            
            return $structure->updateOne(
                ['_id'=>$id],
                ['$set'=>$data]
            );
        }else{
            return $structure->insertOne($data);
        }
    }
}
