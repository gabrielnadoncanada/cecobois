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
<h3>Valeurs pêle-mêle</h3>
<table cellpadding="0" cellspacing="2" border="1"><tbody>
	<tr>
		<td>Coefficient Attache</td>
		<td><?php echo $coefficient_attache; ?></td>
	</tr>
</tbody></table>


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


<h3>Utilisation</h3>
<table cellpadding="0" cellspacing="2" border="1"><tbody>
	<tr>
		<td>Ksb</td>
		<td><?php echo $utilisation->ksb; ?></td>
	</tr>
	<tr>
		<td>Ksv</td>
		<td><?php echo $utilisation->ksv; ?></td>
	</tr>
	<tr>
		<td>Ksc</td>
		<td><?php echo $utilisation->ksc; ?></td>
	</tr>
	<tr>
		<td>Kse</td>
		<td><?php echo $utilisation->kse; ?></td>
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
		<td>E</td>
		<td><?php echo $classe->e; ?></td>
	</tr>
	<tr>
		<td>E05</td>
		<td><?php echo $classe->e05; ?></td>
	</tr>
	<tr>
		<td>Kh</td>
		<td><?php echo $classe->khc; ?></td>
	</tr>
</tbody></table>


<h3>Colonnes</h3>
<table cellpadding="0" cellspacing="2" border="1"><tbody>
	<tr>
		<td>Largeur (b)</td>
		<td><?php echo $colonnes->largeur; ?></td>
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
		<td>Largeur pour Kzbg</td>
		<td><?php echo $colonnes->largeur_kzbg; ?></td>
	</tr>
	<tr>
		<td>Kzb eps Kzv</td>
		<td><?php echo $colonnes->Kzb_eps_Kzv; ?></td>
	</tr>
	<tr>
		<td>Kzv</td>
		<td><?php echo $colonnes->Kzv; ?></td>
	</tr>
	<tr>
		<td>Cb</td>
		<td><?php echo $colonnes->CB; ?></td>
	</tr>
	<tr>
		<td>Poids</td>
		<td><?php echo $colonnes->poids; ?></td>
	</tr>
</tbody></table>


<h3>Cas 0 à 9</h3>
<table cellpadding="0" cellspacing="2" border="1"><tbody>
	<tr>
		<th>Cas #</th>
		<th>Colonnes => Kzbg</th>
		<th>DPs</th>
		<th>W Lateral</th>
		<th>Kd</th>
		<th>D axial pondere</th>
		<th>L axial pondere</th>
		<th>S axial pondere</th>
		<th>W lateral pondere</th>
		<th>Vf</th>
		<th>Pf</th>
		<th>Kcd</th>
		<th>Kcb</th>
		<th>Prd</th>
		<th>Prb</th>
		<th>Pr</th>
		<th>Colonnes => CK</th>
		<th>Colonnes => KL</th>
		<th>Mr</th>
		<th>1 / (1 - Pf / PE)</th>
		<th>Mw</th>
		<th>M<sup>top</sup></th>
		<th>M<sup>milieu</sup></th>
		<th>Mf flexion</th>
		<th>Mf comb</th>
		<th>Mf flexion / Mr</th>
		<th>(Pf/Pr)² + (Mf_comb/Mr)</th>
	</tr>
	<?php for($a=0;$a<10;$a++): ?>
	<tr>
		<td><?php echo $a; ?></td>
		<td><?php echo $colonnes->Kzbg[$a]; ?></td>
		<td><?php echo $tab_DPs[$a]; ?></td>
		<td><?php echo $tab_wlateral[$a]; ?></td>
		<td><?php echo $tab_kd[$a]; ?></td>
		<td><?php echo $tab_Daxial_pondere[$a]; ?></td>
		<td><?php echo $tab_Laxial_pondere[$a]; ?></td>
		<td><?php echo $tab_Saxial_pondere[$a]; ?></td>
		<td><?php echo $tab_Wlateral_pondere[$a]; ?></td>
		<td><?php echo $tab_vf[$a]; ?></td>
		<td><?php echo $tab_pf[$a]; ?></td>
		<td><?php echo $tab_kcd[$a]; ?></td>
		<td><?php echo $tab_kcb[$a]; ?></td>
		<td><?php echo $tab_prd[$a]; ?></td>
		<td><?php echo $tab_prb[$a]; ?></td>
		<td><?php echo $tab_pr[$a]; ?></td>
		<td><?php echo $colonnes->CK[$a]; ?></td>
		<td><?php echo $colonnes->KL[$a]; ?></td>
		<td><?php echo $tab_mr[$a]; ?></td>
		<td><?php echo $un_sur_un_moins_pf_sur_pe[$a]; ?></td>
		<td><?php echo $tab_Mw[$a]; ?></td>
		<td><?php echo $tab_m_top[$a]; ?></td>
		<td><?php echo $tab_m_mid[$a]; ?></td>
		<td><?php echo $tab_mf_flexion[$a]; ?></td>
		<td><?php echo $tab_mf_comb[$a]; ?></td>
		<td><?php echo $tab_mf_sur_mr[$a]; ?></td>
		<td><?php echo $tab_Pf_Pr_Mf_Mr_prime[$a]; ?></td>
	</tr>
	<?php endfor; ?>
</tbody></table>

<h3>Valeurs utilisé dans les cas</h3>
<table cellpadding="0" cellspacing="2" border="1"><tbody>
	<tr>
		<td>KZCd</td>
		<td><?php echo $Kzcd; ?></td>
	</tr>
	<tr>
		<td>KZCb</td>
		<td><?php echo $Kzcb; ?></td>
	</tr>
	<tr>
		<td>CCd</td>
		<td><?php echo $coeficient_Ccd; ?></td>
	</tr>
	<tr>
		<td>CCb</td>
		<td><?php echo $coeficient_Ccb; ?></td>
	</tr>
</tbody></table>


<h3>Résistance des montants</h3>
<table cellpadding="0" cellspacing="2" border="1"><tbody>
	<tr>
		<td>Aire</td>
		<td><?php echo $resistance_montant->aire; ?></td>
	</tr>
	<tr>
		<td>Module section</td>
		<td><?php echo $resistance_montant->module_section; ?></td>
	</tr>
	<tr>
		<td>Moment inertie</td>
		<td><?php echo $resistance_montant->moment_inertie; ?></td>
	</tr>
	<tr>
		<td>Charge euler</td>
		<td><?php echo $resistance_montant->charge_euler; ?></td>
	</tr>
	<tr>
		<td>Vr</td>
		<td><?php echo $resistance_montant->Vr; ?></td>
	</tr>
	<tr>
		<td>EI</td>
		<td><?php echo $resistance_montant->EI; ?></td>
	</tr>
</tbody></table>
</div></div>
