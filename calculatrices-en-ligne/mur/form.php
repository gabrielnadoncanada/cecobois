<div class="list-wide main-title top">
	<p>* <?php echo __d( 'cecobois', 'Tous les champs munis d\'un astérisque doivent être remplis.' ); ?></p>
</div>

<div class="right project-right calculator-container">
	<div class="schematics-image" id="schema">
		<img src="/img/calculators/mur/schema.png" alt="<?php echo __d( 'cecobois', 'Schéma' ); ?>" />
	</div>
</div>

<div class="left project-left calculator-container">
	<div class="form">
		<form name="calcul" method="post" id="calc">
			<fieldset class="item-container">
				<ul>
					<li>
						<label><?php echo __d( 'cecobois', 'Classe' ); ?></label>

						<?php HtmlOutput::select('classe',$html_classe,$html_classe_value,$html_classe_js);?>
					</li>

					<li>
						<label><?php echo __d( 'cecobois', 'Colombages' ); ?></label>

						<?php HtmlOutput::select('colombages',$html_colombages,$html_colombages_value,$html_colombages_js,$html_colombages_style);?>

						<?php HtmlOutput::select('colombages2',$html_colombages2,$html_colombages_value2,$html_colombages2_js,$html_colombages_style2);?>

						<?php HtmlOutput::select('colombages3',$html_colombages3,$html_colombages_value3,$html_colombages3_js,$html_colombages_style3);?>
					</li>

					<li>
						<label><?php echo __d( 'cecobois', 'Espacement' ); ?></label>

						<?php HtmlOutput::select('espacement',$html_espacement,$html_espacement_value,$html_espacement_js);?>
					</li>

					<li>
						<label><span class="ast">*</span> <?php echo __d( 'cecobois', 'Hauteur' ) . ' ' . __d( 'cecobois', '(m)' ); ?></label>

						<?php HtmlOutput::input('hauteur',$html_hauteur_js)?>
					</li>

					<li>
						<label><?php echo __d( 'cecobois', 'Partage de charge (K<sub>H</sub>)' ); ?></label>

						<?php HtmlOutput::select('partage_charge',$html_partage_charge,$html_partage_charge_value,$html_partage_charge_js);?>
					</li>

					<li>
						<label><?php echo __d( 'cecobois', 'Catégorie de risque' ); ?></label>

						<?php HtmlOutput::select('cat_risque',$html_cat_risque,$html_cat_risque_value,$html_cat_risque_js);?>
					</li>
				</ul>
			</fieldset>

			<fieldset class="item-container">
				<legend class="title2"><?php echo __d( 'cecobois', 'Charges axiales non pondérées' ); ?></legend>

				<ul>
					<li>
						<label><span class="ast">*</span> <?php echo __d( 'cecobois', 'Neige (kN/m)' ); ?></label>

						<?php HtmlOutput::input('ax_neige',$html_ax_neige_js)?>
					</li>
					<li>
						<label><span class="ast">*</span> <?php echo __d( 'cecobois', 'Surcharge (kN/m)' ); ?></label>

						<?php HtmlOutput::input('ax_surcharge',$html_ax_surcharge_js)?>
					</li>
					<li>
						<label><span class="ast">*</span> <?php echo __d( 'cecobois', 'Permanente (kN/m)' ); ?></label>

						<?php HtmlOutput::input('ax_permanente',$html_ax_permanente_js)?>
					</li>
					<li>
						<label><span class="ast">*</span> <?php echo __d( 'cecobois', 'Excentricité (mm)' ); ?></label>

						<?php HtmlOutput::input('ax_excentricite',$html_ax_excentricite_js)?>
					</li>
				</ul>
			</fieldset>

			<fieldset class="item-container">
				<legend class="title2"><?php echo __d( 'cecobois', 'Charge latérale non pondérée' ); ?></legend>

				<ul>
					<li>
						<label><span class="ast">*</span> <?php echo __d( 'cecobois', 'Vent (kPa)' ); ?></label>

						<?php HtmlOutput::input('lat_vent',$html_lat_vent_js)?>
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
					<!--
					<li>
						<label>Traitement :</td>
						<?php HtmlOutput::select('fleche_traitement',$html_fleche_traitement,$html_fleche_traitement_value,$html_traitement_js);?>
					</li>
					<li>
						<label>Utilisation :</td>
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