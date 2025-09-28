<?php
/**
 * Upgrade to Pro template
 * Shows upgrade prompts for premium features
 */

if (!defined('ABSPATH')) {
    exit;
}

$current_tab = isset($_GET['tab']) ? sanitize_text_field($_GET['tab']) : '';

$features = array(
    'upload_logs' => array(
        'title' => __('Upload Logs', 'wp-maximum-upload-file-size'),
        'description' => __('Track and monitor all file uploads with detailed logging including user information, file details, upload timestamps, and success/failure status.', 'wp-maximum-upload-file-size'),
        'benefits' => array(
            __('Complete upload history tracking', 'wp-maximum-upload-file-size'),
            __('User-specific upload monitoring', 'wp-maximum-upload-file-size'),
            __('File size and type analytics', 'wp-maximum-upload-file-size'),
            __('Upload success/failure tracking', 'wp-maximum-upload-file-size'),
            __('Exportable logs for reporting', 'wp-maximum-upload-file-size')
        )
    ),
    'user_limits' => array(
        'title' => __('User-Specific Limits', 'wp-maximum-upload-file-size'),
        'description' => __('Set individual upload limits for specific users, giving you granular control over who can upload what size files.', 'wp-maximum-upload-file-size'),
        'benefits' => array(
            __('Individual user upload limits', 'wp-maximum-upload-file-size'),
            __('Per-user storage quotas', 'wp-maximum-upload-file-size'),
            __('User upload statistics', 'wp-maximum-upload-file-size'),
            __('Flexible limit management', 'wp-maximum-upload-file-size'),
            __('Override role-based restrictions', 'wp-maximum-upload-file-size')
        )
    ),
    'role_limits' => array(
        'title' => __('Role-Based Restrictions', 'wp-maximum-upload-file-size'),
        'description' => __('Configure upload limits based on WordPress user roles, ensuring different user types have appropriate upload permissions.', 'wp-maximum-upload-file-size'),
        'benefits' => array(
            __('Role-specific upload limits', 'wp-maximum-upload-file-size'),
            __('Automatic role-based enforcement', 'wp-maximum-upload-file-size'),
            __('Flexible role management', 'wp-maximum-upload-file-size'),
            __('Security-focused restrictions', 'wp-maximum-upload-file-size'),
            __('Easy bulk user management', 'wp-maximum-upload-file-size')
        )
    ),
    'statistics' => array(
        'title' => __('Advanced Statistics', 'wp-maximum-upload-file-size'),
        'description' => __('Get comprehensive insights into your site\'s upload patterns with detailed statistics, charts, and reporting features.', 'wp-maximum-upload-file-size'),
        'benefits' => array(
            __('Upload trend analysis', 'wp-maximum-upload-file-size'),
            __('User activity reports', 'wp-maximum-upload-file-size'),
            __('Storage usage insights', 'wp-maximum-upload-file-size'),
            __('Top uploaders identification', 'wp-maximum-upload-file-size'),
            __('Visual charts and graphs', 'wp-maximum-upload-file-size')
        )
    )
);

$current_feature = $features[$current_tab] ?? $features['upload_logs'];

$upgrade_url = WMUFS_Helper::get_upgrade_url();
?>

