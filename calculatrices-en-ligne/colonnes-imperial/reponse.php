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
			<td<?PHP echo $output_style->flexion;?>><?= number_format($output_ratio->flexion, '0', ',', ''); ?>%</td>
			<td class="note"><?php echo __d( 'cecobois', 'Article' ); ?> <?php echo $output_article->flexion;?></td>
		</tr>

		<tr>
			<td class="titre">Compression de fil <?php if($post->systeme == 'imp'): echo '(lb)'; else: echo '(kN)'; endif; ?></td>
			<td><?php if($post->systeme == 'imp'): echo number_format($output->compression_app, '0', ',', ''); else: echo number_format($output->compression_app, '2', ',', ''); endif; ?></td>
			<td><?php if($post->systeme == 'imp'): echo number_format($output->compression_res, '0', ',', ''); else: echo number_format($output->compression_res, '2', ',', ''); endif; ?></td>
			<td><?php echo __d( 'cecobois', 'P<sub>f</sub> / P<sub>R</sub>' ); ?></td>
			<td<?PHP echo $output_style->compression;?>><?= number_format($output_ratio->compression, '0', ',', ''); ?>%</td>
			<td class="note"><?php echo __d( 'cecobois', 'Article' ); ?> <?php echo $output_article->compression;?></td>
		</tr>

		<tr>
			<td class="titre">Cisaillement <?php if($post->systeme == 'imp'): echo '(lb)'; else: echo '(kN)'; endif; ?></td>
			<td><?php if($post->systeme == 'imp'): echo number_format($output->cisaillement_app, '0', ',', ''); else: echo number_format($output->cisaillement_app, '2', ',', ''); endif; ?></td>
			<td><?php if($post->systeme == 'imp'): echo number_format($output->cisaillement_res, '0', ',', ''); else: echo number_format($output->cisaillement_res, '2', ',', ''); endif; ?></td>
			<td><?php echo __d( 'cecobois', 'V<sub>f</sub> / V<sub>R</sub>' ); ?></td>
			<td<?PHP echo $output_style->cisaillement;?>><?= number_format($output_ratio->cisaillement, '0', ',', ''); ?>%</td>
			<td class="note"><?php echo __d( 'cecobois', 'Article' ); ?> <?php echo $output_article->cisaillement;?></td>
		</tr>

		<tr>
			<td class="titre" style="border:none;">Efforts combinés <?php if($post->systeme == 'imp'): echo '(lb et lb-pi)'; else: echo '(kN et kN-m)'; endif; ?></td>
			<td style="border:none;"><?php if($post->systeme == 'imp'): echo number_format($output->efforts_p_app, '0', ',', ''); else: echo number_format($output->efforts_p_app, '2', ',', ''); endif; ?></td>
			<td style="border:none;"><?php if($post->systeme == 'imp'): echo number_format($output->efforts_p_res, '0', ',', ''); else: echo number_format($output->efforts_p_res, '2', ',', ''); endif; ?></td>
			<td rowspan="2"><?php echo __d( 'cecobois', '(P<sub>f</sub>&nbsp;/&nbsp;P<sub>R</sub>)<sup>2</sup><br />+ (M<sub>f</sub>&nbsp;/&nbsp;M<sub>R</sub>)' ); ?></td>
			<td rowspan="2"<?= $output_style->efforts; ?>><?= number_format($output_ratio->efforts, '0', ',', ''); ?>%</td>
			<td class="note" rowspan="2"><?php echo __d( 'cecobois', 'Article' ); ?> <?php echo $output_article->efforts;?><br /><?php if($mfCombPos == 'mid'): echo __d( 'cecobois', 'Moment appliqué amplifié de' ); echo $output_note->moment; echo __d( 'cecobois', '(effet P - &Delta;)' ); endif; ?></td>
		</tr>

		<tr>
			<td>&nbsp;</td>
			<td><?php if($post->systeme == 'imp'): echo number_format($output->efforts_m_app, '0', ',', ''); else: echo number_format($output->efforts_m_app, '2', ',', ''); endif; ?></td>
			<td><?php if($post->systeme == 'imp'): echo number_format($output->efforts_m_res, '0', ',', ''); else: echo number_format($output->efforts_m_res, '2', ',', ''); endif; ?></td>
		</tr>

		<tr>
			<td class="titre">Flèche sous la surcharge/neige/vent <?php if($post->systeme == 'imp'): echo '(po)'; else: echo '(mm)'; endif; ?></td>
			<td><?php if($post->systeme == 'imp'): echo number_format($output->fleche_surcharge_app, '3', ',', ''); else: echo number_format($output->fleche_surcharge_app, '1', ',', ''); endif; ?></td>
			<td><?php if($post->systeme == 'imp'): echo number_format($output->fleche_surcharge_res, '3', ',', ''); else: echo number_format($output->fleche_surcharge_res, '1', ',', ''); endif; ?></td>
			<td>L / <?PHP echo $output_ratioTxt->surcharge; ?></td>
			<td<?PHP echo $output_style->fleche_surcharge;?>><?= number_format($output_ratio->fleche_surcharge, '0', ',', ''); ?>%</td>
			<td class="note"><?php echo __d( 'cecobois', 'Flèche amplifiée de' ); ?> <?PHP echo number_format($output_note->fleche_surcharge, '2', ',', '');?> (effet P - &Delta;)</td>
		</tr>

		<tr>
			<td class="titre">Flèche sous la charge totale <?php if($post->systeme == 'imp'): echo '(po)'; else: echo '(mm)'; endif; ?></td>
			<td><?php if($post->systeme == 'imp'): echo number_format($output->fleche_charge_tot_app, '3', ',', ''); else: echo number_format($output->fleche_charge_tot_app, '1', ',', ''); endif; ?></td>
			<td><?php if($post->systeme == 'imp'): echo number_format($output->fleche_charge_tot_res, '3', ',', ''); else: echo number_format($output->fleche_charge_tot_res, '1', ',', ''); endif; ?></td>
			<td>L / <?PHP echo $output_ratioTxt->charge_tot; ?></td>
			<td<?PHP echo $output_style->fleche_charge_tot;?>><?= number_format($output_ratio->fleche_charge_tot, '0', ',', ''); ?>%</td>
			<td class="note"><?php echo __d( 'cecobois', 'Flèche amplifiée de' ); ?> <?PHP echo number_format($output_note->fleche_totale, '2', ',', '');?> (effet P - &Delta;)</td>
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
			<li><?php echo __d( 'cecobois', 'Le calcul présume que les colonnes sont en bois non traité (K<sub>T</sub> = 1,00) utilisées en milieu sec (K<sub>s</sub> = 1,00).' ); ?></li>
			<li><?php echo __d( 'cecobois', 'La charge latérale de vent est appliquée sur la largeur «b» des éléments.' ); ?></li>
			<li><?php echo __d( 'cecobois', 'L\'excentricité de la charge axiale est appliquée dans le sens de la profondeur «d» des éléments.' ); ?></li>
			<li><?php echo __d( 'cecobois', 'L\'effet P-&Delta; est appliqué dans le même sens que la pression de vent afin d\'amplifier les efforts latéraux.' ); ?></li>
			<li><?php echo __d( 'cecobois', 'Pour les sections composées de plusieurs plis, le coefficient de stabilité latérale en flexion (KL) est calculé selon la section 6.5.6.4 (CSA O86-09) ou 7.5.6.4 (CSA O68-14) en utilisant les dimensions d’une section pleine équivalente plutôt que les dimensions individuelles d’un pli.' ); ?></li>
			<li><?php echo __d( 'cecobois', 'Pour de plus amples informations sur les colonnes en bois, veuillez communiquer avec les conseillers techniques par courriel à' ); ?> <a href="mailto:info@cecobois.com">info@cecobois.com</a>.</li>
		</ol>
	</div>

	<div id="avertissement">
		<h3><?php echo __d( 'cecobois', 'Avertissement' ); ?></h3>

		<p><?php echo __d( 'cecobois', 'Bien que tous les efforts aient été faits pour assurer que les informations et les calculs soient précis et complets, Cecobois ne garantit pas les performances ou les résultats que vous pourriez obtenir en utilisant la Calculatrice. La Calculatrice n\'a pas pour but de remplacer le jugement des professionnels et vous est fournie «tel quel», sans garantie de quelque sorte. En aucun cas, Cecobois, ses administrateurs, employés et actionnaires ne peuvent être tenus responsables de quelque perte ou dommage que ce soit découlant de l\'utilisation de la Calculatrice ou d\'une incapacité à l\'utiliser, et ce, peu importe que Cecobois ait ou n\'ait pas été avisé de la possibilité de tels dommages.' ); ?></p>
	</div>

    <a href="./colonnes-imperial" class="btn-prev"><?php echo __d( 'cecobois', 'Retour à la calculatrice' ); ?></a>
</div>