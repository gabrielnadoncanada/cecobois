<div class="buttonheading calculator-print">
    <a class="btn-print" href="#" title="<?php echo __d( 'cecobois', 'Imprimer' ); ?>" onclick="window.print();"><?php echo __d( 'cecobois', 'Imprimer' ); ?></a>
</div>
<div class="left full main-content" id="reponse">
	<h2>Analyses selon CSA O86-14 et CNB 2015 — Calculs aux états limites</h2>

	<table id="result" cellpadding="0" cellspacing="0">
		<tr>
			<td class="titre">&nbsp;</td>
			<td class="titre"><?php echo __d( 'cecobois', 'Appliqués' ); ?></td>
			<td class="titre"><?php echo __d( 'cecobois', 'Résistants' ); ?></td>
			<td colspan="2"><?php echo __d( 'cecobois', 'Ratio' ); ?></td>
			<td class="note"><?php echo __d( 'cecobois', 'Notes' ); ?></td>
		</tr>

		<tr>
			<td class="titre">Flexion <?php if($post->systeme == 'imp'): echo '(lb-pi)'; else: echo '(kN-m)'; endif; ?></td>
			<td><?php if($post->systeme == 'imp'): echo number_format($output->flexion_app, '0', ',', ''); else: echo number_format($output->flexion_app, '2', ',', ''); endif; ?></td>
			<td><?php if($post->systeme == 'imp'): echo number_format($output->flexion_res, '0', ',', ''); else: echo number_format($output->flexion_res, '2', ',', ''); endif; ?></td>
			<td><?php echo __d( 'cecobois', 'M<sub>f</sub> / M<sub>R</sub>' ); ?></td>
			<td<?PHP echo $output_style->flexion;?>><?PHP echo number_format($output_ratio->flexion, '0', ',', '');?>%</td>
			<td class="note"><?php echo __d( 'cecobois', 'Article' ); ?> <?php echo $output_article->flexion;?></td>
		</tr>

		<?php if( $post->type_bois == "bois_blc" || $post->type_bois == "bois_blc_nordic"): ?>
		<tr>
			<?php /*<td class="titre" rowspan="2">Cisaillement <?php if($post->systeme == 'imp'): echo '(lb)'; else: echo '(kN)'; endif; ?></td>*/?>
			<td class="titre">Cisaillement <?php if($post->systeme == 'imp'): echo '(lb)'; else: echo '(kN)'; endif; ?></td>
			<td><?php if($post->systeme == 'imp'): echo number_format($output->cisaillement_w_app, '0', ',', ''); else: echo number_format($output->cisaillement_w_app, '2', ',', ''); endif; ?></td>
			<td><?php if($post->systeme == 'imp'): echo number_format($output->cisaillement_w_res, '0', ',', ''); else: echo number_format($output->cisaillement_w_res, '2', ',', ''); endif; ?></td>
			<td><?php echo __d( 'cecobois', 'W<sub>f</sub> / W<sub>R</sub>' ); ?></td>
			<td<?PHP echo $output_style->cisaillement_w;?>><?PHP echo number_format($output_ratio->cisaillement_w, '0', ',', '');?>%</td>
			<td class="note"><?php echo __d( 'cecobois', 'Article' ); ?> <?php echo $output_article->cisaillement_w;?></td>
		</tr>
		<?php /*<tr>
			<td><?php if($post->systeme == 'imp'): echo number_format($output->cisaillement_app, '0', ',', ''); else: echo number_format($output->cisaillement_app, '2', ',', ''); endif; ?></td>
			<td><?php if($post->systeme == 'imp'): echo number_format($output->cisaillement_res, '0', ',', ''); else: echo number_format($output->cisaillement_res, '2', ',', ''); endif; ?></td>
			<td><?php echo __d( 'cecobois', 'V<sub>f</sub> @d / V<sub>R</sub>' ); ?></td>
			<td<?PHP echo $output_style->cisaillement;?>><?PHP echo number_format($output_ratio->cisaillement, '0', ',', '');?>%</td>
			<td class="note"><?php echo __d( 'cecobois', 'Article' ); ?> <?php echo $output_article->cisaillement;?></td>
		</tr>*/ ?>
		<?php else: ?>
		<tr>
			<td class="titre">Cisaillement <?php if($post->systeme == 'imp'): echo '(lb)'; else: echo '(kN)'; endif; ?></td>
			<td><?php if($post->systeme == 'imp'): echo number_format($output->cisaillement_app, '0', ',', ''); else: echo number_format($output->cisaillement_app, '2', ',', ''); endif; ?></td>
			<td><?php if($post->systeme == 'imp'): echo number_format($output->cisaillement_res, '0', ',', ''); else: echo number_format($output->cisaillement_res, '2', ',', ''); endif; ?></td>
			<td><?php echo __d( 'cecobois', 'V<sub>f</sub> @d / V<sub>R</sub>' ); ?></td>
			<td<?PHP echo $output_style->cisaillement;?>><?PHP echo number_format($output_ratio->cisaillement, '0', ',', '');?>%</td>
			<td class="note"><?php echo __d( 'cecobois', 'Article' ); ?> <?php echo $output_article->cisaillement;?></td>
		</tr>
		<?php endif; ?>

		
		<tr>
			<td class="titre">Longueur d'appui minimale <?php if($post->systeme == 'imp'): echo '(po)'; else: echo '(mm)'; endif; ?></td>
			<td colspan="5" class="note">Les hypothèses de cette calculatrice sont trop simplifiées pour cette analyse. Vérifier la poutre et la longueur d'appui avec un logiciel de structure complet (voir notes)</td>
		</tr>

		<tr>
			<td class="titre">Flèche sous la surcharge/neige/vent <?php if($post->systeme == 'imp'): echo '(po)'; else: echo '(mm)'; endif; ?></td>
			<td><?php if($post->systeme == 'imp'): echo number_format($output->fleche_surcharge_app, '3', ',', ''); else: echo number_format($output->fleche_surcharge_app, '1', ',', ''); endif; ?></td>
			<td><?php if($post->systeme == 'imp'): echo number_format($output->fleche_surcharge_res, '3', ',', ''); else: echo number_format($output->fleche_surcharge_res, '1', ',', ''); endif; ?></td>
			<td><?php echo __d( 'cecobois', 'L/' ); ?><?PHP echo number_format($output->fleche_surcharge_app_ratio, '0', ',', '');?></td>
			<td<?PHP echo $output_style->fleche_surcharge;?>><?PHP echo number_format($output_ratio->fleche_surcharge, '0', ',', '');?>%</td>
			<td class="note"><?php echo __d( 'cecobois', 'Article' ); ?> <?php echo $output_article->surcharge;?></td>
		</tr>

		<tr>
			<td class="titre">Flèche sous la charge totale <?php if($post->systeme == 'imp'): echo '(po)'; else: echo '(mm)'; endif; ?></td>
			<td><?php if($post->systeme == 'imp'): echo number_format($output->fleche_charge_tot_app, '3', ',', ''); else: echo number_format($output->fleche_charge_tot_app, '1', ',', ''); endif; ?></td>
			<td><?php if($post->systeme == 'imp'): echo number_format($output->fleche_charge_tot_res, '3', ',', ''); else: echo number_format($output->fleche_charge_tot_res, '1', ',', ''); endif; ?></td>
			<td><?php echo __d( 'cecobois', 'L/' ); ?><?PHP echo number_format($output->fleche_charge_tot_ratio, '0', ',', '');?></td>
			<td<?PHP echo $output_style->fleche_charge_tot;?>><?PHP echo number_format($output_ratio->fleche_charge_tot, '0', ',', '');?>%</td>
			<td class="note"><?php echo __d( 'cecobois', 'Article' ); ?> <?php echo $output_article->charge_tot;?></td>
		</tr>
		<tr>
			<td colspan="6" style="border:none;"></td>
		</tr>
		<!--
		<tr>
			<td class="titre">Volume de bois au mètre linaire</td>
			<td class="titre" colspan="5"><?PHP //echo $output->volume_bois;?> m<sup>3</sup> / m linéaire de mur (<?PHP //echo $output->pmp;?> pmp / pied linéaire)</td>
		</tr>
		-->
	</table>

	<div id="note">
		<h3><?php echo __d( 'cecobois', 'Notes' ); ?></h3>

		<ol>
			<li>
			<?php
				if($post->type_bois == "bois_sciage" || $post->type_bois == "bois_massif" || $post->type_bois == "bois_blc"){
					echo __d( 'cecobois', 'Les résultats sont basés sur les résistances génériques données dans la norme CSA O86 sur les <i>Règles de calculs des charpentes en bois</i>.' );
				}
				else if($post->type_bois == "bois_scl"){
					echo __d( 'cecobois', 'Les résultats sont basés sur les résistances génériques décrites dans le <i>Guide technique sur les poutres et colonnes en gros bois pour la construction commerciale</i> publié par Cecobois. Se référer aux fabricants afin d’obtenir un dimensionnement plus précis en fonction de leurs produits respectifs.' );
				}
				else if($post->type_bois == "bois_blc_nordic"){
					echo __d( 'cecobois', 'Les résultats sont basés sur les résistances publiées dans le rapport d’évaluation CCMC 13216-R. Se référer à la documentation du fabricant afin d’obtenir de plus amples informations sur ce produit.' );
				}
			?>
			</li>
			<li><?php echo __d( 'cecobois', 'Les séries de poutres sont basées sur les résistances génériques données dans la norme CSA O86-14 sur les <i>Règles de calculs des charpentes en bois.</i>' ); ?></li>
			<li><?php echo __d( 'cecobois', 'Cette calculatrice de prédimensionnement ne vérifie pas la résistance à l\'appui d\'extrémité. Référez-vous à la norme CSA O86 ou à d\'autres logiciels tel que Sizer du Conseil Canadien du Bois pour cette analyse (http://woodworks-software.com/canadian-edition/)' ); ?></li>
			<li><?php echo __d( 'cecobois', 'La vérification de la surcharge concentrée conformément à l\'article 4.1.5.9 du CNB n\'est pas effectuée.' ); ?></li>
			<li><?php echo __d( 'cecobois', 'Pour de plus amples informations sur les poutres en bois, veuillez communiquer avec les conseillers techniques par courriel à' ); ?> <a href="mailto:info@cecobois.com">info@cecobois.com</a>.</li>
		</ol>
	</div>

	<div id="avertissement">
		<h3><?php echo __d( 'cecobois', 'Avertissement' ); ?></h3>

		<p><?php echo __d( 'cecobois', 'Bien que tous les efforts aient été faits pour assurer que les informations et les calculs soient précis et complets, Cecobois ne garantit pas les performances ou les résultats que vous pourriez obtenir en utilisant la Calculatrice. La Calculatrice n\'a pas pour but de remplacer le jugement des professionnels et vous est fournie «tel quel», sans garantie de quelque sorte. En aucun cas, Cecobois, ses administrateurs, employés et actionnaires ne peuvent être tenus responsables de quelque perte ou dommage que ce soit découlant de l\'utilisation de la Calculatrice ou d\'une incapacité à l\'utiliser, et ce, peu importe que Cecobois ait ou n\'ait pas été avisé de la possibilité de tels dommages.' ); ?></p>
	</div>

    <a href="./colonnes-imperial" class="btn-prev"><?php echo __d( 'cecobois', 'Retour à la calculatrice' ); ?></a>
</div>