<div class="wmufs-upgrade-pro-container">
    <div class="wmufs-upgrade-hero">
        <div class="wmufs-upgrade-icon">
            <span class="dashicons dashicons-star-filled"></span>
        </div>
        <h2>
            <?php echo esc_html($current_feature['title']); ?>
            <span class="wmufs-pro-badge"><?php _e('PRO', 'wp-maximum-upload-file-size'); ?></span>
        </h2>
        <p class="wmufs-upgrade-description"><?php echo esc_html($current_feature['description']); ?></p>
    </div>

    <div class="wmufs-upgrade-content">
        <div class="wmufs-upgrade-benefits">
            <h3><?php _e('What you\'ll get', 'wp-maximum-upload-file-size'); ?></h3>
            <ul class="wmufs-benefits-list">
                <?php foreach ($current_feature['benefits'] as $benefit): ?>
                    <li>
                        <span class="dashicons dashicons-yes-alt"></span>
                        <?php echo esc_html($benefit); ?>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>

        <div class="wmufs-upgrade-preview">
            <h3><?php _e('Preview', 'wp-maximum-upload-file-size'); ?></h3>
            <div class="wmufs-preview-mockup">
                <?php if ($current_tab === 'upload_logs'): ?>
                    <div class="wmufs-mockup-table">
                        <div class="mockup-header">
                            <div><?php _e('Date', 'wp-maximum-upload-file-size'); ?></div>
                            <div><?php _e('User', 'wp-maximum-upload-file-size'); ?></div>
                            <div><?php _e('File Name', 'wp-maximum-upload-file-size'); ?></div>
                            <div><?php _e('Size', 'wp-maximum-upload-file-size'); ?></div>
                            <div><?php _e('Status', 'wp-maximum-upload-file-size'); ?></div>
                        </div>
                        <div class="mockup-row">
                            <div>2024-01-15 14:30</div>
                            <div>John Doe</div>
                            <div>document.pdf</div>
                            <div>2.5 MB</div>
                            <div><span class="status-success">Success</span></div>
                        </div>
                        <div class="mockup-row">
                            <div>2024-01-15 14:25</div>
                            <div>Jane Smith</div>
                            <div>image.jpg</div>
                            <div>1.8 MB</div>
                            <div><span class="status-success">Success</span></div>
                        </div>
                    </div>
                <?php elseif ($current_tab === 'statistics'): ?>
                    <div class="wmufs-mockup-stats">
                        <div class="stat-box">
                            <h4><?php _e('Total Uploads', 'wp-maximum-upload-file-size'); ?></h4>
                            <div class="stat-number">1,247</div>
                        </div>
                        <div class="stat-box">
                            <h4><?php _e('Total Size', 'wp-maximum-upload-file-size'); ?></h4>
                            <div class="stat-number">15.6 GB</div>
                        </div>
                        <div class="stat-box">
                            <h4><?php _e('Active Users', 'wp-maximum-upload-file-size'); ?></h4>
                            <div class="stat-number">89</div>
                        </div>
                    </div>
                <?php else: ?>
                    <div class="wmufs-mockup-form">
                        <div class="mockup-field">
                            <label><?php _e('User/Role', 'wp-maximum-upload-file-size'); ?></label>
                            <div class="mockup-input">Select user or role...</div>
                        </div>
                        <div class="mockup-field">
                            <label><?php _e('Upload Limit (MB)', 'wp-maximum-upload-file-size'); ?></label>
                            <div class="mockup-input">50</div>
                        </div>
                        <div class="mockup-button">Save Limits</div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <!-- Feature Comparison Table -->
    <div class="wmufs-upgrade-compare">
        <h3><?php _e('Compare Free vs Pro', 'wp-maximum-upload-file-size'); ?></h3>
        <table class="widefat striped wmufs-compare-table">
            <thead>
            <tr>
                <th><?php _e('Features', 'wp-maximum-upload-file-size'); ?></th>
                <th style="text-align:center;"><?php _e('Free', 'wp-maximum-upload-file-size'); ?></th>
                <th style="text-align:center;"><?php _e('Pro', 'wp-maximum-upload-file-size'); ?></th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td><?php _e('Set upload limits globally', 'wp-maximum-upload-file-size'); ?></td>
                <td class="check"><span class="dashicons dashicons-yes"></span></td>
                <td class="check"><span class="dashicons dashicons-yes"></span></td>
            </tr>
            <tr>
                <td><?php _e('Set upload limits by user role', 'wp-maximum-upload-file-size'); ?></td>
                <td class="cross"><span class="dashicons dashicons-no-alt"></span></td>
                <td class="check"><span class="dashicons dashicons-yes"></span></td>
            </tr>
            <tr>
                <td><?php _e('User-specific upload limits & quotas', 'wp-maximum-upload-file-size'); ?></td>
                <td class="cross"><span class="dashicons dashicons-no-alt"></span></td>
                <td class="check"><span class="dashicons dashicons-yes"></span></td>
            </tr>
            <tr>
                <td><?php _e('Upload logs & monitoring', 'wp-maximum-upload-file-size'); ?></td>
                <td class="cross"><span class="dashicons dashicons-no-alt"></span></td>
                <td class="check"><span class="dashicons dashicons-yes"></span></td>
            </tr>
            <tr>
                <td><?php _e('Advanced system status dashboard', 'wp-maximum-upload-file-size'); ?></td>
                <td class="cross"><span class="dashicons dashicons-no-alt"></span></td>
                <td class="check"><span class="dashicons dashicons-yes"></span></td>
            </tr>
            <tr>
                <td><?php _e('Upload statistics & charts', 'wp-maximum-upload-file-size'); ?></td>
                <td class="cross"><span class="dashicons dashicons-no-alt"></span></td>
                <td class="check"><span class="dashicons dashicons-yes"></span></td>
            </tr>
            <tr>
                <td><?php _e('Restrict file types by role', 'wp-maximum-upload-file-size'); ?></td>
                <td class="cross"><span class="dashicons dashicons-no-alt"></span></td>
                <td class="check"><span class="dashicons dashicons-yes"></span></td>
            </tr>
            <tr>
                <td><?php _e('Calculate total storage used', 'wp-maximum-upload-file-size'); ?></td>
                <td class="cross"><span class="dashicons dashicons-no-alt"></span></td>
                <td class="check"><span class="dashicons dashicons-yes"></span></td>
            </tr>
            <tr>
                <td><?php _e('Malware scan in media library', 'wp-maximum-upload-file-size'); ?></td>
                <td class="cross"><span class="dashicons dashicons-no-alt"></span></td>
                <td class="check"><span class="dashicons dashicons-yes"></span></td>
            </tr>
            <tr>
                <td><?php _e('Premium support from our expert team', 'wp-maximum-upload-file-size'); ?></td>
                <td class="cross"><span class="dashicons dashicons-no-alt"></span></td>
                <td class="check"><span class="dashicons dashicons-yes"></span></td>
            </tr>
            </tbody>
        </table>
    </div>


    <div class="wmufs-upgrade-cta">
        <h3><?php _e('Upgrade to Pro Today!', 'wp-maximum-upload-file-size'); ?></h3>
        <p><?php _e('Get access to all premium features and take full control of your WordPress uploads.', 'wp-maximum-upload-file-size'); ?></p>

        <div class="wmufs-upgrade-buttons">
            <a href="<?php echo esc_url($upgrade_url); ?>" target="_blank" class="button button-primary button-hero wmufs-upgrade-btn">
                <?php _e('Upgrade to Pro', 'wp-maximum-upload-file-size'); ?>
            </a>
            <a href="<?php echo esc_url($upgrade_url); ?>" target="_blank" class="button wmufs-learn-more">
                <?php _e('Learn More', 'wp-maximum-upload-file-size'); ?>
            </a>
        </div>

        <div class="wmufs-upgrade-guarantee">
            <span class="dashicons dashicons-shield-alt"></span>
            <?php _e('30-day money-back guarantee. Secure checkout.', 'wp-maximum-upload-file-size'); ?>
        </div>
    </div>
