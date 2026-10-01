<div class="wrap wmufs_mb_50">
    <h1>
        <span class="dashicons dashicons-database-view system-status-icon"></span>
		<?php esc_html_e( 'System Status', 'wp-maximum-upload-file-size' ); ?>
    </h1>
    <br>

    <div class="wmufs_admin_deashboard">
        <div class="wmufs_row" id="poststuff">

            <!-- Start Content Area -->
            <div class="wmufs_admin_left wmufs_card wmufs-col-8 wmufs-system-health">
				<?php foreach ( $system_status as $group ) : ?>
                    <section class="wmufs-status-group wmufs-card">
                        <h2 class="wmufs-status-group__title"><?php echo esc_html( $group['group'] ); ?></h2>
                        <div class="wmufs-status-table-wrap">
                    <table class="wmufs-system-status">
                        <thead>
                        <tr>
                            <th scope="col" class="wmufs-system-status__col-title"><?php esc_html_e('Title','wp-maximum-upload-file-size');?></th>
                            <th scope="col" class="wmufs-system-status__col-status"><?php esc_html_e('Status', 'wp-maximum-upload-file-size');?></th>
                            <th scope="col" class="wmufs-system-status__col-message"><?php esc_html_e('Message', 'wp-maximum-upload-file-size');?></th>
                        </tr>
                        </thead>
                        <tbody>
						<?php foreach ( $group['status'] as $item ) : ?>
                            <tr>
                                <td class="wmufs-system-status__col-title" data-label="<?php esc_attr_e( 'Title', 'wp-maximum-upload-file-size' ); ?>"><?php echo esc_html( $item['title'] ); ?></td>
                                <td class="wmufs-system-status__col-status" data-label="<?php esc_attr_e( 'Status', 'wp-maximum-upload-file-size' ); ?>">
									<?php if ( 1 == $item['status'] ) : ?>
                                        <span class="wmufs-status-pill wmufs-status-pill--ok" title="<?php esc_attr_e( 'OK', 'wp-maximum-upload-file-size' ); ?>"><span class="dashicons dashicons-yes" aria-hidden="true"></span></span>
									<?php else : ?>
                                        <span class="wmufs-status-pill wmufs-status-pill--warn" title="<?php esc_attr_e( 'Needs attention', 'wp-maximum-upload-file-size' ); ?>"><span class="dashicons dashicons-warning" aria-hidden="true"></span></span>
									<?php endif; ?>
                                </td>
                                <td class="wmufs-system-status__col-message" data-label="<?php esc_attr_e( 'Message', 'wp-maximum-upload-file-size' ); ?>">
									<?php if ( 1 == $item['status'] ) : ?>
                                        <p class="wpifw_status_message">
											<?php echo esc_html( $item['version'] ); ?>
											<?php echo $item['success_message']; //phpcs:ignore ?>
                                        </p>
									<?php else : ?>
										<?php echo esc_html( $item['version'] ); ?>
                                        <p class="wpifw_status_message"><?php echo $item['error_message']; //phpcs:ignore ?></p>
									<?php endif; ?>
                                </td>
                            </tr>
						<?php endforeach; ?>
                        </tbody>
                    </table>
                        </div>
                    </section>
				<?php endforeach; ?>
            </div>

            <!-- Start Sidebar Area -->
            <div class="wmufs_admin_right_sidebar wmufs_card wmufs-col-4">
				<?php include WMUFS_PLUGIN_PATH . 'admin/templates/class-wmufs-sidebar.php'; ?>
            </div>

        </div>
    </div>
</div>
