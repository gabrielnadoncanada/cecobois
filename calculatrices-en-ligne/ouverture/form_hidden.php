<div id="absolute">
	<div id="box_absolute">
		<h1>Calculatrice de poutres - Conditions d&rsquo;utilisation</h1>
		
		<div id="content">	
			<strong>En cliquant sur le bouton "Accepter" ci-dessous, vous confirmez que vous avez lu et accept&eacute; les clauses et les conditions d&rsquo;utilisation &eacute;num&eacute;r&eacute;es ci-dessous.</strong>
			<ol>
				<li><strong>Utilisation de la Calculatrice.</strong><br />
				Vous &ecirc;tes autoris&eacute; &agrave; utiliser la Calculatrice et &agrave; consulter son contenu et ses r&eacute;sultats.</li>
				<li><strong>Droits d&rsquo;auteur et marques commerciales.</strong><br />
				Tous les droits de propri&eacute;t&eacute; intellectuelle relatifs &agrave; la Calculatrice sont la propri&eacute;t&eacute; de Cecobois. Elle est, en outre, prot&eacute;g&eacute;e par la l&eacute;gislation canadienne en mati&egrave;re de droits d&rsquo;auteur, par les dispositions des traits internationaux et par les lois applicables dans le pays o&ugrave; elle est utilis&eacute;e. Les pr&eacute;sentes ne vous accordent aucun droit de propri&eacute;t&eacute; sur la Calculatrice.</li>
				<li><strong>Exclusion de garantie.</strong><br />
				La Calculatrice n&rsquo;a pas pour but de remplacer le jugement des professionnels. Elle vous est fournie &laquo; tel quel &raquo;, sans garantie de quelque sorte. Bien que tous les efforts aient &eacute;t&eacute; faits pour assurer que les informations et les calculs soient pr&eacute;cis et complets, Cecobois ne garantit pas les performances ou les r&eacute;sultats que vous pourriez obtenir en utilisant la Calculatrice.</li>
			</ol>
			L&rsquo;utilisateur de la Calculatrice d&eacute;gage Cecobois, ses administrateurs, employ&eacute;s et actionnaires de toute responsabilit&eacute; quant aux contenus et aux r&eacute;sultats produits. En aucun cas, Cecobois, ses administrateurs, employ&eacute;s et actionnaires ne peuvent &ecirc;tre tenus responsables de quelque perte ou dommage que ce soit d&eacute;coulant de l&rsquo;utilisation de la Calculatrice ou d&rsquo;une incapacit&eacute; &agrave; l&rsquo;utiliser, et ce, peu importe que Cecobois ait ou n&rsquo;ait pas &eacute;t&eacute; avis&eacute; de la possibilit&eacute; de tels dommages.
	
			<form name="calcul_hidden" action="calculs.php" method="post" id="formulaire">
			
				<?PHP 
					HtmlOutput::hidden('systeme');
					HtmlOutput::hidden('hauteur');
					HtmlOutput::hidden('largeur');
					HtmlOutput::hidden('hauteur_mur');
					HtmlOutput::hidden('colombages');
					HtmlOutput::hidden('espacement');
					HtmlOutput::hidden('revetement');
					HtmlOutput::hidden('emplacement');
					HtmlOutput::hidden('type');
					HtmlOutput::hidden('cat_risque');
					HtmlOutput::hidden('neige');
					HtmlOutput::hidden('surcharge');
					HtmlOutput::hidden('permanente');
					HtmlOutput::hidden('excentricite');
					HtmlOutput::hidden('vent');
					HtmlOutput::hidden('fleche_surcharge');
					HtmlOutput::hidden('fleche_charge_totale');
				?>
				
				<input type="hidden" name="name" value="ouvertures">
				<input type="hidden" name="action" value="send" />
				<input type="submit" value="Accepter" />
				<input type="reset" value="D&eacute;cliner" onclick="window.location='./'" />
			</form>
		</div>
	</div>
</div>
<div class="clear_height_absolute"></div>