<div class="buttonheading calculator-print">
    <a class="btn-print" href="#" title="<?php echo __d( 'cecobois', 'Imprimer' ); ?>" onclick="window.print();"><?php echo __d( 'cecobois', 'Imprimer' ); ?></a>
</div>
<div id="reponse">
	<h3>Ouvertures pour mur à ossature légère</h3>
	<?php if($valide && $tous): ?>
		<table cellpadding="0" cellspacing="0" border="0"><tbody>
			<tr class="bold bigger">
				<td style="border-left:none;border-top:none;border-bottom:none;">&nbsp;</td>
				<td colspan="3" style="border-bottom:none;"> Nombre de plis de 38 x <?php echo $post->colombages; ?></td>
				<td style="border-bottom:none;">Écrasement</td>
			</tr>
			<tr class="bold underline">
				<td style="border-left:none;text-decoration:none;">&nbsp;</td>
				<td>Poteau court</td>
				<td>Poteau long</td>
				<td>Lisse de l'ouverture</td>
				<td>Lisse d'assise</td>
			</tr>
			<?php foreach($tab_classe_propriete['bois_sciage'] as $key=>$essence): ?>
				<?php if(
					(isset($pl['essences'][$key]) || isset($pc['essences'][$key]) || isset($o['essences'][$key]))
						&&
					($pl['essences'][$key]['nb_min'] != -1 || $pc['essences'][$key]['nb_min'] != -1 || $o['essences'][$key]['nb_min'] != -1)
					):
				?>
			<tr>
				<td><?php echo $essence['nom']; ?></td>
				<td><?php echo ($pc['essences'][$key]['nb_min']!= -1?$pc['essences'][$key]['nb_min']:'-'); ?></td>
				<td><?php echo ($pl['essences'][$key]['nb_min']!= -1?$pl['essences'][$key]['nb_min']:'-'); ?></td>
				<td><?php echo ($o['essences'][$key]['nb_min']!= -1?$o['essences'][$key]['nb_min']:'-'); ?></td>
				<td>
					<?php if($e['essences'][$key]['reponse'] == 'Ok') :?>
						<span class="vert"><?php echo $e['essences'][$key]['reponse']; ?></span>
					<?php else :?>
						<span class="rouge"><?php echo $e['essences'][$key]['reponse']; ?></span>
					<?php endif; ?>
				</td>
			</tr>
				<?php endif; ?>
			<?php endforeach; ?>
		</tbody></table>


		<?php if($post->type == 'bois_sciage' || $post->type == "bois_composite"): ?>
		<?php
			if($post->type == 'bois_sciage'){
				$b = 38;
				$titre = 'Linteau (bois sciage)';
			}
			else if($post->type == "bois_composite"){
				$b = 44;
				$titre = 'Linteau (SCL)';
			}
		?>

		<table cellpadding="0" cellspacing="0" border="0"><tbody>
			<tr class="bold bigger">
				<td style="border-left:none;border-top:none;border-bottom:none;">&nbsp;</td>
				<td colspan="<?php echo count($all_d[$post->type][0]); ?>" style="border-bottom:none;"> Nombre de plis de</td>
			</tr>
			<tr class="bold underline">
				<td style="border-left:none;font-size:14px;"><?php echo $titre; ?></td>
				<?php foreach($all_d[$post->type][0] as $d ): ?>
					<?php if($colonnes[$d]):?>
				<td><?php echo $b; ?> x <?php echo $d; ?></td>
					<?php endif; ?>
				<?php endforeach; ?>
			</tr>
			<?php foreach($tab_classe_propriete[$post->type] as $key=>$essence): ?>
				<?php if($lignes[$key]):?>
			<tr>
				<td><?php echo $essence['nom']; ?></td>
					<?php foreach($all_d[$post->type][0] as $d ): ?>
						<?php if($colonnes[$d]):?>
							<?php if(isset($l['essences'][$key][$d])) :?>
				<td><?php echo ($l['essences'][$key][$d]['nb_min'] != -1?$l['essences'][$key][$d]['nb_min']:'-') ?></td>
							<?php else: ?>
				<td>-</td>
							<?php endif; ?>
						<?php endif; ?>
					<?php endforeach; ?>
			</tr>
				<?php endif; ?>
			<?php endforeach; ?>
		</tbody></table>
		<?php elseif($post->type == "lamelle_colle"): ?>
		<?php
			$count = 0;
			foreach($all_b['lamelle_colle'] as $b ){
				if($b < $post->colombages) { $count++; }
			}
		?>
		<table cellpadding="0" cellspacing="0" border="0"><tbody>
			<tr class="bold bigger">
				<td style="border-left:none;border-top:none;border-bottom:none;">&nbsp;</td>
				<td colspan="<?php echo $count; ?>" style="border-bottom:none;">Hauteur minimum par largueur</td>
			</tr>
			<tr class="bold underline">
				<td style="border-left:none;font-size:14px;">Linteau (BLC)</td>
				<?php for($i=0;$i<$count;$i++): ?>
				<td><?php echo $all_b['lamelle_colle'][$i]; ?></td>
				<?php endfor; ?>
			</tr>
			<?php foreach($tab_classe_propriete['lamelle_colle'] as $key=>$essence): ?>
				<?php if($lignes[$key]):?>
			<tr>
				<td><?php echo $essence['nom']; ?></td>
					<?php for($i=0;$i<$count;$i++): ?>
						<?php if($colonnes[$all_b['lamelle_colle'][$i]]):?>
							<?php if(isset($l['essences'][$key][$all_b['lamelle_colle'][$i]])) :?>
				<td><?php echo ($l['essences'][$key][$all_b['lamelle_colle'][$i]]['nb_min'] != -1?$l['essences'][$key][$all_b['lamelle_colle'][$i]]['nb_min']:'-') ?></td>
							<?php else: ?>
				<td>-</td>
							<?php endif; ?>
						<?php endif; ?>
					<?php endfor; ?>
			</tr>
				<?php endif; ?>
			<?php endforeach; ?>
		</tbody></table>
		<?php endif; ?>
	<?php else: ?>
		<strong style="color:#FF0000;">Aucune classe ne satisfait les exigences ci-dessus.</strong>
	<?php endif; ?>

	<?php
	switch($post->type)
	{
		case "bois_composite":
			$note = "Les séries de poutres sont basées sur les résistances génériques décrites dans le Guide technique sur les poutres et colonnes en gros bois pour la construction commerciale publié par Cecobois. Se référer aux fabricants afin d'obtenir un dimensionnement plus précis en fonction de leurs produits respectifs.";
			break;
		case "bois_sciage":
		case "lamelle_colle":
			$note = "Les séries de poutres sont basées sur les résistances génériques données dans la norme CSA O86-09 sur les <i>Règles de calculs des charpentes en bois.</i>";
			break;
	}
	?>

	<div id="note">
		<h3><?php echo __d( 'cecobois', 'Notes' ); ?></h3>

		<ol>
			<li><? echo $note ?></li>
			<li style="display:none">Les séries de poutres sont basées sur les résistances génériques décrites dans le <em>Guide de conception sur les poutres pour la construction commerciale</em> publié par Cecobois. Se référer aux fabricants afin d'obtenir un dimensionnement plus précis en fonction de leurs produits respectifs.</li>
			<li>Le calcul des poutres présume qu'il y a un support latéral aux points d'appui afin d'empêcher le déplacement latéral et la rotation, de même que sur toute la longueur de la rive comprimée, prévenant ainsi le flambage de celle-ci (articles 5.5.4.2, 6.5.6.3 et 13.3.2.7 ).
			</li>
			<li>Le calcul des poutres présume que celles-ci sont en bois non traité utilisées en milieu sec (K<sub>T</sub> = 1,00 et K<sub>S</sub> = 1,00).</li>
			<li>Le calcul des poutres ne vérifie pas la résistance à l'appui d'extrémité. Se réferer au <em>Guide de conception</em> pour diverses options permettant d'augmenter la résistance à l'appui.</li>
			<li>La vérification de la surcharge concentrée conformément à l'article 4.1.5.10 du CNB n'est pas effectuée.</li>
			<li>Pour de plus amples informations sur les poutres, veuillez communiquer avec les conseillers techniques par courriel <a href="mailto:info@cecobois.com">info@cecobois.com</a>.</li>
		</ol>
	</div>
	<div id="avertissement">
		<h3><?php echo __d( 'cecobois', 'Avertissement' ); ?></h3>

		<p><?php echo __d( 'cecobois', 'Bien que tous les efforts aient été faits pour assurer que les informations et les calculs soient précis et complets, Cecobois ne garantit pas les performances ou les résultats que vous pourriez obtenir en utilisant la Calculatrice. La Calculatrice n\'a pas pour but de remplacer le jugement des professionnels et vous est fournie «tel quel», sans garantie de quelque sorte. En aucun cas, Cecobois, ses administrateurs, employés et actionnaires ne peuvent être tenus responsables de quelque perte ou dommage que ce soit découlant de l\'utilisation de la Calculatrice ou d\'une incapacité à l\'utiliser, et ce, peu importe que Cecobois ait ou n\'ait pas été avisé de la possibilité de tels dommages.' ); ?></p>
	</div>
    <a href="./ouverture" class="btn-prev"><?php echo __d( 'cecobois', 'Retour à la calculatrice' ); ?></a>
</div>