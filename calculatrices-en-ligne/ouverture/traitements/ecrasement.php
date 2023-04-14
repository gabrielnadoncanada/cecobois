<?PHP
	/********** Poteau Court **********/
	$b = 38;
	$d = $post->colombages;
	$e = array( 'essences' => array());
	
	/***** ELU *****/
	$e['Qf'] = max($pc['Pf'],$pl['Pf']['Cas 1'],$pl['Pf']['Cas 2'],$pl['Pf']['Cas 3']);
	
	$e['Kd'] = $Kd;
	if($e['Qf'] == $pc['Pf']){
		$type_poteau = 'court';
	}
	else{
		$type_poteau = 'long';
		if($e['Qf'] != $pl['Pf']['Cas 1']){
			$e['Kd'] = 1.15;
		}
	}
	
	if($d == 64){
		$e['Kzcp'] = 1.05;
	}
	else{
		$e['Kzcp'] = 1.15;
	}
		
	/***** ELS *****/
	foreach($tab_classe_propriete['bois_sciage'] as $key=>$essence){
		if(in_array($d,$essence['d'][0])){
			$ok = true;
			if($type_poteau == 'court'){
				if($pc['essences'][$key]['nb_min'] != -1){
					$e['essences'][$key]['pli'] = $pc['essences'][$key]['nb_min'];
				}
				else{
					$ok = false;
				}
			}
			else{
				if($pl['essences'][$key]['nb_min'] != -1){
					$e['essences'][$key]['pli'] = $pl['essences'][$key]['nb_min'] * $b * $d;
				}
				else{
					$ok = false;
				}
			}
			
			$e['essences'][$key]['Ab'] = $e['essences'][$key]['pli'] * $b * $d;
			
			switch($e['essences'][$key]['pli']){
				case 1:
					$e['essences'][$key]['Kb'] = 1.25;
					break;
				case 1:
					$e['essences'][$key]['Kb'] = 1.13;
					break;
				case 1:
					$e['essences'][$key]['Kb'] = 1.10;
					break;
				default:
					$e['essences'][$key]['Kb'] = 1.00;
					break;
			}
			
			//Qr = 0.8 * Fcp * Kd * Ab * Kb * Kzcp
			$e['essences'][$key]['Qr'] = 0.8 * $post->fleche_charge_totale * $e['Kd'] * $e['essences'][$key]['Ab'] * $e['essences'][$key]['Kb'] * $e['Kzcp'];
			
			if( $ok && $e['essences'][$key]['Qr'] >= $e['Qf']){
				$e['essences'][$key]['reponse'] = "Ok";
			}
			else{
				$e['essences'][$key]['reponse'] = "Problème d'écrasement";
			}
		}
	}
?>