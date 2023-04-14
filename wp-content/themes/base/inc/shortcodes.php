<?php

add_shortcode('news', function () {
    ob_start();

    $actualites = get_posts([
        'post_type' => 'post',
        'post_status' => 'publish',
        'numberposts' => 5,
    ]);

    if (count($actualites)) {
        ?>
        <section class="actualites-list wrap no-bg wrap-no-padding-x swiper" id="swiper-actualites">
            <div id="actualites" class="list swiper-wrapper">
                <?php

                foreach ($actualites as $actualite) {
                    $cats = wp_list_pluck(get_the_category($actualite->ID), 'cat_name');

                    !$cats ?: $cats = implode(', ', $cats);

                    ?>
                    <div class="swiper-slide">
                        <div class="category"><p><?= $cats ?></p></div>
                        <div class="content">
                            <div class="photo">
                                <?= get_the_post_thumbnail($actualite->ID); ?>
                            </div>
                            <div>
                                <p class="date">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24.567"
                                         height="23.805"
                                         viewBox="0 0 24.567 23.805">
                                        <path d="M-575.859,542.273a2.725,2.725,0,0,1-1.938-.8,2.723,2.723,0,0,1-.8-1.938V524.647a2.746,2.746,0,0,1,2.741-2.741h1.02v-.915a1.524,1.524,0,0,1,1.522-1.523h.81a1.524,1.524,0,0,1,1.523,1.522v.915h8.333v-.915a1.524,1.524,0,0,1,1.522-1.523h.812a1.524,1.524,0,0,1,1.523,1.522v.915h1.02a2.725,2.725,0,0,1,1.938.8,2.725,2.725,0,0,1,.8,1.938v14.885a2.723,2.723,0,0,1-.8,1.938,2.726,2.726,0,0,1-1.939.8h-18.083Zm-2.136-2.739a2.137,2.137,0,0,0,2.134,2.134h18.083a2.137,2.137,0,0,0,2.134-2.134V528.642h-22.35Zm2.136-17.021a2.137,2.137,0,0,0-2.134,2.134v3.389h22.348v-3.389a2.138,2.138,0,0,0-2.134-2.134H-558.8v.915a1.524,1.524,0,0,1-1.522,1.523h-.813a1.524,1.524,0,0,1-1.523-1.522v-.915h-8.333v.915a1.524,1.524,0,0,1-1.521,1.523h-.814a1.524,1.524,0,0,1-1.523-1.523v-.915Zm14.733-2.438a.917.917,0,0,0-.915.915l0,2.438a.916.916,0,0,0,.914.915h.816a.908.908,0,0,0,.647-.267.912.912,0,0,0,.268-.648v-2.438a.91.91,0,0,0-.267-.647.908.908,0,0,0-.647-.268Zm-12.187,0a.917.917,0,0,0-.915.915l0,2.438a.916.916,0,0,0,.914.915h.817a.908.908,0,0,0,.647-.267.912.912,0,0,0,.268-.648v-2.438a.91.91,0,0,0-.267-.647.909.909,0,0,0-.647-.268Z"
                                              transform="translate(579.1 -518.968)"></path>
                                    </svg>
                                    <?= get_the_date('', $actualite->ID) ?>
                                </p>
                                <h2>
                                    <?= get_the_title($actualite->ID); ?>
                                </h2>

                            </div>
                            <a href="<?= get_the_guid($actualite->ID); ?>" class="more">
                                <svg xmlns="http://www.w3.org/2000/svg" width="13.5" height="13.5"
                                     viewBox="0 0 13.5 13.5">
                                    <path d="M13.5,4.9V8.5h-5v5H4.9v-5H0V4.9H4.9V0H8.5V4.9Z"></path>
                                </svg>
                            </a>
                        </div>
                        <a href="<?= get_the_guid($actualite->ID); ?>" class="link"></a>
                    </div>
                    <?php
                }
                ?>
            </div>

        </section>
        <script>
            (function () {
                document.addEventListener('DOMContentLoaded', function (e) {
                    new Swiper('#swiper-actualites', {
                        slidesPerView: 1,
                        loop: true,
                        spaceBetween: 50,
                        keyboard: {
                            enabled: true,
                        },
                        navigation: {
                            nextEl: '.swiper-button-next',
                            prevEl: '.swiper-button-prev',
                        },
                        pagination: {
                            el: "#swiper-actualites .swiper-pagination",
                            type: "progressbar",
                            dynamicBullets: true,
                            clickable: true
                        },
                        breakpoints: {
                            1024: {
                                slidesPerView: 2,
                                spaceBetween: 100
                            }
                        }
                    })
                })
            })();
        </script>
        <?php
    }
    return ob_get_clean();
});


