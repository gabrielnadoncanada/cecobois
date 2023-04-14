<?php

class Conversion{

	function ConvertPiedsToMetre($pieds){
		
		$pouces	= Conversion::ConvertPiedsToPouce($pieds);
		$metres	= $pouces * 0.0254;
		return $metres;
	}
	
	function ConvertPiedsToPouce($pieds){
				
		$pouces = $pieds*12;
		
		return $pouces;

	}
	
	function ConvertPoucesToMillimetre($pouces){
		$mm = $pouces * 25.4;
		return $mm;
	}
	
	function ConvertLbsurPiToKnsurM($LbsurPi){
		$kNsurM = $LbsurPi * 0.01459388;
		return $kNsurM;
	}
	
	function ConvertLbsurPiCarreToKPa($LbsurPiCarre){
		$KPa = $LbsurPiCarre * 0.0478803;
		return $KPa;
	}
	
	function ConvertLbToKn($Lb){
		$kN = $Lb *0.00444822049;
		return $kN;
	}
	
}
?>