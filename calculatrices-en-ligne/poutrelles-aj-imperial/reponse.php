<div class="buttonheading calculator-print">
    <a class="btn-print" href="#" title="<?php echo __d( 'cecobois', 'Imprimer' ); ?>" onclick="window.print();"><?php echo __d( 'cecobois', 'Imprimer' ); ?></a>
</div>
<div class="left full main-content" id="reponse">
	<h2><?php echo __d( 'cecobois', 'Poutrelles ajourées en bois' ); ?></h2>

	<h3><?php echo __d( 'cecobois', 'Analyses selon CSA O86 — Calculs aux états limites' ); ?></h3>

	<?PHP if(isset($tab_nom_serie[0])): ?>

		<?PHP for($a=0; $a<count($tab_nom_serie); $a++): ?>
			<table id="result" cellpadding="0" cellspacing="0">
				<tr>
					<td class="titre"><?php echo __d( 'cecobois', 'Série' ); ?></td>

					<td class="titre"><?php echo __d( 'cecobois', 'Sollicitation' ); ?></td>

					<td class="titre"><?php echo __d( 'cecobois', 'Résistance limitant la conception' ); ?></td>
				</tr>
				<?PHP for($a=0;$a<count($tab_nom_serie);$a++):?>
					<tr>
						<td><?PHP echo $tab_nom_serie[$a];?></td>

						<td><?PHP echo round($tab_max_ratio[$a]*100);?> %</td>

						<td><?PHP echo $tab_nom_resistance_max[$a];?></td>
					</tr>
				<?PHP endfor;?>
			</table>
		<?PHP endfor;?>

	<?PHP else:?>
		<br /><strong style="color:#FF0000;"><?php echo __d( 'cecobois', 'Aucune poutrelle ne satisfait les exigences ci-dessus.' ); ?></strong>
	<?PHP endif;?>

	<div id="note">
		<h3><?php echo __d( 'cecobois', 'Notes' ); ?></h3>

		<ol>
			<li><?php echo __d( 'cecobois', 'Les séries de poutrelles ajourées en bois sont basées sur les résistances génériques décrites dans le <em>Guide de conception sur les poutrelles ajourées en bois pour la construction commerciale</em> publié par Cecobois. Se référer aux fabricants afin d\'obtenir un dimensionnement plus précis en fonction de leurs produits respectifs.' ); ?></li>
			<li><?php echo __d( 'cecobois', 'Le calcul des poutrelles ajourées en bois présume qu\'il y a un support latéral aux points d\'appui afin d\'empêcher le déplacement latéral et la rotation, de même que le long de toutes les rives comprimées, prévenant ainsi le flambage de la semelle supérieure (article 13.2.5.2).' ); ?></li>
			<li><?php echo __d( 'cecobois', 'Le calcul des poutrelles ajourées en bois présume que les poutrelles sont en bois non traité <br />(K<sub>T</sub> = 1,00) utilisées en milieu sec (K<sub>S</sub> = 1,00).' ); ?></li>
			<li><?php echo __d( 'cecobois', 'Le calcul des poutrelles ajourées en bois ne vérifie pas la résistance à l\'appui d\'extrémité. Se réferer au <em>Guide de conception</em> pour diverses options permettant d\'augmenter la résistance à l\'appui.' ); ?></li>
			<!--<li>Le calcul des poutrelles ajourées en bois ne vérifie pas la résistance en flexion, en cisaillement et à l'écrasement, ni la flèche des sabières ou des poutres les supportant.</li>-->
			<li><?php echo __d( 'cecobois', 'Le calcul des flèches ne considèrent pas l\'effet composite que l\'assemblage du système peut procurer. Ce dernier influence uniquement la performance du plancher lors de la vérification pour la vibration.' ); ?></li>
			<li><?php echo __d( 'cecobois', 'La vérification de la surcharge concentrée est effectuée conformément à l\'article 4.1.5.10 du CNB selon le type de surcharge concentrée sélectionnée ci-dessus.' ); ?></li>
			<li><?php echo __d( 'cecobois', 'Pour de plus amples informations sur les poutrelles ajourées en bois, veuillez communiquer avec les conseillers techniques par courriel à' ); ?> <a href="mailto:info@cecobois.com">info@cecobois.com</a>.</li>
		</ol>
	</div>

	<div id="avertissement">
		<h3><?php echo __d( 'cecobois', 'Avertissement' ); ?></h3>

		<p><?php echo __d( 'cecobois', 'Bien que tous les efforts aient été faits pour assurer que les informations et les calculs soient précis et complets, Cecobois ne garantit pas les performances ou les résultats que vous pourriez obtenir en utilisant la Calculatrice. La Calculatrice n\'a pas pour but de remplacer le jugement des professionnels et vous est fournie «tel quel», sans garantie de quelque sorte. En aucun cas, Cecobois, ses administrateurs, employés et actionnaires ne peuvent être tenus responsables de quelque perte ou dommage que ce soit découlant de l\'utilisation de la Calculatrice ou d\'une incapacité à l\'utiliser, et ce, peu importe que Cecobois ait ou n\'ait pas été avisé de la possibilité de tels dommages.' ); ?></p>
	</div>
        <a href="/calculatrices-en-ligne/poutrelles-aj-imperial" class="btn-prev"><?php echo __d( 'cecobois', 'Retour à la calculatrice' ); ?></a>
</div>