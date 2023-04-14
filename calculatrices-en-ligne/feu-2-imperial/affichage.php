<?php if( $post->action == 'verif' && !isset( $error ) ):?>
	<style type="text/css">
		select.inputbox{display:none;}
	</style>
<?php endif;?>

<script type="text/javascript" src="/calculatrices-en-ligne/js/calculators/feu-2-imperial/swap.js" language="javascript"></script>

<?php if( $post->action == 'send'):?>
	<script type="text/javascript" src="/calculatrices-en-ligne/js/calculators/script_clean.php" language="javascript"></script>
<?php endif;?>

<?php
	if( $show_debug && $post->action != '' && !isset( $error ) ) {
		require_once( 'debug.php' );
	}
?>

<?php
	require_once( 'class/htmloutput.php');

	if( $post->action != 'print') {
		echo '<h3 style="margin:0px;margin-bottom:10px;">M&eacute;thode fond&eacute;e sur la somme des &eacute;l&eacute;ments contribuants</h3>';
	}

	//si on veut afficher le résultat, ca prend le bouton imprimer pour afficher le popup d'impression
	if( $post->action == 'send' && !isset( $error ) ) : ?>
		<div class="buttonheading">
			<a class="btn-print" href="index.php?action=print" title="Imprimer" onclick="window.open(this.href,\'win2\',\'status=no,toolbar=no,scrollbars=yes,titlebar=no,menubar=no,resizable=yes,width=640,height=480,directories=no,location=no\'); return false;"><?php echo __d( 'cecobois', 'Imprimer' ); ?></a>
		</div>
<?php //si on veut imprimer, ca prend le bouton d'impression
	elseif( $post->action == 'print' ) : ?>
		<div id="logo_sys">
			<img src="img/ceco_print.png" alt="cecobois" border="0" />
		</div>

		<div id="page">

			<div class="buttonheading">
				<a class="btn-print" href="#" onclick="window.print();return false;"><?php echo __d( 'cecobois', 'Imprimer' ); ?></a>
			</div>
		</div>
<?php endif; ?>

<?php if( $post->action == 'verif' ) {
		//si il y a des erreurs,
		if( isset( $error ) ) {
			//on les affiche
			echo '<div id="message_form" class="main-title top error"><p class="large">' . $error . '</p></div>';
		//sinon
		} else {

			//on insere la politique de désengagememt
			require_once( 'form_hidden.php');
		}

	}
	//on affiche le formulaire
	require_once( 'form.php');

// AFFICHAGE SCRIPT SORTIE

	if( ( $post->action == 'send' || $post->action == 'print') && !isset( $error ) ) {
		require_once( 'reponse.php');
	} else if( $post->action == 'verif' && !isset( $error ) ) {
		echo '<div class="clear_height"></div>';
	}
?>