<?php
/**
 * Class Codepopular_WMUFS
 */
class Codepopular_WMUFS {
    static function init() {
        if ( is_admin() ) {
            add_action('admin_enqueue_scripts', array( __CLASS__, 'wmufs_style_and_script' ));
            add_action('admin_menu', array( __CLASS__, 'upload_max_file_size_add_pages' ));
            add_filter('plugin_action_links_' . WMUFS_PLUGIN_BASENAME, array( __CLASS__, 'plugin_action_links' ));
            add_filter('plugin_row_meta', array( __CLASS__, 'plugin_meta_links' ), 10, 2);
            add_filter('admin_footer_text', array( __CLASS__, 'admin_footer_text' ));

            if ( isset($_POST['upload_max_file_size_field']) ) {
                $retrieved_nonce = isset($_POST['upload_max_file_size_nonce']) ? sanitize_text_field(wp_unslash($_POST['upload_max_file_size_nonce'])) : '';
                if ( ! wp_verify_nonce($retrieved_nonce, 'upload_max_file_size_action') ) {
                    die('Failed security check');
                }
                $max_size = (int) $_POST['upload_max_file_size_field'] * 1024 * 1024;
                $max_execution_time = isset($_POST['wmufs_maximum_execution_time']) ? sanitize_text_field(wp_unslash((int) $_POST['wmufs_maximum_execution_time'])) : '';
                update_option('wmufs_maximum_execution_time', $max_execution_time);
                update_option('max_file_size', $max_size);
                wp_safe_redirect(admin_url('admin.php?page=max_uploader&max-size-updated=true'));
            }
        }

        add_filter('upload_size_limit', array( __CLASS__, 'upload_max_increase_upload' ));

        $wmufs_get_max_execution_time = get_option('wmufs_maximum_execution_time') != '' ? get_option('wmufs_maximum_execution_time') : ini_get('max_execution_time');
        set_time_limit($wmufs_get_max_execution_time);
    }

    static function wmufs_style_and_script() {
        wp_enqueue_style('wmufs-admin-style', WMUFS_PLUGIN_URL . 'assets/css/wmufs.css', array(), WMUFS_PLUGIN_VERSION);

        // Ensure jQuery is loaded
        wp_enqueue_script('jquery');

        // Enqueue your script with explicit dependency on jQuery
        wp_enqueue_script('wmufs-admin', WMUFS_PLUGIN_URL . 'assets/js/admin.js', array('jquery'), time(), true);

        wp_localize_script(
            'wmufs-admin',
            'wmufs_admin_notice_ajax_object',
            array(
                'wmufs_admin_notice_ajax_url' => admin_url('admin-ajax.php'),
                'nonce' => wp_create_nonce('wmufs_notice_status'),
                'plugin_url' => WMUFS_PLUGIN_URL,
                'active_tab' => isset($_GET['tab']) ? sanitize_text_field($_GET['tab']) : 'general',
            )
        );
    }

    static function get_plugin_version(): string {
        $plugin_data = get_file_data(__FILE__, array('version' => 'Version'), 'plugin');
        return $plugin_data['version'];
    }
    static function is_plugin_page(): bool {
        $current_screen = get_current_screen();
        return ($current_screen->id === 'toplevel_page_max_uploader');
    }

    static function plugin_action_links( $links ) {
        $settings_link = '<a href="' . admin_url('admin.php?page=max_uploader') . '">Settings</a>';
        array_unshift($links, $settings_link);
        return $links;
    }

    static function plugin_meta_links( $links, $file ) {
        if ( $file === plugin_basename(__FILE__) ) {
            $links[] = '<a target="_blank" href="https://wordpress.org/support/plugin/wp-maximum-upload-file-size/">Support</a>';
        }
        return $links;
    }

    static function admin_footer_text( $text ) {
        if ( ! self::is_plugin_page() ) {
            return $text;
        }
        return '<span id="footer-thankyou">If you like <strong><ins>WP Maximum Upload File Size</ins></strong> please leave us a <a target="_blank" style="color:#f9b918" href="https://wordpress.org/support/view/plugin-reviews/wp-maximum-upload-file-size?rate=5#postform">★★★★★</a> rating. A huge thank you in advance!</span>';
    }

    static function upload_max_file_size_add_pages() {
        add_menu_page(
            'Increase Max Upload File Size',
            'Max Uploader',
            'manage_options',
            'max_uploader',
            [ __CLASS__, 'upload_max_file_size_dash' ],
            'dashicons-upload',
            21
        );
    }

    static function upload_max_file_size_dash() {
        $active_tab = isset($_GET['tab']) ? sanitize_text_field($_GET['tab']) : 'general';
        ?>
        <div class="wrap wmufs-wrap">
            <h2 class="nav-tab-wrapper">
                <a href="#" data-tab="general" class="nav-tab max-uploader-tab-link <?php echo $active_tab === 'general' ? 'nav-tab-active' : ''; ?>">General</a>
                <a href="#" data-tab="system_status" class="nav-tab max-uploader-tab-link <?php echo $active_tab === 'system_status' ? 'nav-tab-active' : ''; ?>">System Status</a>
                <a href="#" data-tab="pro" class="nav-tab max-uploader-tab-link <?php echo $active_tab === 'pro' ? 'nav-tab-active' : ''; ?>">Pro</a>
            </h2>
            <div id="max-uploader-tab-content">
                <?php include_once WMUFS_PLUGIN_PATH . 'inc/class-wmufs-helper.php'; ?>
                <div id="max-uploader-tab-general" class="max-uploader-tab-content" <?php echo $active_tab !== 'general' ? 'style="display:none;"' : ''; ?>>
                    <?php
                    include WMUFS_PLUGIN_PATH . 'admin/templates/class-wmufs-template.php';
                    ?>
                </div>
                <div id="max-uploader-tab-system_status" class="max-uploader-tab-content" <?php echo $active_tab !== 'system_status' ? 'style="display:none;"' : ''; ?>>
                    <?php
                    include WMUFS_PLUGIN_PATH . 'admin/templates/ClassSystemHealth.php';
                    ?>
                </div>
                <div id="max-uploader-tab-pro" class="max-uploader-tab-content" <?php echo $active_tab !== 'pro' ? 'style="display:none;"' : ''; ?>>
                    <?php
                    include WMUFS_PLUGIN_PATH . 'admin/templates/FreeVsPro.php';
                    ?>
                </div>
            </div>
        </div>
        <?php
        add_action('admin_head', [ __CLASS__, 'wmufs_remove_admin_action' ]);
    }

    static function wmufs_remove_admin_action() {
        remove_all_actions('user_admin_notices');
        remove_all_actions('admin_notices');
    }

    static function upload_max_increase_upload( $data ): int {
        return get_option('max_file_size') ? get_option('max_file_size') : $data;
    }
}

add_action('init', array( 'Codepopular_WMUFS', 'init' ));
?>
