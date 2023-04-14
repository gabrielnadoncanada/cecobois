<div class="main-title top">
	<p>* <?php echo __d( 'cecobois', 'Tous les champs munis d\'un astérisque doivent être remplis.' ); ?><br /><?php echo __d( 'cecobois', 'Toutes les mesures, qu\'elles suivent le système métrique ou impérial, doivent être entrées en décimal.' ); ?></p>
</div>

<div class="right project-right calculator-container">
	<div class="schematics-image" id="schema">
		<img src="/img/calculators/ouverture/schema.png" alt="<?php echo __d( 'cecobois', 'Schéma' ); ?>" />
	</div>
</div>

<div class="left project-left calculator-container">
	<div class="form">
		<form name="calcul" method="post" id="calc">
			<fieldset class="item-container">
				<legend class="title2"><?php echo __d( 'cecobois', 'Dimensions de l\'ouverture' ); ?></legend>

				<ul>
					<li>
						<label><?php echo __d( 'cecobois', 'Système' ); ?>&nbsp;:</label>
						<?php HtmlOutput::radio( 'systeme', $html_systeme, $html_systeme_value, $html_systeme_js ); ?>
					</li>
					<li class="mesure">
						<label><?php echo __d( 'cecobois', 'Hauteur' ); ?> (<span class="mesure_unite"><?php $unit = ( $post->systeme == "met" ) ? __d( 'cecobois', 'mm' ) : __d( 'cecobois', 'pouces' ); echo $unit; ?></span>)&nbsp;:</label>
						<?php HtmlOutput::input( 'hauteur', $html_hauteur_js, ' mesure_valeur' ); ?>
					</li>
					<li class="mesure">
						<label><?php echo __d( 'cecobois', 'Largeur' ); ?> (<span class="mesure_unite"><?php $unit = ( $post->systeme == "met" ) ? __d( 'cecobois', 'mm' ) : __d( 'cecobois', 'pouces' ); echo $unit; ?></span>)&nbsp;:</label>
						<?php HtmlOutput::input( 'largeur', $html_largeur_js, ' mesure_valeur' ); ?>
					</li>
				</ul>
			</fieldset>

			<fieldset class="item-container">
				<legend class="title2"><?php echo __d( 'cecobois', 'Murs' ); ?></legend>
				<ul>
					<li class="mesure">
						<label><?php echo __d( 'cecobois', 'Hauteur du mur' ); ?> (<span class="mesure_unite"><?php $unit = ($post->systeme == "met") ? __d( 'cecobois', 'mm' ) : __d( 'cecobois', 'pouces' ); echo $unit; ?></span>)&nbsp;:</label>
						<?php HtmlOutput::input( 'hauteur_mur', $html_hauteur_mur_js, ' mesure_valeur'); ?>
					</li>
					<li>
						<label><?php echo __d( 'cecobois', 'Colombages' ); ?>&nbsp;:</label>
						<?php HtmlOutput::select( 'colombages', $html_colombages, $html_colombages_value, $html_colombages_js ); ?>
					</li>
					<li class="mesure">
						<label><?php echo __d( 'cecobois', 'Espacement des colombages' ); ?> (<span class="mesure_unite"><?php $unit = ($post->systeme == "met") ? __d( 'cecobois', 'mm' ) : __d( 'cecobois', 'pouces' ); echo $unit; ?></span>)&nbsp;:</label>
						<?php HtmlOutput::input('espacement',$html_espacement_js,' mesure_valeur'); ?>
					</li>
					<li>
						<label><?php echo __d( 'cecobois', 'Revêtement structural' ); ?>&nbsp;:</label>
						<?php HtmlOutput::radio('revetement',$html_revetement,$html_revetement_value,$html_revetement_js); ?>
					</li>
				</ul>
			</fieldset>

			<fieldset class="item-container">
				<legend class="title2"><?php echo __d( 'cecobois', 'Linteau' ); ?></legend>

				<ul>
					<li>
						<label><?php echo __d( 'cecobois', 'Emplacement du linteau' ); ?>&nbsp;:</label>
						<?php HtmlOutput::radio( 'emplacement', $html_emplacement, $html_emplacement_value, $html_emplacement_js ); ?>
					</li>
					<li>
						<label><?php echo __d( 'cecobois', 'Type de bois' ); ?>&nbsp;:</label>
						<?php HtmlOutput::select( 'type', $html_type, $html_type_value, $html_type_js ); ?>
					</li>
				</ul>
			</fieldset>

			<fieldset class="item-container">
				<legend class="title2"><?php echo __d( 'cecobois', 'Charges axiales non pondérées' ); ?></legend>

				<ul>
					<li>
						<label><?php echo __d( 'cecobois', 'Catégorie de risque' ); ?>&nbsp;:</label>
						<?php HtmlOutput::select( 'cat_risque', $html_cat_risque, $html_cat_risque_value, $html_cat_risque_js ); ?>
					</li>
					<li class="mesure">
						<label><?php echo __d( 'cecobois', 'Neige' ); ?> (<span class="mesure_unite"><?php $unit = ( $post->systeme == "met" ) ? __d( 'cecobois', 'kN/m' ) : __d( 'cecobois', 'lb/pi<sup>2</sup>' ); echo $unit; ?></span>)&nbsp;:</label>
						<?php HtmlOutput::input( 'neige', $html_neige_js, ' mesure_valeur'); ?>
					</li>
					<li class="mesure">
						<label><?php echo __d( 'cecobois', 'Surcharge' ); ?> (<span class="mesure_unite"><?php $unit = ( $post->systeme == "met" ) ?  __d( 'cecobois', 'kN/m' ) : __d( 'cecobois', 'lb/pi<sup>2</sup>' ); echo $unit; ?></span>)&nbsp;:</label>
						<?php HtmlOutput::input( 'surcharge', $html_surcharge_js, ' mesure_valeur' ); ?>
					</li>

					<li class="mesure">
						<label><?php echo __d( 'cecobois', 'Permanente' ); ?> (<span class="mesure_unite"><?php $unit = ( $post->systeme == "met" ) ? __d( 'cecobois', 'kN/m' ) : __d( 'cecobois', 'lb/pi<sup>2</sup>' ); echo $unit; ?></span>)&nbsp;:</label>
						<?php HtmlOutput::input( 'permanente', $html_permanente_js, ' mesure_valeur'); ?>
					</li>

					<li class="mesure">
						<label><?php echo __d( 'cecobois', 'Excentricité' ); ?> (<span class="mesure_unite"><?php $unit = ( $post->systeme == "met" ) ? __d( 'cecobois', 'mm' ) : __d( 'cecobois', 'pouces' ); echo $unit; ?></span>)&nbsp;:</label>
						<?php HtmlOutput::input( 'excentricite', $html_excentricite_js, ' mesure_valeur'); ?>
					</li>
				</ul>
			</fieldset>

			<fieldset class="item-container">
				<legend class="title2"><?php echo __d( 'cecobois', 'Charge latérale non pondérée' ); ?></legend>

				<ul>
					<li class="mesure">
						<label><?php echo __d( 'cecobois', 'Vent' ); ?> (<span class="mesure_unite"><?php $unit = ( $post->systeme == "met" ) ? __d( 'cecobois', 'kN/m' ) : __d( 'cecobois', 'lb/pi<sup>2</sup>' ); echo $unit; ?></span>)&nbsp;:</label>
						<?php HtmlOutput::input( 'vent', $html_vent_js, ' mesure_valeur' ); ?>
					</li>
				</ul>
			</fieldset>

			<fieldset class="item-container">
				<legend class="title2"><?php echo __d( 'cecobois', 'Limites de flèche' ); ?></legend>

				<ul>
					<li>
						<label><?php echo __d( 'cecobois', 'Sous la surcharge' ) . '/' . __d( 'cecobois', 'vent' ); ?>&nbsp;:</label>
						<?php HtmlOutput::select( 'fleche_surcharge', $html_fleche_surcharge, $html_fleche_surcharge_value, $html_fleche_surcharge_js ); ?>
					</li>
					<li>
						<label><?php echo __d( 'cecobois', 'Sous la charge totale' ); ?>&nbsp;:</label>
						<?php HtmlOutput::select( 'fleche_charge_totale', $html_fleche_charge_totale, $html_fleche_charge_totale_value,$html_fleche_charge_totale_js ); ?>
					</li>
				</ul>
			</fieldset>

			<input type="hidden" name="name" value="ouvertures">
			<input type="hidden" name="action" value="verif" />
			<?php if( $post->action != "print" ): ?>
			<input type="submit" value="<?php echo __d( 'cecobois', 'Calculer' ); ?>" class="btn" />
			<?php endif;?>
		</form>
	</div>
</div>