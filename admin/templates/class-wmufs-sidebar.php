
<!-- Premium Features List -->
<?php if(WMUFS_Helper::get_upgrade_url()){ ?>
    <div class="wmufs_faq_section">
        <h2>Frequently Asked Questions</h2>
        <div class="wmufs_faq_item">
            <strong>Q: What happens if I set a file size higher than my server allows?</strong>
            <p>A: Your server configuration will override this setting. Please update your <code>php.ini</code>, <code>.htaccess</code>, or contact your host.</p>
        </div>
        <div class="wmufs_faq_item">
            <strong>Q: What is the recommended maximum execution time?</strong>
            <p>A: For large uploads or slow connections, 300 to 600 seconds is recommended. Confirm limits with your host.</p>
        </div>
        <div class="wmufs_faq_item">
            <strong>Q: Why don’t changes take effect immediately?</strong>
            <p>A: Server caching or PHP-FPM may delay changes. Clear server cache or restart PHP services.</p>
        </div>
        <div class="wmufs_faq_item">
            <strong>Q: Can I upload files larger than 2GB?</strong>
            <p>A: It depends on your PHP/server configuration. Many shared hosts do not allow uploads > 2GB.</p>
        </div>
        <div class="wmufs_faq_item">
            <strong>Q: Where can I find my current server limits?</strong>
            <p>A: Go to <code>Tools > Site Health > Info || System Status Tab</code> or ask your host.</p>
        </div>
    </div>

<?php } ?>

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
