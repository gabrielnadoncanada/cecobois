
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
						<label><?php echo __d( 'cecobois', 'Type de poutrelle' ); ?></label>

						<?php HtmlOutput::radio('type_poutrelle',$html_type_poutrelle,$html_type_poutrelle_value,$html_type_poutrelle_js);?>
					</li>

					<li class="mesure">
						<label><span class="ast">*</span> <?php echo __d( 'cecobois', 'Portée' ); ?> (<span class="mesure_unite"><?php $unit = ($post->systeme == "met") ? 'm' : 'pieds'; echo $unit;?></span>)</label>

						<?php HtmlOutput::input('portee',$html_portee_js,' mesure_valeur');?>
					</li>

					<li class="mesure">
						<label><?php echo __d( 'cecobois', 'Espacement' ); ?> (<span class="mesure_unite"><?php $unit = ($post->systeme == "met") ? 'mm' : 'pouces'; echo $unit;?></span>)</label>
						<?php HtmlOutput::select('espacement',$html_espacement,$html_espacement_value,$html_espacement_js,'','',' mesure_valeur');?>
					</li>

					<li class="mesure">
						<label><?php echo __d( 'cecobois', 'Hauteur de poutrelle' ); ?> (<span class="mesure_unite"><?php $unit = ($post->systeme == "met") ? 'mm' : 'pouces'; echo $unit;?></span>)</label>

						<?php HtmlOutput::select('hauteur',$html_hauteur,$html_hauteur_value,$html_hauteur_js,'','',' mesure_valeur');?>
					</li>

					<li>
						<label><?php echo __d( 'cecobois', 'Surcharge concentrée' ); ?></label>

						<?php HtmlOutput::select('PL',$html_charge_pl,$html_charge_pl_value,$html_charge_pl_js);?>
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
						<label><span class="ast">*</span> <?php echo __d( 'cecobois', 'Surcharge ou charge de neige' ); ?> (<span class="mesure_unite"><?php $unit = ($post->systeme == "met") ? 'kPa' : 'lb/pi<sup>2</sup>'; echo $unit;?></span>)</label>

						<?php HtmlOutput::input('surcharge',$html_surcharge_js,' mesure_valeur')?>

						<span class="extra-info"> <?php echo __d( 'cecobois', '(excluant le I<sub>S</sub>)' ); ?></span>
					</li>

					<li class="mesure">
						<label><span class="ast">*</span> <?php echo __d( 'cecobois', 'Charge permanente' ); ?> (<span class="mesure_unite"><?php $unit = ($post->systeme == "met") ? 'kPa' : 'lb/pi<sup>2</sup>'; echo $unit;?></span>)</label>

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

			<fieldset class="item-container">
				<legend class="title2"><?php echo __d( 'cecobois', 'Assemblage de plancher (vibration seulement)' ); ?></legend>

				<ul id="assemblage">
					<li>
						<label><span class="ast">*</span> <?php echo __d( 'cecobois', 'Type de revêtement' ); ?></label>

						<?php HtmlOutput::radio('type_revetement',$html_type_revetement,$html_type_revetement_value,$html_type_revetement_js,'',1);?>
					</li>

					<li class="mesure">
						<label><span class="ast">*</span> <?php echo __d( 'cecobois', 'Épaisseur de revêtement' ); ?> (<span class="mesure_unite"><?php $unit = ($post->systeme == "met") ? 'mm' : 'pouces'; echo $unit;?></span>)</label>

						<?php HtmlOutput::radio('epaisseur_revetement',$html_epaisseur_revetement,$html_epaisseur_revetement_value,$html_epaisseur_revetement_js,'',1,'','mesure_valeur');?>
					</li>

					<li>
						<label><span class="ast">*</span> <?php echo __d( 'cecobois', 'Attache du revêtement' ); ?></label>

						<?php HtmlOutput::radio('attache_revetement',$html_attache_revetement,$html_attache_revetement_value,$html_attache_revetement_js,'',1);?>
					</li>

					<li class="mesure">
						<label><span class="ast">*</span> <?php echo __d( 'cecobois', 'Plafond de gypse' ); ?> (<span class="mesure_unite"><?php $unit = ($post->systeme == "met") ? 'mm' : 'pouces'; echo $unit;?></span>)</label>

						<?php HtmlOutput::radio('plafond_gypse',$html_plafond_gypse,$html_plafond_gypse_value,$html_plafond_gypse_js,'',1,'','mesure_valeur');?>
					</li>

					<li>
						<label><span class="ast">*</span> <?php echo __d( 'cecobois', 'Rangée de blocages transversaux' ); ?></label>
						<?php HtmlOutput::radio('rangee_blocages',$html_rangee_blocages,$html_rangee_blocages_value,$html_rangee_blocages_js,'',1);?>
					</li>
				</ul>
			</fieldset>

			<input type="hidden" name="action" value="verif" />
			<?php if($post->action!="print"): ?>
			<input type="submit" class="btn" value="<?php echo __d( 'cecobois', 'Calculer' ); ?>" />
			<?php endif;?>
		</form>
	</div>
</div>

<div class="right project-right calculator-container">
	<div class="schematics-image" id="schema">
		<?php
			$diagramPath = '/calculatrices-en-ligne/img/calculators/poutrelles-imperial/schema.png';
		?>

		<img src="<?php echo $diagramPath; ?>" alt="<?php echo __d( 'cecobois', 'Schéma' ); ?>" />
	</div>
</div>