add_shortcode('share_this', function () {
    ob_start();
    ?>
    <div class="share-btn">
        <p class="title">Partager <br>l'article</p>

        <div class="btn">
            <a class="btn-round"
               href="http://www.facebook.com/share.php?u=<?= get_permalink() ?>title=<?= get_the_title() ?>"
               target="_blank">
                <svg xmlns="http://www.w3.org/2000/svg" width="23.035" height="22.896"
                     viewBox="0 0 23.035 22.896">
                    <g transform="translate(-1951.482 -186.452)">
                        <g transform="translate(110 68)">
                            <g transform="translate(-3 -21)">
                                <g transform="translate(1845 139.967)">
                                    <path class="cls-1"
                                          d="M23.035,11.518A11.518,11.518,0,1,0,9.718,22.9V14.847H6.794V11.518H9.718V8.98c0-2.886,1.719-4.481,4.351-4.481a17.714,17.714,0,0,1,2.578.225V7.558H15.193a1.665,1.665,0,0,0-1.876,1.8v2.16h3.194L16,14.847H13.317V22.9A11.519,11.519,0,0,0,23.035,11.518Z"
                                          transform="translate(-0.518 -0.514)"></path>
                                </g>
                            </g>
                        </g>
                    </g>
                </svg>
            </a>
            <a class="btn-round"
               href="https://twitter.com/intent/tweet?url=<?= get_permalink() ?>"
               target="_blank">
                <svg xmlns="http://www.w3.org/2000/svg" width="25.439" height="20.349"
                     viewBox="0 0 25.439 20.349">
                    <path d="M715.006,197.639a11.129,11.129,0,0,1-2.993.814,5.148,5.148,0,0,0,2.3-2.856,10.627,10.627,0,0,1-3.325,1.255,5.242,5.242,0,0,0-9.037,3.5,5.369,5.369,0,0,0,.152,1.173,14.816,14.816,0,0,1-10.762-5.367,5.071,5.071,0,0,0,1.6,6.857,5.05,5.05,0,0,1-2.358-.635v.069a4.859,4.859,0,0,0,.358,1.849,5.2,5.2,0,0,0,3.836,3.173,5.13,5.13,0,0,1-1.38.193,4.645,4.645,0,0,1-.98-.11,5.263,5.263,0,0,0,4.871,3.587,10.554,10.554,0,0,1-6.471,2.194c-.428,0-.827-.028-1.255-.069a15.062,15.062,0,0,0,8,2.3,14.519,14.519,0,0,0,14.5-11.506,14.118,14.118,0,0,0,.345-3.1V200.3a10.789,10.789,0,0,0,2.594-2.663Z"
                          transform="translate(-689.567 -195.225)"></path>
                </svg>
            </a>
            <a class="btn-round"
               href="https://www.linkedin.com/shareArticle?mini=true&amp;url=<?= get_permalink() ?>title=<?= get_the_title() ?>"
               target="_blank">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                    <path d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z"></path>
                </svg>
            </a>
            <a class="btn-round"
               href="mailto:?body=<?= get_permalink() ?>">
                <svg xmlns="http://www.w3.org/2000/svg" width="29.495" height="19.909"
                     viewBox="0 0 29.495 19.909">
                    <g transform="translate(-135.82 -11.917)">
                        <g transform="translate(125.82 88.917)">
                            <path class="cls-1"
                                  d="M12.95-77a2.931,2.931,0,0,0-1.717.553l.012.012,12.9,12.121a.994.994,0,0,0,1.2,0l12.9-12.121.012-.012A2.932,2.932,0,0,0,36.546-77Zm-2.662,1.682A2.938,2.938,0,0,0,10-74.05v14.01a2.92,2.92,0,0,0,.426,1.509l9.125-8.077Zm28.919,0-9.263,8.71,9.125,8.077A2.92,2.92,0,0,0,39.5-60.04v-14.01a2.938,2.938,0,0,0-.288-1.267ZM20.635-65.594l-9.16,8.1a2.927,2.927,0,0,0,1.475.4h23.6a2.927,2.927,0,0,0,1.475-.4l-9.16-8.1-2.5,2.35a2.366,2.366,0,0,1-3.226,0Z"></path>
                        </g>
                    </g>
                </svg>
            </a>
        </div>
    </div>

    <?php

    return ob_get_clean();
});


