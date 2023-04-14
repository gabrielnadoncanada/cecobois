<div class="buttonheading calculator-print">
    <a class="btn-print" href="#" title="<?php echo __d( 'cecobois', 'Imprimer' ); ?>" onclick="window.print();"><?php echo __d( 'cecobois', 'Imprimer' ); ?></a>
</div>
<div class="left full main-content" id="reponse">
	<h2><?php echo __d( 'cecobois', 'Analyses selon CNB 2015 & CSA O86-14 — Calcul aux états limites' ); ?></h2>

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
			<td<?PHP echo $output_style->flexion;?>><?= number_format($output_ratio->flexion, 0, '.', ''); ?>%</td>
			<td class="note"><?php echo __d( 'cecobois', 'Article' ).' '.$output->articles['flexion']; ?></td>
		</tr>

		<tr>
			<td class="titre">Compression de fil <?php if($post->systeme == 'imp'): echo '(lb)'; else: echo '(kN)'; endif; ?></td>
			<td><?php if($post->systeme == 'imp'): echo number_format($output->compression_app, '0', ',', ''); else: echo number_format($output->compression_app, '2', ',', ''); endif; ?></td>
			<td><?php if($post->systeme == 'imp'): echo number_format($output->compression_res, '0', ',', ''); else: echo number_format($output->compression_res, '2', ',', ''); endif; ?></td>
			<td><?php echo __d( 'cecobois', 'P<sub>f</sub> / P<sub>R</sub>' ); ?></td>
			<td<?PHP echo $output_style->compression;?>><?= number_format($output_ratio->compression, 0, '.', ''); ?>%</td>
			<td class="note"><?php echo __d( 'cecobois', 'Article' ).' '.$output->articles['compression']; ?></td>
		</tr>

		<tr>
			<td class="titre">Cisaillement <?php if($post->systeme == 'imp'): echo '(lb)'; else: echo '(kN)'; endif; ?></td>
			<td><?php if($post->systeme == 'imp'): echo number_format($output->cisaillement_app, '0', ',', ''); else: echo number_format($output->cisaillement_app, '2', ',', ''); endif; ?></td>
			<td><?php if($post->systeme == 'imp'): echo number_format($output->cisaillement_res, '0', ',', ''); else: echo number_format($output->cisaillement_res, '2', ',', ''); endif; ?></td>
			<td><?php echo __d( 'cecobois', 'V<sub>f</sub> / V<sub>R</sub>' ); ?></td>
			<td<?PHP echo $output_style->cisaillement;?>><?= number_format($output_ratio->cisaillement, 0, '.', ''); ?>%</td>
			<td class="note"><?php echo __d( 'cecobois', 'Article' ).' '.$output->articles['cisaillement']; ?></td>
		</tr>

		<tr>
			<td class="titre" style="border:none;">Efforts combinés <?php if($post->systeme == 'imp'): echo '(lb & lb-pi)'; else: echo '(kN & kN-m)'; endif; ?></td>
			<td style="border:none;"><?php if($post->systeme == 'imp'): echo number_format($output->efforts_p_app, '0', ',', ''); else: echo number_format($output->efforts_p_app, '2', ',', ''); endif; ?></td>
			<td style="border:none;"><?php if($post->systeme == 'imp'): echo number_format($output->efforts_p_res, '0', ',', ''); else: echo number_format($output->efforts_p_res, '2', ',', ''); endif; ?></td>
			<td rowspan="2"><?php echo __d( 'cecobois', '(P<sub>f</sub>&nbsp;/&nbsp;P<sub>R</sub>)<sup>2</sup><br />+ (M<sub>f</sub>&nbsp;/&nbsp;M<sub>R</sub>)' ); ?></td>
			<td rowspan="2"<?PHP echo $output_style->efforts;?>><?= number_format($output_ratio->efforts, 0, '.', ''); ?>%</td>
			<td class="note" rowspan="2"><?php echo __d( 'cecobois', 'Article' ).' '.$output->articles['efforts']; ?><br /><?php echo __d( 'cecobois', 'Moment appliqué amplifié de' ) . ' ' . $output_note->moment . ' ' . __d( 'cecobois', '(effet P - &Delta;)' ); ?></td>
		</tr>

		<tr>
			<td>&nbsp;</td>
			<td><?php if($post->systeme == 'imp'): echo number_format($output->efforts_m_app, '0', ',', ''); else: echo number_format($output->efforts_m_app, '2', ',', ''); endif; ?></td>
			<td><?php if($post->systeme == 'imp'): echo number_format($output->efforts_m_res, '0', ',', ''); else: echo number_format($output->efforts_m_res, '2', ',', ''); endif; ?></td>
		</tr>

		<tr>
			<td class="titre">Écrasement de la lisse basse <?php if($post->systeme == 'imp'): echo '(lb)'; else: echo '(kN)'; endif; ?></td>
			<td><?php if($post->systeme == 'imp'): echo number_format($output->pf, '0', ',', ''); else: echo number_format($output->pf, '2', ',', ''); endif; ?></td>
			<td><?php if($post->systeme == 'imp'): echo number_format($output->qr, '0', ',', ''); else: echo number_format($output->qr, '2', ',', ''); endif; ?></td>
			<td>Pf / Qr</td>
			<td<?PHP echo $output_style->lisse;?>><?= number_format($output_ratio->lisse, 0, '.', ''); ?>%</td>
			<td class="note"><?php echo __d( 'cecobois', 'Article' ).' '.$output->articles['lisse']; ?></td>
		</tr>


		<tr>
			<td class="titre">Flèche sous la surcharge/neige/vent <?php if($post->systeme == 'imp'): echo '(po)'; else: echo '(mm)'; endif; ?></td>
			<td><?php if($post->systeme == 'imp'): echo number_format($output->fleche_surcharge_app, '3', ',', ''); else: echo number_format($output->fleche_surcharge_app, '1', ',', ''); endif; ?></td>
			<td><?php if($post->systeme == 'imp'): echo number_format($output->fleche_surcharge_res, '3', ',', ''); else: echo number_format($output->fleche_surcharge_res, '1', ',', ''); endif; ?></td>
			<td>L / <?= number_format($output_ratioTxt->surcharge, 0, '.', ''); ?></td>
			<td<?PHP echo $output_style->fleche_surcharge;?>><?= number_format($output_ratio->fleche_surcharge, 0, '.', ''); ?>%</td>
			<td class="note"><?php echo __d( 'cecobois', 'Article' ).' '.$output->articles['surcharge']; ?><br /><?php echo __d( 'cecobois', 'Flèche amplifiée de' ) . ' ' . $output_note->fleche_surcharge . ' ' . __d( 'cecobois', '(effet P - &Delta;)' ); ?></td>
		</tr>

		<tr>
			<td class="titre">Flèche sous la charge total <?php if($post->systeme == 'imp'): echo '(po)'; else: echo '(mm)'; endif; ?></td>
			<td><?php if($post->systeme == 'imp'): echo number_format($output->fleche_charge_tot_app, '3', ',', ''); else: echo number_format($output->fleche_charge_tot_app, '1', ',', ''); endif; ?></td>
			<td><?php if($post->systeme == 'imp'): echo number_format($output->fleche_charge_tot_res, '3', ',', ''); else: echo number_format($output->fleche_charge_tot_res, '1', ',', ''); endif; ?></td>
			<td>L / <?= number_format($output_ratioTxt->charge_tot, 0, '.', ''); ?></td>
			<td<?PHP echo $output_style->fleche_charge_tot;?>><?= number_format($output_ratio->fleche_charge_tot, 0, '.', ''); ?>%</td>
			<td class="note"><?php echo __d( 'cecobois', 'Article' ).' '.$output->articles['total']; ?><br /><?php echo __d( 'cecobois', 'Flèche amplifiée de' ) . ' ' . $output_note->fleche_totale . ' ' . __d( 'cecobois', '(effet P - &Delta;)' ); ?></td>
		</tr>
		<?php /* ?>
		<tr>
			<td colspan="6" style="border:none;"></td>
		</tr>
		<tr>
			<td class="titre"><?php echo __d( 'cecobois', 'Volume de bois au mètre linaire' ); ?></td>
			<td class="titre" colspan="5"><?PHP echo $output->volume_bois;?> m<sup>3</sup> / <?php echo __d( 'cecobois', 'm linéaire de mur' ) . ' (' . $output->pmp . ' ' . __d( 'cecobois', 'pmp / pied linéaire' ) . ')'; ?></td>
		</tr>
		<?php */ ?>
	</table>

	<div id="note">
		<h3><?php echo __d( 'cecobois', 'Notes' ); ?></h3>

		<ol>
			<li><?php echo __d( 'cecobois', 'Le calcul des montants s’effectue conformément à la norme CSA O86-14.' ); ?></li>
			<li><?php echo __d( 'cecobois', 'Le calcul des montants présume qu\'un revêtement soit fixé sur la face étroite des montants sur au moins un côté et sur toute leur longueur, prévenant ainsi le flambage selon l\'axe faible (article 6.5.6.5). Le calcul présume également que ce revêtement assure la stabilité latérale sous les efforts de flexion (K<sub>L</sub> = 1,00).' ); ?></li>
			<li><?php echo __d( 'cecobois', 'Le calcul des montants présume que le bois est non traité (K<sub>T</sub> = 1,00) utilisé en milieu sec (K<sub>s</sub> = 1,00).' ); ?></li>
			<li><?php echo __d( 'cecobois', 'Le présent outil de calcul des montants ne vérifie pas la résistance en flexion, en cisaillement et la déformation de la sablière.' ); ?></li>
			<li><?php echo __d( 'cecobois', 'L\'effet P-&Delta; est appliqué dans le même sens que la pression de vent afin d\'amplifier les efforts de flexion et les flèches.' ); ?></li>
			<li><?php echo __d( 'cecobois', 'Pour de plus amples informations sur les murs en ossature de bois, veuillez communiquer avec les conseillers techniques par courriel à' ); ?> <a href="mailto:info@cecobois.com">info@cecobois.com</a>.</li>
		</ol>
	</div>

	<div id="avertissement">
		<h3><?php echo __d( 'cecobois', 'Avertissement' ); ?></h3>

		<p><?php echo __d( 'cecobois', 'Bien que tous les efforts aient été faits pour assurer que les informations et les calculs soient précis et complets, Cecobois ne garantit pas les performances ou les résultats que vous pourriez obtenir en utilisant la Calculatrice. La Calculatrice n\'a pas pour but de remplacer le jugement des professionnels et vous est fournie «tel quelle», sans garantie de quelque sorte. En aucun cas, Cecobois, ses administrateurs, employés et actionnaires ne peuvent être tenus responsables de quelque perte ou dommage que ce soit découlant de l\'utilisation de la Calculatrice ou d\'une incapacité à l\'utiliser, et ce, peu importe que Cecobois ait ou n\'ait pas été avisé de la possibilité de tels dommages.' ); ?></p>
	</div>

	<a href="./mur-imperial" class="btn-prev"><?php echo __d( 'cecobois', 'Retour à la calculatrice' ); ?></a>
</div>