<?PHP
	/********** Linteau **********/
	$Kse = 1;
	$Ksb = 1;
	$Kt  = 1;
	$Kx  = 1;
	$d_mur = $post->colombages;
	$l = array( 'essences' => array());
	
	/***** ELU *****/
	$l['Mf'] = ($comb_max * pow(($l_l / 1000),2)) / 8;
	$l['Vf'] = ($comb_max * ($l_l / 1000)) / 2;
	$l['Wf'] = ($comb_max * $l_l ) / 1000;
		
	/***** ELS *****/
	foreach($tab_classe_propriete[$post->type] as $key=>$essence){
		if($post->type == 'bois_sciage' || $post->type == 'bois_composite'){
			$b = $essence['b'][0];
			$nb_max = floor($d_mur/$b);
			//Pas plus que 5 plis
			if( $nb_max > 5 ){ $nb_max = 5; }
						
			foreach($essence['d'][0] as $j=>$d){
				$l['essences'][$key][$d]['nb_min'] = -1;
				//Nb de plis
				for($k=1;$k<=$nb_max;$k++){
					$ok = true;
					
					//**** Kh ****
					if($post->type == 'bois_sciage'){ $Kh = ($k!=1?1.1:1); }
					else if($post->type == 'bois_composite'){ $Kh = ($k<3?1:1.04); }

					//**** Kl ****
					//Le = 1.92 * Ll
					//Cb = √((Le * d) / (b^2))
					//FB = fb(Kd * Kh * Ksb * Kt)
					//Ck = √( (0.97 * E * Kse * Kt ) / Fb)
					//Kl = 1.0											=>	emplacement en haut
					//Kl = 1.0											=>	Cb <= 10
					//Kl = 1 - (1/3)(Cb/Ck)^4							=>	Cb > 10 	&&		Cb <= Ck 
					//Kl = (0.65 * E * kse * Kt) / (Cb^2 * Fb * Kx)		=>	Cb > Ck 	&& 		Cb <= 50					
					$l['essences'][$key][$d][$k]['Le'] = 1.92* $l_l;
					$l['essences'][$key][$d][$k]['Cb'] = sqrt(($l['essences'][$key][$d][$k]['Le'] * $d)/(pow(($k*$b),2)));
					$l['essences'][$key][$d][$k]['Fb'] = $essence['Fb'] * ($Kd * $Kh * $Ksb * $Kt);
					$l['essences'][$key][$d][$k]['Ck'] = sqrt((0.97 *  $essence['E'] * $Kse * $Kt)/ $l['essences'][$key][$d][$k]['Fb']);
					if( $post->emplacement == "haut" ){
						$l['essences'][$key][$d][$k]['Kl'] = 1.0;
					}
					if( $l['essences'][$key][$d][$k]['Cb'] < 10){
						$l['essences'][$key][$d][$k]['Kl'] = 1.0;
					}
					else if( $l['essences'][$key][$d][$k]['Cb'] <= $l['essences'][$key][$d][$k]['Ck'] ){
						$l['essences'][$key][$d][$k]['Kl'] = 1 - ((1/3) * pow(($l['essences'][$key][$d][$k]['Cb']/$l['essences'][$key][$d][$k]['Ck']),4));
					}
					else if( $l['essences'][$key][$d][$k]['Cb'] <= 50 ){
						$l['essences'][$key][$d][$k]['Kl'] = (0.65 * $essence['E'] * $Kse * $Kt ) / (pow($l['essences'][$key][$d][$k]['Cb'],2) * $l['essences'][$key][$d][$k]['Fb'] * $Kx);
					}
					else{
						//ERREUR
						$ok = false;
					}
					
					//Mr = 0.9 * fb * Kh * S * Kzb * Kl * Kd
					//Vr = 0.9 * Fv * Kh * (2A/3) * Kzv * Kd
					$l['essences'][$key][$d][$k]['Mr'] = 0.9 * $essence['Fb'] * $Kh * ($k * $essence['Sx'][$b][$d]) * $essence['Kzb'][$b][$d] * $l['essences'][$key][$d][$k]['Kl'] * $Kd;
					$l['essences'][$key][$d][$k]['Vr'] = 0.9 * $essence['Fv'] * $Kh * (2 * $k * $essence['A'][$b][$d] / 3) * $essence['Kzv'][$b][$d] * $Kd;
					
					//Fm = (5 * w * Ll^3 * x) / 384		=>		w = max(1;2a;3a)				=>		x = Flèche sous la charge totale
					//Fv = (5 * w * Ll^3 * x) / 384		=>		w = max(L + 0.5S; S + 0.5L)		=>		x = Flèche sous la surcharge/vent
					$l['essences'][$key][$d][$k]['Fm'] = (5 * max($combinaisons['ELS']['1'],$combinaisons['ELS']['2a'],$combinaisons['ELS']['3a']) * pow($l_l,3) * $post->fleche_surcharge)/384;
					$l['essences'][$key][$d][$k]['Fv'] = (5 * max(($charges['ELS']['L'] + (0.5 * $charges['ELS']['S'])), ($charges['ELS']['S'] + (0.5 * $charges['ELS']['L']))) * pow($l_l,3) * $post->fleche_charge_totale)/384;
					
					//Verifier Mr >= Mf 	&& 		Vr >= Vf 	&& 		EsI >= Fm		&& 		Esi >= Fv		&&		Cb <= 50
					if($l['essences'][$key][$d]['nb_min'] == -1){
						if(ok){
							if($l['essences'][$key][$d][$k]['Mr'] >= $l['Mf']){
								if( $l['essences'][$key][$d][$k]['Vr'] >= $l['Vf'] ){
									if( ($k * $essence['EsI'][$b][$d]) >= $l['essences'][$key][$d][$k]['Fm'] ){
										if( ($k * $essence['EsI'][$b][$d]) >= $l['essences'][$key][$d][$k]['Fv'] ){
											$l['essences'][$key][$d]['nb_min'] = $k;
										}
									}
								}
							}
						}
					}
				}
			}
		}
		else{
			foreach($essence['b'] as $i=>$b){
				// Pas plus large que le mur
				if($b <= $d_mur){
					$l['essences'][$key][$b]['nb_min'] = -1;
					foreach($essence['d'][$i] as $j=>$d){						
						$ok = true;
						
						//**** Kh ****
						$Kh = 1;
	
						//**** Kl ****
						//Le = 1.92 * Ll
						//Cb = √((Le * d) / (b^2))
						//FB = fb(Kd * Kh * Ksb * Kt)
						//Ck = √( (0.97 * E * Kse * Kt ) / Fb)
						//Kl = 1.0											=>	emplacement en haut
						//Kl = 1.0											=>	Cb <= 10
						//Kl = 1 - (1/3)(Cb/Ck)^4							=>	Cb > 10 	&&		Cb <= Ck 
						//Kl = (0.65 * E * kse * Kt) / (Cb^2 * Fb * Kx)		=>	Cb > Ck 	&& 		Cb <= 50					
						$l['essences'][$key][$b][$d]['Le'] = 1.92* $l_l;
						$l['essences'][$key][$b][$d]['Cb'] = sqrt(($l['essences'][$key][$b][$d]['Le'] * $d)/(pow($b,2)));
						$l['essences'][$key][$b][$d]['Fb'] = $essence['Fb'] * ($Kd * $Kh * $Ksb * $Kt);
						$l['essences'][$key][$b][$d]['Ck'] = sqrt((0.97 *  $essence['E'] * $Kse * $Kt)/ $l['essences'][$key][$b][$d]['Fb']);
						if( $post->emplacement == "haut" ){
							$l['essences'][$key][$b][$d]['Kl'] = 1.0;
						}
						if( $l['essences'][$key][$b][$d]['Cb'] < 10){
							$l['essences'][$key][$b][$d]['Kl'] = 1.0;
						}
						else if( $l['essences'][$key][$b][$d]['Cb'] <= $l['essences'][$key][$b][$d]['Ck'] ){
							$l['essences'][$key][$b][$d]['Kl'] = 1 - ((1/3) * pow(($l['essences'][$key][$b][$d]['Cb']/$l['essences'][$key][$b][$d]['Ck']),4));
						}
						else if( $l['essences'][$key][$b][$d]['Cb'] <= 50 ){
							$l['essences'][$key][$b][$d]['Kl'] = (0.65 * $essence['E'] * $Kse * $Kt ) / (pow($l['essences'][$key][$b][$d]['Cb'],2) * $l['essences'][$key][$b][$d]['Fb'] * $Kx);
						}
						else{
							//ERREUR
							$ok = false;
						}
						
						//Z = Ll/1000 * b/1000 * d/1000
						//Mr = 0.9 * fb * Kd * S * min(Kl;Kzb)
						//Vr = 0.9 * Fv * Kd * A * 3.69 * Z^-0.18
						$l['essences'][$key][$b][$d]['Z'] = $l_l/1000 * $b/1000 * $d/1000;
						$l['essences'][$key][$b][$d]['Mr'] = 0.9 * $essence['Fb'] * $Kd * $essence['Sx'][$b][$d] * min($l['essences'][$key][$b][$d]['Kl'],$essence['Kzb'][$b][$d]);
						$l['essences'][$key][$b][$d]['Vr'] = 0.9 * $essence['Fv'] * $Kd * $essence['A'][$b][$d] * 3.69 * pow($l['essences'][$key][$b][$d]['Z'], -0.18);
						
						//Fm = (5 * w * Ll^3 * x) / 384		=>		w = max(1;2a;3a)				=>		x = Flèche sous la charge totale
						//Fv = (5 * w * Ll^3 * x) / 384		=>		w = max(L + 0.5S; S + 0.5L)		=>		x = Flèche sous la surcharge/vent
						$l['essences'][$key][$b][$d]['Fm'] = (5 * max($combinaisons['ELS']['1'],$combinaisons['ELS']['2a'],$combinaisons['ELS']['3a']) * pow($l_l,3) * $post->fleche_surcharge)/384;
						$l['essences'][$key][$b][$d]['Fv'] = (5 * max(($charges['ELS']['L'] + (0.5 * $charges['ELS']['S'])), ($charges['ELS']['S'] + (0.5 * $charges['ELS']['L']))) * pow($l_l,3) * $post->fleche_charge_totale)/384;
						
						//Verifier Mr >= Mf 	&& 		Vr >= Wf 	&& 		EsI >= Fm		&& 		Esi >= Fv		&&		Cb <= 50
						if($l['essences'][$key][$b]['nb_min'] == -1){
							if(ok){
								if($l['essences'][$key][$b][$d]['Mr'] >= $l['Mf']){
									if( $l['essences'][$key][$b][$d]['Vr'] >= $l['Vf'] ){
										if( $essence['EsI'][$b][$d] >= $l['essences'][$key][$b][$d]['Fm'] ){
											if( $essence['EsI'][$b][$d] >= $l['essences'][$key][$b][$d]['Fv'] ){
												$l['essences'][$key][$b]['nb_min'] = $d;
											}
										}
									}
								}
							}
						}
					}
				}
			}
		}
	}
?>