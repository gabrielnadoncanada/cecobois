<?php

return [
    'calc_cecobois' => [
        'label' => __('Calculatrices', 'calculatrice_cecobois'),
        'description' => __('Calculatrices', 'calculatrice_cecobois'),
        'labels' => [
            'name' => __('Calculatrices Cecobois', 'calculatrice_cecobois'),
            'singular_name' => __('Calculatrice', 'calculatrice_cecobois'),
            'menu_name' => __('Calculatrices', 'calculatrice_cecobois'),
            'all_items' => __('Calculatrices Cecobois', 'calculatrice_cecobois'),
            'view_item' => __('Voir toutes les Calculatrices', 'calculatrice_cecobois'),
            'add_new_item' => __('Ajouter une nouvelle Calculatrice', 'calculatrice_cecobois'),
            'add_new' => __('Ajouter', 'calculatrice_cecobois'),
            'edit_item' => __('Éditer', 'calculatrice_cecobois'),
            'update_item' => __('Modifier', 'calculatrice_cecobois'),
            'search_items' => __('Rechercher', 'calculatrice_cecobois'),
            'not_found' => __('Aucun résultat', 'calculatrice_cecobois'),
            'not_found_in_trash' => __('Introuvable dans la poubelle', 'calculatrice_cecobois'),
        ],
        'rewrite' => [
            'slug' => __('calculatrice-cecobois', 'calculatrice_cecobois')
        ],
        'supports' => [
            'title',
            'thumbnail',
            'excerpt',
            'editor'
        ],
        'taxonomies' => [
        ],
        'show_in_rest' => true,
        'hierarchical' => false,
        'public' => true,
        'has_archive' => true,
    ],
    'calc_iframe' => [
        'label' => __('Calculatrices', 'calculatrice_iframe'),
        'description' => __('Calculatrices', 'calculatrice_iframe'),
        'labels' => [
            'name' => __('Calculatrices ShapeDiver', 'calculatrice_iframe'),
            'singular_name' => __('Calculatrice', 'calculatrice_iframe'),
            'menu_name' => __('Calculatrices', 'calculatrice_iframe'),
            'all_items' => __('Toutes les Calculatrices', 'calculatrice_iframe'),
            'view_item' => __('Voir toutes les Calculatrices', 'calculatrice_iframe'),
            'add_new_item' => __('Ajouter une nouvelle Calculatrice', 'calculatrice_iframe'),
            'add_new' => __('Ajouter', 'calculatrice_iframe'),
            'edit_item' => __('Éditer', 'calculatrice_iframe'),
            'update_item' => __('Modifier', 'calculatrice_iframe'),
            'search_items' => __('Rechercher', 'calculatrice_iframe'),
            'not_found' => __('Aucun résultat', 'calculatrice_iframe'),
            'not_found_in_trash' => __('Introuvable dans la poubelle', 'calculatrice_iframe'),
        ],
        'rewrite' => [
            'slug' => __('calculatrice-shapediver', 'calculatrice_iframe')
        ],
        'supports' => [
            'title',
            'thumbnail',
            'excerpt',
            'editor'
        ],
        'taxonomies' => [
        ],
        'show_in_rest' => true,
        'hierarchical' => false,
        'public' => true,
        'has_archive' => true,
        'show_in_menu' => false,
    ],
];
