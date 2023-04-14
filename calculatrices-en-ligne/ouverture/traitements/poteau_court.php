<?PHP
	/********** Poteau Court **********/
	$b = 38;
	$d = $post->colombages;
	$pc = array( 'essences' => array());
	
	/***** ELU *****/
	$pc['Pf'] = $comb_max * ($l_l/1000) / 2;
	
	/***** ELS *****/
	foreach($tab_classe_propriete['bois_sciage'] as $key=>$essence){
		if(in_array($d,$essence['d'][0])){
			$pc['essences'][$key] = array( 'nb_min' => -1 );
			//5 plis max
			for($i=1;$i<=5;$i++){
				$pc['essences'][$key][$i] = array();
				//Axe Fort
				// Kzc = 6.3(d*Lpc)^-.013 <= 1.3
				// Cc = Lpx/d
				// Kc = ( 1 + ( ( Fc*Kzc*CC^3 ) / ( 35*E05 ) ) )^-1
				// Pr = ( 0.8 *Fc * A * Kc * Kzc * Kd ) / 1000
				$pc['essences'][$key][$i]['axe_fort'] = array();
				$pc['essences'][$key][$i]['axe_fort']['Kzc'] = 6.3 * pow(($d*$l_pc),-0.13);
				if($pc['essences'][$key][$i]['axe_fort']['Kzc'] > 1.3){ $pc['essences'][$key][$i]['axe_fort']['Kzc'] = 1.3; }
				$pc['essences'][$key][$i]['axe_fort']['Cc'] = $l_pc/$d;
				$pc['essences'][$key][$i]['axe_fort']['Kc'] = pow( ( 1 + ( ( $essence['Fc'] * $pc['essences'][$key][$i]['axe_fort']['Kzc'] * pow($pc['essences'][$key][$i]['axe_fort']['Cc'],3) ) / ( 35 * $essence['E05'] ) ) ) , -1 );
				$pc['essences'][$key][$i]['axe_fort']['Pr'] = (0.8 * $essence['Fc'] * ($i * $essence['A'][$b][$d]) * $pc['essences'][$key][$i]['axe_fort']['Kc'] * $pc['essences'][$key][$i]['axe_fort']['Kzc'] * $Kd ) / 1000;
				
				//Axe Faible
				// Kzc = 6.3(b*Lpc)^-.013 <= 1.3
				// Cc = Lpx/b
				// Kc = ( 1 + ( ( Fc*Kzc*CC^3 ) / ( 35*E05 ) ) )^-1
				// Pr = ( 1 * 0.8 *Fc * A * Kc * Kzc * Kd ) / 1000		=>	1 pli
				// Pr = ( 0.6 * 0.8 *Fc * A * Kc * Kzc * Kd ) / 1000	=>	2 pli et plus
				$pc['essences'][$key][$i]['axe_faible'] = array();
				$pc['essences'][$key][$i]['axe_faible']['Kzc'] = 6.3 * pow((($b*$i)*$l_pc),-0.13);
				if($pc['essences'][$key][$i]['axe_faible']['Kzc'] > 1.3){ $pc['essences'][$key][$i]['axe_faible']['Kzc'] = 1.3; }
				$pc['essences'][$key][$i]['axe_faible']['Cc'] = $l_pc/($b*$i);
				$pc['essences'][$key][$i]['axe_faible']['Kc'] = pow( ( 1 + ( ( $essence['Fc'] * $pc['essences'][$key][$i]['axe_faible']['Kzc'] * pow($pc['essences'][$key][$i]['axe_faible']['Cc'],3) ) / ( 35 * $essence['E05'] ) ) ) , -1 );
				$pc['essences'][$key][$i]['axe_faible']['Pr'] = (($i!=1?0.6:1) * 0.8 * $essence['Fc'] * ($i * $essence['A'][$b][$d]) * $pc['essences'][$key][$i]['axe_faible']['Kc'] * $pc['essences'][$key][$i]['axe_faible']['Kzc'] * $Kd ) / 1000;
				
				
				//Verifier Pr >= Pf  && Cc <= 50
				if($pc['essences'][$key]['nb_min'] == -1){
					//Axe fort & Axe faible
					if($post->revetement == 'non'){
						if( $pc['essences'][$key][$i]['axe_fort']['Pr'] >= $pc['Pf'] && $pc['essences'][$key][$i]['axe_faible']['Pr'] >= $pc['Pf'] ){
							if( $pc['essences'][$key][$i]['axe_fort']['Cc'] <= 50 && $pc['essences'][$key][$i]['axe_faible']['Cc'] <= 50 ){
								$pc['essences'][$key]['nb_min'] = $i;
							}
						}
					}
					//Axe fort seulement
					else{
						if( $pc['essences'][$key][$i]['axe_fort']['Pr'] >= $pc['Pf']){
							if( $pc['essences'][$key][$i]['axe_fort']['Cc'] <= 50){
								$pc['essences'][$key]['nb_min'] = $i;
							}
						}
					}
				}			
			}
		}
	}
?>