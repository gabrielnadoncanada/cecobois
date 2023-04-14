<div class="left full main-content" id="reponse">
	<?PHP if($output->res_feu_min!='' || $output->res_feu_min==0): ?>
		<p>Le syst&egrave;me structural aura un degr&eacute; de r&eacute;sistance au feu de <strong><?php echo $output->res_feu_min;?></strong> selon les conditions indiqu&eacute;es ci-dessus.</p>
	<?PHP endif;?>

	<div id="note">
		<h3>Notes</h3>

		<ol>
			<li>Le degr&eacute; de r&eacute;sistance au feu de l&rsquo;ensemble est d&eacute;termin&eacute; selon la m&eacute;thode indiqu&eacute;e &agrave; l&rsquo;annexe D-2.3 du CNB 2005 pour l&rsquo;ossature l&eacute;g&egrave;re et D-2.4 pour le bois massif.</li>
			<li>Tel que sp&eacute;cifi&eacute; aux articles 3.1.7.3 de la division B du CNB, la calculatrice pr&eacute;sume une exposition au feu &agrave; partir de la face inf&eacute;rieure d&rsquo;un plancher ou d&rsquo;un toit (paroi protectrice plac&eacute;e en-dessous de l&rsquo;ensemble) ou une exposition au feu provenant de chaque face des murs (paroi protectrice des 2 c&ocirc;t&eacute;s du mur).</li>
			<li>Se r&eacute;f&eacute;rer aux annexes D-2.3 et D-2.4 du CNB 2005 quant aux points &agrave; consid&eacute;rer dans ces types de syst&egrave;mes tels que les mat&eacute;riaux et les &eacute;l&eacute;ments d&rsquo;ossature, l&rsquo;installation et le mode de fixation des parois protectrices ainsi que les ouvertures dans les faux-plafonds.</li>
			<?php if($post->type_constr == 'ossature'):?>
			<li>Il est possible de trouver la r&eacute;sistance au feu de plusieurs autres assemblages dans l&rsquo;annexe A du Code national du b&acirc;timent, tableaux A-9-10.3.1.A. et B. ainsi qu&rsquo;&agrave; la page suivante: <a href="http://www.cecobois.com/index.php?option=com_content&view=article&id=195&Itemid=157" target="_parent" style="text-decoration:none;color:#0000EE;">Performances des syst&egrave;mes &#8594;  R&eacute;sistance au feu &#8594;  Construction &agrave; ossature l&eacute;g&egrave;re</a></li>
			<?php endif;?>
			<li>Pour de plus amples informations sur le degr&eacute; de r&eacute;sistance au feu d&rsquo;&eacute;l&eacute;ments en bois, veuillez communiquer avec les conseillers techniques par courriel au <a href="mailto:info@cecobois.com">info@cecobois.com</a>.</li>
		</ol>
	</div>

	<div id="avertissement">
		<h3>Avertissement</h3>

		<p>Bien que tous les efforts aient &eacute;t&eacute; faits pour assurer que les informations et les calculs soient pr&eacute;cis et complets, Cecobois ne garantit pas les performances ou les r&eacute;sultats que vous pourriez obtenir en utilisant la Calculatrice. La Calculatrice n&rsquo;a pas pour but de remplacer le jugement des professionnels et vous est fournie &laquo;tel quel&raquo;, sans garantie de quelque sorte. En aucun cas, Cecobois, ses administrateurs, employ&eacute;s et actionnaires ne peuvent &ecirc;tre tenus responsables de quelque perte ou dommage que ce soit d&eacute;coulant de l&rsquo;utilisation de la Calculatrice ou d&rsquo;une incapacit&eacute; &agrave; l&rsquo;utiliser, et ce, peu importe que Cecobois ait ou n&rsquo;ait pas &eacute;t&eacute; avis&eacute; de la possibilit&eacute; de tels dommages.</p>
	</div>
</div>