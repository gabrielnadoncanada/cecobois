<?PHP
	/********** Lisse de l'ouverture **********/
	$b = 38;
	$d = $post->colombages;
	$o = array( 'essences' => array());
	
	/***** ELU *****/
	$o['Wf'] = $combinaisons['ELU']['4aii'] * (($post->hauteur_mur/1000)/2);
	$o['Mf'] = ($o['Wf'] * pow(($l_o/1000),2)) / 8;
	$o['Vf'] = ($o['Wf'] * ($l_o/1000)) / 2;
		
	/***** ELS *****/
	foreach($tab_classe_propriete['bois_sciage'] as $key=>$essence){
		if(in_array($d,$essence['d'][0])){
			$o['essences'][$key] = array( 'nb_min' => -1 );
			//4 plis max
			for($i=1;$i<=4;$i++){				
				$o['essences'][$key][$i] = array();
				// Mr = 0.9 * Fb * 1.15 * Kh * S * Kzb
				// Vr = 0.9 * Fv * 1.15 * Kh * ((2 * A)/3) * Kzv
				$Kh = ($i!=1?1.1:1);
				$o['essences'][$key][$i]['Mr'] = 0.9 * $essence['Fb'] * 1.15 * $Kh * ($i * $essence['Sx'][$b][$d]) * $essence['Kzb'][$b][$d];
				$o['essences'][$key][$i]['Vr'] = 0.9 * $essence['Fv'] * 1.15 * $Kh * ($i * 2 * $essence['A'][$b][$d] / 3) * $essence['Kzv'][$b][$d];
				$o['essences'][$key][$i]['W'] = $combinaisons['ELS']['4aii'] * (($post->hauteur_mur/10000)/2);
				$o['essences'][$key][$i]['Fm'] = (5 * $o['essences'][$key][$i]['W'] * pow($l_o,3) * $post->fleche_surcharge)/384;
				
				//Verifier Mr >= Mf 	&& 		Vr >= Vf 	&& 		EsI >= Fm		&&		Cb <= 50
				if($o['essences'][$key]['nb_min'] == -1){
					if($o['essences'][$key][$i]['Mr'] >= $o['Mf']){
						if( $o['essences'][$key][$i]['Vr'] >= $o['Vf'] ){
							if( ($i * $essence['EsI'][$b][$d]) >= $o['essences'][$key][$i]['Fm'] ){
								$o['essences'][$key]['nb_min'] = $i;
							}
						}
					}
				}
			}
		}
	}
?>