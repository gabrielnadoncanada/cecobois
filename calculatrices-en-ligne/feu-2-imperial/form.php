
<div class="list-wide main-title top">
	<p>* <?php echo __d( 'cecobois', 'Tous les champs munis d\'un astérisque doivent être remplis.' ); ?></p>
</div>

<div class="left project-left calculator-container">
	<div class="form">
		<form name="calcul" method="post" id="calc">
			<fieldset class="item-container">
				<ul id="table_content">
					<li>
						<label><?php echo __d( 'cecobois', 'Système' ); ?></label>

						<?php HtmlOutput::radio( 'systeme',$html_systeme,$html_systeme_value,$html_systeme_js);?>
					</li>

					<li id="tr_type_constr" style="<?php echo $html_type_constr_css; ?>">
						<label><span class="ast">*&nbsp;</span><?php echo __d( 'cecobois', 'Type de construction' ); ?></label>

						<?php HtmlOutput::radio( 'type_constr',$html_type_constr,$html_type_constr_value,$html_type_constr_js);?>
					</li>

					<li id="tr_syst_struc1" style="<?php echo $html_syst_struc1_css; ?>">
						<label><span class="ast">*&nbsp;</span><?php echo __d( 'cecobois', 'Système structural' ); ?></label>

						<?php HtmlOutput::select( 'syst_struc1',$html_syst_struc1,$html_syst_struc1_value,$html_syst_struc1_js);?>
					</li>

					<li id="tr_porteur" style="<?php echo $html_porteur_css; ?>">
						<label><span class="ast">*&nbsp;</span><?php echo __d( 'cecobois', 'Porteur' ); ?></label>

						<?php HtmlOutput::radio('porteur',$html_porteur,$html_porteur_value,$html_porteur_js);?>
					</li>

					<li id="tr_espacement1" style="<?php echo $html_espacement1_css; ?>">
						<label><span class="ast">*&nbsp;</span><?php echo __d( 'cecobois', 'Espacement' ); ?>&nbsp;(<span class="mesure_unite"><?php $unit = ($post->systeme == "met") ? __d( 'cecobois', 'mm' ) : __d( 'cecobois', 'pouces' ); echo $unit;?></span>)</label>

						<?php HtmlOutput::select('espacement1',$html_espacement1,$html_espacement1_value,$html_espacement1_js);?>
					</li>

					<li id="tr_paroi1" style="<?php echo $html_paroi1_css; ?>">
						<label><span class="ast">*&nbsp;</span><?php echo __d( 'cecobois', 'Paroi' ); ?>&nbsp;(<span class="mesure_unite"><?php $unit = ($post->systeme == "met") ? __d( 'cecobois', 'mm' ) : __d( 'cecobois', 'pouces' ); echo $unit;?></span>)</label>

						<?php HtmlOutput::select('paroi1',$html_paroi1,$html_paroi1_value,$html_paroi1_js);?>
					</li>

					<li id="tr_isolant1" style="<?php echo $html_isolant1_css; ?>">
						<label><span class="ast">*&nbsp;</span><?php echo __d( 'cecobois', 'Isolant' ); ?></label>

						<?php HtmlOutput::select('isolant1',$html_isolant1,$html_isolant1_value,$html_isolant1_js);?>
					</li>

					<li id="tr_espacement2" style="<?php echo $html_espacement2_css; ?>">
						<label><span class="ast">*&nbsp;</span><?php echo __d( 'cecobois', 'Espacement' ); ?></label>

						<?php HtmlOutput::select('espacement2',$html_espacement2,$html_espacement2_value,$html_espacement2_js);?>
					</li>

					<li id="tr_paroi2" style="<?php echo $html_paroi2_css; ?>">
						<label><span class="ast">*&nbsp;</span><?php echo __d( 'cecobois', 'Paroi' ); ?></label>

						<?php HtmlOutput::select('paroi2',$html_paroi2,$html_paroi2_value,$html_paroi2_js);?>
					</li>

					<li id="tr_isolant2" style="<?php echo $html_isolant2_css; ?>">
						<label><span class="ast">*&nbsp;</span><?php echo __d( 'cecobois', 'Isolant' ); ?></label>

						<?php HtmlOutput::select('isolant2',$html_isolant2,$html_isolant2_value,$html_isolant2_js);?>
					</li>

					<li id="tr_paroi3" style="<?php echo $html_paroi3_css; ?>">
						<label><span class="ast">*&nbsp;</span><?php echo __d( 'cecobois', 'Paroi' ); ?></label>

						<?php HtmlOutput::select('paroi3',$html_paroi3,$html_paroi3_value,$html_paroi3_js);?>
					</li>

					<li id="tr_paroi4" style="<?php echo $html_paroi4_css; ?>">
						<label><span class="ast">*&nbsp;</span><?php echo __d( 'cecobois', 'Paroi' ); ?></label>

						<?php HtmlOutput::select('paroi4',$html_paroi4,$html_paroi4_value,$html_paroi4_js);?>
					</li>

					<li id="tr_paroi5" style="<?php echo $html_paroi5_css; ?>">
						<label><span class="ast">*&nbsp;</span><?php echo __d( 'cecobois', 'Paroi' ); ?></label>

						<?php HtmlOutput::select('paroi5',$html_paroi5,$html_paroi5_value,$html_paroi5_js);?>
					</li>

					<li id="tr_syst_struc2" style="<?php echo $html_syst_struc2_css; ?>">
						<label><span class="ast">*&nbsp;</span><?php echo __d( 'cecobois', 'Système structural' ); ?></label>

						<?php HtmlOutput::select('syst_struc2',$html_syst_struc2,$html_syst_struc2_value,$html_syst_struc2_js);?>
					</li>

					<li id="tr_elements1" style="<?php echo $html_elements1_css; ?>">
						<label><span class="ast">*&nbsp;</span><?php echo __d( 'cecobois', 'Éléments' ); ?></label>

						<?php HtmlOutput::select('elements1',$html_elements1,$html_elements1_value,$html_elements1_js);?>
					</li>

					<li id="tr_dimensions1" style="<?php echo $html_dimensions1_css; ?>">
						<label><span class="ast">*&nbsp;</span><?php echo __d( 'cecobois', 'Dimensions' ); ?></label>

						<?php HtmlOutput::select('dimensions1',$html_dimensions1,$html_dimensions1_value,$html_dimensions1_js);?>
					</li>

					<li id="tr_paroi6" style="<?php echo $html_paroi6_css; ?>">
						<label><span class="ast">*&nbsp;</span><?php echo __d( 'cecobois', 'Paroi' ); ?></label>

						<?php HtmlOutput::select('paroi6',$html_paroi6,$html_paroi6_value,$html_paroi6_js);?>
					</li>

					<li id="tr_dimensions2" style="<?php echo $html_dimensions2_css; ?>">
						<label><span class="ast">*&nbsp;</span><?php echo __d( 'cecobois', 'Dimensions' ); ?></label>

						<?php HtmlOutput::select('dimensions2',$html_dimensions2,$html_dimensions2_value,$html_dimensions2_js);?>
					</li>

					<li id="tr_paroi7" style="<?php echo $html_paroi7_css; ?>">
						<label><span class="ast">*&nbsp;</span><?php echo __d( 'cecobois', 'Paroi' ); ?></label>

						<?php HtmlOutput::select('paroi7',$html_paroi7,$html_paroi7_value,$html_paroi7_js);?>
					</li>

					<li id="tr_elements2" style="<?php echo $html_elements2_css; ?>">
						<label><span class="ast">*&nbsp;</span><?php echo __d( 'cecobois', 'Éléments' ); ?></label>

						<?php HtmlOutput::select('elements2',$html_elements2,$html_elements2_value,$html_elements2_js);?>
					</li>

					<li id="tr_dimensions3" style="<?php echo $html_dimensions3_css; ?>">
						<label><span class="ast">*&nbsp;</span><?php echo __d( 'cecobois', 'Dimensions' ); ?></label>

						<?php HtmlOutput::select('dimensions3',$html_dimensions3,$html_dimensions3_value,$html_dimensions3_js);?>
					</li>

					<li id="tr_paroi8" style="<?php echo $html_paroi8_css; ?>">
						<label><span class="ast">*&nbsp;</span><?php echo __d( 'cecobois', 'Paroi' ); ?></label>

						<?php HtmlOutput::select('paroi8',$html_paroi8,$html_paroi8_value,$html_paroi8_js);?>
					</li>

					<li id="tr_dimensions4" style="<?php echo $html_dimensions4_css; ?>">
						<label><span class="ast">*&nbsp;</span><?php echo __d( 'cecobois', 'Dimensions' ); ?></label>

						<?php HtmlOutput::select('dimensions4',$html_dimensions4,$html_dimensions4_value,$html_dimensions4_js);?>
					</li>

					<li id="tr_paroi9" style="<?php echo $html_paroi9_css; ?>">
						<label><span class="ast">*&nbsp;</span><?php echo __d( 'cecobois', 'Paroi' ); ?></label>

						<?php HtmlOutput::select('paroi9',$html_paroi9,$html_paroi9_value,$html_paroi9_js);?>
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
		<?php /*<img src="/calculatrices-en-ligne/img/calculators/feu-2-imperial/schema.jpg" alt="<?php echo __d( 'cecobois', 'Schéma' ); ?>" /> */ ?>
	</div>
</div>