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
        $html.='</div>'."\n";
    
        return $html;
    }
    
    function chmodOptions($chmod,$level){
        $n=strval($chmod)[$level];
        $html='<option value="0"'.($n=='0'?' selected="selected"':'').($level==0?' disabled="disabled"':'').'>---</option>
        <option value="4"'.($n=='4'?' selected="selected"':'').($level==0?' disabled="disabled"':'').'>r--</option>
        <option value="6"'.($n=='6'?' selected="selected"':'').($level==0?' disabled="disabled"':'').'>rw-</option>
        <option value="7"'.($n=='7'?' selected="selected"':'').'>rwx</option>';
        return $html;
    }
}
