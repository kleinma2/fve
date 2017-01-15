<?php 
class Render {
    function strom(){
        $get=new Get();
        $html='';
        $structure=$get->structure();
        foreach($structure as $s){
            if($s->parent == NULL){
                $html.=$this->iterateStrom($s->_id,$structure);
            }
        }
        return $html;
    }

    function iterateStrom($id,$structure){
        foreach($structure as $s){
            if($s->_id==$id){
                  $html='<a data-id="'.$s->_id.'" class="w3-padding nav"><i class="fa fa-folder-o fa-fw"></i>  '.$s->name.'</a>'."\n";
            }
        }
        
        $hasChildren=false;
        foreach($structure as $s){ 
            if($s->parent==$id){
               $hasChildren=true;
            }
        }
        
        $html.='<div data-parent="'.$id.'" class="w3-container hidden">'."\n";
        foreach($structure as $s){ 
            if($s->parent==$id){
                $html.=$this->iterateStrom($s->_id,$structure);
            }
        }
        $html.='<a data-addto="'.$id.'" class="w3-padding structure-add"><i class="fa fa-plus fa-fw"></i> přidat</a>';
        $html.='</div>'."\n";
    
        return $html;
    }
}
