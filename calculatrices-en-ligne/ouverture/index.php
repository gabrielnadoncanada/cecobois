<?php

require_once('variables.php');

if($post->action!=""){
    require_once('traitement.php');
}
		
require_once( 'class/htmloutput.php' );

//verification
if( $post->action == 'verif' ) {
    if( isset( $error ) ) {
        //display errors
        echo '<div id="message_form" class="main-title top error"><p class="large">' . $error . '</p></div>';
        require_once( 'form.php' );
    } else {
        //display terms and conditions
        require_once( 'form_hidden.php' );
    }
} else if( $post->action == 'send'  && !isset( $error ) ) {
    //display calculations results
    require_once( 'reponse.php' );
} else {
    //display calculator
    require_once( 'form.php' );
}
?>
<script type="text/javascript" src="/js/calculators/ouverture/swap_systeme.js" language="javascript"></script>