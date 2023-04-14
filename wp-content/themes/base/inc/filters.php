<?php

/**
 * Return image placeholder if ain't have one
 * @return string
 */
add_filter('post_thumbnail_id', function ($thumbnail_id, $post) {
    if ($thumbnail_id):
        return $thumbnail_id;
    endif;

    if (get_option('custom_settings_img_placeholder')):
        return get_option('custom_settings_img_placeholder');
    endif;

    return false;
}, 10, 2);


add_filter('login_form_top', function ($args) {
    return '<h2>Connexion</h2>';
}, 10, 1);

add_filter('login_form_middle', function ($args) {

}, 10, 1);

add_filter('login_form_bottom', function ($args) {
    return '<div class="field" style="text-align: center; margin-top: 10px;margin-bottom: 0;">
                <span class="forgetPSW">Pas de compte?<span><a href="' . $_SERVER['REQUEST_URI'] . 'connexion"> Créer votre compte maintenant !</a></span></span>
                </div>';
}, 10, 1);

add_filter('loginout', function ($link) {
    if (is_user_logged_in()) {
        return '<a href="' . wp_login_url(home_url()) . '" class="btn-login">
                <span class="txt">Déconnexion</span><span class="icn">
                <svg xmlns="http://www.w3.org/2000/svg" width="22.285" height="24.869" viewBox="0 0 22.285 24.869"><path d="M7.35-77.048a1.234,1.234,0,0,1-.877-.362,1.236,1.236,0,0,1-.364-.876v-1.776a2.149,2.149,0,0,1,.782-1.669,33.747,33.747,0,0,1,6.077-3.9.081.081,0,0,0,.046-.075v-1.979a4.813,4.813,0,0,1-.576-1.548c-.309-.1-.586-.6-.847-1.523-.239-.844-.254-1.393,0-1.675h0a.551.551,0,0,1,.381-.193,4.268,4.268,0,0,1-.127-.508,4.559,4.559,0,0,1,0-2.063,4.493,4.493,0,0,1,1.21-2.124,5.78,5.78,0,0,1,1.1-.934,4.413,4.413,0,0,1,1.086-.556A3.647,3.647,0,0,1,16.232-99a4.1,4.1,0,0,1,2.489.527,3.211,3.211,0,0,1,1.2,1.094,1.52,1.52,0,0,1,.9.578c.574.729.721,1.962.439,3.664a4.266,4.266,0,0,1-.127.508.549.549,0,0,1,.381.193c.234.282.231.83,0,1.675-.254.924-.54,1.423-.85,1.523h0a4.761,4.761,0,0,1-.573,1.522v1.522a5.51,5.51,0,0,0-.876,4.553L15.978-78.4a2.74,2.74,0,0,0-.738,1.349Zm19.934-8.577h0a3.777,3.777,0,0,1,1.058,3.3,3.778,3.778,0,0,1-2.074,2.773,3.779,3.779,0,0,1-3.462-.08l-1.093,1.093.472.472a.981.981,0,0,1,.325.7.976.976,0,0,1-.287.721.984.984,0,0,1-.721.284.98.98,0,0,1-.7-.328l-.472-.472-.857.857.472.472a.984.984,0,0,1,0,1.389.984.984,0,0,1-1.389,0l-.469-.47-.7-.7-.135-.14a.982.982,0,0,1,0-1.388l4.034-4.034h0a3.78,3.78,0,0,1-.042-3.439A3.775,3.775,0,0,1,24-86.662a3.776,3.776,0,0,1,3.278,1.039Zm-1.591,1.579a1.522,1.522,0,0,0-1.655-.318,1.523,1.523,0,0,0-.934,1.4,1.522,1.522,0,0,0,.934,1.4,1.522,1.522,0,0,0,1.655-.318,1.52,1.52,0,0,0,.456-1.085,1.524,1.524,0,0,0-.456-1.086Z" transform="translate(-6.109 99.023)"></path></svg></span>
            </a>';
    }
}, 20, 1);

