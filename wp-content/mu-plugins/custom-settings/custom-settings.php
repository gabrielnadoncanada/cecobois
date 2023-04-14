<?php

require_once WPMU_PLUGIN_DIR . '/custom-settings/fields.php';

add_action('admin_menu', 'custom_settings_admin_menu');
add_action('admin_init', 'custom_settings_init');

const SETTINGS_MENU_SLUG = 'custom-settings';
const SETTINGS_NAMESPACE = 'custom-settings';

function custom_settings_admin_menu()
{
    add_menu_page(
        __('Custom Settings', SETTINGS_NAMESPACE),
        __('Custom Settings', SETTINGS_NAMESPACE),
        'manage_options',
        SETTINGS_MENU_SLUG,
        'custom_settings_page_contents',
        'dashicons-schedule',
        999
    );
}

function custom_settings_page_contents()
{
    ?>
    <h1> <?php esc_html_e('Custom Settings', SETTINGS_NAMESPACE); ?> </h1>
    <form method="POST" action="options.php">
        <?php
        settings_fields(SETTINGS_MENU_SLUG);
        do_settings_sections(SETTINGS_MENU_SLUG);
        submit_button();
        ?>
    </form>
    <?php
}

function custom_settings_init()
{
    add_settings_section(
        'custom_settings_section',
        __('Settings', SETTINGS_NAMESPACE),
        false,
        SETTINGS_MENU_SLUG
    );

    add_settings_field(
        'custom_settings_img_placeholder',
        __('Default Image Placeholder', SETTINGS_NAMESPACE),
        'render_image_field',
        SETTINGS_MENU_SLUG,
        'custom_settings_section',
        [
            'field_id' => 'custom_settings_img_placeholder',
            'field_value' => get_option('custom_settings_img_placeholder')
        ]
    );

    register_setting(SETTINGS_MENU_SLUG, 'custom_settings_img_placeholder');
}
