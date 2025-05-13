<div class="wrap wmufs_mb_50">
    <h1>
        <span class="dashicons dashicons-money" style="font-size: inherit; line-height: unset;"></span>
		<?php echo esc_html__('Upgrade to Pro Extension', 'wp-maximum-upload-file-size'); ?>
    </h1><br>

    <div class="wmufs_admin_deashboard">
        <div class="wmufs_row" id="poststuff">

            <!-- Start Content Area -->
            <div class="wmufs_admin_left wmufs_card wmufs-col-8" style="text-align: center; padding: 40px;">

                <h2 style="font-size: 25px; margin-bottom: 20px;">
					<?php echo esc_html__('Introducing MaxUploader Pro – The Powerful Extension to Maximize WordPress Uploads', 'wp-maximum-upload-file-size'); ?>
                </h2>

                <p style="font-size: 16px; line-height: 1.8; max-width: 700px; margin: 0 auto 20px;">
					<?php echo esc_html__('MaxUploader Pro is a premium extension of your current plugin that adds game-changing features for serious site owners. Whether you run a membership site, WooCommerce store, or client projects – this upgrade puts you in complete control.', 'wp-maximum-upload-file-size'); ?>
                </p>

                <p style="font-size: 18px; font-weight: bold; color: #0073aa; margin-top: 30px;">
					<?php echo esc_html__('🎉 Launch Offer: Reserve your 50% discount today – starting at just $39!', 'wp-maximum-upload-file-size'); ?>
                </p>

                <p style="font-size: 15px; color: #444; max-width: 600px; margin: 10px auto 30px;">
					<?php echo esc_html__('We’re offering a limited number of early-bird discounts to thank our free users. Lock in your savings now and be the first to access Pro features when it launches!', 'wp-maximum-upload-file-size'); ?>
                </p>

                <!-- Email Subscription Form -->
                <div style="display: flex; flex-direction: column; align-items: center; gap: 20px; max-width: 300px; margin: 0 auto;">
                    <form action="YOUR_MAILCHIMP_FORM_ACTION_URL_HERE" method="post" target="_blank" style="width: 100%;" novalidate>
                        <div style="display: flex; flex-direction: column; gap: 10px;">
                            <input type="email" name="EMAIL" required
                                   placeholder="<?php echo esc_attr__('Enter your email to book 50% OFF', 'wp-maximum-upload-file-size'); ?>"
                                   style="padding: 12px; font-size: 16px; width: 100%; border: 1px solid #ccc; border-radius: 5px;" />

                            <input type="submit" value="<?php echo esc_attr__('Book My Discount Now', 'wp-maximum-upload-file-size'); ?>"
                                   class="button button-primary"
                                   style="font-size: 16px; padding: 10px 20px;" />
                        </div>
                        <p style="font-size: 13px; color: #666; margin-top: 5px;">
							<?php echo esc_html__('No spam – we’ll only notify you once the Pro version is ready.', 'wp-maximum-upload-file-size'); ?>
                        </p>
                    </form>
                </div>
            </div>
            <!-- End Content Area -->

            <!-- Start Sidebar Area -->
            <div class="wmufs_admin_right_sidebar wmufs_card wmufs-col-4">
	            <?php include WMUFS_PLUGIN_PATH . 'admin/templates/class-wmufs-sidebar.php'; ?>
            </div>
            <!-- End Sidebar area -->

        </div> <!-- End Row -->
    </div>
</div> <!-- End Wrapper -->
