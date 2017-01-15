<?php 
class Parse {
    function csv($csv,$delimiter,$enclosure){
        $obj=array();
        $headers=array();
        $lines=explode("\n",$csv);
        foreach($lines as $num=>$line){
            if($line==0){
                $headers=str_getcsv($line,$delimiter,$enclosure);
            }else{
                $obj[]=(array_filter(array_combine($headers,str_getcsv($line,$delimiter,$enclosure))));
            }
        }
        return $obj;
    }
}
