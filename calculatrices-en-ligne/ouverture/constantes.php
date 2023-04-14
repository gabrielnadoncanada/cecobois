<?php
	/***** Longeurs *****/
	//Poteau court
	if($post->emplacement == 'haut'){
		$l_pc = $post->hauteur - 38;
	}
	else{
		$l_pc = $post->hauteur_mur - ( 3 * 38 ) - 140;
	}
	
	//Lisse de l'ouverture
	$l_o = $post->largeur + ( 2 * 38 );
	
	//Linteau
	$l_l = $post->largeur + ( 2 * 38 );
	
	//Poteau long
	$l_pl = $post->largeur - ( 3 * 38 );
	
	//Is = Iw
	$Is = array(
		'faible' 			=> 0.80,
		'normale' 			=> 1.00,
		'elevee' 			=> 1.15,
		'protection_civile' => 1.25
	);
	
	$charges = array(
		//État Limites Ultime
		'ELU' => array(
			'L' => $post->surcharge,
			'S' => $post->neige * $Is[$post->cat_risque],
			'D' => $post->permanente,
			'W' => $post->vent * $Is[$post->cat_risque]
		),
		//État Limites en Service
		'ELS' => array(
			'L' => $post->surcharge,
			'S' => $post->neige * 0.9,
			'D' => $post->permanente,
			'W' => $post->vent * .75
		)
	);
	
	$combinaisons = array(
		//État Limites Ultime
		'ELU' => array(
			'1'		=> (1.40 * $charges['ELU']['D']),
			'2a'	=> (1.25 * $charges['ELU']['D']) + (1.5 * $charges['ELU']['L']) + (0.5 * $charges['ELU']['S']),
			'3a'	=> (1.25 * $charges['ELU']['D']) + (1.5 * $charges['ELU']['S']) + (0.5 * $charges['ELU']['L']),
			'2bi'	=> (1.25 * $charges['ELU']['D']) + (1.5 * $charges['ELU']['L']),
			'3bi'	=> (1.25 * $charges['ELU']['D']) + (1.5 * $charges['ELU']['S']),
			'2bii'	=> (0.40 * $charges['ELU']['W']),
			'4ai'	=> (1.25 * $charges['ELU']['D']) + (0.5 * $charges['ELU']['L']),
			'4bi'	=> (1.25 * $charges['ELU']['D']) + (0.5 * $charges['ELU']['S']),
			'4aii'	=> (1.40 * $charges['ELU']['W'])
		),
		//État Limites en Service
		'ELS' => array(
			'1'		=> (1.00 * $charges['ELS']['D']),
			'2a'	=> (1.00 * $charges['ELS']['D']) + (1.0 * $charges['ELS']['L']) + (0.5 * $charges['ELS']['S']),
			'3a'	=> (1.00 * $charges['ELS']['D']) + (1.0 * $charges['ELS']['S']) + (0.5 * $charges['ELS']['L']),
			'2bi'	=> (1.00 * $charges['ELS']['D']) + (1.0 * $charges['ELS']['L']),
			'3bi'	=> (1.00 * $charges['ELS']['D']) + (1.0 * $charges['ELS']['S']),
			'2bii'	=> (0.40 * $charges['ELS']['W']),
			'4ai'	=> (1.00 * $charges['ELS']['D']) + (0.5 * $charges['ELS']['L']),
			'4bi'	=> (1.00 * $charges['ELS']['D']) + (0.5 * $charges['ELS']['S']),
			'4aii'	=> (1.00 * $charges['ELS']['W'])
		)
	);
	
	/***** Kd *****/
	$comb_max = max($combinaisons['ELU']['1'],$combinaisons['ELU']['2a'],$combinaisons['ELU']['3a']);
	if($comb_max == $combinaisons['ELU']['1']){ 
		$Kd = 0.65; 
	}
	else if($comb_max == $combinaisons['ELU']['2a']){ 
		$Kd = 1 -(0.5 * log($charges['ELS']['D']/($charges['ELS']['L']+(0.5*$charges['ELS']['S']/$Is[$post->cat_risque])))); 
	}
	else if($comb_max == $combinaisons['ELU']['3a']){ 
		$Kd = 1 -(0.5 * log($charges['ELS']['D']/(($charges['ELS']['S']/$Is[$post->cat_risque])+(0.5*$charges['ELS']['L'])))); 
	}
	
	if($Kd < .65){
		$Kd = 0.65;
	}
	else if($Kd > 1){
		$Kd = 1;
	}
	
	$all_b = array(
		'bois_sciage' => array(38), 
		'bois_composite' => array(44.5), 
		'lamelle_colle' => array(80,130,175,215,265)
	);
	
	$all_d = array(
		'bois_sciage' => array(array(64,89,140,184,235,286)), 
		'bois_composite' => array(array(140,184,235,241,286,302,356,406,457,508,559,610)), 
		'lamelle_colle' => array(
			//80
			array(114,152,190,228,266,304,342,380,418,456,494,532,570),
			//130
			array(152,190,228,266,304,342,380,418,456,494,532,570,608),
			//175
			array(190,228,266,304,342,380,418,456,494,532,570,608),
			//215
			array(266,304,342,380,418,456,494,532,570,608),
			//265
			array(342,380,418,456,494,532,570,608)
		)
	);
	
	//Pour sciage EPS
	$kzb_eps = array(64 => 1.7, 89 => 1.7, 	140 => 1.4, 184 => 1.2, 235 => 1.1, 286 => 1.0);
	
	$tab_classe_propriete	= array(
		'bois_sciage' => array(
			//"EPS 1/2"		=> 
			array(
				"nom"	=> "EPS n&deg;1/n&deg;2",
				"Fc"	=> 11.5,
				"Fb"	=> 11.8,
				"Fv"	=> 1.5,
				"Fcp"	=> 5.3,
				"E"		=> 9500,
				"E05"	=> 6500,
				"b"		=> array(38),
				"d"		=> array(array(64,89,140,184,235,286))
			),
			//"EPS 3/Stud"	=> 
			array(
				"nom"	=> "EPS n&deg;3/Stud",
				"Fc"	=> 9.0,
				"Fb"	=> 7.0,
				"Fv"	=> 1.5,
				"Fcp"	=> 5.3,
				"E"		=> 9000,
				"E05"	=> 5500,
				"b"		=> array(38),
				"d"		=> array(array(64,89,140,184,235,286))
			),
			//"MSR1650"	=> 
			array(
				"nom"	=> "MSR1650F<sup>b</sup>-1.5E",
				"Fc"	=> 18.1,
				"Fb"	=> 23.9,
				"Fv"	=> 1.5,
				"Fcp"	=> 5.3,
				"E"		=> 10300,
				"E05"	=> 8446,
				"b"		=> array(38),
				"d"		=> array(array(64,89,140))
			),
			//"MSR1950"	=> 
			array(
				"nom"	=> "MSR1950F<sup>b</sup>-1.7E",
				"Fc"	=> 19.3,
				"Fb"	=> 28.2,
				"Fv"	=> 1.5,
				"Fcp"	=> 5.3,
				"E"		=> 11700,
				"E05"	=> 9594,
				"b"		=> array(38),
				"d"		=> array(array(184))
			),
			//"MSR2100"	=> 
			array(
				"nom"	=> "MSR2100F<sup>b</sup>-1.8E",
				"Fc"	=> 19.9,
				"Fb"	=> 30.4,
				"Fv"	=> 1.5,
				"Fcp"	=> 6.5,
				"E"		=> 12400,
				"E05"	=> 10168,
				"b"		=> array(38),
				"d"		=> array(array(64,89,140))
			),
			//"MSR2250"	=> 
			array(
				"nom"	=> "MSR2250F<sup>b</sup>-1.9E",
				"Fc"	=> 20.5,
				"Fb"	=> 32.6,
				"Fv"	=> 1.5,
				"Fcp"	=> 6.5,
				"E"		=> 13100,
				"E05"	=> 10742,
				"b"		=> array(38),
				"d"		=> array(array(184))
			),
			//"MSR2400"	=> 
			array(
				"nom"	=> "MSR2400F<sup>b</sup>-2.9E",
				"Fc"	=> 21.1,
				"Fb"	=> 34.7,
				"Fv"	=> 1.5,
				"Fcp"	=> 6.5,
				"E"		=> 13800,
				"E05"	=> 11316,
				"b"		=> array(38),
				"d"		=> array(array(64,89))
			)
		),
		'bois_composite' => array(
			//"SCL 1.5"	=> 
			array(
				"nom"	=> "SCL 1.5",
				"Fb"	=> 25.80,
				"Fv"	=> 2.65,
				"E"		=> 10300
			),
			//"SCL 1.7"	=> 
			array(
				"nom"	=> "SCL 1.7",
				"Fb"	=> 29.7,
				"Fv"	=> 3.6,
				"E"		=> 11700
			),
			//"SCL 1.8"	=> 
			array(
				"nom"	=> "SCL 1.8",
				"Fb"	=> 31.70,
				"Fv"	=> 3.6,
				"E"		=> 12400
			),
			//"SCL 1.9"	=> 
			array(
				"nom"	=> "SCL 1.9",
				"Fb"	=> 33.60,
				"Fv"	=> 3.6,
				"E"		=> 13100
			),
			//"SCL 2.0"	=> 
			array(
				"nom"	=> "SCL 2.0",
				"Fb"	=> 35.60,
				"Fv"	=> 3.65,
				"E"		=> 13800
			),
			//"SCL 2.1"	=> 
			array(
				"nom"	=> "SCL 2.1",
				"Fb"	=> 37.55,
				"Fv"	=> 3.65,
				"E"		=> 14500
			)
		),
		'lamelle_colle' => array(
			//"DF-20f-E"=> 
			array(
				"nom"	=> "DM-20f-E",
				"Fb"	=> 25.6,
				"Fv"	=> 2.0,
				"E"		=> 12400
			),
			//"DF-24f-E"=> 
			array(
				"nom"	=> "DM-24f-E",
				"Fb"	=> 30.6,
				"Fv"	=> 2.0,
				"E"		=> 12800
			),
			//"EP-20f-E"=> 
			array(
				"nom"	=> "EP-20f-E",
				"Fb"	=> 25.6,
				"Fv"	=> 1.75,
				"E"		=> 10300
			)
		)		
	);
	
	foreach($tab_classe_propriete as $type => &$bois){
		foreach($bois as $serie => &$infos){
			//Set B & D si pas deja setter			
			if(!isset($infos['b'])){
				$infos['b'] = $all_b[$type];
				$infos['d'] = $all_d[$type];
			}		
			
			foreach($infos['b'] as $i => $b){
				foreach($infos['d'][$i] as $j => $d){
					/***** A - I - S *****/
					//A  = B * D	
					//Sx = B(D^2)/6
					//Ix = b(D^3)/12
					//EI = E / Ix
					$infos['A'][$b][$d]		= $b * $d;
					$infos['Sx'][$b][$d]	= ($b * pow($d,2))/6;
					$infos['Ix'][$b][$d]	= ($b * pow($d,3))/12;
					$infos['EsI'][$b][$d]	= $infos['E'] * $infos['Ix'][$b][$d];
					
					/***** Kzv && Kzb *****/
					if($type == 'bois_sciage'){ 
						if(strpos($infos['name'],'EPS') !== false){
							$infos['Kzb'][$b][$d] = $kzb_eps[$d];
							echo $infos['Kzb'][$b][$d].'-';
							$infos['Kzv'][$b][$d] = $kzb_eps[$d];
							echo $infos['Kzb'][$b][$d].'-'.$infos['Kzv'][$b][$d].'<br />';
						}
						else{
							$infos['Kzb'][$b][$d] = 1;
							$infos['Kzv'][$b][$d] = 1;
						}	
					}
					else if($type == 'bois_composite'){ 
						// (305/d)^(1/9)
						$infos['Kzb'][$b][$d] = pow((305/$d),(1/9)); 
						$infos['Kzv'][$b][$d] = 1;
					}
					else if($type == 'lamelle_colle'){ 
						// 1.03 * (b * Ll / 1 000 000)^-0.18 <= 1.0
						$infos['Kzb'][$b][$d] = 1.03 * pow(($b * $l_l / 1000000),-0.18);
						if($infos['Kzb'][$b][$d] > 1.0){ $infos['Kzb'][$b][$d] = 1.0; }
					}
									
				}
			}
		}
	}
?>