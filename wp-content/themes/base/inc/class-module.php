<?php

class Module
{
    private mixed $modules;

    public function __construct()
    {
        $this->modules = include(__DIR__ . '/registry/modules.php');

        add_action("init", [$this, "register_modules"], 999);
    }

    public static function instance(): Module|bool
    {
        static $instance = false;

        if (!$instance) {
            $instance = new self();
        }

        return $instance;
    }

    public function register_modules(): void
    {
        foreach ($this->modules as $module_name => $module_args):
            $taxonomies = [];

            if (isset($module_args['taxonomies'])):
                foreach ($module_args['taxonomies'] as $key => $taxonomy):
                    if(is_array($taxonomy)){
                        $taxonomies[$key] = $taxonomy;
                        unset($module_args['taxonomies'][$key]);
                        $module_args['taxonomies'][] = $key;
                    }
                endforeach;
            endif;

            $this->register_post_type($module_name, $module_args);

            if (!empty($taxonomies)):

                foreach ($taxonomies as $taxonomy_name => $taxonomy_args):
                    $this->register_taxonomy($taxonomy_name, $module_name, $taxonomy_args);
                endforeach;
            endif;

        endforeach;
    }

    public function register_post_type($module_name, $args): void
    {
        register_post_type($module_name, $args);
    }

    public function register_taxonomy($taxonomy_name, $module_name, $args): void
    {
        if (!taxonomy_exists($taxonomy_name)):
            register_taxonomy($taxonomy_name, $module_name, $args);
            $this->register_taxonomy_meta_field($taxonomy_name);
        endif;
    }

    public function register_taxonomy_meta_field($taxonomy_name)
    {
        add_action($taxonomy_name . '_add_form_fields', [$this, 'taxonomy_add_new_meta_field'], 10, 2);
        add_action($taxonomy_name . '_edit_form_fields', [$this, 'taxonomy_edit_meta_field'], 10, 2);
        add_action('edited_' . $taxonomy_name, [$this, 'taxonomy_update_custom_meta'], 10, 2);
        add_action('created_' . $taxonomy_name, [$this, 'taxonomy_save_custom_meta'], 10, 2);
        add_action('admin_enqueue_scripts', [$this, 'load_media']);
        add_action('admin_footer', [$this, 'add_script']);
    }

    public function taxonomy_add_new_meta_field()
    {
        ?>
        <div class="form-field term-group">
            <label for="image_id"><?php _e('Image', 'module'); ?></label>
            <input type="hidden" id="image_id" name="image_id" class="custom_media_url" value="">
            <div id="category-image-wrapper" style="margin-bottom: 10px;"></div>
            <p>
                <input type="button" class="button button-secondary tax_media_button" id="tax_media_button"
                       name="tax_media_button" value="<?php _e('Ajouter une image', 'module'); ?>"/>
                <input type="button" class="button button-secondary tax_media_remove" id="tax_media_remove"
                       name="tax_media_remove" value="<?php _e('Retirer l\'image', 'module'); ?>"/>
            </p>
        </div>
        <?php
    }

    public function taxonomy_save_custom_meta($term_id)
    {
        if (isset($_POST['image_id']) && '' !== $_POST['image_id']) {
            $image = $_POST['image_id'];
            add_term_meta($term_id, 'image_id', $image, true);
        }
    }

    public function taxonomy_edit_meta_field($term)
    {
        ?>
        <tr class="form-field term-group-wrap">
            <th scope="row">
                <label for="category-image-id"><?php _e('Image', 'module'); ?></label>
            </th>
            <td>
                <?php $image_id = get_term_meta($term->term_id, 'image_id', true); ?>
                <input type="hidden" id="image_id" name="image_id" value="<?php echo $image_id; ?>">
                <div id="category-image-wrapper">
                    <?php if ($image_id) { ?>
                        <?php echo wp_get_attachment_image($image_id, 'thumbnail'); ?>
                    <?php } ?>
                </div>
                <p>
                    <input type="button" class="button button-secondary tax_media_button" id="tax_media_button"
                           name="tax_media_button" value="<?php _e('Ajouter une image', 'module'); ?>"/>
                    <input type="button"
                           class="button button-secondary tax_media_remove" id="tax_media_remove"
                           name="tax_media_remove" value="<?php _e('Retirer l\'image', 'module'); ?>"/>
                </p>
            </td>
        </tr>
        <?php
    }

    public function taxonomy_update_custom_meta($term_id)
    {
        if (isset($_POST['image_id']) && '' !== $_POST['image_id']) {
            $image = $_POST['image_id'];
            update_term_meta($term_id, 'image_id', $image);
        } else {
            update_term_meta($term_id, 'image_id', '');
        }
    }

    public function load_media()
    {
        wp_enqueue_media();
    }

    public function add_script()
    {
        ?>
        <script>
            jQuery(document).ready(function ($) {

                function taxonomy_media_upload(button_class) {
                    let custom_media = true,
                        orig_send_attachment = wp.media.editor.send.attachment;

                    $('body').on('click', button_class, function (e) {
                        let button_id = '#' + $(this).attr('id'),
                            button = $(button_id);

                        custom_media = true;

                        wp.media.editor.send.attachment = function (props, attachment) {
                            if (custom_media) {
                                $('#image_id').val(attachment.id);
                                $('#category-image-wrapper').html('<img class="custom_media_image" src="" style="margin:0;padding:0;max-height:100px;float:none;" />');
                                $('#category-image-wrapper .custom_media_image').attr('src', attachment.url).css('display', 'block');
                            } else {
                                return orig_send_attachment.apply(button_id, [props, attachment]);
                            }
                        }

                        wp.media.editor.open(button);

                        return false;
                    });
                }

                taxonomy_media_upload('.tax_media_button.button');

                $('body').on('click', '.tax_media_remove', function () {
                    $('#image_id').val('');
                    $('#category-image-wrapper').html('<img class="custom_media_image" src="" style="margin:0;padding:0;max-height:100px;float:none;" />');
                });

                $(document).ajaxComplete(function (event, xhr, settings) {
                    var queryStringArr = settings.data.split('&');

                    if ($.inArray('action=add-tag', queryStringArr) !== -1) {
                        var xml = xhr.responseXML;
                        $response = $(xml).find('term_id').text();
                        if ($response != "") {
                            // Clear the thumb image
                            $('#category-image-wrapper').html('');
                        }
                    }
                });
            });
        </script>
        <?php
    }
}

Module::instance();
