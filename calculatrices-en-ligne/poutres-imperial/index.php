<?php
require_once('../../wp-config.php');
global $wpdb;

if(!is_user_logged_in()):
    header('Location: /');
    exit();
endif;

function __d($domain, $string){
    return $string;
}

?>
<!doctype html>
<html>
<head>
    <meta charset="utf-8" />
    <link rel="stylesheet" type="text/css" href="/calculatrices-en-ligne/css/global.css" />
    <link rel="stylesheet" type="text/css" href="/calculatrices-en-ligne/css/global_2.css" />
</head>
<body>
    <div class="main-content"><main>

    <div class="calcu-title">
        <p class="title">Calculatrice de prédimensionnement</p>
        <p class="subtitle">La conception doit être effectuée par un ingénieur qualifié.</p>
    </div>

<?php
require_once('variables.php');

if($post->action!=""){
    require_once('traitement.php');

    if($show_debug == true){
        require_once('debug.php');
    }
}

echo '<div class="row">';

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
    require_once( 'form.php' );
    require_once( 'reponse.php' );
} else {
    //display calculator
    require_once( 'form.php' );
}
?>
    </div></main></div>

    <script type="text/javascript" src="/calculatrices-en-ligne/js/calculators/poutres-imperial/script.js" language="javascript"></script>
    <script type="text/javascript" src="/calculatrices-en-ligne/js/calculators/poutres-imperial/swap_systeme.js" language="javascript"></script>
</body>
</html>