</div>

<style>
    .wmufs-upgrade-pro-container {
        margin: 25px 0;
        background: #fff;
        border: 1px solid #e5e7eb;
        border-radius: 10px;
        overflow: hidden;
        box-shadow: 0 4px 12px rgba(0,0,0,0.05);
        font-family: "Segoe UI", Roboto, Arial, sans-serif;
    }

    /* Hero */
    .wmufs-upgrade-hero {
        background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 100%);
        color: white;
        padding: 50px 30px;
        text-align: center;
    }

    .wmufs-upgrade-icon {
        font-size: 56px;
        margin-bottom: 20px;
    }

    .wmufs-upgrade-hero h2 {
        margin: 0 0 15px 0;
        font-size: 30px;
        font-weight: 700;
    }

    .wmufs-upgrade-description {
        font-size: 17px;
        opacity: 0.95;
        margin: 0 auto;
        max-width: 700px;
        line-height: 1.6;
    }

    /* Content */
    .wmufs-upgrade-content {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 40px;
        padding: 50px;
    }

    .wmufs-upgrade-benefits h3,
    .wmufs-upgrade-preview h3 {
        margin-top: 0;
        color: #1f2937;
        font-size: 20px;
        font-weight: 600;
    }

    .wmufs-benefits-list {
        list-style: none;
        padding: 0;
        margin: 20px 0;
    }

    .wmufs-benefits-list li {
        display: flex;
        align-items: center;
        margin-bottom: 14px;
        font-size: 15px;
        color: #374151;
    }

    .wmufs-benefits-list .dashicons {
        color: #10b981;
        margin-right: 10px;
        font-size: 18px;
    }

    .wmufs-preview-mockup {
        background: #f9fafb;
        border: 1px solid #e5e7eb;
        border-radius: 8px;
        padding: 20px;
        margin-top: 15px;
    }

    .wmufs-mockup-table {
        font-size: 13px;
    }

    .mockup-header {
        display: grid;
        grid-template-columns: 1fr 1fr 1.5fr 0.8fr 0.8fr;
        gap: 10px;
        font-weight: 600;
        padding: 10px 0;
        border-bottom: 2px solid #ddd;
        margin-bottom: 10px;
    }

    .mockup-row {
        display: grid;
        grid-template-columns: 1fr 1fr 1.5fr 0.8fr 0.8fr;
        gap: 10px;
        padding: 8px 0;
        border-bottom: 1px solid #eee;
    }

    .status-success {
        color: #10b981;
        font-weight: 600;
    }

    .wmufs-mockup-stats {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 15px;
    }

    .stat-box {
        text-align: center;
        padding: 20px;
        background: white;
        border: 1px solid #ddd;
        border-radius: 6px;
        box-shadow: 0 1px 3px rgba(0,0,0,0.05);
    }

    .stat-box h4 {
        margin: 0 0 8px 0;
        font-size: 14px;
        color: #6b7280;
    }

    .stat-number {
        font-size: 22px;
        font-weight: 700;
        color: #111827;
    }

    .wmufs-mockup-form .mockup-field {
        margin-bottom: 15px;
    }

    .mockup-field label {
        display: block;
        margin-bottom: 6px;
        font-weight: 600;
        color: #333;
    }

    .mockup-input {
        padding: 8px 12px;
        border: 1px solid #ddd;
        border-radius: 4px;
        background: white;
        width: 100%;
        box-sizing: border-box;
    }

    .mockup-button {
        background: #4f46e5;
        color: white;
        padding: 10px 20px;
        border-radius: 4px;
        text-align: center;
        margin-top: 15px;
        font-weight: 600;
        cursor: not-allowed;
        opacity: 0.8;
    }


    .wmufs-upgrade-compare {
        margin: 50px auto;
        padding: 20px;
        background: #f9fafb;
        border: 1px solid #e5e7eb;
        border-radius: 8px;
    }

    .wmufs-upgrade-compare h3 {
        text-align: center;
        font-size: 22px;
        margin-bottom: 20px;
        font-weight: 600;
        color: #111827;
    }

    .wmufs-compare-table th {
        text-align: center;
        background: #f3f4f6;
        font-weight: 600;
    }

    .wmufs-compare-table td {
        text-align: center;
        font-size: 14px;
    }

    .wmufs-compare-table td:first-child {
        text-align: left;
        font-weight: 500;
        color: #374151;
    }

    .wmufs-compare-table .check .dashicons {
        color: #10b981;
        font-size: 18px;
    }

    .wmufs-compare-table .cross .dashicons {
        color: #ef4444;
        font-size: 18px;
    }


    /* CTA */
    .wmufs-upgrade-cta {
        background: #f3f4f6;
        padding: 50px 30px;
        text-align: center;
        border-top: 1px solid #e5e7eb;
    }

    .wmufs-upgrade-cta h3 {
        margin-top: 0;
        font-size: 26px;
        color: #111827;
        font-weight: 700;
    }

    .wmufs-upgrade-buttons {
        margin: 25px 0;
    }

    .wmufs-upgrade-btn {
        margin-right: 15px;
        font-size: 16px;
        padding: 14px 32px !important;
        height: auto !important;
        background: linear-gradient(90deg, #4f46e5, #7c3aed) !important;
        border: none !important;
    }

    .wmufs-learn-more {
        font-size: 16px;
        padding: 12px 25px !important;
        height: auto !important;
        border-radius: 6px;
    }

    .wmufs-upgrade-guarantee {
        display: flex;
        align-items: center;
        justify-content: center;
        margin-top: 20px;
        color: #6b7280;
        font-size: 14px;
    }

    .wmufs-upgrade-guarantee .dashicons {
        margin-right: 8px;
        color: #10b981;
    }

    .wmufs-pro-badge {
        background: #ef4444;
        color: white;
        font-size: 11px;
        padding: 3px 7px;
        border-radius: 4px;
        margin-left: 8px;
        font-weight: 700;
        vertical-align: middle;
    }

    @media (max-width: 768px) {
        .wmufs-upgrade-content {
            grid-template-columns: 1fr;
            gap: 30px;
            padding: 30px 20px;
        }

        .wmufs-upgrade-hero {
            padding: 40px 20px;
        }

        .mockup-header,
        .mockup-row {
            grid-template-columns: 1fr;
            gap: 5px;
        }

        .wmufs-mockup-stats {
            grid-template-columns: 1fr;
        }
    }
</style>
