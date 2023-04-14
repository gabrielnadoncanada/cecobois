<?PHP
	/********** Poteau Court **********/
	$b = 38;
	$d = $post->colombages;
	$pl = array( 'essences' => array());
	
	/***** ELU *****/
	$pl['aa'] = max($post->hauteur, ($l_pl - $post->hauteur));
	$pl['bb'] = min($post->hauteur, ($l_pl - $post->hauteur));
	
	//*** Cas 1 ***//
	$pl['wf']['Cas 1'] = $comb_max;
	$pl['Pf']['Cas 1'] = $pl['wf']['Cas 1'] * ($post->espacement/1000);
	$pl['Mf']['Cas 1'] = $pl['Pf']['Cas 1'] * ($post->excentricite/1000);
	
	//*** Cas 2 ***//
	//wf = max(2bi;3bi)
	//wfv = 2bii * ((espacement/1000)/2)
	//wfc = 2bii * ((hauteur_mur/1000)/2) * ((Ll/1000)/2)
	//Pf = wf * ((espacement/1000)/2)
	//Mf = ((Pf * excentricite * aa)/(Lpl/1000)) + ((wfv * bb * aa / 2)/(1000 * 1000)) + ((wfc * bb * aa)/(Lpl / 1000))
	//Vf = ((Pf * excentricite)/(Lpl)) + ((wfv * (Lpl / 1000))/ 2) + ((wfc * aa)/Lpl)
	$pl['wf']['Cas 2'] = max($combinaisons['ELU']['2bi'],$combinaisons['ELU']['3bi']);
	$pl['wfv']['Cas 2'] = $combinaisons['ELU']['2bii'] * (($post->espacement / 1000) / 2);
	$pl['wfc']['Cas 2'] =  $combinaisons['ELU']['2bii'] * (($post->hauteur_mur / 1000) / 2) * (($l_l / 1000) /2);
	$pl['Pf']['Cas 2'] = $pl['wf']['Cas 2'] * (($post->espacement/1000)/2);
	$pl['Mf']['Cas 2'] = (($pl['Pf']['Cas 2'] * $post->excentricite * $pl['aa'])/($l_pl/1000)) + (($pl['wfv']['Cas 2'] * $pl['bb'] * $pl['aa'] / 2)/(1000 * 1000)) + (($pl['wfc']['Cas 2'] * $pl['bb'] * $pl['aa'])/($l_pl * 1000));
	$pl['Vf']['Cas 2'] = (($pl['Pf']['Cas 2'] * $post->excentricite)/$l_pl) + (($pl['wfv']['Cas 2'] * ($l_pl / 1000))/2) + (($pl['wfc']['Cas 2'] * $pl['aa'])/$l_pl);
	
	//*** Cas 3 ***//
	//wf = max(4ai;4bi)
	//wfv = 4aii * ((espacement/1000)/2)
	//wfc = 4aii * ((hauteur_mur/1000)/2) * ((Ll/1000)/2)
	//Pf = wf * ((espacement/1000)/2)
	//Mf = ((Pf * excentricite * aa)/(Lpl/1000)) + ((wfv * bb * aa / 2)/(1000 * 1000)) + ((wfc * bb * aa)/(Lpl / 1000))
	//Vf = ((Pf * excentricite)/(Lpl)) + ((wfv * (Lpl / 1000))/ 2) + ((wfc * aa)/Lpl)
	$pl['wf']['Cas 3'] = max($combinaisons['ELU']['4ai'],$combinaisons['ELU']['4bi']);
	$pl['wfv']['Cas 3'] = $combinaisons['ELU']['4aii'] * (($post->espacement / 1000) / 2);
	$pl['wfc']['Cas 3'] =  $combinaisons['ELU']['4aii'] * (($post->hauteur_mur / 1000) / 2) * (($l_l / 1000) /2);
	$pl['Pf']['Cas 3'] = $pl['wf']['Cas 2'] * (($post->espacement/1000)/2);
	$pl['Mf']['Cas 3'] = (($pl['Pf']['Cas 2'] * $post->excentricite * $pl['aa'])/($l_pl/1000)) + (($pl['wfv']['Cas 2'] * $pl['bb'] * $pl['aa'] / 2)/(1000 * 1000)) + (($pl['wfc']['Cas 2'] * $pl['bb'] * $pl['aa'])/($l_pl * 1000));
	$pl['Vf']['Cas 3'] = (($pl['Pf']['Cas 2'] * $post->excentricite)/$l_pl) + (($pl['wfv']['Cas 2'] * ($l_pl / 1000))/2) + (($pl['wfc']['Cas 2'] * $pl['aa'])/$l_pl);
	
	/***** ELS *****/
	foreach($tab_classe_propriete['bois_sciage'] as $key=>$essence){
		if(in_array($d,$essence['d'][0])){
			$pl['essences'][$key] = array( 'nb_min' => -1 );
			//5 plis max
			for($i=1;$i<=5;$i++){
				$Kh = ($i!=1?1.1:1);
				
				$pl['essences'][$key][$i] = array();
				//Axe Fort
				// Kzc = 6.3(d*Lpl)^-.013 <= 1.3
				// Cc = Lpl/d
				// Kc = ( 1 + ( ( Fc*Kzc*CC^3 ) / ( 35*E05 ) ) )^-1
				$pl['essences'][$key][$i]['axe_fort'] = array();
				$pl['essences'][$key][$i]['axe_fort']['Kzc'] = 6.3 * pow(($d*$l_pl),-0.13);
				if($pl['essences'][$key][$i]['axe_fort']['Kzc'] > 1.3){ $pl['essences'][$key][$i]['axe_fort']['Kzc'] = 1.3; }
				$pl['essences'][$key][$i]['axe_fort']['Cc'] = $l_pl/$d;
				$pl['essences'][$key][$i]['axe_fort']['Kc'] = pow( ( 1 + ( ( $essence['Fc'] * $pl['essences'][$key][$i]['axe_fort']['Kzc'] * pow($pl['essences'][$key][$i]['axe_fort']['Cc'],3) ) / ( 35 * $essence['E05'] ) ) ) , -1 );
				//CAS 1
				// Pr = ( 0.8 *Fc * A * Kc * Kzc * Kd ) / 1000
				// Mr = ( 0.9 *Fb * Kh * S * Kzb * Kd ) / (1000 * 1000)
				$pl['essences'][$key][$i]['axe_fort']['Pr']['Cas 1'] = (0.8 * $essence['Fc'] * ($i * $essence['A'][$b][$d]) * $pl['essences'][$key][$i]['axe_fort']['Kc'] * $pl['essences'][$key][$i]['axe_fort']['Kzc'] * $Kd ) / 1000;
				$pl['essences'][$key][$i]['axe_fort']['Mr']['Cas 1'] = (0.9 * $essence['Fb'] * $Kh * ($i * $essence['Sx'][$b][$d]) * $essence['Kzb'][$b][$d] * $Kd ) / (1000 * 1000);
				//CAS 2 & 3
				// Pr = ( 0.8 *Fc * A * Kc * Kzc * 1.15 ) / 1000
				// Mr = ( 0.9 *Fb * Kh * S * Kzb * 1.15 ) / (1000 * 1000)
				$pl['essences'][$key][$i]['axe_fort']['Pr']['Cas 2'] = (0.8 * $essence['Fc'] * ($i * $essence['A'][$b][$d]) * $pl['essences'][$key][$i]['axe_fort']['Kc'] * $pl['essences'][$key][$i]['axe_fort']['Kzc'] * 1.15 ) / 1000;
				$pl['essences'][$key][$i]['axe_fort']['Mr']['Cas 2'] = (0.9 * $essence['Fb'] * $Kh * ($i * $essence['Sx'][$b][$d]) * $essence['Kzb'][$b][$d] * 1.15 ) / (1000 * 1000);
				$pl['essences'][$key][$i]['axe_fort']['Pr']['Cas 3'] = (0.8 * $essence['Fc'] * ($i * $essence['A'][$b][$d]) * $pl['essences'][$key][$i]['axe_fort']['Kc'] * $pl['essences'][$key][$i]['axe_fort']['Kzc'] * 1.15 ) / 1000;
				$pl['essences'][$key][$i]['axe_fort']['Mr']['Cas 3'] = (0.9 * $essence['Fb'] * $Kh * ($i * $essence['Sx'][$b][$d]) * $essence['Kzb'][$b][$d] * 1.15 ) / (1000 * 1000);
				
			
				
			
				//Axe Faible
				// Kzc = 6.3(b*Lpc)^-.013 <= 1.3
				// Cc = Lpl/b
				// Kc = ( 1 + ( ( Fc*Kzc*CC^3 ) / ( 35*E05 ) ) )^-1
				$pl['essences'][$key][$i]['axe_faible'] = array();
				$pl['essences'][$key][$i]['axe_faible']['Kzc'] = 6.3 * pow((($b*$i)*$l_pl),-0.13);
				if($pl['essences'][$key][$i]['axe_faible']['Kzc'] > 1.3){ $pl['essences'][$key][$i]['axe_faible']['Kzc'] = 1.3; }
				$pl['essences'][$key][$i]['axe_faible']['Cc'] = $l_pl/($b*$i);
				$pl['essences'][$key][$i]['axe_faible']['Kc'] = pow( ( 1 + ( ( $essence['Fc'] * $pl['essences'][$key][$i]['axe_faible']['Kzc'] * pow($pl['essences'][$key][$i]['axe_faible']['Cc'],3) ) / ( 35 * $essence['E05'] ) ) ) , -1 );
				//CAS 1
				// Pr = ( 1 * 0.8 * Fc * A * Kc * Kzc * Kd ) / 1000		=>	1 pli
				// Pr = ( 0.6 * 0.8 * Fc * A * Kc * Kzc * Kd ) / 1000	=>	2 pli et plus
				$pl['essences'][$key][$i]['axe_faible']['Pr']['Cas 1'] = (($i!=1?0.6:1) * 0.8 * $essence['Fc'] * ($i * $essence['A'][$b][$d]) * $pl['essences'][$key][$i]['axe_faible']['Kc'] * $pl['essences'][$key][$i]['axe_faible']['Kzc'] * $Kd ) / 1000;
				//CAS 2 & 3
				// Pr = ( 1 * 0.8 * Fc * A * Kc * Kzc * 1.15 ) / 1000		=>	1 pli
				// Pr = ( 0.6 * 0.8 * Fc * A * Kc * Kzc * 1.15 ) / 1000	=>	2 pli et plus
				$pl['essences'][$key][$i]['axe_faible']['Pr']['Cas 2'] = (($i!=1?0.6:1) * 0.8 * $essence['Fc'] * ($i * $essence['A'][$b][$d]) * $pl['essences'][$key][$i]['axe_faible']['Kc'] * $pl['essences'][$key][$i]['axe_faible']['Kzc'] * 1.15 ) / 1000;
				$pl['essences'][$key][$i]['axe_faible']['Pr']['Cas 3'] = (($i!=1?0.6:1) * 0.8 * $essence['Fc'] * ($i * $essence['A'][$b][$d]) * $pl['essences'][$key][$i]['axe_faible']['Kc'] * $pl['essences'][$key][$i]['axe_faible']['Kzc'] * 1.15 ) / 1000;
				
				
				//VR = 0.9 * Fv * 1.15 * Kh * ((2 * A)/3) * Kzv
				$pl['essences'][$key][$i]['Vr'] = 0.9 * $essence['Fv'] * 1.15 * $Kh * ($i * 2 * $essence['A'][$b][$d] / 3) * $essence['Kzv'][$b][$d];
				
				
				//Δt & Δl
				//Pe = (π^2 * E05 * Ix)/(L_pl^2 * 1000)
				$pl['essences'][$key][$i]['Pe'] = (pow(pi(),2) * $essence['E05'] * ($i * $essence['Ix'][$b][$d])) / (pow($l_pl,2) * 1000);
				//CAS 1
				//Pt = max(1;2a;3a) * (espacement / 2)
				//Pl = (max(2a;3a) - D) * (espacement / 2)
				//Δ = ((P * excentricite * L_pl^2)/(16 * E * Ix)) * (1 / ( 1 - ( (P/1000)/Pe) ) )
				$pl['essences'][$key][$i]['Pt']['Cas 1'] = max($combinaisons['ELS']['1'],$combinaisons['ELS']['2a'],$combinaisons['ELS']['3a']) * ($post->espacement / 2);
				$pl['essences'][$key][$i]['Pl']['Cas 1'] = (max($combinaisons['ELS']['2a'],$combinaisons['ELS']['3a']) - $charges['ELS']['D']) * ($post->espacement / 2);
				$pl['essences'][$key][$i]['Δt']['Cas 1'] = ( ( $pl['essences'][$key][$i]['Pt']['Cas 1'] * $post->excentricite * pow($l_pl,2) ) / (16 * $essence['E'] * ($i * $essence['Ix'][$b][$d]))) * ( 1 / ( 1 - ( ($pl['essences'][$key][$i]['Pt']['Cas 1']/1000) / $pl['essences'][$key][$i]['Pe'])));
				$pl['essences'][$key][$i]['Δl']['Cas 1'] = ( ( $pl['essences'][$key][$i]['Pl']['Cas 1'] * $post->excentricite * pow($l_pl,2) ) / (16 * $essence['E'] * ($i * $essence['Ix'][$b][$d]))) * ( 1 / ( 1 - ( ($pl['essences'][$key][$i]['Pl']['Cas 1']/1000) / $pl['essences'][$key][$i]['Pe'])));
				//CAS 2
				//Pt = max(2bi;3bi) * (espacement / 2)
				//Pl = max(S;L) * (espacement / 2)
				//Wu = 2bii * ((espacement/1000)2)
				//Wc = 2bii * ((hauteur_mur/1000)2) * (Ll/2)
				//Δ = ( (P * excentricite)/( 16 * E * Ix ) + ( 5 * Wu * Lpl^4 )/( 384 * E * Ix ) + ( Wc * aa * bb * (aa + ( 2 * bb )) * √( (3 * aa)*( aa + ( 2 * bb ) ) ) )/( 27 * E * Ix * Lpl )) * ( 1 / ( 1 - ((P/1000)/Pe) ) )
				//Separé la formule en 4 parties pour faciliter debug
				//Δ = (Δ1 + Δ2 + Δ3) * Δ4 
				//Δ1 = (P * excentricite * Lpl^2)/( 16 * E * Ix )
				//Δ2 = ( 5 * Wu * Lpl^4 )/( 384 * E * Ix )
				//Δ3 = ( Wc * aa * bb * (aa + ( 2 * bb )) * √( (3 * aa)*( aa + ( 2 * bb ) ) ) )/( 27 * E * Ix * Lpl )
				//Δ4 = ( 1 / ( 1 - ((P/1000)/Pe) ) )
				$pl['essences'][$key][$i]['Pt']['Cas 2'] = max($combinaisons['ELS']['2bi'],$combinaisons['ELS']['3bi']) * ($post->espacement / 2);
				$pl['essences'][$key][$i]['Pl']['Cas 2'] = max($charges['ELS']['S'],$charges['ELS']['L']) * ($post->espacement / 2);
				$pl['essences'][$key][$i]['Wu']['Cas 2'] = $combinaisons['ELS']['2bii'] * (($post->espacement/1000)/2);
				$pl['essences'][$key][$i]['Wc']['Cas 2'] = $combinaisons['ELS']['2bii'] * (($post->hauteur_mur/1000)/2) * ($l_l/2);
				//Δt
				$pl['essences'][$key][$i]['Δtl']['Cas 2'] = ($pl['essences'][$key][$i]['Pt']['Cas 2'] * $post->excentricite * pow($l_pl,2)) / (16 * $essence['E'] * ($i * $essence['Ix'][$b][$d]));
				$pl['essences'][$key][$i]['Δt2']['Cas 2'] = (5 * $pl['essences'][$key][$i]['Wu']['Cas 2'] * pow($l_pl,4))/(384 * $essence['E'] * ($i * $essence['Ix'][$b][$d]));
				$pl['essences'][$key][$i]['Δt3']['Cas 2'] = ($pl['essences'][$key][$i]['Wc']['Cas 2'] * $pl['aa'] * $pl['bb'] * ($pl['aa'] + ( 2 * $pl['bb'])) * sqrt(((3*$pl['aa']) * ($pl['aa'] + (2*$pl['bb']))))) / (27 * $essence['E'] * ($i * $essence['Ix'][$b][$d]) * $l_pl );
				$pl['essences'][$key][$i]['Δt4']['Cas 2'] = ( 1 / ( 1 - (($pl['essences'][$key][$i]['Pt']['Cas 2']/1000)/$pl['essences'][$key][$i]['Pe'])));
				$pl['essences'][$key][$i]['Δt']['Cas 2'] = ($pl['essences'][$key][$i]['Δtl']['Cas 2'] + $pl['essences'][$key][$i]['Δt2']['Cas 2'] + $pl['essences'][$key][$i]['Δt3']['Cas 2']) * $pl['essences'][$key][$i]['Δt4']['Cas 2'];
				//Δl
				$pl['essences'][$key][$i]['Δll']['Cas 2'] = ($pl['essences'][$key][$i]['Pl']['Cas 2'] * $post->excentricite * pow($l_pl,2)) / (16 * $essence['E'] * ($i * $essence['Ix'][$b][$d]));
				$pl['essences'][$key][$i]['Δl2']['Cas 2'] = (5 * $pl['essences'][$key][$i]['Wu']['Cas 2'] * pow($l_pl,4))/(384 * $essence['E'] * ($i * $essence['Ix'][$b][$d]));
				$pl['essences'][$key][$i]['Δl3']['Cas 2'] = ($pl['essences'][$key][$i]['Wc']['Cas 2'] * $pl['aa'] * $pl['bb'] * ($pl['aa'] + ( 2 * $pl['bb'])) * sqrt(((3*$pl['aa']) * ($pl['aa'] + (2*$pl['bb']))))) / (27 * $essence['E'] * ($i * $essence['Ix'][$b][$d]) * $l_pl );
				$pl['essences'][$key][$i]['Δl4']['Cas 2'] = ( 1 / ( 1 - (($pl['essences'][$key][$i]['Pl']['Cas 2']/1000)/$pl['essences'][$key][$i]['Pe'])));
				$pl['essences'][$key][$i]['Δl']['Cas 2'] = ($pl['essences'][$key][$i]['Δtl']['Cas 2'] + $pl['essences'][$key][$i]['Δt2']['Cas 2'] + $pl['essences'][$key][$i]['Δt3']['Cas 2']) * $pl['essences'][$key][$i]['Δt4']['Cas 2'];
				//CAS 3
				//Pt = max(4ai;4bi) * (espacement / 2)
				//Pl = max(0.5S;0.5L) * (espacement / 2)
				//Wu = 4bii * ((espacement/1000)2)
				//Wc = 4bii * ((hauteur_mur/1000)2) * (Ll/2)
				//Δ = ( (P * excentricite)/( 16 * E * Ix ) + ( 5 * Wu * Lpl^4 )/( 384 * E * Ix ) + ( Wc * aa * bb * (aa + ( 2 * bb )) * √( (3 * aa)*( aa + ( 2 * bb ) ) ) )/( 27 * E * Ix * Lpl )) * ( 1 / ( 1 - ((P/1000)/Pe) ) )
				//Separé la formule en 4 parties pour faciliter debug
				//Δ = (Δ1 + Δ2 + Δ3) * Δ4 
				//Δ1 = (P * excentricite * Lpl^2)/( 16 * E * Ix )
				//Δ2 = ( 5 * Wu * Lpl^4 )/( 384 * E * Ix )
				//Δ3 = ( Wc * aa * bb * (aa + ( 2 * bb )) * √( (3 * aa)*( aa + ( 2 * bb ) ) ) )/( 27 * E * Ix * Lpl )
				//Δ4 = ( 1 / ( 1 - ((P/1000)/Pe) ) )
				$pl['essences'][$key][$i]['Pt']['Cas 3'] = max($combinaisons['ELS']['4ai'],$combinaisons['ELS']['4bi']) * ($post->espacement / 2);
				$pl['essences'][$key][$i]['Pl']['Cas 3'] = max(0.5*$charges['ELS']['S'],0.5*$charges['ELS']['L']) * ($post->espacement / 2);
				$pl['essences'][$key][$i]['Wu']['Cas 3'] = $combinaisons['ELS']['4aii'] * (($post->espacement/1000)/2);
				$pl['essences'][$key][$i]['Wc']['Cas 3'] = $combinaisons['ELS']['4aii'] * (($post->hauteur_mur/1000)/2) * ($l_l/2);
				//Δt
				$pl['essences'][$key][$i]['Δtl']['Cas 3'] = ($pl['essences'][$key][$i]['Pt']['Cas 3'] * $post->excentricite * pow($l_pl,2)) / (16 * $essence['E'] * ($i * $essence['Ix'][$b][$d]));
				$pl['essences'][$key][$i]['Δt2']['Cas 3'] = (5 * $pl['essences'][$key][$i]['Wu']['Cas 3'] * pow($l_pl,4))/(384 * $essence['E'] * ($i * $essence['Ix'][$b][$d]));
				$pl['essences'][$key][$i]['Δt3']['Cas 3'] = ($pl['essences'][$key][$i]['Wc']['Cas 3'] * $pl['aa'] * $pl['bb'] * ($pl['aa'] + ( 2 * $pl['bb'])) * sqrt(((3*$pl['aa']) * ($pl['aa'] + (2*$pl['bb']))))) / (27 * $essence['E'] * ($i * $essence['Ix'][$b][$d]) * $l_pl );
				$pl['essences'][$key][$i]['Δt4']['Cas 3'] = ( 1 / ( 1 - (($pl['essences'][$key][$i]['Pt']['Cas 3']/1000)/$pl['essences'][$key][$i]['Pe'])));
				$pl['essences'][$key][$i]['Δt']['Cas 3'] = ($pl['essences'][$key][$i]['Δtl']['Cas 3'] + $pl['essences'][$key][$i]['Δt2']['Cas 3'] + $pl['essences'][$key][$i]['Δt3']['Cas 3']) * $pl['essences'][$key][$i]['Δt4']['Cas 3'];
				//Δl
				$pl['essences'][$key][$i]['Δll']['Cas 3'] = ($pl['essences'][$key][$i]['Pl']['Cas 3'] * $post->excentricite * pow($l_pl,2)) / (16 * $essence['E'] * ($i * $essence['Ix'][$b][$d]));
				$pl['essences'][$key][$i]['Δl2']['Cas 3'] = (5 * $pl['essences'][$key][$i]['Wu']['Cas 3'] * pow($l_pl,4))/(384 * $essence['E'] * ($i * $essence['Ix'][$b][$d]));
				$pl['essences'][$key][$i]['Δl3']['Cas 3'] = ($pl['essences'][$key][$i]['Wc']['Cas 3'] * $pl['aa'] * $pl['bb'] * ($pl['aa'] + ( 2 * $pl['bb'])) * sqrt(((3*$pl['aa']) * ($pl['aa'] + (2*$pl['bb']))))) / (27 * $essence['E'] * ($i * $essence['Ix'][$b][$d]) * $l_pl );
				$pl['essences'][$key][$i]['Δl4']['Cas 3'] = ( 1 / ( 1 - (($pl['essences'][$key][$i]['Pl']['Cas 3']/1000)/$pl['essences'][$key][$i]['Pe'])));
				$pl['essences'][$key][$i]['Δl']['Cas 3'] = ($pl['essences'][$key][$i]['Δtl']['Cas 3'] + $pl['essences'][$key][$i]['Δt2']['Cas 3'] + $pl['essences'][$key][$i]['Δt3']['Cas 3']) * $pl['essences'][$key][$i]['Δt4']['Cas 3'];
				
						
				
				//Verifier si valide
				if($pl['essences'][$key]['nb_min'] == -1){
					//Prendre les bonnes valeur selon revetement
					if($post->revetement == 'non'){
						$pr_temp1 = min($pl['essences'][$key][$i]['axe_fort']['Pr']['Cas 1'], $pl['essences'][$key][$i]['axe_faible']['Pr']['Cas 1']);
						$pr_temp2 = min($pl['essences'][$key][$i]['axe_fort']['Pr']['Cas 2'], $pl['essences'][$key][$i]['axe_faible']['Pr']['Cas 2']);
						$pr_temp3 = min($pl['essences'][$key][$i]['axe_fort']['Pr']['Cas 3'], $pl['essences'][$key][$i]['axe_faible']['Pr']['Cas 3']);
						$cc_temp = max($pl['essences'][$key][$i]['axe_fort']['Cc'],$pl['essences'][$key][$i]['axe_faible']['Cc']);
					}
					else{
						$pr_temp1 = $pl['essences'][$key][$i]['axe_fort']['Pr']['Cas 1'];
						$pr_temp2 = $pl['essences'][$key][$i]['axe_fort']['Pr']['Cas 2'];
						$pr_temp3 = $pl['essences'][$key][$i]['axe_fort']['Pr']['Cas 3'];
						$cc_temp = $pl['essences'][$key][$i]['axe_fort']['Cc'];
					}
					
					//Ratio ? ou p-e Interaction
					// (Pf/Pr)^2 + (Mf/Mr)(1/(1-(Pf/Pe)))
					$pl['essences'][$key][$i]['ratio']['Cas 1'] = pow(($pl['Pf']['Cas 1']/$pr_temp1),2) + (($pl['Pf']['Cas 1']/$pl['essences'][$key][$i]['axe_fort']['Mr']['Cas 1']) * (1/(1-($pl['Pf']['Cas 1']/$pl['essences'][$key][$i]['Pe']))));
					$pl['essences'][$key][$i]['ratio']['Cas 2'] = pow(($pl['Pf']['Cas 2']/$pr_temp2),2) + (($pl['Pf']['Cas 2']/$pl['essences'][$key][$i]['axe_fort']['Mr']['Cas 2']) * (1/(1-($pl['Pf']['Cas 2']/$pl['essences'][$key][$i]['Pe']))));
					$pl['essences'][$key][$i]['ratio']['Cas 3'] = pow(($pl['Pf']['Cas 3']/$pr_temp3),2) + (($pl['Pf']['Cas 3']/$pl['essences'][$key][$i]['axe_fort']['Mr']['Cas 3']) * (1/(1-($pl['Pf']['Cas 3']/$pl['essences'][$key][$i]['Pe']))));
					
					//Valide
					$ok = true;
					
					//Verifier CC <= 50
					if($cc_temp > 50){ $ok = false; }
					//Verifier Ratios? Interaction? <= 1
					if( $ok && $pl['essences'][$key][$i]['ratio']['Cas 1'] > 1 ){ $ok = false; }
					if( $ok && $pl['essences'][$key][$i]['ratio']['Cas 2'] > 1 ){ $ok = false; }
					if( $ok && $pl['essences'][$key][$i]['ratio']['Cas 3'] > 1 ){ $ok = false; }
					//Vr >= Vf (cas 2 & cas 3)
					if( $ok && $pl['essences'][$key][$i]['Vr'] < $pl['Vf']['Cas 2'] ){ $ok = false; }
					if( $ok && $pl['essences'][$key][$i]['Vr'] < $pl['Vf']['Cas 3'] ){ $ok = false; }
					//Verifier Δt(limite) >= Δt
					if( $ok && $post->fleche_charge_totale < $pl['essences'][$key][$i]['Δt']['Cas 1'] ){ $ok = false; }
					if( $ok && $post->fleche_charge_totale < $pl['essences'][$key][$i]['Δt']['Cas 2'] ){ $ok = false; }
					if( $ok && $post->fleche_charge_totale < $pl['essences'][$key][$i]['Δt']['Cas 3'] ){ $ok = false; }
					//Verifier Δl(limite) >= Δl
					if( $ok && $post->fleche_surcharge < $pl['essences'][$key][$i]['Δl']['Cas 1'] ){ $ok = false; }
					if( $ok && $post->fleche_surcharge < $pl['essences'][$key][$i]['Δl']['Cas 2'] ){ $ok = false; }
					if( $ok && $post->fleche_surcharge < $pl['essences'][$key][$i]['Δl']['Cas 3'] ){ $ok = false; }
					
					//Si encore valide
					if($ok){ $pl['essences'][$key]['nb_min'] = $i; }
				}			
			}
		}
	}
?>