add_shortcode('go_back', function () {
    ob_start();
    ?>
    <div class="return-btn">
        <a href="/actualites" class="btn-prev">
            <svg xmlns="http://www.w3.org/2000/svg" width="17.08" height="16.985" viewBox="0 0 17.08 16.985">
                <path d="M8417.421,10768.407l5.171-5.171h-11.985v-2.813h12.264l-5.449-5.449,1.775-1.776,8.49,8.493-8.49,8.492Z"
                      transform="translate(-8410.606 -10753.197)"></path>
            </svg>
        </a>
        <a href="<?= wp_get_referer() ?>">Retour</a>
    </div>

    <?php
    return ob_get_clean();
});


if (!class_exists('ShortcodeExtended')) {
    class ShortcodeExtended
    {
        public function render($attributes, $content, $data)
        {
            // just a failsafe
            if (!($data instanceof WP_Block)) {
                return $content;
            }

            // if no ACF not activated or installed, then return early.
            if (!function_exists('get_field')) {
                return $content;
            }

            // if no ACF shortcode found in content, then return early.
            if (strpos($content, '[acf ') === false) {
                return $content;
            }

            // Native functionality is to call `wpautop`, which means we lose access to the Post ID and ACF related data
            return do_shortcode($content);
        }
    }

    add_filter('register_block_type_args', function ($args, $name) {
        // Here we list the native blocks we are likely to include ACF shortcodes in.
        // This list probably needs to be expanded, but suits my immediate requirements.
        $validBlocks = ['core/shortcode', 'core/paragraph', 'core/list'];

        // override the native render_callback function to ensure ACF shortcodes run as expected.
        if (in_array($name, $validBlocks)) {
            $args['render_callback'] = [new ShortcodeExtended, 'render'];
        }

        return $args;
    }, 10, 2);
}

