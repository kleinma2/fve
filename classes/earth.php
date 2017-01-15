<?php 
class Earth {
	function correctTemp($temp,$from,$to){
		return $temp+(($to-$from)*0.0065);
	}
}
