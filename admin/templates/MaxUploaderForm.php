<?php
$max_uploader_settings = get_option('wmufs_settings', []);
$max_size = $max_uploader_settings['max_limits']['all'] ?? '';
if (!$max_size) {
    $max_size = wp_max_upload_size();
}
$max_size = $max_size / 1024 / 1024;

// Unified size options (16 MB to 10 GB)
$size_options = array(
    '16' => '16 MB',
    '32' => '32 MB',
    '40' => '40 MB',
    '64' => '64 MB',
    '128' => '128 MB',
    '256' => '256 MB',
    '512' => '512 MB',
    '1024' => '1 GB',
    '2048' => '2 GB',
    '3072' => '3 GB',
    '4096' => '4 GB',
    '5120' => '5 GB',
    '10240' => '10 GB',
);

// Add custom upload size if needed
if (!isset($size_options[(string)$max_size])) {
    $size_options[(string)$max_size] = $max_size . ' MB';
    ksort($size_options, SORT_NUMERIC);
}

// Execution time
$wpufs_max_execution_time = $max_uploader_settings['max_execution_time'] ?? '';
$wpufs_max_execution_time = $wpufs_max_execution_time ?: ini_get('max_execution_time');

// Get memory limit
$max_uploader_customize_memory_limit = $max_uploader_settings['max_memory_limit'] ?? '';
if ($max_uploader_customize_memory_limit) {
    $memory_limit_mb = $max_uploader_customize_memory_limit / 1024 / 1024;
} else {
    $memory_limit_mb = ini_get('memory_limit');
}

if ($memory_limit_mb && preg_match('/(\d+)([KMG]?)/i', $memory_limit_mb, $matches)) {
    $value = (int)$matches[1];
    $unit = strtoupper($matches[2]);
    switch ($unit) {
        case 'G':
            $memory_limit_mb = $value * 1024;
            break;
        case 'K':
            $memory_limit_mb = (int)($value / 1024);
            break;
        default:
            $memory_limit_mb = $value;
            break;
    }
}

// Add detected memory limit if not present
if (!isset($size_options[(string)$memory_limit_mb])) {
    $label = ($memory_limit_mb >= 1024) ? ($memory_limit_mb / 1024) . ' GB' : $memory_limit_mb . ' MB';
    $size_options[(string)$memory_limit_mb] = $label;
    ksort($size_options, SORT_NUMERIC);
}

// Make sure $memory_limit_mb is always defined
if (!isset($memory_limit_mb)) {
    $memory_limit_mb = 0;
}

// Check if pro/premium is active
$pro_active = WMUFS_Helper::is_premium_active();
?>

