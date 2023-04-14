<style>
	.debug{	padding:10px !important; text-align: center; }
	.debug > div{ display:inline-block; background-color: #FFF; }
	.debug table{  text-align: left; margin:10px auto!important; }
	.debug h3{ cursor:pointer; }
	.debug h3:after{ content:' +'; }
	.debug h3.active:after{	content:' -'; }
</style>
<script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
<script>
	$(function() {
		$('.debug table').wrap( "<div class='sliding'></div>" );
		$('.sliding').hide();
		$('.debug h3').on('click', function(){
			$(this).next().slideToggle();
			$(this).toggleClass('active');
		});
	});
</script>
<div class="debug full main-content" style="clear:both;"><div>
<h1>DEBUG</h1>


<h3>Catégorie de risque</h3>
<table cellpadding="0" cellspacing="2" border="1"><tbody>
	<tr>
		<td>is elu</td>
		<td><?php echo $cat_risque->is_elu; ?></td>
	</tr>
	<tr>
		<td>is els</td>
		<td><?php echo $cat_risque->is_els; ?></td>
	</tr>
	<tr>
		<td>iw elu</td>
		<td><?php echo $cat_risque->iw_elu; ?></td>
	</tr>
	<tr>
		<td>iw els</td>
		<td><?php echo $cat_risque->iw_els; ?></td>
	</tr>
</tbody></table>

<h3>Classe</h3>
<table cellpadding="0" cellspacing="2" border="1"><tbody>
	<tr>
		<td>Densite Bois</td>
		<td><?php echo $densite_bois; ?></td>
	</tr>
	<tr>
		<td>fb</td>
		<td><?php echo $classe->fb; ?></td>
	</tr>
	<tr>
		<td>fv</td>
		<td><?php echo $classe->fv; ?></td>
	</tr>
	<tr>
		<td>fc</td>
		<td><?php echo $classe->fc; ?></td>
	</tr>
	<tr>
		<td>fcp</td>
		<td><?php echo $classe->fcp; ?></td>
	</tr>
	<tr>
		<td>E</td>
		<td><?php echo $classe->e; ?></td>
	</tr>
	<tr>
		<td>E05</td>
		<td><?php echo $classe->e05; ?></td>
	</tr>
	<tr>
		<td>Khc</td>
		<td><?php echo $classe->khc; ?></td>
	</tr>
</tbody></table>


<h3>Poutres</h3>
<table cellpadding="0" cellspacing="2" border="1"><tbody>
	<tr>
		<td>Largeur (b)</td>
		<td><?php echo $colonnes->largeur; ?></td>
	</tr>
	<tr>
		<td>Largeur pli</td>
		<td><?php echo $colonnes->largeur_pli; ?></td>
	</tr>
	<tr>
		<td>Profondeur (d)</td>
		<td><?php echo $colonnes->hauteur; ?></td>
	</tr>
	<tr>
		<td>d/b</td>
		<td><?php echo number_format(($colonnes->hauteur/$colonnes->largeur), 2, '.', ''); ?></td>
	</tr>
	
	<tr>
		<td>Khb</td>
		<td><?php echo $colonnes->khb; ?></td>
	</tr>
	<tr>
		<td>Khv</td>
		<td><?php echo $colonnes->khv; ?></td>
	</tr>
	<tr>
		<td>Z</td>
		<td><?php echo $colonnes->z; ?></td>
	</tr>
	<tr>
		<td>S</td>
		<td><?php echo $colonnes->s; ?></td>
	</tr>
	<tr>
		<td>Kzb EPS Kzv</td>
		<td><?php echo $colonnes->Kzb_eps_Kzv; ?></td>
	</tr>
	<tr>
		<td>Kzb</td>
		<td><?php echo $colonnes->Kzb; ?></td>
	</tr>
	<tr>
		<td>Kzv</td>
		<td><?php echo $colonnes->Kzv; ?></td>
	</tr>
	<tr>
		<td>Poids</td>
		<td><?php echo $colonnes->poids; ?></td>
	</tr>
	<tr>
		<td>Largeur pour Kzbg</td>
		<td><?php echo $colonnes->largeur_kzbg; ?></td>
	</tr>
	<tr>
		<td>kzbg</td>
		<td><?php echo $colonnes->Kzbg; ?></td>
	</tr>
	<tr>
		<td>Kzcp</td>
		<td><?php echo $colonnes->kzcp; ?></td>
	</tr>
</tbody></table>

<h3>Cas 1 à 5 - ELU</h3>
<table cellpadding="0" cellspacing="2" border="1"><tbody>
	<tr>
		<th>Cas #</th>
		<th>Welu</th>
		<th>Mf</th>
		<th>Mr</th>
		<th>Vf max</th>
		<th>Vf @d</th>
		<th>Vr</th>
		<th>Wf</th>
		<th>Wr</th>
		<th>Kd</th>
		<th>Fb</th>
		<th>Cb</th>
		<th>Ck</th>
		<th>Kl</th>
		<th>Fv</th>
		<th>Lb</th>
		<th>Fcp</th>
	</tr>
	<?php for($a=1;$a<6;$a++): ?>
	<tr>
		<td><?php echo $a; ?></td>
		<td><?php echo $tab_welu[$a]; ?></td>
		<td><?php echo $tab_mf[$a]; ?></td>
		<td><?php echo $tab_mr[$a]; ?></td>
		<td><?php echo $tab_vf[$a]; ?></td>
		<td><?php echo $tab_vf_atd[$a]; ?></td>
		<td><?php echo $tab_vr[$a]; ?></td>
		<td><?php echo $tab_wf[$a]; ?></td>
		<td><?php echo $tab_wr[$a]; ?></td>
		<td><?php echo $tab_kd[$a]; ?></td>
		<td><?php echo $tab_fb[$a]; ?></td>
		<td><?php echo $tab_cb[$a]; ?></td>
		<td><?php echo $tab_ck[$a]; ?></td>
		<td><?php echo $tab_kl[$a]; ?></td>
		<td><?php echo $tab_fv[$a]; ?></td>
		<td><?php echo $tab_lb[$a]; ?></td>
		<td><?php echo $tab_fcp[$a]; ?></td>
	</tr>
	<?php endfor; ?>
</tbody></table>


<h3>Cas 1 à 5 - ELS</h3>
<table cellpadding="0" cellspacing="2" border="1"><tbody>
	<tr>
		<th>Cas #</th>
		<th>Wels</th>
		<th>Δt</th>
	</tr>
	<?php for($a=1;$a<6;$a++): ?>
	<tr>
		<td><?php echo $a; ?></td>
		<td><?php echo $tab_wels[$a]; ?></td>
		<td><?php echo $tab_delta_t[$a]; ?></td>
	</tr>
	<?php endfor; ?>
</tbody></table>

<h3>Cas 6 à 7 - Surcharge</h3>
<table cellpadding="0" cellspacing="2" border="1"><tbody>
	<tr>
		<th>Cas #</th>
		<th>Wels</th>
		<th>Δl</th>
	</tr>
	<?php for($a=1;$a<3;$a++): ?>
	<tr>
		<td><?php echo $a+5; ?></td>
		<td><?php echo $tab_surcharge[$a]; ?></td>
		<td><?php echo $tab_delta_l[$a]; ?></td>
	</tr>
	<?php endfor; ?>
</tbody></table>



</div></div>
