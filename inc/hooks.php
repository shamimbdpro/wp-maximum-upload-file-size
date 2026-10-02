<?php

/**
 * Scripts for the EasyMedia dashboard admin notice (Hide for 6 months).
 */
add_action( 'admin_enqueue_scripts', 'wmufs_enqueue_dashboard_promo_notice_assets' );

function wmufs_enqueue_dashboard_promo_notice_assets( $hook ) {
	if ( 'index.php' !== $hook ) {
		return;
	}

	if ( ! class_exists( 'WMUFS_Helper' ) || ! WMUFS_Helper::user_can_manage_options() ) {
		return;
	}

	$hidden_until = (int) get_option( 'wmufs_notice_disable_time', 0 );
	if ( time() <= $hidden_until ) {
		return;
	}

	wp_enqueue_style(
		'wmufs-promotion-notice',
		WMUFS_PLUGIN_URL . 'assets/css/wmufs.css',
		array(),
		WMUFS_PLUGIN_VERSION
	);

	wp_enqueue_script( 'jquery' );
	wp_enqueue_script(
		'wmufs-admin-notice',
		WMUFS_PLUGIN_URL . 'assets/js/admin-notice.js',
		array( 'jquery' ),
		WMUFS_PLUGIN_VERSION,
		true
	);

	wp_localize_script(
		'wmufs-admin-notice',
		'wmufs_admin_notice_ajax_object',
		array(
			'wmufs_admin_notice_ajax_url' => admin_url( 'admin-ajax.php' ),
			'nonce'                       => wp_create_nonce( 'wmufs_notice_status' ),
		)
	);
}

add_action('wp_ajax_wmufs_admin_notice_ajax_object_save', 'wmufs_admin_notice_ajax_object_callback');

    /**
     * Save option after clicking hide button in WP dashboard.
     *
     * @return void
     */
     function wmufs_admin_notice_ajax_object_callback() {
        if ( ! class_exists( 'WMUFS_Helper' ) || ! WMUFS_Helper::user_can_manage_options() ) {
            wp_send_json_error( array( 'message' => 'Forbidden' ), 403 );
        }

        check_ajax_referer( 'wmufs_notice_status' );

        $data = isset( $_POST['data'] ) ? sanitize_text_field( wp_unslash( $_POST['data'] ) ) : '';

        if ( '' === $data ) {
            wp_send_json_error( array( 'message' => 'Invalid request' ), 400 );
        }

        update_option( 'wmufs_notice_disable_time', strtotime( '+6 months' ) );

        wp_send_json_success( array( 'message' => 'success' ) );
    }


add_action('admin_footer', 'custom_button_inline_after_upload_limit_by_class');

function custom_button_inline_after_upload_limit_by_class() {

    if(!WMUFS_Helper::user_can_manage_options()){
        return;
    }

	$screen = get_current_screen();

	if ($screen->base === 'media') {
		$custom_link = admin_url('admin.php?page=easy_media');
		?>
		<script type="text/javascript">
            jQuery(document).ready(function($) {
                // Target the p tag with the max-upload-size class
                var uploadNotice = $('p.max-upload-size');

                // Append inline link after the message
                uploadNotice.append(
                    ' <a href="<?php echo esc_url($custom_link); ?>" style="margin-left: 5px;">Change with - EasyMedia</a>'
                );



            });
		</script>
		<?php
	}
}

add_action('admin_enqueue_scripts', function($hook) {
    if ($hook === 'upload.php') {
        $custom_link = esc_url( admin_url('admin.php?page=easy_media') );
        wp_add_inline_script('media-views', "
            jQuery(document).ready(function($) {
                // Also run once on first load
                $(window).on('load', function() {
                    const maxText = $('.max-upload-size');
                    if (maxText.length && !maxText.find('a.easymedia-link').length) {
                        maxText.append(
                            ' <a href=\"{$custom_link}\" class=\"easymedia-link\" target=\"_blank\" style=\"margin-left:8px;\">Change Limit With EasyMedia</a>'
                        );
                    }
                });
            });
        ");
    }
});

