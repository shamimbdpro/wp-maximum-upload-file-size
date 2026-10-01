
<!-- Create Support Ticket -->
<div class="wmufs_card_mini wmufs_mb_20">
    <div class="support-ticket">
        <h2><?php echo esc_html__('Do you need any free help?', 'wp-maximum-upload-file-size'); ?></h2>
        <div class="support-buttons">
            <a target="_blank" class="button" href="<?php echo esc_url_raw('https://wordpress.org/support/plugin/wp-maximum-upload-file-size/');?>">
                <span class="dashicons dashicons-sos"></span>&nbsp;<?php echo esc_html__('Open Ticket', 'wp-maximum-upload-file-size'); ?>
            </a>
            <a target="_blank" class="button" href="<?php echo esc_url_raw('https://codepopular.com/contact/?utm_source=wp_dashboard&utm_medium=plugin&utm_campaign=contact_us_button');?>">
                <span class="dashicons dashicons-email"></span>&nbsp;<?php esc_html_e('Contact Us', 'wp-maximum-upload-file-size'); ?>
            </a>
            <a target="_blank" class="button button-primary" href="<?php echo esc_url_raw('https://ko-fi.com/codepopular');?>">
                <span class="dashicons dashicons-smiley"></span>&nbsp;<?php esc_html_e('Buy Me a Coffee', 'wp-maximum-upload-file-size'); ?>
            </a>
        </div>
    </div>
</div>

<!-- Pro feature list -->
<?php if ( ! WMUFS_Helper::is_premium_active() ) : ?>
<div class="wmufs_card_mini wmufs_mb_20 wmufs-pro-sidebar">
    <header class="wmufs-pro-sidebar__header">
        <span class="wmufs-pro-sidebar__label"><?php esc_html_e( 'EasyMedia Pro', 'wp-maximum-upload-file-size' ); ?></span>
        <p class="wmufs-pro-sidebar__lead"><?php esc_html_e( 'Extended logging, quotas, and media tools for growing sites.', 'wp-maximum-upload-file-size' ); ?></p>
    </header>
    <p class="wmufs-pro-sidebar__note"><?php esc_html_e( 'One-time license · No subscription', 'wp-maximum-upload-file-size' ); ?></p>
    <ul class="wmufs-pro-sidebar__features">
        <li><?php esc_html_e( 'Advanced media logs', 'wp-maximum-upload-file-size' ); ?></li>
        <li><?php esc_html_e( 'Trace media source points', 'wp-maximum-upload-file-size' ); ?></li>
        <li><?php esc_html_e( 'Per-user upload quotas', 'wp-maximum-upload-file-size' ); ?></li>
        <li><?php esc_html_e( 'Custom file types', 'wp-maximum-upload-file-size' ); ?></li>
        <li><?php esc_html_e( 'Upload restrictions by file type', 'wp-maximum-upload-file-size' ); ?></li>
        <li><?php esc_html_e( 'Statistics dashboard', 'wp-maximum-upload-file-size' ); ?></li>
        <li><?php esc_html_e( 'Advanced media manager', 'wp-maximum-upload-file-size' ); ?></li>
        <li><?php esc_html_e( 'Priority support', 'wp-maximum-upload-file-size' ); ?></li>
    </ul>
    <a target="_blank" rel="noopener noreferrer" class="button button-primary wmufs-pro-sidebar__cta" href="<?php echo esc_url( WMUFS_Helper::get_upgrade_url() ); ?>">
        <?php esc_html_e( 'View Pro details', 'wp-maximum-upload-file-size' ); ?>
    </a>
</div>
<?php endif; ?>
