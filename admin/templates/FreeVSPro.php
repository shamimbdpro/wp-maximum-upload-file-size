
<div class="wrap wmufs_mb_50">
    <h1><span class="dashicons dashicons-admin-settings" style="font-size: inherit; line-height: unset;"></span> <?php echo esc_html_e( 'Pricing', 'wp-maximum-upload-file-size' ); ?></h1><br>
    <div class="wmufs_admin_deashboard">
        <!-- Row -->
        <div class="wmufs_row" id="poststuff">

            <!-- Start Content Area -->
            <div class="wmufs_admin_left wmufs_card wmufs-col-8">


                <table class="wmufs-system-status">
                    <tr>
                        <th><?php esc_html_e('Feature','wp-maximum-upload-file-size');?></th>
                        <th><?php esc_html_e('Free', 'wp-maximum-upload-file-size');?></th>
                        <th><?php esc_html_e('Pro', 'wp-maximum-upload-file-size');?></th>
                    </tr>

                    <tr>
                        <td><?php esc_html_e('View Current Upload Limit', 'wp-maximum-upload-file-size');?></td>
                        <td><span class="dashicons dashicons-yes"></span></td>
                        <td><span class="dashicons dashicons-yes"></span></td>
                    </tr>
                    <tr>
                        <td><?php esc_html_e('Increase Upload Limit', 'wp-maximum-upload-file-size');?></td>
                        <td><span class="dashicons dashicons-warning"></span> <?php esc_html_e('Limited', 'wp-maximum-upload-file-size');?></td>
                        <td><span class="dashicons dashicons-yes"></span> <?php esc_html_e('Full Control', 'wp-maximum-upload-file-size');?></td>
                    </tr>
                    <tr>
                        <td><?php esc_html_e('Server Compatibility Detection', 'wp-maximum-upload-file-size');?></td>
                        <td><span class="dashicons dashicons-no"></span></td>
                        <td><span class="dashicons dashicons-yes"></span></td>
                    </tr>
                    <tr>
                        <td><?php esc_html_e('One-click Fix Suggestions', 'wp-maximum-upload-file-size');?></td>
                        <td><span class="dashicons dashicons-no"></span></td>
                        <td><span class="dashicons dashicons-yes"></span></td>
                    </tr>
                    <tr>
                        <td><?php esc_html_e('Multisite Support', 'wp-maximum-upload-file-size');?></td>
                        <td><span class="dashicons dashicons-no"></span></td>
                        <td><span class="dashicons dashicons-yes"></span></td>
                    </tr>
                    <tr>
                        <td><?php esc_html_e('Priority Support', 'wp-maximum-upload-file-size');?></td>
                        <td><span class="dashicons dashicons-no"></span></td>
                        <td><span class="dashicons dashicons-yes"></span></td>
                    </tr>
                </table>



                <div class="support-ticket">
                    <h2><?php echo esc_html__('Do you need any free help?', 'wp-maximum-upload-file-size'); ?></h2>
                    <a target="_blank" href="<?php echo esc_url_raw('https://wordpress.org/support/plugin/wp-maximum-upload-file-size/');?>"><?php echo esc_html__('Open Ticket', 'wp-maximum-upload-file-size'); ?></a>
                </div>


            </div>
            <!-- End Content Area -->

            <!-- Start Sidebar Area -->
            <div class="wmufs_admin_right_sidebar wmufs_card wmufs-col-4">
                <?php include_once WMUFS_PLUGIN_PATH . 'admin/templates/class-wmufs-sidebar.php'; ?>
            </div>
            <!-- End Sidebar area-->

        </div> <!-- End Row--->
    </div>
</div> <!-- End Wrapper -->