add_shortcode('register', function () {
    ob_start();

    $errors = [];
    $success = '';

    global $wpdb, $PasswordHash, $current_user, $user_ID;

    if (isset($_POST['task']) && $_POST['task'] == 'register') {

        $password1 = $wpdb->prepare(trim($_POST['password1']));
        $password2 = $wpdb->prepare(trim($_POST['password2']));
        $first_name = $wpdb->prepare(trim($_POST['first_name']));
        $last_name = $wpdb->prepare(trim($_POST['last_name']));
        $email = $wpdb->prepare(trim($_POST['email']));
        $username = $wpdb->prepare(trim($_POST['username']));

        if (empty($email)) {
            $errors[] = [
                'message' => 'Ce champ est obligatoire.',
                'field' => 'email'
            ];
        } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors[] = [
                'message' => 'Cette adresse courriel est invalide.',
                'field' => 'email'
            ];
        } else if (email_exists($email)) {
            $errors[] = [
                'message' => 'Cette adresse courriel existe déjà.',
                'field' => 'email'
            ];
        }

        if (empty($username)) {
            $errors[] = [
                'message' => 'Ce champ est obligatoire.',
                'field' => 'username'
            ];
        }

        if (empty($password1)) {
            $errors[] = [
                'message' => 'Ce champ est obligatoire.',
                'field' => 'password1'
            ];
        }

        if (empty($password2)) {
            $errors[] = [
                'message' => 'Ce champ est obligatoire.',
                'field' => 'password2'
            ];
        }

        if (!empty($password1) && !empty($password2)) {
            if ($password1 <> $password2) {
                $errors[] = [
                    'message' => 'Le mot de passe ne correspond pas.',
                    'field' => 'password2'
                ];
            }
        }

        if (empty($first_name)) {
            $errors[] = [
                'message' => 'Ce champ est obligatoire.',
                'field' => 'first_name'
            ];
        }

        if (empty($last_name)) {
            $errors[] = [
                'message' => 'Ce champ est obligatoire.',
                'field' => 'last_name'
            ];
        }


        if (!count($errors)) {
            $user_id = wp_insert_user(
                array(
                    'first_name' => apply_filters('pre_user_first_name', $first_name),
                    'last_name' => apply_filters('pre_user_last_name', $last_name),
                    'user_pass' => apply_filters('pre_user_user_pass', $password1),
                    'user_login' => apply_filters('pre_user_user_login', $username),
                    'user_email' => apply_filters('pre_user_user_email', $email),
                    'role' => 'subscriber')
            );

            if (is_wp_error($user_id)) {
                return;
            } else {
                do_action('user_register', $user_id);
                $user_signon = wp_signon([
                    'user_login' => $username,
                    'user_password' => $password2,
                    'remember' => true
                ], false);
            }
        } else {
            $errors = json_encode($errors);
        }
    }

    ?>

    <main style="">
        <div class="wrap">
            <div class="white-box">
                <div class="box">
                    <div class="wrap-box">
                        <form id="register" style="width: 100%;" method="post">
                            <h2 style="margin-top: 0;">Pas de compte ? Créer votre compte maintenant !</h2>
                            <p>L’inscription est entièrement gratuite et offre de nombreux avantages, dont l’utilisation
                                des outils de calcul.</p>
                            <div class="fields -active">
                                <div class="field half">
                                    <label for="first_name">Prénom<sup>*</sup></label>
                                    <input type="text" name="first_name" id="first_name"
                                           placeholder="Votre prénom" required="">
                                    <span class="status"></span>
                                </div>
                                <div class="field half no-margin">
                                    <label for="last_name">Nom<sup>*</sup></label>
                                    <input type="text" name="last_name" id="last_name"
                                           placeholder="Votre nom" required="">
                                    <span class="status"></span>
                                </div>
                                <div class="field half">
                                    <label for="email">Courriel de connexion<sup>*</sup></label>
                                    <input type="email" name="email" id="email"
                                           placeholder="Votre courriel" required="">
                                    <span class="status"></span>
                                </div>
                                <div class="field half no-margin">
                                    <label for="username">Nom d'utilisateur<sup>*</sup></label>
                                    <input type="text" name="username" id="username"
                                           placeholder="Nom d'utilisateur" required="">
                                    <span class="status"></span>
                                </div>
                                <div class="field half">
                                    <label for="password1">Mot de passe<sup>*</sup></label>
                                    <input type="password" class="password" name="password1"
                                           id="password1" placeholder="•••••••••" required="">
                                    <span class="status"></span>
                                </div>
                                <div class="field half no-margin">
                                    <label for="password2">Confirmation du mot de
                                        passe<sup>*</sup></label>
                                    <input type="password" class="password" name="password2"
                                           id="password2" placeholder="•••••••••" required="">
                                    <span class="status"></span>
                                </div>
                            </div>


                            <button class="btn btn-green btnBig" type="submit">Créer votre compte maintenant</button>
                            <p class="security">Vos données personnelles sont privées et en sécurité</p>
                            <input type="hidden" name="task" value="register"/>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </main>
    <?php
    if (!empty($errors)) :
        ?>
        <script>
            let errors = <?= $errors ?>;

            for (var i = 0; i < errors.length; i++) {
                let error_message = errors[i]['message'],
                    error_field = errors[i]['field'],
                    field = document.querySelector('[name="' + error_field + '"]');
                field.closest('.field').classList.add("-error");
                field.nextElementSibling.textContent = error_message;
            }
        </script>
    <?php
    endif;

    return ob_get_clean();

});