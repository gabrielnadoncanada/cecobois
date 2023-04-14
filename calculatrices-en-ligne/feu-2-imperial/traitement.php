<?PHP

	// VARIABLES DE SORTIES
	//---------------------

		$html_champs_sortie=array(
			'res_feu_min'
		);

		//on associe les variables de $html_champs_sortie dans l'object output.
		for($a=0; $a<count($html_champs_sortie); $a++){
			$output->$html_champs_sortie[$a]='';
		}


	//VARIABLES FIXES
	//---------------
		//$html_type_constr_css = 'display:block;';
		if($post->type_constr == 'ossature'){

			$html_syst_struc1_css = 'display:block;';
			if($post->syst_struc1 == 'mur'){

				$html_porteur_css = 'display:block;';
				if($post->porteur == 'oui'){

					$html_espacement1_css = 'display:block;';
					if($post->espacement1 == '406'){
						$output->res_feu_min = 20;

					}else if($post->espacement1 == '610'){
						$output->res_feu_min = 15;

					}else/*if($post->espacement1 == '')*/{
						$error = true;
					}

					$html_paroi1_css = 'display:block;';
					if($post->paroi1 == '12.7'){
						$output->res_feu_min += 25;

					}else if($post->paroi1 == '15.9'){
						$output->res_feu_min += 40;

					}else /*if($post->paroi1 == '')*/{
						$error = true;
					}


					$html_isolant1_css = 'display:block;';
					if($post->isolant1 == 'roche' || $post->isolant1 == 'laitier'){
						$output->res_feu_min += 15;

					}

				}else if($post->porteur == 'non'){

					$html_espacement2_css = 'display:block;';
					if($post->espacement2 == '406'){
						$output->res_feu_min = 20;

					}else if($post->espacement2 == '610'){
						$output->res_feu_min = 15;

					}else/*if($post->espacement2 == '')*/{
						$error = true;
					}

					$html_paroi2_css = 'display:block;';
					if($post->paroi2 == '12.7' || $post->paroi2 == '15.9'){

						if($post->paroi2 == '12.7'){
							$output->res_feu_min += 25;

						}else if($post->paroi2 == '15.9'){
							$output->res_feu_min += 40;

						}else /*if($post->paroi2 == '')*/{
							$error = true;
						}

						$html_isolant2_css = 'display:block;';
						if($post->isolant2 == 'verres'){
							$output->res_feu_min += 5;
						}

					}else if($post->paroi2 == '11'){
						$output->res_feu_min += 10;

					}else if($post->paroi2 == '14'){
						$output->res_feu_min += 15;

					}

				}else/*if($post->porteur == '')*/{
					$error = true;
				}

			}else if($post->syst_struc1 == 'poutrelles'){

				$output->res_feu_min = 5;

				$html_paroi3_css = 'display:block;';
				if($post->paroi3 == '12.7'){
					$output->res_feu_min += 25;

				}else if($post->paroi3 == '15.9'){
					$output->res_feu_min += 40;

				}else if($post->paroi3 == '25.4'){
					$output->res_feu_min = 45;

				}else if($post->paroi3 == '31.8'){
					$output->res_feu_min = 60;

				}else if($post->paroi3 == '28'){
					$output->res_feu_min = 30;

				}else /*if($post->paroi3 == '')*/{
					$error = true;
				}

			}else if($post->syst_struc1 == 'solives'){

				$output->res_feu_min = 10;

				$html_paroi5_css = 'display:block;';
				if($post->paroi5 == '12.7'){
					$output->res_feu_min += 25;

				}else if($post->paroi5 == '15.9'){
					$output->res_feu_min += 40;

				}else if($post->paroi5 == '25.4'){
					$output->res_feu_min = 45;

				}else if($post->paroi5 == '31.8'){
					$output->res_feu_min = 60;

				}else if($post->paroi5 == '28'){
					$output->res_feu_min = 30;

				}else /*if($post->paroi5 == '')*/{
					$error = true;
				}

			}else if($post->syst_struc1 == 'fermes'){

				$output->res_feu_min = 5;

				$html_paroi4_css = 'display:block;';
				if($post->paroi4 == '12.7'){
					$output->res_feu_min += 25;

				}else if($post->paroi4 == '15.9'){
					$output->res_feu_min += 40;

				}else if($post->paroi4 == '25.4'){
					$output->res_feu_min = 45;

				}else if($post->paroi4 == '31.8'){
					$output->res_feu_min = 60;

				}else if($post->paroi4 == '28'){
					$output->res_feu_min = 30;

				}else /*if($post->paroi4 == '')*/{
					$error = true;
				}

			}else/*if($post->syst_struc1 == '')*/{
				$error = true;
			}

		}else if($post->type_constr == 'bois'){

			$html_syst_struc2_css = 'display:block;';
			if($post->syst_struc2 == 'mur'){

				$html_elements1_css = 'display:block;';
				if($post->elements1 == 'mvp'){

					$html_dimensions1_css = 'display:block;';
					if($post->dimensions1=='89'){
						$output->res_feu_min = 30;
					}else if($post->dimensions1=='114'){
						$output->res_feu_min = 45;
					}else if($post->dimensions1=='140'){
						$output->res_feu_min = 60;
					}else if($post->dimensions1=='184'){
						$output->res_feu_min = 90;
					}else /*if($post->dimensions1=='')*/{
						$error = true;
					}

					$html_paroi6_css = 'display:block;';
					if($post->paroi6 == '12.7'){
						$output->res_feu_min += 15;
					}

				}else if($post->elements1 == 'mhnp'){

					$html_dimensions2_css = 'display:block;';
					if($post->dimensions2=='89'){
						$output->res_feu_min = 60;
					}else if($post->dimensions2=='140'){
						$output->res_feu_min = 90;
					}else /*if($post->dimensions1=='')*/{
						$error = true;
					}

					$html_paroi7_css = 'display:block;';
					if($post->paroi7 == '12.7'){
						$output->res_feu_min += 15;
					}

				}else/* if($post->elements1 == '')*/{
					$error = true;
				}

			}else if($post->syst_struc2 == 'plancher'){

				$html_elements2_css = 'display:block;';
				if($post->elements2 == 'msc'){

					$html_dimensions3_css = 'display:block;';
					if($post->dimensions3=='89'){
						$output->res_feu_min = 30;
					}else if($post->dimensions3=='114'){
						$output->res_feu_min = 45;
					}else if($post->dimensions3=='165'){
						$output->res_feu_min = 60;
					}else if($post->dimensions3=='235'){
						$output->res_feu_min = 90;
					}else /*if($post->dimensions2=='')*/{
						$error = true;
					}

					$html_paroi8_css = 'display:block;';
					if($post->paroi8 == '12.7'){
						$output->res_feu_min += 15;
					}

				}else if($post->elements2 == 'prl'){

					$html_dimensions4_css = 'display:block;';
					if($post->dimensions4=='64'){
						$output->res_feu_min = 30;
					}else if($post->dimensions4=='76'){
						$output->res_feu_min = 45;
					}else /*if($post->dimensions1=='')*/{
						$error = true;
					}

					$html_paroi9_css = 'display:block;';
					if($post->paroi9 == '12.7'){
						$output->res_feu_min += 15;
					}

				}else/* if($post->elements1 == '')*/{
					$error = true;
				}

			}else /*if($post->syst_struc2 == '')*/{
				$error = true;
			}


		}else/*if($post->type_constr == '')*/{
			$error = true;
		}








//**********************************************************************

//**********************************************************************

	// VARIABLES A CALCULER
	//---------------------

	//si les donnes rentres sont bonnes
	//et QU'IL N'Y A PAS D'ERREUR
	//on peut continuer le traitement.
	if(!isset($error) && $post->action!=""){


		//CALCUL
		//------

		//on transforme l'heure

		function HMS($minutes){
			$heure	= 0;
			$out	= '';
			/*
			while($minutes >= "60"){
				$minutes = $minutes-60;
				$heure++;
			}
			if($heure){
				$out .= $heure." heure";
				if($heure>=2){
					$out.="s";
				}
				$out.=" ";
			}
			*/
			if($minutes){
				$out.=$minutes." minute";
				if($minutes>=1){
					$out.="s";
				}
			}

			return $out;
		}

		 $output->res_feu_min = HMS($output->res_feu_min);

	}else{
		$error = __d( 'cecobois', 'Veuillez remplir correctement tous les champs demandés. Merci.' );
	}

?>