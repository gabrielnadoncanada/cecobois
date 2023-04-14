<div class="calculator-terms text" id="absolute">
	<div id="box_absolute">
		<h2 class="green-title"><?php echo __d( 'cecobois', 'Calculatrice de mur à colombages' ) . ' - ' . __d( 'cecobois', 'Conditions d\'utilisation' ); ?></h2>

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
				foreach($_POST as $key => $value):
					HtmlOutput::hidden($key);
					//echo "POST parameter '$key' has '$value'";
				endforeach;
					/*HtmlOutput::hidden('systeme');
					HtmlOutput::hidden('classe');
					HtmlOutput::hidden('classe1');
					HtmlOutput::hidden('classe2');
					HtmlOutput::hidden('classe3');
					HtmlOutput::hidden('classe4');
					HtmlOutput::hidden('classe5');
					HtmlOutput::hidden('classe6');
					HtmlOutput::hidden('classe7');
					HtmlOutput::hidden('largeur');
					HtmlOutput::hidden('largeur1');
					HtmlOutput::hidden('largeur2');
					HtmlOutput::hidden('largeur3');
					HtmlOutput::hidden('largeur4');
					HtmlOutput::hidden('largeur5');
					HtmlOutput::hidden('largeur6');
					HtmlOutput::hidden('largeur7');
					HtmlOutput::hidden('profondeur');
					HtmlOutput::hidden('profondeur1');
					HtmlOutput::hidden('profondeur2');
					HtmlOutput::hidden('profondeur3');
					HtmlOutput::hidden('profondeur4');
					HtmlOutput::hidden('profondeur42');
					HtmlOutput::hidden('profondeur5');
					HtmlOutput::hidden('profondeur6');
					HtmlOutput::hidden('profondeur7');
					HtmlOutput::hidden('espacement');
					HtmlOutput::hidden('hauteur');
					HtmlOutput::hidden('partage_charge');
					HtmlOutput::hidden('cat_risque');
					HtmlOutput::hidden('edition_code');
					HtmlOutput::hidden('ax_neige');
					HtmlOutput::hidden('ax_surcharge');
					HtmlOutput::hidden('ax_permanente');
					HtmlOutput::hidden('ax_excentricite');
					HtmlOutput::hidden('lat_vent');
					HtmlOutput::hidden('fleche_surcharge');
					HtmlOutput::hidden('fleche_charge_totale');
					HtmlOutput::hidden('fleche_traitement');
					HtmlOutput::hidden('fleche_utilisation');*/
				?>

				<input type="hidden" name="action" value="send" />
				<input type="submit" value="<?php echo __d( 'cecobois', 'Accepter' ); ?>" class="btn" />
				<input type="button" value="<?php echo __d( 'cecobois', 'Décliner' ); ?>" onclick="window.location='./'" class="btn red"/>
			</form>
		</div>
	</div>
</div>