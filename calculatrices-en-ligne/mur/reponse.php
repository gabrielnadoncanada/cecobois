<div class="left full main-content" id="reponse">
	<h2>Analyses selon CSA O86 - Calcul aux &eacute;tats limites</h2>

	<table id="result" cellpadding="0" cellspacing="0">
		<tr>
			<td class="titre">&nbsp;</td>
			<td class="titre">Appliqu&eacute;s</td>
			<td class="titre">R&eacute;sistants</td>
			<td colspan="2">Ratio</td>
			<td class="note">Notes</td>
		</tr>

		<tr>
			<td class="titre">Flexion (kN-m)</td>
			<td><?PHP echo $output->flexion_app;?></td>
			<td><?PHP echo $output->flexion_res;?></td>
			<td>M<sub>f</sub> / M<sub>R</sub></td>
			<td<?PHP echo $output_style->flexion;?>><?PHP echo $output_ratio->flexion;?>%</td>
			<td class="note">Article 5.5.4</td>
		</tr>

		<tr>
			<td class="titre">Compression de fil (kN)</td>
			<td><?PHP echo $output->compression_app;?></td>
			<td><?PHP echo $output->compression_res;?></td>
			<td>P<sub>f</sub> / P<sub>R</sub></td>
			<td<?PHP echo $output_style->compression;?>><?PHP echo $output_ratio->compression;?>%</td>
			<td class="note">Article 5.5.6</td>
		</tr>

		<tr>
			<td class="titre">Cisaillement (kN)</td>
			<td><?PHP echo $output->cisaillement_app;?></td>
			<td><?PHP echo $output->cisaillement_res;?></td>
			<td>V<sub>f</sub> / V<sub>R</sub></td>
			<td<?PHP echo $output_style->cisaillement;?>><?PHP echo $output_ratio->cisaillement;?>%</td>
			<td class="note">Article 5.5.5</td>
		</tr>

		<tr>
			<td class="titre" style="border:none;">Efforts combin&eacute;s (kN et kN-m)</td>
			<td style="border:none;"><?PHP echo $output->efforts_p_app;?></td>
			<td style="border:none;"><?PHP echo $output->efforts_p_res;?></td>
			<td rowspan="2">(P<sub>f</sub>&nbsp;/&nbsp;P<sub>R</sub>)<br />+ (M<sub>f</sub>&nbsp;/&nbsp;M<sub>R</sub>)</td>
			<td rowspan="2"<?PHP echo $output_style->efforts;?>><?PHP echo $output_ratio->efforts;?>%</td>
			<td class="note" rowspan="2">Article 5.5.10<br />Moment appliqu&eacute; amplifi&eacute; de <?PHP echo $output_note->moment;?> (effet P - &Delta;)</td>
		</tr>

		<tr>
			<td>&nbsp;</td>
			<td><?PHP echo $output->efforts_m_app;?></td>
			<td><?PHP echo $output->efforts_m_res;?></td>
		</tr>

		<tr>
			<td class="titre">Fl&egrave;che sous la surcharge/neige/vent (mm)</td>
			<td><?PHP echo $output->fleche_surcharge_app;?></td>
			<td><?PHP echo $output->fleche_surcharge_res;?></td>
			<td>L / <?PHP echo $output_ratioTxt->surcharge; ?></td>
			<td<?PHP echo $output_style->fleche_surcharge;?>><?PHP echo $output_ratio->fleche_surcharge;?>%</td>
			<td class="note">Fl&egrave;che amplifi&eacute;e de <?PHP echo $output_note->fleche_surcharge;?>(effet P - &Delta;)</td>
		</tr>

		<tr>
			<td class="titre">Fl&egrave;che sous la charge totale (mm)</td>
			<td><?PHP echo $output->fleche_charge_tot_app;?></td>
			<td><?PHP echo $output->fleche_charge_tot_res;?></td>
			<td>L / <?PHP echo $output_ratioTxt->charge_tot; ?></td>
			<td<?PHP echo $output_style->fleche_charge_tot;?>><?PHP echo $output_ratio->fleche_charge_tot;?>%</td>
			<td class="note">Fl&egrave;che amplifi&eacute;e de <?PHP echo $output_note->fleche_totale;?>(effet P - &Delta;)</td>
		</tr>
		<tr>
			<td colspan="6" style="border:none;"></td>
		</tr>
		<tr>
			<td class="titre">Volume de bois au m&egrave;tre linaire</td>
			<td class="titre" colspan="5"><?PHP echo $output->volume_bois;?> m<sup>3</sup> / m lin&eacute;aire de mur (<?PHP echo $output->pmp;?> pmp / pied lin&eacute;aire)</td>
		</tr>

	</table>

	<div id="note">
		<h3>Notes</h3>

		<ol>
			<li>Le calcul des colombages pr&eacute;sume qu&rsquo;un rev&ecirc;tement structural soit clou&eacute; sur la face &eacute;troite des colombages sur au moins un c&ocirc;t&eacute; et sur toute leur longueur, pr&eacute;venant ainsi le flambage selon l&rsquo;axe faible (article 5.5.6.5).</li>
			<li>Le calcul des colombages pr&eacute;sume que les colombages sont en bois non trait&eacute; (K<sub>T</sub> = 1,00) utilis&eacute; en milieu sec (K<sub>s</sub> = 1,00).</li>
			<li>Le calcul des colombages ne v&eacute;rifie pas la r&eacute;sistance en flexion, en cisaillement et l&rsquo;&eacute;crasement, ni la fl&ecirc;che de la lisse basse et des sabli&egrave;res.</li>
			<li>L&rsquo;effet P-&Delta; est appliqu&eacute; dans le m&ecirc;me sens que la pression de vent afin d&rsquo;amplifier les efforts lat&eacute;raux.</li>
			<li>Pour de plus amples informations sur les murs en ossature de bois, veuillez communiquer avec les conseillers techniques par courriel <a href="mailto:info@cecobois.com">info@cecobois.com</a>.</li>
		</ol>
	</div>

	<div id="avertissement">
		<h3>Avertissement</h3>

		<p>Bien que tous les efforts aient &eacute;t&eacute; faits pour assurer que les informations et les calculs soient pr&eacute;cis et complets, Cecobois ne garantit pas les performances ou les r&eacute;sultats que vous pourriez obtenir en utilisant la Calculatrice. La Calculatrice n&rsquo;a pas pour but de remplacer le jugement des professionnels et vous est fournie &laquo;tel quel&raquo;, sans garantie de quelque sorte. En aucun cas, Cecobois, ses administrateurs, employ&eacute;s et actionnaires ne peuvent &ecirc;tre tenus responsables de quelque perte ou dommage que ce soit d&eacute;coulant de l&rsquo;utilisation de la Calculatrice ou d&rsquo;une incapacit&eacute; &agrave; l&rsquo;utiliser, et ce, peu importe que Cecobois ait ou n&rsquo;ait pas &eacute;t&eacute; avis&eacute; de la possibilit&eacute; de tels dommages.</p>
	</div>
</div>