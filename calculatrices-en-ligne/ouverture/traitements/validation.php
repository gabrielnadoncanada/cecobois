<?php
	/********** Valider tableau poteaux / lisses **********/
	$valide = false;
	foreach($tab_classe_propriete['bois_sciage'] as $key=>$essence){
		//Verifie si au moins une valeur est bonne
		if((isset($pl['essences'][$key]) || isset($pc['essences'][$key]) || isset($o['essences'][$key])) && ($pl['essences'][$key]['nb_min'] != -1 || $pc['essences'][$key]['nb_min'] != -1 || $o['essences'][$key]['nb_min'] != -1)){
			$valide = true;
			break;
		}
	}
	
	/********** Pour linteau valider colonnes et lignes **********/
	$colonnes = array();
	$lignes = array();
	$tous = false;
	
	//Sciage et SCL
	if($post->type == 'bois_sciage' || $post->type == "bois_composite"){	
		foreach($tab_classe_propriete[$post->type] as $key=>$essence){
			//Par defaut a false
			$lignes[$key] = false;
			foreach($all_d[$post->type][0] as $d ){
				//Par defaut a false
				if(!isset($colonnes[$d])){ $colonnes[$d] = false; }
				//Si != -1 mettre colonne et ligne a vrai
				if(isset($l['essences'][$key][$d]) && $l['essences'][$key][$d]['nb_min'] != -1){
					$lignes[$key] = true;
					$colonnes[$d] = true;
					$tous = true;
				}
			}
		}
	}
	//BLC
	else if($post->type == "lamelle_colle"){
		$count = 0;
		foreach($all_b['lamelle_colle'] as $b ){
			if($b < $post->colombages) { $count++; }
		}
			
		foreach($tab_classe_propriete['lamelle_colle'] as $key=>$essence){
			//Par defaut a false
			$lignes[$key] = false;
			for($i=0;$i<$count;$i++){
				//Par defaut a false
				if(!isset($colonnes[$all_b['lamelle_colle'][$i]])){ $colonnes[$all_b['lamelle_colle'][$i]] = false; }
				//Si != -1 mettre colonne et ligne a vrai
				if(isset($l['essences'][$key][$all_b['lamelle_colle'][$i]]) && $l['essences'][$key][$all_b['lamelle_colle'][$i]]['nb_min'] != -1){
					$lignes[$key] = true;
					$colonnes[$all_b['lamelle_colle'][$i]] = true;
					$tous = true;
				} 
			} 
		}
	}
?>