<div class="calculator-terms text" id="absolute">
	<div id="box_absolute">
		<h2 class="green-title"><?php echo __d( 'cecobois', 'Calculatrice de poutrelles ajourées en bois' ) . ' - ' . __d( 'cecobois', 'Conditions d\'utilisation' ); ?></h2>

		<div id="content">
			<p class="large"><strong><?php echo __d( 'cecobois', 'En cliquant sur le bouton "Accepter" ci-dessous, vous confirmez que vous avez lu et accepté les clauses et les conditions d\'utilisation énumérées ci-dessous.' ); ?></strong></p>

			<ol>
				<li><strong><?php echo __d( 'cecobois', 'Utilisation de la Calculatrice' ); ?></strong><br />
				<?php echo __d( 'cecobois', 'Vous êtes autorisé à utiliser la Calculatrice et à consulter son contenu et ses résultats.' ); ?></li>
				<li><strong><?php echo __d( 'cecobois', 'Droits d\'auteur et marques commerciales' ); ?></strong><br />
				<?php echo __d( 'cecobois', 'Tous les droits de propriété intellectuelle relatifs à la Calculatrice sont la propriété de Cecobois. Elle est, en outre, protégée par la législation canadienne en matière de droits d\'auteur, par les dispositions des traits internationaux et par les lois applicables dans le pays oè elle est utilisée. Les présentes ne vous accordent aucun droit de propriété sur la Calculatrice.' ); ?></li>
				<li><strong><?php echo __d( 'cecobois', 'Exclusion de garantie' ); ?></strong><br />
				<?php echo __d( 'cecobois', 'La Calculatrice n\'a pas pour but de remplacer le jugement des professionnels. Elle vous est fournie «tel quel», sans garantie de quelque sorte. Bien que tous les efforts aient été faits pour assurer que les informations et les calculs soient précis et complets, Cecobois ne garantit pas les performances ou les résultats que vous pourriez obtenir en utilisant la Calculatrice.' ); ?></li>
			</ol>

			<p><?php echo __d( 'cecobois', 'L\'utilisateur de la Calculatrice dégage Cecobois, ses administrateurs, employés et actionnaires de toute responsabilité quant aux contenus et aux résultats produits. En aucun cas, Cecobois, ses administrateurs, employés et actionnaires ne peuvent être tenus responsables de quelque perte ou dommage que ce soit découlant de l\'utilisation de la Calculatrice ou d\'une incapacité à l\'utiliser, et ce, peu importe que Cecobois ait ou n\'ait pas été avisé de la possibilité de tels dommages.' ); ?></p>

			<form name="calcul_hidden" method="post" id="formulaire">

				<?PHP
					HtmlOutput::hidden('systeme');
					HtmlOutput::hidden('type_poutrelle');
					HtmlOutput::hidden('portee');
					HtmlOutput::hidden('espacement');
					HtmlOutput::hidden('hauteur');
					HtmlOutput::hidden('surcharge');
					HtmlOutput::hidden('PL');
					HtmlOutput::hidden('morte_sup');
					HtmlOutput::hidden('morte_inf');
					HtmlOutput::hidden('cat_risque');
					HtmlOutput::hidden('fleche_surcharge');
					HtmlOutput::hidden('fleche_charge_totale');
					HtmlOutput::hidden('type_revetement');
					HtmlOutput::hidden('epaisseur_revetement');
					HtmlOutput::hidden('attache_revetement');
					HtmlOutput::hidden('plafond_gypse');
					HtmlOutput::hidden('rangee_blocages');
				?>

				<input type="hidden" name="action" value="send" />
				<input type="submit" value="<?php echo __d( 'cecobois', 'Accepter' ); ?>" class="btn" />
				<input type="button" value="<?php echo __d( 'cecobois', 'Décliner' ); ?>" onclick="window.location='./'" class="btn red"/>
			</form>
		</div>
	</div>
</div>