<?php 
class Interpolation {
	/**
	 * lineární interpolace 1d
	 */	 
    function lin($xn,$x1,$y1,$x2,$y2){
		return $y1+(($xn-$x1)*(($y2-$y1)/($x2-$x1)));
    }
    
    
    /**
     * inverse distance weighted interpolation (kartézské souřadnice)
     * $array=x,y,val
     */
    function idw($xn,$yn,$p,$arr){
		$val=0;
		foreach($arr as $a){
			$val+=($a['z']/pow(pow($a['x']-$xn,2)+pow($a['y']-$yn,2),($p/2)))/(1/pow(pow($a['x']-$xn,2)+pow($a['y']-$yn,2),($p/2)));
		}
		return $val;
	}
	
} 
