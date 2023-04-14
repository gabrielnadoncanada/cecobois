<?php
	//D-M & P-S
	$b 		= array(140,191,241,292,343,394);
	$b_imp	= array('5 &frac12;','7 &frac12;','9 &frac12;','11 &frac12;','13 &frac12;','15 &frac12;');
	
	$d = array(
			/*140*/
			array(140,191,241,292,343,394),
			/*191*/
			array(191,241,292,343,394),
			/*241*/
			array(241,292,343,394),
			/*292*/
			array(292,343,394),
			/*343*/
			array(343,394),
			/*394*/
			array(394)
	);
	
	$d_imp = array(
			/*140*/
			array('5 &frac12;','7 &frac12;','9 &frac12;','11 &frac12;','13 &frac12;','15 &frac12;'),
			/*191*/
			array('7 &frac12;','9 &frac12;','11 &frac12;','13 &frac12;','15 &frac12;'),
			/*241*/
			array('9 &frac12;','11 &frac12;','13 &frac12;','15 &frac12;'),
			/*292*/
			array('11 &frac12;','13 &frac12;','15 &frac12;'),
			/*343*/
			array('13 &frac12;','15 &frac12;'),
			/*394*/
			array('15 &frac12;')
	);
	
	//E-P-S & Nordique
	$b2 		= array(140,191,241);
	$b2_imp		= array('5 &frac12;','7 &frac12;','9 &frac12;');
	
	$d2 = array(
			/*140*/
			array(140,191,241),
			/*191*/
			array(191,241),
			/*241*/
			array(241),
	);
	
	$d2_imp = array(
			/*140*/
			array('5 &frac12;','7 &frac12;','9 &frac12;'),
			/*191*/
			array('7 &frac12;','9 &frac12;'),
			/*241*/
			array('9 &frac12;'),
	);
	
	$kzb = array(
			/*140*/
			array(1.3,1.3,1.2,1.1,1.0,0.9),
			/*191*/
			array(1.3,1.2,1.1,1.0,0.9),
			/*241*/
			array(1.2,1.1,1.0,0.9),
			/*292*/
			array(1.1,1.0,0.9),
			/*343*/
			array(1.0,0.9),
			/*394*/
			array(0.9)
	);
	
	$constantes = array(
		'D-M' => array(
			'ss' => array(
				'Fb' => 19.5,
				'Fv' => 1.5,
				'E' => 12000,
				'Fb2' => 18.3,
				'E2' => 12000
			),
			'n1' => array(
				'Fb' => 15.8,
				'Fv' => 1.5,
				'E' => 12000,
				'Fb2' => 13.8,
				'E2' => 10500
			),
			'n2' => array(
				'Fb' => 9,
				'Fv' => 1.5,
				'E' => 9500,
				'Fb2' => 6,
				'E2' => 9500
			)
		),
		'P-S' => array(
			'ss' => array(
				'Fb' => 14.5,
				'Fv' => 1.2,
				'E' => 10000,
				'Fb2' => 13.6,
				'E2' => 10000
			),
			'n1' => array(
				'Fb' => 11.7,
				'Fv' => 1.2,
				'E' => 10000,
				'Fb2' => 10.2,
				'E2' => 9000
			),
			'n2' => array(
				'Fb' => 6.7,
				'Fv' => 1.2,
				'E' => 8000,
				'Fb2' => 4.5,
				'E2' => 8000
			)
		),
		'E-P-S' => array(
			'ss' => array(
				'Fb' => 13.6,
				'Fv' => 1.2,
				'E' => 8500,
				'Fb2' => 12.7,
				'E2' => 8500
			),
			'n1' => array(
				'Fb' => 11,
				'Fv' => 1.2,
				'E' => 8500,
				'Fb2' => 9.6,
				'E2' => 7500
			),
			'n2' => array(
				'Fb' => 6.3,
				'Fv' => 1.2,
				'E' => 6500,
				'Fb2' => 4.2,
				'E2' => 6500
			)
		),
		'Nordique' => array(
			'ss' => array(
				'Fb' => 12.8,
				'Fv' => 1,
				'E' => 8000,
				'Fb2' => 12,
				'E2' => 8000
			),
			'n1' => array(
				'Fb' => 10.8,
				'Fv' => 1,
				'E' => 8000,
				'Fb2' => 9,
				'E2' => 7000
			),
			'n2' => array(
				'Fb' => 5.9,
				'Fv' => 1,
				'E' => 6000,
				'Fb2' => 3.9,
				'E2' => 6000
			)
		)
	);
	
	
	//D-M & P-S
	for($a=0; $a<count($b); $a++){
		for($i=0; $i<count($d[$a]); $i++){
			if($post->systeme=="imp"){
				$d_nom[$a][$i]	= $b_imp[$a].'" x '.$d_imp[$a][$i].' "';
			}else{
				$d_nom[$a][$i]	= $b[$a]."x".$d[$a][$i];
			}
		}
	}
	
	//E-P-S & Nordique
	for($a=0; $a<count($b2); $a++){
		for($i=0; $i<count($d2[$a]); $i++){
			if($post->systeme=="imp"){
				$d2_nom[$a][$i]	= $b2_imp[$a].'" x '.$d2_imp[$a][$i].' "';
			}else{
				$d2_nom[$a][$i]	= $b2[$a]."x".$d2[$a][$i];
			}
		}
	}
	
	$max_A = 1;
	$max_Sx= 1;
	$max_EI= 1;
	
	$classes = array(0 => 'ss', 1 => 'n1', 2 => 'n2');		
	
	$tab_classe_proprietes = array();
	
	for($i=0;$i<3;$i++){
		$classe = $classes[$i];
		
		$tab_classe_proprietes[$i]	= array(
				/*"D-M"=> */array(
					"nom"	=> "D-M",
					"Fv"	=> $constantes['D-M'][$classe]['Fv'],
					"d"		=> $d,
					"d_nom"	=> $d_nom,
					"Kzb"	=> $kzb,
					"Kzv"   => $kzb
				),
				/*"P-S"=> */array(
					"nom"	=> "P-S",
					"Fv"	=> $constantes['P-S'][$classe]['Fv'],
					"d"		=> $d,
					"d_nom"	=> $d_nom,
					"Kzb"	=> $kzb,
					"Kzv"   => $kzb
				),
				/*"E-P-S"=> */array(
					"nom"	=> "E-P-S",
					"Fv"	=> $constantes['E-P-S'][$classe]['Fv'],
					"d"		=> $d2,
					"d_nom"	=> $d2_nom,
					"Kzb"	=> $kzb,
					"Kzv"   => $kzb
				),
				/*"Nordique"=> */array(
					"nom"	=> "Nordique",
					"Fv"	=> $constantes['Nordique'][$classe]['Fv'],
					"d"		=> $d2,
					"d_nom"	=> $d2_nom,
					"Kzb"	=> $kzb,
					"Kzv"   => $kzb
				)
		);
		
		for($cpt_classe=0; $cpt_classe<count($tab_classe_proprietes[$i]); $cpt_classe++){
			if($cpt_classe < 2){ $count_d = count($d); }
			else{ $count_d = count($d2); }
			for($cpt_b=0; $cpt_b<$count_d; $cpt_b++){
				for($cpt_d=0; $cpt_d<count($tab_classe_proprietes[$i][$cpt_classe]['d'][$cpt_b]); $cpt_d++){
					//D-M & P-S
					if($cpt_classe < 2){
						if($cpt_d == 0 || $cpt_d == 1){
							$tab_classe_proprietes[$i][$cpt_classe]['Fb'][$cpt_b][$cpt_d]	= $constantes[$tab_classe_proprietes[$i][$cpt_classe]['nom']][$classe]['Fb2'];
							$tab_classe_proprietes[$i][$cpt_classe]['E'][$cpt_b][$cpt_d]		= $constantes[$tab_classe_proprietes[$i][$cpt_classe]['nom']][$classe]['E2'];
						}
						else{
							$tab_classe_proprietes[$i][$cpt_classe]['Fb'][$cpt_b][$cpt_d]	= $constantes[$tab_classe_proprietes[$i][$cpt_classe]['nom']][$classe]['Fb'];
							$tab_classe_proprietes[$i][$cpt_classe]['E'][$cpt_b][$cpt_d]		= $constantes[$tab_classe_proprietes[$i][$cpt_classe]['nom']][$classe]['E'];
						}
					}
					//E-P-S & Nordique
					else{
						if($cpt_b != 0 || $cpt_d != 2){
							$tab_classe_proprietes[$i][$cpt_classe]['Fb'][$cpt_b][$cpt_d]	= $constantes[$tab_classe_proprietes[$i][$cpt_classe]['nom']][$classe]['Fb2'];
							$tab_classe_proprietes[$i][$cpt_classe]['E'][$cpt_b][$cpt_d]		= $constantes[$tab_classe_proprietes[$i][$cpt_classe]['nom']][$classe]['E2'];
						}
						else{
							$tab_classe_proprietes[$i][$cpt_classe]['Fb'][$cpt_b][$cpt_d]	= $constantes[$tab_classe_proprietes[$i][$cpt_classe]['nom']][$classe]['Fb'];
							$tab_classe_proprietes[$i][$cpt_classe]['E'][$cpt_b][$cpt_d]		= $constantes[$tab_classe_proprietes[$i][$cpt_classe]['nom']][$classe]['E'];
						}
					}
													
					$tab_classe_proprietes[$i][$cpt_classe]['A'][$cpt_b][$cpt_d]		= $b[$cpt_b] * $d[$cpt_b][$cpt_d];
					$tab_classe_proprietes[$i][$cpt_classe]['Sx'][$cpt_b][$cpt_d]	= ($b[$cpt_b] * pow($d[$cpt_b][$cpt_d],2))/6;
					$tab_classe_proprietes[$i][$cpt_classe]['Ix'][$cpt_b][$cpt_d]	= ($b[$cpt_b] * pow($d[$cpt_b][$cpt_d],3))/12;
					$tab_classe_proprietes[$i][$cpt_classe]['EI'][$cpt_b][$cpt_d]	= $tab_classe_proprietes[$i][$cpt_classe]['E'][$cpt_b][$cpt_d] * $tab_classe_proprietes[$i][$cpt_classe]['Ix'][$cpt_b][$cpt_d];
	
				}
			}	
		}
	}
?>