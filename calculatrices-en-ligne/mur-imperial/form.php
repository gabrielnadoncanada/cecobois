<div class="list-wide main-title top">
	<p>* <?php echo __d( 'cecobois', 'Tous les champs munis d\'un astérisque doivent être remplis.' ); ?><br /><?php echo __d( 'cecobois', 'Toutes les mesures, qu\'elles suivent le système métrique ou impérial, doivent être entrées en décimal.' ); ?></p>
</div>

<div class="right project-right calculator-container">
	<div class="schematics-image" id="schema">
		<?php
			//if( Configure::read( 'Config.language' ) == 'fr' ) {
				$diagramPath = '/calculatrices-en-ligne/img/calculators/mur-imperial/schema.png';
			//} else {
			//	$diagramPath = '/img/calculators/mur-imperial/schema_en.png';
			//}
		?>

		<img src="<?php echo $diagramPath; ?>" alt="<?php echo __d( 'cecobois', 'Schéma' ); ?>" />
	</div>
</div>

<div class="left project-left calculator-container">
	<div class="form">
		<form name="calcul" method="post" id="calc">
			<fieldset class="item-container">
				<ul>
					<li>
						<label>Système</label>

						<?php HtmlOutput::radio('systeme',$html_systeme,$html_systeme_value,$html_systeme_js);?>
					</li>

					<li>
						<label>Type</label>

						<?php HtmlOutput::select('type',$html_type,$html_type_value,$html_type_js);?>
					</li>

					<li>
						<label>Classe</label>

						<?php HtmlOutput::select('classe',$html_classe,$html_classe_value,$html_classe_js,$html_classe_style,'classe');?>
						<?php HtmlOutput::select('classe2',$html_classe2,$html_classe2_value,$html_classe2_js,$html_classe2_style,'classe2');?>
						<?php HtmlOutput::select('classe3',$html_classe3,$html_classe3_value,$html_classe3_js,$html_classe3_style,'classe3');?>
						<?php HtmlOutput::select('classe4',$html_classe4,$html_classe4_value,$html_classe4_js,$html_classe4_style,'classe4');?>
						<?php HtmlOutput::select('classe5',$html_classe5,$html_classe5_value,$html_classe5_js,$html_classe5_style,'classe5');?>
						<?php HtmlOutput::select('classe6',$html_classe6,$html_classe6_value,$html_classe6_js,$html_classe6_style,'classe6');?>
						<?php HtmlOutput::select('classe7',$html_classe7,$html_classe7_value,$html_classe7_js,$html_classe7_style,'classe7');?>
					</li>

					<li class="mesure">
						<label><?php echo __d( 'cecobois', 'Largeur' ); ?> (<span class="mesure_unite"><?php $unit = ($post->systeme == "met") ? __d( 'cecobois', 'mm' ) : __d( 'cecobois', 'pouces' ); echo $unit;?></span>)</label>

						<?php HtmlOutput::select('largeur',$html_largeur,$html_largeur_value,$html_largeur_js,$html_largeur_style,'largeur',' mesure_valeur');?>
						<?php HtmlOutput::select('largeur2',$html_largeur2,$html_largeur2_value,$html_largeur2_js,$html_largeur2_style,'largeur2',' mesure_valeur');?>
						<?php HtmlOutput::select('largeur3',$html_largeur3,$html_largeur3_value,$html_largeur3_js,$html_largeur3_style,'largeur3',' mesure_valeur');?>
						<?php HtmlOutput::select('largeur4',$html_largeur4,$html_largeur4_value,$html_largeur4_js,$html_largeur4_style,'largeur4',' mesure_valeur');?>
						<?php HtmlOutput::select('largeur5',$html_largeur5,$html_largeur5_value,$html_largeur5_js,$html_largeur5_style,'largeur5',' mesure_valeur');?>
						<?php HtmlOutput::select('largeur6',$html_largeur6,$html_largeur6_value,$html_largeur6_js,$html_largeur6_style,'largeur6',' mesure_valeur');?>
						<?php HtmlOutput::select('largeur7',$html_largeur7,$html_largeur7_value,$html_largeur7_js,$html_largeur7_style,'largeur7',' mesure_valeur');?>
					</li>

					<li class="mesure">
						<label><?php echo __d( 'cecobois', 'Profondeur' ); ?> (<span class="mesure_unite"><?php $unit = ($post->systeme == "met") ? __d( 'cecobois', 'mm' ) : __d( 'cecobois', 'pouces' ); echo $unit;?></span>)</label>

						<?php HtmlOutput::select('profondeur',$html_profondeur,$html_profondeur_value,$html_profondeur_js,$html_profondeur_style,'profondeur',' mesure_valeur');?>
						<?php HtmlOutput::select('profondeur2',$html_profondeur2,$html_profondeur2_value,$html_profondeur2_js,$html_profondeur2_style,'profondeur2',' mesure_valeur');?>
						<?php HtmlOutput::select('profondeur3',$html_profondeur3,$html_profondeur3_value,$html_profondeur3_js,$html_profondeur3_style,'profondeur3',' mesure_valeur');?>
						<?php HtmlOutput::select('profondeur4',$html_profondeur4,$html_profondeur4_value,$html_profondeur4_js,$html_profondeur4_style,'profondeur4',' mesure_valeur');?>
						<?php HtmlOutput::select('profondeur8',$html_profondeur8,$html_profondeur8_value,$html_profondeur8_js,$html_profondeur8_style,'profondeur8',' mesure_valeur');?>
						<?php HtmlOutput::select('profondeur5',$html_profondeur5,$html_profondeur5_value,$html_profondeur5_js,$html_profondeur5_style,'profondeur5',' mesure_valeur');?>
						<?php HtmlOutput::select('profondeur6',$html_profondeur6,$html_profondeur6_value,$html_profondeur6_js,$html_profondeur6_style,'profondeur6',' mesure_valeur');?>
						<?php HtmlOutput::select('profondeur7',$html_profondeur7,$html_profondeur7_value,$html_profondeur7_js,$html_profondeur7_style,'profondeur7',' mesure_valeur');?>
					</li>

					<li class="mesure">
						<label><?php echo __d( 'cecobois', 'Espacement' ); ?> (<span class="mesure_unite"><?php $unit = ($post->systeme == "met") ? __d( 'cecobois', 'mm' ) : __d( 'cecobois', 'pouces' ); echo $unit;?></span>)</label>

						<?php HtmlOutput::select('espacement',$html_espacement,$html_espacement_value,$html_espacement_js,'','',' mesure_valeur');?>
					</li>

					<li class="mesure">
						<label><span class="ast">*</span> <?php echo __d( 'cecobois', 'Hauteur' ); ?> (<span class="mesure_unite"><?php $unit = ($post->systeme == "met") ? __d( 'cecobois', 'm' ) : __d( 'cecobois', 'pieds' ); echo $unit;?></span>)</label>

						<?php HtmlOutput::input('hauteur',$html_hauteur_js,' mesure_valeur')?>
					</li>

					<li>
						<label><?php echo __d( 'cecobois', 'Partage de charge (K<sub>H</sub>)' ); ?></label>

						<?php HtmlOutput::select('partage_charge',$html_partage_charge,$html_partage_charge_value,$html_partage_charge_js);?>
					</li>

					<li>
						<label><?php echo __d( 'cecobois', 'Catégorie de risque' ); ?></label>

						<?php HtmlOutput::select('cat_risque',$html_cat_risque,$html_cat_risque_value,$html_cat_risque_js);?>
					</li>

					<input type="hidden" name="edition_code" value="2015" />
				</ul>
			</fieldset>

			<fieldset class="item-container">
				<legend class="title2"><?php echo __d( 'cecobois', 'Charges axiales non pondérées' ); ?></legend>
				<ul>
					<li class="mesure">
						<label><span class="ast">*</span> <?php echo __d( 'cecobois', 'Neige' ); ?> (<span class="mesure_unite"><?php $unit = ($post->systeme == "met") ? __d( 'cecobois', 'kN/m' ) : __d( 'cecobois', 'lb/pi' ); echo $unit;?></span>)</label>

						<?php HtmlOutput::input('ax_neige',$html_ax_neige_js,' mesure_valeur')?>
					</li>

					<li class="mesure">
						<label><span class="ast">*</span> <?php echo __d( 'cecobois', 'Surcharge' ); ?> (<span class="mesure_unite"><?php $unit = ($post->systeme == "met") ? __d( 'cecobois', 'kN/m' ) : __d( 'cecobois', 'lb/pi' ); echo $unit;?></span>)</label>

						<?php HtmlOutput::input('ax_surcharge',$html_ax_surcharge_js,' mesure_valeur')?>
					</li>

					<li class="mesure">
						<label><span class="ast">*</span> <?php echo __d( 'cecobois', 'Permanente' ); ?> (<span class="mesure_unite"><?php $unit = ($post->systeme == "met") ? 'kN/m' : 'lb/pi'; echo $unit;?></span>)</label>

						<?php HtmlOutput::input('ax_permanente',$html_ax_permanente_js,' mesure_valeur')?>
					</li>

					<li class="mesure">
						<label><span class="ast">*</span> <?php echo __d( 'cecobois', 'Excentricité' ); ?> (<span class="mesure_unite"><?php $unit = ($post->systeme == "met") ? 'mm' : 'pouces'; echo $unit;?></span>)</label>

						<?php HtmlOutput::input('ax_excentricite',$html_ax_excentricite_js,' mesure_valeur')?>
					</li>
				</ul>
			</fieldset>

			<fieldset class="item-container">
				<legend class="title2"><?php echo __d( 'cecobois', 'Charge latérale non pondérée' ); ?></legend>

				<ul>
					<li class="mesure">
						<label><span class="ast">*</span> <?php echo __d( 'cecobois', 'Vent' ); ?> (<span class="mesure_unite"><?php $unit = ($post->systeme == "met") ? __d( 'cecobois', 'kPa' ) : __d( 'cecobois', 'lb/pi<sup>2</sup>' ); echo $unit;?></span>)</label>

						<?php HtmlOutput::input('lat_vent',$html_lat_vent_js,' mesure_valeur')?>
					</li>
				</ul>
			</fieldset>

			<fieldset class="item-container">
				<legend class="title2"><?php echo __d( 'cecobois', 'Critères de flèche' ); ?></legend>

				<ul>
					<li>
						<label><?php echo __d( 'cecobois', 'Sous la surcharge' ); ?></label>

						<?php HtmlOutput::select('fleche_surcharge',$html_fleche_surcharge,$html_fleche_surcharge_value,$html_fleche_surcharge_js);?>
					</li>

					<li>
						<label><?php echo __d( 'cecobois', 'Sous la charge totale' ); ?></label>

						<?php HtmlOutput::select('fleche_charge_totale',$html_fleche_charge_totale,$html_fleche_charge_totale_value,$html_charge_totale_js);?>
					</li>

					<!--<li>
						<label><?php echo __d( 'cecobois', 'Traitement' ); ?></td>
						<?php HtmlOutput::select('fleche_traitement',$html_fleche_traitement,$html_fleche_traitement_value,$html_traitement_js);?>
					</li>

					<li>
						<label><?php echo __d( 'cecobois', 'Utilisation' ); ?></td>
						<?php HtmlOutput::select('fleche_utilisation',$html_fleche_utilisation,$html_fleche_utilisation_value,$html_utilisation_js);?>
					</li>-->
				</ul>
			</fieldset>

			<input type="hidden" name="action" value="verif" />

			<?php if($post->action!="print"): ?>
				<input type="submit" value="<?php echo __d( 'cecobois', 'Calculer' ); ?>" class="btn" />
			<?php endif;?>
		</form>
	</div>
</div>