<?PHP
	$debug_sortie = '';
	
	$debug_sortie .= '<div id="debug">';

	$debug_sortie .= '<table border="1">';
	$debug_sortie .= '<tr><td colspan="'.(count($classe_valeurs)*2).'" class="titre">Classe</td></tr>';
	for($a=0; $a<count($classe_valeurs); $a++){
		$debug_sortie .= '<tr><td>'.$classe_valeurs[$a].'</td><td>'.$classe->$classe_valeurs[$a].'</td></tr>';
	}
	$debug_sortie .= '</table>';
	//-------------------------------------------------------------------------------------------
	
	$debug_sortie .= '<table border="1">';
	$debug_sortie .= '<tr><td colspan="'.(count($colombages_valeurs)*2).'" class="titre">Colombages</td></tr>';
	for($a=0; $a<count($colombages_valeurs); $a++){
		$debug_sortie .= '<tr><td>'.$colombages_valeurs[$a].'</td><td>'.$colombages->$colombages_valeurs[$a].'</td></tr>';
	}
	$debug_sortie .= '</table>';
	//-------------------------------------------------------------------------------------------
	
	$debug_sortie .= '<table border="1">';
	$debug_sortie .= '<tr><td colspan="'.(count($cat_risque_valeurs)*2).'" class="titre">Categorie de risque</td></tr>';
	for($a=0; $a<count($cat_risque_valeurs); $a++){
		$debug_sortie .= '<tr><td>'.$cat_risque_valeurs[$a].'</td><td>'.$cat_risque->$cat_risque_valeurs[$a].'</td></tr>';
	}
	$debug_sortie .= '</table>';
	//-------------------------------------------------------------------------------------------
	
	/*
	$debug_sortie .= '<table border="1">';
	$debug_sortie .= '<tr><td colspan="'.(count($traitement_valeurs)*2).'" class="titre">Traitement</td></tr>';
	for($a=0; $a<count($traitement_valeurs); $a++){
		$debug_sortie .= '<tr><td>'.$traitement_valeurs[$a].'</td><td>'.$traitement->$traitement_valeurs[$a].'</td></tr>';
	}
	$debug_sortie .= '</table>';
	//-------------------------------------------------------------------------------------------
	*/
	
	$debug_sortie .= '<table border="1">';
	$debug_sortie .= '<tr><td colspan="'.(count($utilisation_valeurs)*2).'" class="titre">Utilisation</td></tr>';
	for($a=0; $a<count($utilisation_valeurs); $a++){
		$debug_sortie .= '<tr><td>'.$utilisation_valeurs[$a].'</td><td>'.$utilisation->$utilisation_valeurs[$a].'</td></tr>';
	}
	$debug_sortie .= '</table>';
	//-------------------------------------------------------------------------------------------
	
	$debug_sortie .= '<table border="1">';
	$debug_sortie .= '<tr><td colspan="'.(count($resistance_montant_valeurs)*2).'" class="titre">Résistance des montants</td></tr>';
	for($a=0; $a<count($resistance_montant_valeurs); $a++){
		//if(!($resistance_montant_valeurs[$a] == "Mr" || $resistance_montant_valeurs[$a] == "Pr"))
			$debug_sortie .= '<tr><td>'.$resistance_montant_valeurs[$a].'</td><td>'.$resistance_montant->$resistance_montant_valeurs[$a].'</td></tr>';	
	}
	$debug_sortie .= '</table>';
	//-------------------------------------------------------------------------------------------
	
	
	$debug_sortie .= '<div class="clr"></div>';
	
	$debug_sortie .= '<table border="1">';
	$debug_sortie .= '<tr>';
		$debug_sortie .= '<td class="titre" colspan="2">&nbsp;</td>';
		$debug_sortie .= '<td class="titre" colspan="5">Charges non ponder&eacute;es</td>';
		$debug_sortie .= '<td class="titre">&nbsp;</td>';
		$debug_sortie .= '<td class="titre" colspan="7">Charges ponder&eacute;es</td>';
	$debug_sortie .= '</tr>';
	$debug_sortie .= '<tr>';
		$debug_sortie .= '<td>&nbsp;</td>';
		$debug_sortie .= '<td class="titre">&Eacute;tats limites utlimes</td>';
		$debug_sortie .= '<td class="titre">Daxial</td>';
		$debug_sortie .= '<td class="titre">Laxial</td>';
		$debug_sortie .= '<td class="titre">Saxial</td>';
		$debug_sortie .= '<td class="titre">D/Ps</td>';
		$debug_sortie .= '<td class="titre">Wlateral</td>';
		$debug_sortie .= '<td class="titre">KD</td>';
		$debug_sortie .= '<td class="titre">Daxial</td>';
		$debug_sortie .= '<td class="titre">Laxial</td>';
		$debug_sortie .= '<td class="titre">Saxial</td>';
		$debug_sortie .= '<td class="titre">Wlateral</td>';
		$debug_sortie .= '<td class="titre">Kc</td>';
		$debug_sortie .= '<td class="titre">Pr</td>';
		$debug_sortie .= '<td class="titre">Mr</td>';
	$debug_sortie .= '</tr>';
	
	$tab_etat_ultime = array('1,4D','1,25D + 1,5L','1,25D + 1,5S','1,25D + 1,4W','1,25D + 1,5L + 0,5S','1,25D + 1,5L + 1,4W','1,25D + 1,5S + 0,5L','1,25D + 1,5S + 0,4W','1,25D + 1,4W + 0,5L','1,25D + 1,4W + 0,5S','0,9D + 1,5L','0,9D + 1,5S','0,9D + 1,4W','0,9D + 1,5L + 0,5S','0,9D + 0,4W','0,9D + 1,5S + 0,5L','0,9D + 1,5S + 0,4W','0,9D + 1,4W + 0,5L','0,9D + 1,4W + 0,5S');
	
	for($a=0;$a<19;$a++){
		$debug_sortie .= '<tr>';
			$debug_sortie .= '<td>'.($a+1).'</td>';
			$debug_sortie .= '<td>'.$tab_etat_ultime[$a].'</td>';
			$debug_sortie .= '<td>Non calcule</td>';
			$debug_sortie .= '<td>Non calcule</td>';
			$debug_sortie .= '<td>Non calcule</td>';
			$debug_sortie .= '<td>'.$tab_DPs[$a].'</td>';
			$debug_sortie .= '<td>'.$tab_wlateral[$a].'</td>';
			$debug_sortie .= '<td>'.$tab_kd[$a].'</td>';
			$debug_sortie .= '<td>'.$tab_Daxial_pondere[$a].'</td>';
			$debug_sortie .= '<td>'.$tab_Laxial_pondere[$a].'</td>';
			$debug_sortie .= '<td>'.$tab_Saxial_pondere[$a].'</td>';
			$debug_sortie .= '<td>'.$tab_Wlateral_pondere[$a].'</td>';
			$debug_sortie .= '<td>'.$tab_kc[$a]	.'</td>';
			$debug_sortie .= '<td>'.$tab_pr	[$a].'</td>';
			$debug_sortie .= '<td>'.$tab_mr	[$a].'</td>';
			
		$debug_sortie .= '</tr>';
	}
	$debug_sortie .= '</table>';
	
	$debug_sortie .= '<div class="clr"></div>';
	//-------------------------------------------------------------------------------------------

	$debug_sortie .= '<table border="1">';
	$debug_sortie .= '<tr>';
		$debug_sortie .= '<td class="titre">&nbsp;</td>';
		$debug_sortie .= '<td class="titre">Pf(kN)</td>';
		$debug_sortie .= '<td class="titre" colspan="7">Mf (kN-m)</td>';
		$debug_sortie .= '<td class="titre">Vf(kN)</td>';
		$debug_sortie .= '<td class="titre">Pf/Pr + Mf/Mr</td>';
		$debug_sortie .= '<td class="titre">Pf/Pr + (Mf/Mr)\'</td>';
	$debug_sortie .= '</tr>';
	$debug_sortie .= '<tr>';
		$debug_sortie .= '<td>&nbsp;</td>';
		$debug_sortie .= '<td class="titre">&sum; Axial</td>';
		$debug_sortie .= '<td class="titre">1 / (1 - Pf / PE)</td>';
		$debug_sortie .= '<td class="titre">Pf - D</td>';
		$debug_sortie .= '<td class="titre">(Pf - &Delta;) \'</td>';
		$debug_sortie .= '<td class="titre">Mw</td>';
		$debug_sortie .= '<td class="titre">(Mw) \'</td>';
		$debug_sortie .= '<td class="titre">&sum; Moment</td>';
		$debug_sortie .= '<td class="titre">&sum; Moment \'</td>';
		$debug_sortie .= '<td class="titre">Vw</td>';
		$debug_sortie .= '<td class="titre">&nbsp;</td>';
		$debug_sortie .= '<td class="titre">&nbsp;</td>';
	$debug_sortie .= '</tr>';
	
	for($a=0;$a<19;$a++){
		$debug_sortie .= '<tr>';
			$debug_sortie .= '<td>'.($a+1).'</td>';
			$debug_sortie .= '<td>'.$tab_pf[$a].'</td>';
			$debug_sortie .= '<td>'.$un_sur_un_moins_pf_sur_pe[$a].'</td>';
			$debug_sortie .= '<td>Non calcule</td>';
			$debug_sortie .= '<td>Non calcule</td>';
			$debug_sortie .= '<td>'.$tab_Mw[$a].'</td>';
			$debug_sortie .= '<td>Non calcule</td>';
			$debug_sortie .= '<td>'.$tab_somme_moment[$a].'</td>';
			$debug_sortie .= '<td>'.$tab_somme_moment_prime[$a].'</td>';
			$debug_sortie .= '<td>Non calcule</td>';
			$debug_sortie .= '<td>Non calcule</td>';
			$debug_sortie .= '<td>'.$tab_Pf_Pr_Mf_Mr_prime[$a].'</td>';
		$debug_sortie .= '</tr>';
	}
	$debug_sortie .= '<div class="clr"></div>';
	
	//-------------------------------------------------------------------------------------------

	$debug_sortie .= '<table border="1">';
	$debug_sortie .= '<tr>';
		$debug_sortie .= '<td class="titre">&nbsp;</td>';
		$debug_sortie .= '<td class="titre" colspan="4">Charges ponderees (Fleche totale)</td>';
	$debug_sortie .= '</tr>';
	$debug_sortie .= '<tr>';
		$debug_sortie .= '<td class="titre">&nbsp;</td>';
		$debug_sortie .= '<td class="titre">Daxial</td>';
		$debug_sortie .= '<td class="titre">Laxial</td>';
		$debug_sortie .= '<td class="titre">Saxial</td>';
		$debug_sortie .= '<td class="titre">Wlateral</td>';
	$debug_sortie .= '</tr>';
	
	for($a=0;$a<10;$a++){
		$debug_sortie .= '<tr>';
			$debug_sortie .= '<td>'.($a+1).'</td>';
			$debug_sortie .= '<td>'.$tab_fleche_Daxial_pondere[$a].'</td>';
			$debug_sortie .= '<td>'.$tab_fleche_Laxial_pondere[$a].'</td>';
			$debug_sortie .= '<td>'.$tab_fleche_Saxial_pondere[$a].'</td>';
			$debug_sortie .= '<td>'.$tab_fleche_Wlateral_pondere[$a].'</td>';
		$debug_sortie .= '</tr>';
	}
	
	$debug_sortie .= '<div class="clr"></div>';
	//-------------------------------------------------------------------------------------------
	
	$debug_sortie .= '<table border="1">';
	$debug_sortie .= '<tr>';
		$debug_sortie .= '<td class="titre">&nbsp;</td>';
		$debug_sortie .= '<td class="titre" colspan="7">Fleche sous charge vive</td>';
		$debug_sortie .= '<td class="titre" colspan="7">Fleche sous charge totale</td>';
	$debug_sortie .= '</tr>';
	$debug_sortie .= '<tr>';
		$debug_sortie .= '<td class="titre">&nbsp;</td>';
		$debug_sortie .= '<td class="titre">Pf(kN)</td>';
		$debug_sortie .= '<td class="titre">Wf (kN/m)</td>';
		$debug_sortie .= '<td class="titre">Amplification</td>';
		$debug_sortie .= '<td class="titre">&Delta;axial (mm)</td>';
		$debug_sortie .= '<td class="titre">&Delta;lateral (mm)</td>';
		$debug_sortie .= '<td class="titre">&sum; &Delta;lat + &Delta;axial</td>';
		$debug_sortie .= '<td class="titre">&sum; (&Delta;lat + &Delta;axial)\'</td>';
		$debug_sortie .= '<td class="titre">Pf(kN)</td>';
		$debug_sortie .= '<td class="titre">Wf (kN/m)</td>';
		$debug_sortie .= '<td class="titre">Amplification</td>';
		$debug_sortie .= '<td class="titre">&Delta;axial (mm)</td>';
		$debug_sortie .= '<td class="titre">&Delta;lateral (mm)</td>';
		$debug_sortie .= '<td class="titre">&sum; &Delta;lat + &Delta;axial</td>';
		$debug_sortie .= '<td class="titre">&sum; (&Delta;lat + &Delta;axial)\'</td>';
	$debug_sortie .= '</tr>';
	$debug_sortie .= '<tr>';
		$debug_sortie .= '<td class="titre">&nbsp;</td>';
		$debug_sortie .= '<td class="titre">&Delta; axial</td>';
		$debug_sortie .= '<td class="titre">&Delta; lateral</td>';
		$debug_sortie .= '<td class="titre">1/(1-Pf/PE)</td>';
		$debug_sortie .= '<td class="titre">P<sub>s</sub>eL<sup>2</sup>/16EI</td>';
		$debug_sortie .= '<td class="titre">5wL<sup>4</sup>/384EI</td>';
		$debug_sortie .= '<td class="titre">(mm)</td>';
		$debug_sortie .= '<td class="titre">&nbsp;</td>';
		$debug_sortie .= '<td class="titre">&Delta; axial</td>';
		$debug_sortie .= '<td class="titre">&Delta; lateral</td>';
		$debug_sortie .= '<td class="titre">1/(1-Pf/PE)</td>';
		$debug_sortie .= '<td class="titre">P<sub>s</sub>eL<sup>2</sup>/16EI</td>';
		$debug_sortie .= '<td class="titre">5wL<sup>4</sup>/384EI</td>';
		$debug_sortie .= '<td class="titre">(mm)</td>';
		$debug_sortie .= '<td class="titre">&nbsp;</td>';
	$debug_sortie .= '</tr>';

	
	for($a=0;$a<10;$a++){
		$debug_sortie .= '<tr>';
			$debug_sortie .= '<td>'.($a+1).'</td>';
			$debug_sortie .= '<td>'.$tab_fleche_pf[$a].'</td>';
			$debug_sortie .= '<td>'.$tab_fleche_Wlateral_pondere[$a].'</td>';
			$debug_sortie .= '<td>'.$tab_fleche_amplification[$a].'</td>';
			$debug_sortie .= '<td>Non calcule</td>';
			$debug_sortie .= '<td>Non calcule</td>';
			$debug_sortie .= '<td>Non calcule</td>';
			$debug_sortie .= '<td>'.$tab_fleche_somme_moment[$a].'</td>';
			
			$debug_sortie .= '<td>'.$tab_fleche_tot_pf[$a].'</td>';
			$debug_sortie .= '<td>'.$tab_fleche_Wlateral_pondere[$a].'</td>';
			$debug_sortie .= '<td>'.$tab_fleche_tot_amplification[$a].'</td>';
			$debug_sortie .= '<td>Non calcule</td>';
			$debug_sortie .= '<td>Non calcule</td>';
			$debug_sortie .= '<td>Non calcule</td>';
			$debug_sortie .= '<td>'.$tab_fleche_tot_somme_moment[$a].'</td>';
		$debug_sortie .= '</tr>';
	}
	$debug_sortie .= '<div class="clr"></div>';
	
	$debug_sortie .= '</div>';
	

	
	echo $debug_sortie;
		
?>