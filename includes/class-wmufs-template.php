<?php

include_once WMUFS_PLUGIN_PATH . 'includes/class-wmufs-helper.php';

//if (isset($_GET['max-size-updated'])) { ?>
<!--    <div class="notice-success notice is-dismissible">-->
<!--        <p>Maximum Upload File Size Saved Changed!</p>-->
<!--    </div>-->
<?php //}//

$ini_size = ini_get('upload_max_filesize');

if (!$ini_size) {
    $ini_size = 'unknown';
} elseif (is_numeric($ini_size)) {
    $ini_size .= ' bytes';
} else {
    $ini_size .= 'B';
}

$wp_size = wp_max_upload_size();
if (!$wp_size) {
    $wp_size = 'unknown';
} else {
    $wp_size = round(($wp_size / 1024 / 1024));
    $wp_size = $wp_size == 1024 ? '1GB' : $wp_size . 'MB';
}

$max_size = get_option('max_file_size');
if (!$max_size) {
    $max_size = 64 * 1024 * 1024;
}
$max_size = $max_size / 1024 / 1024;
$upload_sizes = array(16, 32, 64, 128, 256, 512, 1024);
$current_max_size = self::get_closest($max_size, $upload_sizes);

?>

<div class="wrap wmufs_mb_50">
    <h1><span class="dashicons dashicons-upload" style="font-size: inherit; line-height: unset;"></span> Wp Maximum Upload File Size</h1><br>

    <p class="gray-box"><b>Important</b>: if you want to upload files larger than <?php echo $ini_size; ?> (which is the limit set by your hosting provider) you have to contact your hosting provider.<br>It\'s <b>NOT POSSIBLE</b> to increase that hosting defined upload limit from a plugin.</p>

   <p>
       Maximum upload file size, set by your hosting provider <?php echo $ini_size; ?> <br>
       Maximum upload file size, set by WordPress: <?php echo $wp_size; ?>
   </p>

    <div class="wmufs_admin_deashboard">
        <!-- Row -->
        <div class="wmufs_row">

            <!-- Start Content Area -->
            <div class="wmufs_admin_left wmufs_card wmufs-col-8">
                <form method="post">
                   <?php settings_fields("header_section"); ?>
                    <table class="form-table">
                        <tbody>
                        <tr>
                            <th scope="row"><label for="upload_max_file_size_field">Choose Maximum Upload File Size</label></th>
                            <td>
                                <select id="upload_max_file_size_field" name="upload_max_file_size_field"> <?php
                                    foreach ($upload_sizes as $size) {
                                    echo '<option value="' . $size . '" ' . ($size == $current_max_size ? 'selected' : '') . '>' . ($size == 1024 ? '1GB' : $size . 'MB') . '</option>';
                                    } ?>
                                </select>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                    <?php wp_nonce_field('upload_max_file_size_action', 'upload_max_file_size_nonce'); ?>
                    <?php submit_button(); ?>
                </form>

                <table class="wmufs-system-status">

                    <tr>
                        <th><?php esc_html_e('Title','wp-maximum-upload-file-size');?></th>
                        <th><?php esc_html_e('Status', 'wp-maximum-upload-file-size');?></th>
                        <th><?php esc_html_e('Message', 'wp-maximum-upload-file-size');?></th>
                    </tr>
                    <!-- PHP Version -->
                    <?php
                    foreach ( $system_status as $value ) { ?>
                    <tr>
                        <td><?php printf( '%s', esc_html( $value['title'] ) ); ?></td>

                        <td>
                            <?php if ( 1 == $value['status'] ) { ?>
                                <span class="dashicons dashicons-yes"></span>
                            <?php } else { ?>
                                <span class="dashicons dashicons-warning"></span>

                            <?php }; ?>
                        </td>
                        <td>
                            <?php if ( 1 == $value['status'] ) { ?>
                                <p class="wpifw_status_message">  <?php printf( '%s', esc_html( $value['version'] ) ); ?> <?php echo $value['success_message']; //phpcs:ignore ?></p>
                            <?php } else { ?>
                                <?php printf( '%s', esc_html( $value['version'] ) ); ?>
                                <p class="wpifw_status_message"><?php echo $value['error_message']; //phpcs:ignore ?></p>

                            <?php }; ?>

                        </td>
                    </tr>
                    <?php } ?>
                </table>


            </div>
            <!-- End Content Area -->

            <!-- Start Sidebar Area -->
            <div class="wmufs_admin_right_sidebar wmufs_card wmufs-col-4">
                <?php include_once WMUFS_PLUGIN_PATH . 'includes/class-wmufs-sidebar.php'; ?>
            </div>
            <!-- End Sidebar area-->

        </div> <!-- End Row--->
    </div>
</div> <!-- End Wrapper -->

