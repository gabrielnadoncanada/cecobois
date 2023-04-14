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
						<label><span class="ast">*</span> <?php echo __d( 'cecobois', 'Type d\'élément porteur' ); ?></label>

						<?php HtmlOutput::radio('type_element',$html_type_element,$html_type_element_value,$html_type_element_js);?>
					</li>

					<li class="mesure">
						<label><span class="ast">*</span> <?php echo __d( 'cecobois', 'Largeur, B' ); ?> (<span class="mesure_unite"><?php $unit = ($post->systeme == "met") ? 'mm' : 'pouces'; echo $unit;?></span>)</label>

						<?php HtmlOutput::input('largeur',$html_largeur_js,' mesure_valeur');?>
					</li>

					<li class="mesure">
						<label><span class="ast">*</span> <?php echo __d( 'cecobois', 'Profondeur, D' ); ?> (<span class="mesure_unite"><?php $unit = ($post->systeme == "met") ? 'mm' : 'pouces'; echo $unit;?></span>)</label>

						<?php HtmlOutput::input('profondeur',$html_largeur_js,' mesure_valeur');?>
					</li>

					<li class="mesure">
						<label><span class="ast">*</span> <?php echo __d( 'cecobois', 'Portée/Hauteur, L' ); ?> (<span class="mesure_unite"><?php $unit = ($post->systeme == "met") ? 'm' : 'pieds'; echo $unit;?></span>)</label>

						<?php HtmlOutput::input('portee',$html_portee_js,' mesure_valeur')?>
					</li>

					<li>
						<label><span class="ast">*</span> <?php echo __d( 'cecobois', 'Coefficient de longueur, K<sub>e</sub>' ); ?></label>

						<?php HtmlOutput::select('coef',$html_coef,$html_coef_value,$html_coef_js);?>
					</li>

					<li>
						<label><span class="ast">*</span> <?php echo __d( 'cecobois', 'Exposition' ); ?></label>

						<?php HtmlOutput::radio('faces',$html_faces,$html_faces_value,$html_faces_js);?>
					</li>

					<li>
						<label><span class="ast">*</span> <?php echo __d( 'cecobois', 'Ratio de sollicitation' ); ?><?php /*if( $post->action=="send" || $post->action=="verif" || $post->action=="print" ){ echo '<sup>(3)</sup>';}*/?> (%)</label>

						<?php HtmlOutput::input('sollicitation',$html_sollicitation_js,'');?>
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
		<?php $diagramPath = '/calculatrices-en-ligne/img/calculators/feu-imperial/schema.png'; ?>
		<img src="<?php echo $diagramPath; ?>" alt="<?php echo __d( 'cecobois', 'Schéma' ); ?>" />
	</div>
</div>