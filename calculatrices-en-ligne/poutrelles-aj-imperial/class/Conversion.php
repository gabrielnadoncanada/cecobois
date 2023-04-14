<?php

class Conversion{

	function ConvertPiedsToMetre($pieds){
		
		$pouces	= Conversion::ConvertPiedsToPouce($pieds);
		$metres	= $pouces * 0.0254;
		return $metres;
	}
	
	function ConvertPiedsToPouce($pieds){
		
		/*
		//si il y a un 'ou un " 
		if(strpos($pieds,"'")!==false) || strpos($pieds,'"')!==false){
			
			//si il y a des '
			if(strpos($pieds,"'")!==false){
				
				$tab_pieds_pouces = explode("'",$pieds);
				$pouces = ($tab_pieds_pouces[0]*12)+(str_replace('"',"'",$tab_pieds_pouces[1]));
			}
		}else{
			$pouces = $pieds*12;	
		}
		*/
		
		$pouces = $pieds*12;
		
		return $pouces;

	}
	
	function ConvertPoucesToMillimetre($pouces){
		$mm 		= $pouces * 25.4;
		return $mm;
	}
	
	function ConvertLbsurPiCarreToKPa($LbsurPiCarre){
		$KPa = $LbsurPiCarre * 0.0478803;
		return $KPa;
	}
	
}
?>