<div class="buttonheading calculator-print">
    <a class="btn-print" href="#" title="<?php echo __d( 'cecobois', 'Imprimer' ); ?>" onclick="window.print();"><?php echo __d( 'cecobois', 'Imprimer' ); ?></a>
</div>
<div class="left full main-content" id="reponse">
	<p><?PHP if($output->drf!='' || $output->drf==0): ?>
			<?php if($post->type_element == 'poutre'): ?>
				<?php echo __d( 'cecobois', 'La poutre' ); ?>
			<?php else: ?>
				<?php echo __d( 'cecobois', 'Le poteau' ); ?>
			<?php endif;?>

			<?php echo __d( 'cecobois', 'en lamellé-collé aura un degré de résistance au feu de <strong>' ) . ' ' . round( $output->drf ) . ' ' . __d( 'cecobois', 'minutes</strong> selon les conditions indiquées ci-dessus.' ); ?>
		<?PHP endif;?>
	</p>

	<div id="note">
		<h3><?php echo __d( 'cecobois', 'Notes' ); ?></h3>

		<ol>
			<li><?php echo __d( 'cecobois', 'Le degré de résistance au feu de l\'élément en bois lamellé-collé est déterminé selon la méthode indiquée à l\'annexe D-2.11 du CNB 2005 utilisée lorsque les dimensions des éléments sont supérieures à celles indiquées au tableau 3.1.4.6 du CNB.' ); ?></li>
			<li><?php echo __d( 'cecobois', 'Le tableau 3.1.4.6 de la division B du CNB prescrit les dimensions minimales requises pour une construction en gros bois d\'œuvre ayant un degré de résistance au feu d\'au plus 45 minutes. Lorsque ces dimensions minimales sont respectées mais que le degré de résistance au feu calculé selon la méthode indiquée à l\'annexe D-2.11 est inférieur à 45 minutes, un degré de résistance au feu prescriptif de 45 minutes s\'applique tel qu\'indiqué à l\'article 3.1.4.5.1) de la division B du CNB.' ); ?></li>
			<!--<li>Le ratio de sollicitation peut être déterminé à partir de l'effort maximal appliqué selon la combinaison de charges recommandé au paragraphe A-25 du <em>Guide de l'utilisateur - CNB 2005 : Commentaires sur le calcul des structures (partie 4 de la division B)</em>.</li>-->
			<li><?php echo __d( 'cecobois', 'Pour de plus amples informations sur le degré de résistance au feu d\'éléments en bois, veuillez communiquer avec les conseillers techniques par courriel à' ); ?> <a href="mailto:info@cecobois.com">info@cecobois.com</a>.</li>
		</ol>
	</div>

	<div id="avertissement">
		<h3><?php echo __d( 'cecobois', 'Avertissement' ); ?></h3>

		<p><?php echo __d( 'cecobois', 'Bien que tous les efforts aient été faits pour assurer que les informations et les calculs soient précis et complets, Cecobois ne garantit pas les performances ou les résultats que vous pourriez obtenir en utilisant la Calculatrice. La Calculatrice n\'a pas pour but de remplacer le jugement des professionnels et vous est fournie «tel quel», sans garantie de quelque sorte. En aucun cas, Cecobois, ses administrateurs, employés et actionnaires ne peuvent être tenus responsables de quelque perte ou dommage que ce soit découlant de l\'utilisation de la Calculatrice ou d\'une incapacité à l\'utiliser, et ce, peu importe que Cecobois ait ou n\'ait pas été avisé de la possibilité de tels dommages.' ); ?></p>
	</div>
    <a href="/calculatrices-en-ligne/feu-imperial" class="btn-prev"><?php echo __d( 'cecobois', 'Retour à la calculatrice' ); ?></a>
</div>