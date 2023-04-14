<?php

add_action('admin_enqueue_scripts', 'load_wp_enqueue_media');

function render_image_field($args)
{
    add_action('admin_footer', 'add_image_field_script');
    ?>
    <div class="form-field field-image">
        <input type="hidden" id="<?= $args['field_id'] ?>" name="<?= $args['field_id'] ?>" class="custom_media_url"
               value="">
        <div id="category-image-wrapper" style="margin-bottom: 10px;">

            <?php echo wp_get_attachment_image($args['field_value']); ?>

        </div>
        <p>
            <input type="button" class="button button-secondary media_button" id="media_button"
                   name="media_button" value="<?php _e('Ajouter une image', 'custom_settings_section'); ?>"/>
            <input type="button" class="button button-secondary media_remove" id="media_remove"
                   name="media_remove" value="<?php _e('Retirer l\'image', 'custom_settings_section'); ?>"/>
        </p>
    </div>
    <?php
}

function load_wp_enqueue_media()
{
    wp_enqueue_media();
}

function add_image_field_script()
{
    ?>
    <script>
        jQuery(document).ready(function ($) {
            function media_upload(button_class) {
                let custom_media = true,
                    orig_send_attachment = wp.media.editor.send.attachment;

                $('body').on('click', button_class, function (e) {
                    let button_id = '#' + $(this).attr('id'),
                        button = $(button_id);

                    custom_media = true;

                    wp.media.editor.send.attachment = function (props, attachment) {
                        if (custom_media) {
                            $('.custom_media_url').val(attachment.id);
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

            media_upload('.media_button.button');

            $('body').on('click', '.media_remove', function () {
                $('.custom_media_url').val('');
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