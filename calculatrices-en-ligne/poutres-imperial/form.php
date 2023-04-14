<div class="list-wide main-title top">
	<p>* <?php echo __d( 'cecobois', 'Tous les champs munis d\'un astérisque doivent être remplis.' ); ?><br /><?php echo __d( 'cecobois', 'Toutes les mesures, qu\'elles suivent le système métrique ou impérial, doivent être entrées en décimal.' ); ?></p>
</div>

<div class="left project-left calculator-container">
	<div class="form">
		<form name="calcul" method="post" id="calc">
			<fieldset class="item-container">
				<ul>
					<li>
						<label><?php echo __d( 'cecobois', 'Système' ); ?></label>

						<?php HtmlOutput::radio('systeme',$html_systeme,$html_systeme_value,$html_systeme_js);?>
					</li>

					<li>
						<label><?php echo __d( 'cecobois', 'Type de bois' ); ?></label>

						<?php HtmlOutput::select('type_bois',$html_type_bois,$html_type_bois_value,$html_type_bois_js);?>
					</li>

				</ul>

				<ul id="bois_sciage"<?php echo $html_classe_bois_sciage_style;?>>
					<li>
						<label><?php echo __d( 'cecobois', 'Classe' ); ?></label>

						<?php HtmlOutput::select('classe_bois_sciage',$html_classe_bois_sciage,$html_classe_bois_sciage_value,$html_classe_bois_sciage_js);?>
					</li>

					<li>
						<label><?php echo __d( 'cecobois', 'Dimensions' ); ?></label>

						<?php HtmlOutput::select('colonnes_bois_sciage',$html_colonnes_bois_sciage,$html_colonnes_bois_sciage_value,$html_colonnes_bois_sciage_js,$html_colonnes_bois_sciage_style);?>
					</li>

					<li>
						<label><?php echo __d( 'cecobois', '# de plis' ); ?></label>

						<?php HtmlOutput::select('plis_bois_sciage',$html_plis_bois_sciage,$html_plis_bois_sciage_value,$html_plis_bois_sciage_js);?>
					</li>
				</ul>

				<ul id="bois_scl"<?php echo $html_classe_bois_scl_style;?>>
					<li>
						<label><?php echo __d( 'cecobois', 'Classe' ); ?></label>

						<?php HtmlOutput::select('classe_bois_scl',$html_classe_bois_scl,$html_classe_bois_scl_value,$html_classe_bois_scl_js);?>
					</li>

					<li class="mesure">
						<label><?php echo __d( 'cecobois', 'Largeur' ); ?>&nbsp;(<span class="mesure_unite"><?php $unit = ($post->systeme == "met") ? __d( 'cecobois', 'mm' ) : __d( 'cecobois', 'pouces' ); echo $unit;?></span>)</label>
						<?php HtmlOutput::select('largeur_bois_scl',$html_largeur_bois_scl,$html_largeur_bois_scl_value,$html_largeur_bois_scl_js,'','largeur_bois_scl',' mesure_valeur');?>
					</li>

					<li class="mesure">
						<label><?php echo __d( 'cecobois', 'Profondeur' ); ?>&nbsp;(<span class="mesure_unite"><?php $unit = ($post->systeme == "met") ? __d( 'cecobois', 'mm' ) : __d( 'cecobois', 'pouces' ); echo $unit;?></span>)</label>
						<?php HtmlOutput::select('profondeur45_bois_scl',$html_profondeur45_bois_scl,$html_profondeur45_bois_scl_value,$html_profondeur45_bois_scl_js,$html_profondeur45_bois_scl_style,'profondeur45_bois_scl',' mesure_valeur');?>
						<?php HtmlOutput::select('profondeur89_bois_scl',$html_profondeur89_bois_scl,$html_profondeur89_bois_scl_value,$html_profondeur89_bois_scl_js,$html_profondeur89_bois_scl_style,'profondeur89_bois_scl',' mesure_valeur');?>
						<?php HtmlOutput::select('profondeur134_bois_scl',$html_profondeur134_bois_scl,$html_profondeur134_bois_scl_value,$html_profondeur134_bois_scl_js,$html_profondeur134_bois_scl_style,'profondeur134_bois_scl',' mesure_valeur');?>
						<?php HtmlOutput::select('profondeur178_bois_scl',$html_profondeur178_bois_scl,$html_profondeur178_bois_scl_value,$html_profondeur178_bois_scl_js,$html_profondeur178_bois_scl_style,'profondeur178_bois_scl',' mesure_valeur');?>
					</li>

					<li id="plis_bois_scl_box"<?php echo $html_plis_bois_scl_style;?>>
						<label><?php echo __d( 'cecobois', '# de plis' ); ?></label>

						<?php HtmlOutput::select('plis_bois_scl',$html_plis_bois_scl,$html_plis_bois_scl_value,$html_plis_bois_scl_js);?>
					</li>
				</ul>

                            
				<ul id="bois_blc_nordic"<?php echo $html_classe_bois_blc_nordic_style;?>>
						<li>
								<label><?php echo __d( 'cecobois', 'Classe' ); ?></label>
								<?PHP HtmlOutput::select('classe_bois_blc_nordic',$html_classe_bois_blc_nordic,$html_classe_bois_blc_nordic_value,$html_classe_bois_blc_nordic_js);?>
						</li>
						<li class="mesure">
								<label><?php echo __d( 'cecobois', 'Largeur' ); ?>&nbsp;(<span class="mesure_unite"><?php $unit = ($post->systeme == "met") ? __d( 'cecobois', 'mm' ) : __d( 'cecobois', 'pouces' ); echo $unit;?></span>)&nbsp;:</label>
								<?PHP HtmlOutput::select('largeur_bois_blc_nordic',$html_largeur_bois_blc_nordic,$html_largeur_bois_blc_nordic_value,$html_largeur_bois_blc_nordic_js,'','largeur_bois_blc_nordic',' mesure_valeur');?>
						</li>
						<li class="mesure">
								<label><?php echo __d( 'cecobois', 'Profondeur' ); ?>&nbsp;(<span class="mesure_unite"><?php $unit = ($post->systeme == "met") ? __d( 'cecobois', 'mm' ) : __d( 'cecobois', 'pouces' ); echo $unit;?></span>)&nbsp;:</label>
								
								<?PHP HtmlOutput::select('profondeur86_bois_blc_nordic' ,$html_profondeur86_bois_blc_nordic,$html_profondeur86_bois_blc_nordic_value,$html_profondeur86_bois_blc_nordic_js,$html_profondeur86_bois_blc_nordic_style,'profondeur86_bois_blc_nordic',' mesure_valeur');?>
								<?PHP HtmlOutput::select('profondeur137_bois_blc_nordic',$html_profondeur137_bois_blc_nordic,$html_profondeur137_bois_blc_nordic_value,$html_profondeur137_bois_blc_nordic_js,$html_profondeur137_bois_blc_nordic_style,'profondeur137_bois_blc_nordic',' mesure_valeur');?>
								<?PHP HtmlOutput::select('profondeur184_bois_blc_nordic',$html_profondeur184_bois_blc_nordic,$html_profondeur184_bois_blc_nordic_value,$html_profondeur184_bois_blc_nordic_js,$html_profondeur184_bois_blc_nordic_style,'profondeur184_bois_blc_nordic',' mesure_valeur');?>
								<?PHP HtmlOutput::select('profondeur215_bois_blc_nordic',$html_profondeur215_bois_blc_nordic,$html_profondeur215_bois_blc_nordic_value,$html_profondeur215_bois_blc_nordic_js,$html_profondeur215_bois_blc_nordic_style,'profondeur215_bois_blc_nordic',' mesure_valeur');?>
								<?PHP HtmlOutput::select('profondeur241_bois_blc_nordic',$html_profondeur241_bois_blc_nordic,$html_profondeur241_bois_blc_nordic_value,$html_profondeur241_bois_blc_nordic_js,$html_profondeur241_bois_blc_nordic_style,'profondeur241_bois_blc_nordic',' mesure_valeur');?>
								<?PHP HtmlOutput::select('profondeur292_bois_blc_nordic',$html_profondeur292_bois_blc_nordic,$html_profondeur292_bois_blc_nordic_value,$html_profondeur292_bois_blc_nordic_js,$html_profondeur292_bois_blc_nordic_style,'profondeur292_bois_blc_nordic',' mesure_valeur');?>


						</li>
				</ul>     
                            
				<ul id="bois_blc"<?php echo $html_classe_bois_blc_style;?>>
					<li>
						<label><?php echo __d( 'cecobois', 'Classe' ); ?></label>

						<?php HtmlOutput::select('classe_bois_blc',$html_classe_bois_blc,$html_classe_bois_blc_value,$html_classe_bois_blc_js);?>
					</li>

					<li class="mesure">
						<label><?php echo __d( 'cecobois', 'Largeur' ); ?>&nbsp;(<span class="mesure_unite"><?php $unit = ($post->systeme == "met") ? __d( 'cecobois', 'mm' ) : __d( 'cecobois', 'pouces' ); echo $unit;?></span>)</label>
						<?php HtmlOutput::select('largeur_bois_blc',$html_largeur_bois_blc,$html_largeur_bois_blc_value,$html_largeur_bois_blc_js,'','largeur_bois_blc',' mesure_valeur');?>
					</li>

					<li class="mesure">
						<label><?php echo __d( 'cecobois', 'Profondeur' ); ?>&nbsp;(<span class="mesure_unite"><?php $unit = ($post->systeme == "met") ? __d( 'cecobois', 'mm' ) : __d( 'cecobois', 'pouces' ); echo $unit;?></span>)</label>
						<?php HtmlOutput::select('profondeur80_bois_blc',$html_profondeur80_bois_blc,$html_profondeur80_bois_blc_value,$html_profondeur80_bois_blc_js,$html_profondeur80_bois_blc_style,'profondeur80_bois_blc',' mesure_valeur');?>

						<?php HtmlOutput::select('profondeur105_bois_blc',$html_profondeur105_bois_blc,$html_profondeur105_bois_blc_value,$html_profondeur105_bois_blc_js,$html_profondeur105_bois_blc_style,'profondeur105_bois_blc',' mesure_valeur');?>

						<?php HtmlOutput::select('profondeur130_bois_blc',$html_profondeur130_bois_blc,$html_profondeur130_bois_blc_value,$html_profondeur130_bois_blc_js,$html_profondeur130_bois_blc_style,'profondeur130_bois_blc',' mesure_valeur');?>

						<?php HtmlOutput::select('profondeur175_bois_blc',$html_profondeur175_bois_blc,$html_profondeur175_bois_blc_value,$html_profondeur175_bois_blc_js,$html_profondeur175_bois_blc_style,'profondeur175_bois_blc',' mesure_valeur');?>

						<?php HtmlOutput::select('profondeur215_bois_blc',$html_profondeur215_bois_blc,$html_profondeur215_bois_blc_value,$html_profondeur215_bois_blc_js,$html_profondeur215_bois_blc_style,'profondeur215_bois_blc',' mesure_valeur');?>

						<?php HtmlOutput::select('profondeur225_bois_blc',$html_profondeur225_bois_blc,$html_profondeur225_bois_blc_value,$html_profondeur225_bois_blc_js,$html_profondeur225_bois_blc_style,'profondeur225_bois_blc',' mesure_valeur');?>

						<?php HtmlOutput::select('profondeur265_bois_blc',$html_profondeur265_bois_blc,$html_profondeur265_bois_blc_value,$html_profondeur265_bois_blc_js,$html_profondeur265_bois_blc_style,'profondeur265_bois_blc',' mesure_valeur');?>

						<?php HtmlOutput::select('profondeur275_bois_blc',$html_profondeur275_bois_blc,$html_profondeur275_bois_blc_value,$html_profondeur275_bois_blc_js,$html_profondeur275_bois_blc_style,'profondeur275_bois_blc',' mesure_valeur');?>

						<?php HtmlOutput::select('profondeur315_bois_blc',$html_profondeur315_bois_blc,$html_profondeur315_bois_blc_value,$html_profondeur315_bois_blc_js,$html_profondeur315_bois_blc_style,'profondeur315_bois_blc',' mesure_valeur');?>

						<?php HtmlOutput::select('profondeur365_bois_blc',$html_profondeur365_bois_blc,$html_profondeur365_bois_blc_value,$html_profondeur365_bois_blc_js,$html_profondeur365_bois_blc_style,'profondeur365_bois_blc',' mesure_valeur');?>

						<?php HtmlOutput::select('profondeur415_bois_blc',$html_profondeur415_bois_blc,$html_profondeur415_bois_blc_value,$html_profondeur415_bois_blc_js,$html_profondeur415_bois_blc_style,'profondeur415_bois_blc',' mesure_valeur');?>

						<?php HtmlOutput::select('profondeur465_bois_blc',$html_profondeur465_bois_blc,$html_profondeur465_bois_blc_value,$html_profondeur465_bois_blc_js,$html_profondeur465_bois_blc_style,'profondeur465_bois_blc',' mesure_valeur');?>

						<?php HtmlOutput::select('profondeur515_bois_blc',$html_profondeur515_bois_blc,$html_profondeur515_bois_blc_value,$html_profondeur515_bois_blc_js,$html_profondeur515_bois_blc_style,'profondeur515_bois_blc',' mesure_valeur');?>
					</li>
				</ul>
				
				<ul id="bois_massif"<?php echo $html_classe_bois_massif_style;?>>
					
					<li>
						<label><?php echo __d( 'cecobois', 'Essence' ); ?></label>

						<?php HtmlOutput::select('essence_bois_massif',$html_essence_bois_massif,$html_essence_bois_massif_value,$html_essence_bois_massif_js,'','essence_bois_massif');?>
					</li>
					
					<li>
						<label><?php echo __d( 'cecobois', 'Classe' ); ?></label>

						<?php HtmlOutput::select('classe_bois_massif',$html_classe_bois_massif,$html_classe_bois_massif_value,$html_classe_bois_massif_js);?>
					</li>

					<li class="mesure">
						<label><?php echo __d( 'cecobois', 'Largeur' ); ?>&nbsp;(<span class="mesure_unite"><?php $unit = ($post->systeme == "met") ? __d( 'cecobois', 'mm' ) : __d( 'cecobois', 'pouces' ); echo $unit;?></span>)</label>
						
						<?php HtmlOutput::select('largeur1_bois_massif',$html_largeur1_bois_massif,$html_largeur1_bois_massif_value,$html_largeur1_bois_massif_js,$html_largeur1_bois_massif_style,'largeur1_bois_massif',' mesure_valeur');?>
						<?php HtmlOutput::select('largeur2_bois_massif',$html_largeur2_bois_massif,$html_largeur2_bois_massif_value,$html_largeur2_bois_massif_js,$html_largeur2_bois_massif_style,'largeur2_bois_massif',' mesure_valeur');?>
					</li>

					<li class="mesure">
						<label><?php echo __d( 'cecobois', 'Profondeur' ); ?>&nbsp;(<span class="mesure_unite"><?php $unit = ($post->systeme == "met") ? __d( 'cecobois', 'mm' ) : __d( 'cecobois', 'pouces' ); echo $unit;?></span>)</label>
						<?php HtmlOutput::select('profondeur140_bois_massif',$html_profondeur140_bois_massif,$html_profondeur140_bois_massif_value,$html_profondeur140_bois_massif_js,$html_profondeur140_bois_massif_style,'profondeur140_bois_massif',' mesure_valeur');?>
						<?php HtmlOutput::select('profondeur191_bois_massif',$html_profondeur191_bois_massif,$html_profondeur191_bois_massif_value,$html_profondeur105_bois_massif_js,$html_profondeur191_bois_massif_style,'profondeur191_bois_massif',' mesure_valeur');?>
						<?php HtmlOutput::select('profondeur241_bois_massif',$html_profondeur241_bois_massif,$html_profondeur241_bois_massif_value,$html_profondeur130_bois_massif_js,$html_profondeur241_bois_massif_style,'profondeur241_bois_massif',' mesure_valeur');?>
						<?php HtmlOutput::select('profondeur292_bois_massif',$html_profondeur292_bois_massif,$html_profondeur292_bois_massif_value,$html_profondeur292_bois_massif_js,$html_profondeur292_bois_massif_style,'profondeur292_bois_massif',' mesure_valeur');?>
						<?php HtmlOutput::select('profondeur343_bois_massif',$html_profondeur343_bois_massif,$html_profondeur343_bois_massif_value,$html_profondeur343_bois_massif_js,$html_profondeur343_bois_massif_style,'profondeur343_bois_massif',' mesure_valeur');?>
						<?php HtmlOutput::select('profondeur394_bois_massif',$html_profondeur394_bois_massif,$html_profondeur394_bois_massif_value,$html_profondeur394_bois_massif_js,$html_profondeur394_bois_massif_style,'profondeur394_bois_massif',' mesure_valeur');?>
						
						<?php HtmlOutput::select('profondeur140_2_bois_massif',$html_profondeur140_2_bois_massif,$html_profondeur140_2_bois_massif_value,$html_profondeur140_2_bois_massif_js,$html_profondeur140_2_bois_massif_style,'profondeur140_2_bois_massif',' mesure_valeur');?>
						<?php HtmlOutput::select('profondeur191_2_bois_massif',$html_profondeur191_2_bois_massif,$html_profondeur191_2_bois_massif_value,$html_profondeur105_2_bois_massif_js,$html_profondeur191_2_bois_massif_style,'profondeur191_2_bois_massif',' mesure_valeur');?>
						<?php HtmlOutput::select('profondeur241_2_bois_massif',$html_profondeur241_2_bois_massif,$html_profondeur241_2_bois_massif_value,$html_profondeur130_2_bois_massif_js,$html_profondeur241_2_bois_massif_style,'profondeur241_2_bois_massif',' mesure_valeur');?>
						<?php HtmlOutput::select('profondeur241_2_bois_massif',$html_profondeur241_2_bois_massif,$html_profondeur241_2_bois_massif_value,$html_profondeur130_2_bois_massif_js,$html_profondeur241_2_bois_massif_style,'profondeur292_2_bois_massif',' mesure_valeur');?>
						<?php HtmlOutput::select('profondeur292_2_bois_massif',$html_profondeur292_2_bois_massif,$html_profondeur292_2_bois_massif_value,$html_profondeur130_2_bois_massif_js,$html_profondeur292_2_bois_massif_style,'profondeur292_2_bois_massif',' mesure_valeur');?>
						<?php HtmlOutput::select('profondeur343_2_bois_massif',$html_profondeur343_2_bois_massif,$html_profondeur343_2_bois_massif_value,$html_profondeur130_2_bois_massif_js,$html_profondeur343_2_bois_massif_style,'profondeur343_2_bois_massif',' mesure_valeur');?>
						<?php HtmlOutput::select('profondeur394_2_bois_massif',$html_profondeur394_2_bois_massif,$html_profondeur394_2_bois_massif_value,$html_profondeur130_2_bois_massif_js,$html_profondeur394_2_bois_massif_style,'profondeur394_2_bois_massif',' mesure_valeur');?>
					</li>
				</ul>


				<ul>

					<li class="mesure">
						<label><span class="ast">*</span> <?php echo __d( 'cecobois', 'Portée' ); ?> (<span class="mesure_unite"><?php $unit = ($post->systeme == "met") ? 'm' : 'pieds'; echo $unit;?></span>)</label>

						<?php HtmlOutput::input('portee',$html_portee_js,' mesure_valeur');?>
					</li>

					<li>
						<label><?php echo __d( 'cecobois', 'Rive comprimée retenue' ); ?></label>

						<?php HtmlOutput::select('rive_comprimee_retenue',$html_rive_comprimee_retenue,$html_rive_comprimee_retenue_value,$html_rive_comprimee_retenue_js);?>
					</li>

					<li class="mesure" id="intervalles"<?php echo $html_intervalles_style;?>>
						<label><span class="ast">*</span> <?php echo __d( 'cecobois', 'Longueur des intervalles' ); ?> (<span class="mesure_unite"><?php $unit = ($post->systeme == "met") ? 'mm' : 'pouces'; echo $unit;?></span>)</label>

						<?php HtmlOutput::input('intervalles',$html_intervalles_js,' mesure_valeur');?>
					</li>

					<li>
						<label><?php echo __d( 'cecobois', 'Catégorie de risque' ); ?></label>

						<?php HtmlOutput::select('cat_risque',$html_cat_risque,$html_cat_risque_value,$html_cat_risque_js);?>
					</li>
				</ul>
			</fieldset>

			<fieldset class="item-container">
				<legend class="title2"><?php echo __d( 'cecobois', 'Charges non pondérées' ); ?></legend>

				<ul>
					<li class="mesure">
						<label><span class="ast">*</span> <?php echo __d( 'cecobois', 'Neige' ); ?> (<span class="mesure_unite"><?php $unit = ($post->systeme == "met") ? 'kN/m' : 'lb/pi'; echo $unit;?></span>)</label>

						<?php HtmlOutput::input('neige',$html_neige_js,' mesure_valeur')?>

						<span class="extra-info"> <?php echo __d( 'cecobois', '(excluant le I<sub>S</sub>)' ); ?></span>
					</li>
					<li class="mesure">
						<label><span class="ast">*</span> <?php echo __d( 'cecobois', 'Surcharge' ); ?> (<span class="mesure_unite"><?php $unit = ($post->systeme == "met") ? 'kN/m' : 'lb/pi'; echo $unit;?></span>)</label>

						<?php HtmlOutput::input('surcharge',$html_surcharge_js,' mesure_valeur')?>
					</li>
					<li class="mesure">
						<label><span class="ast">*</span> <?php echo __d( 'cecobois', 'Charge permanente' ); ?> (<span class="mesure_unite"><?php $unit = ($post->systeme == "met") ? 'kN/m' : 'lb/pi'; echo $unit;?></span>)</label>

						<?php HtmlOutput::input('morte',$html_morte_js,' mesure_valeur')?>
					</li>
				</ul>
			</fieldset>

			<fieldset class="item-container">
				<legend class="title2"><?php echo __d( 'cecobois', 'Limites de flèche' ); ?></legend>

				<ul>
					<li>
						<label><?php echo __d( 'cecobois', 'Sous la surcharge' ); ?></label>

						<?php HtmlOutput::select('fleche_surcharge',$html_fleche_surcharge,$html_fleche_surcharge_value,$html_fleche_surcharge_js);?>
					</li>
					<li>
						<label><?php echo __d( 'cecobois', 'Sous la charge totale' ); ?></label>

						<?php HtmlOutput::select('fleche_charge_totale',$html_fleche_charge_totale,$html_fleche_charge_totale_value,$html_charge_totale_js);?>
					</li>
				</ul>
			</fieldset>

			<input type="hidden" name="action" value="verif" />
			<?php if($post->action!="print"): ?>
			<input type="submit" value="<?php echo __d( 'cecobois', 'Calculer' ); ?>" class="btn" />
			<?php endif;?>
		</form>
	</div>
</div>

<div class="right project-right calculator-container">
	<div class="schematics-image" id="schema">
		<?php
			//if( Configure::read( 'Config.language' ) == 'fr' ) {
				$diagramPath = '/calculatrices-en-ligne/img/calculators/poutres-imperial/schema.png';
			//} else {
			//	$diagramPath = '/img/calculators/poutres-imperial/schema_en.png';
			//}
		?>

		<img src="<?php echo $diagramPath; ?>" alt="<?php echo __d( 'cecobois', 'Schéma' ); ?>" />
	</div>
</div>