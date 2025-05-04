
<div class="wrap wmufs_mb_50">
    <h1><span class="dashicons dashicons-database-view" style="font-size: inherit; line-height: unset;"></span> <?php echo esc_html_e( 'System Status', 'wp-maximum-upload-file-size' ); ?></h1><br>
    <div class="wmufs_admin_deashboard">
        <!-- Row -->
        <div class="wmufs_row" id="poststuff">

            <!-- Start Content Area -->
            <div class="wmufs_admin_left wmufs_card wmufs-col-8">
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


                <div class="support-ticket">
                    <h2><?php echo esc_html__('Do you need any free help?', 'wp-maximum-upload-file-size'); ?></h2>
                    <a target="_blank" href="<?php echo esc_url_raw('https://wordpress.org/support/plugin/wp-maximum-upload-file-size/');?>"><?php echo esc_html__('Open Ticket', 'wp-maximum-upload-file-size'); ?></a>
                </div>


            </div>
            <!-- End Content Area -->

            <!-- Start Sidebar Area -->
            <div class="wmufs_admin_right_sidebar wmufs_card wmufs-col-4">
                <?php include WMUFS_PLUGIN_PATH . 'admin/templates/class-wmufs-sidebar.php'; ?>
            </div>
            <!-- End Sidebar area-->

        </div> <!-- End Row--->
    </div>
</div> <!-- End Wrapper -->

