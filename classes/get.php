<?php 
class Get {
    public function __construct() {
       $this->db = (new MongoDB\Client())->selectDatabase('fve');
    }
    
    function structure(){
        $structure=$this->db->selectCollection('structure');        
        return $structure->find()->toArray();
    }
}