<div class="wrap wmufs_mb_50">
    <h1><span class="dashicons dashicons-admin-settings" style="font-size: inherit; line-height: unset;"></span>
        <?php esc_html_e('Control Upload Limits', 'wp-maximum-upload-file-size'); ?>
    </h1><br>

    <div class="wmufs_admin_deashboard">
        <div class="wmufs_row" id="poststuff">

            <!-- Start Content Area -->
            <div class="wmufs_admin_left wmufs_card wmufs-col-8 wmufs_form_centered">
                <div class="wmufs_inner_form_box">
                    <div class="wmufs-card wmufs-toggle-card">
                        <h3 class="wmufs-card-title">Select Upload Limit Mode</h3>

                        <div class="wmufs-toggle-buttons">
                            <button type="button" class="wmufs-toggle-btn active" data-target="#all-users-section">Global Limit</button>
                            <button type="button" class="wmufs-toggle-btn" data-target="#role-based-section">Role-Based Limit <?php if(!$pro_active){?><span class="wmufs-pro-badge">PRO</span><?php } ?></button>
                        </div>

                        <div id="all-users-section" class="wmufs-toggle-section">
                            <!-- All Users Form -->
                            <form method="post" action="options.php">
                                <?php settings_fields('wmufs_settings_group'); ?>
                                <h2><?php esc_html_e('Apply Upload Limit for All Users', 'wp-maximum-upload-file-size'); ?></h2>
                                <table class="form-table">
                                    <tbody>
                                    <tr>
                                        <th scope="row"><label for="max_file_size_field"><?php esc_html_e('Choose Upload File Size', 'wp-maximum-upload-file-size'); ?></label></th>
                                        <td>
                                            <select id="max_file_size_field" name="wmufs_settings[max_limits][all]">
                                                <?php
                                                foreach ($size_options as $key => $size) {
                                                    echo '<option value="' . esc_attr($key) . '" ' . selected($key, $max_size, false) . '>' . esc_html($size) . '</option>';
                                                }
                                                ?>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="row"><label for="max_execution_time_field"><?php esc_html_e('Execution Time', 'wp-maximum-upload-file-size'); ?></label></th>
                                        <td>
                                            <input id="max_execution_time_field" name="wmufs_settings[max_execution_time]" type="number" value="<?php echo esc_attr($wpufs_max_execution_time); ?>">
                                            <br><small><?php esc_html_e('Example: 300, 600, 1800, 3600', 'wp-maximum-upload-file-size'); ?></small>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="row"><label for="max_memory_limit_field"><?php esc_html_e('Memory Limit', 'wp-maximum-upload-file-size'); ?></label></th>
                                        <td>
                                            <select id="max_memory_limit_field" name="wmufs_settings[max_memory_limit]">
                                                <?php
                                                foreach ($size_options as $key => $label) {
                                                    echo '<option value="' . esc_attr($key) . '" ' . selected($key, $memory_limit_mb, false) . '>' . esc_html($label) . '</option>';
                                                }
                                                ?>
                                            </select>
                                            <?php if ((int)$memory_limit_mb > 4096): ?>
                                                <p style="color: red; font-weight: bold;">⚠️ <?php esc_html_e('Warning: Setting the memory limit above 4 GB may cause server instability on shared hosting environments.', 'wp-maximum-upload-file-size'); ?></p>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>

                                <?php wp_nonce_field('upload_max_file_size_action', 'upload_max_file_size_nonce'); ?>
                                <?php submit_button(); ?>
                            </form>
                        </div>

                        <div id="role-based-section" class="wmufs-toggle-section" style="display:none;">
                            <?php
                            $roles = WMUFS_Helper::get_available_roles();
                            $role_limits = WMUFS_Helper::get_role_limits();
                            ?>
                            <h2><?php _e('Role-Based Upload Limits', 'wp-maximum-upload-file-size'); ?></h2>
                            <?php if (!$pro_active) : ?>
                                <p><?php esc_html_e('Upgrade to Pro to edit role-based upload limits.', 'wp-maximum-upload-file-size'); ?> <a href="https://x.ai/grok" target="_blank"><?php _e('Learn More', 'wp-maximum-upload-file-size'); ?></a></p>
                            <?php endif; ?>
                            <table class="wp-list-table widefat fixed striped">
                                <thead>
                                <tr>
                                    <th><?php _e('Role', 'wp-maximum-upload-file-size'); ?></th>
                                    <th><?php _e('Display Name', 'wp-maximum-upload-file-size'); ?></th>
                                    <th><?php _e('Upload Limit (MB)', 'wp-maximum-upload-file-size'); ?></th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach ($roles as $role_key => $role_data):
                                    $current_limit = isset($role_limits[$role_key]) ? $role_limits[$role_key] / (1024 * 1024) : 0;
                                    ?>
                                    <tr>
                                        <td><?php echo esc_html($role_key); ?></td>
                                        <td><?php echo esc_html($role_data['name']); ?></td>
                                        <td>
                                            <?php if ($pro_active) : ?>
                                                <input type="number" name="role_limits[<?php echo esc_attr($role_key); ?>]"
                                                       value="<?php echo esc_attr($current_limit); ?>" min="0" step="1" />
                                                <p><small><?php _e('0 = no limit', 'wp-maximum-upload-file-size'); ?></small></p>
                                            <?php else : ?>
                                                <span><?php _e('Upgrade Pro', 'wp-maximum-upload-file-size')?></span>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                                </tbody>
                            </table>
                            <?php if ($pro_active) : ?>
                                <form id="role-limits-form" method="post" action="options.php">
                                    <?php settings_fields('wmufs_role_limits_group'); ?>
                                    <?php wp_nonce_field('role_limits_action', 'role_limits_nonce'); ?>
                                    <input type="hidden" name="wmufs_role_limits" value="<?php echo esc_attr(json_encode($role_limits)); ?>">
                                    <p class="submit">
                                        <button type="submit" class="button button-primary"><?php _e('Save Role Limits', 'wp-maximum-upload-file-size'); ?></button>
                                    </p>
                                </form>
                            <?php else : ?>
                                <p class="submit">
                                    <button type="button" class="button button-primary"><?php _e('Upgrade Pro', 'wp-maximum-upload-file-size'); ?><span class="wmufs-pro-badge">PRO</span></button>
                                </p>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Content Area -->

            <div class="wmufs_admin_right_sidebar wmufs_card wmufs-col-4">
                <?php include WMUFS_PLUGIN_PATH . 'admin/templates/class-wmufs-sidebar.php'; ?>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const toggleButtons = document.querySelectorAll('.wmufs-toggle-btn');
        const toggleSections = document.querySelectorAll('.wmufs-toggle-section');

        toggleButtons.forEach(button => {
            button.addEventListener('click', function() {
                // Remove active class from all buttons
                toggleButtons.forEach(btn => btn.classList.remove('active'));
                // Add active class to clicked button
                this.classList.add('active');

                // Hide all sections
                toggleSections.forEach(section => section.style.display = 'none');
                // Show the target section
                const targetSection = document.querySelector(this.dataset.target);
                if (targetSection) {
                    targetSection.style.display = 'block';
                }
            });
        });
    });
</script>